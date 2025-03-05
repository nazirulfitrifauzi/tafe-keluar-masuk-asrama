<?php

namespace App\Livewire\Notes\Amali;

use App\Models\Note;
use App\Models\Chapter;
use Livewire\Component;

class User extends Component
{
    public $chapters = [];
    public $notes = [];
    public $activeChapter = null;
    public $activeNote = null;
    public $activeLink = null;

    public function mount()
    {
        // Get all unique chapters from notes that have links
        $this->chapters = Note::query()
            ->select('chapters.name')
            ->join('chapters', 'notes.chapter_id', '=', 'chapters.id')
            ->amali()
            ->whereNotNull('link')
            ->distinct()
            ->orderBy('chapters.name')
            ->pluck('chapters.name')
            ->toArray();
        
        // Set active chapter to the first one if available
        if (count($this->chapters) > 0) {
            $this->setActiveChapter($this->chapters[0]);
        }
    }

    public function setActiveChapter($chapterName)
    {
        $this->activeChapter = $chapterName;
        
        // Get notes for the selected chapter
        $this->notes = Note::with(['title'])
            ->select('notes.*')
            ->join('chapters', 'notes.chapter_id', '=', 'chapters.id')
            ->join('titles', 'notes.title_id', '=', 'titles.id')
            ->where('chapters.name', $chapterName)
            ->amali()
            ->whereNotNull('link')
            ->orderBy('titles.name')
            ->get();
            
        $this->activeNote = null;
        $this->activeLink = null;
    }

    public function setActiveNote($noteId)
    {
        $note = Note::find($noteId);
        if ($note) {
            $this->activeNote = $note->id;
            $this->activeLink = $note->link;
        }
    }

    public function render()
    {
        return view('livewire.notes.amali.user');
    }
}
