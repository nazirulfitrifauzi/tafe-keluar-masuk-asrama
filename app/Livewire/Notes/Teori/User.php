<?php

namespace App\Livewire\Notes\Teori;

use App\Models\Note;
use App\Models\Chapter;
use Livewire\Component;

class User extends Component
{
    public $chapters = [];
    public $notes = [];
    public $activeChapter = null;
    public $activeNote = null;

    public function mount()
    {
        // Get all unique chapters from notes that have documents
        $this->chapters = Note::query()
            ->select('chapters.name')
            ->join('chapters', 'notes.chapter_id', '=', 'chapters.id')
            ->theory()
            ->whereNotNull('doc_path')
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
            ->theory()
            ->whereNotNull('doc_path')
            ->orderBy('titles.name')
            ->get();
            
        $this->activeNote = null;
    }

    public function setActiveNote($noteId)
    {
        $this->activeNote = $noteId;
    }

    public function render()
    {
        return view('livewire.notes.teori.user');
    }
}
