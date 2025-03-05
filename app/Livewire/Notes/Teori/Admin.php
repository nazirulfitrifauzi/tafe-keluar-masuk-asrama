<?php

namespace App\Livewire\Notes\Teori;

use App\Models\Chapter;
use App\Models\Note;
use App\Models\Title;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\WireUiActions;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;

class Admin extends Component
{
    use WithPagination;
    use WireUiActions;
    use WithFileUploads;

    public $chapter = '';
    public $title = '';
    public $document;
    public $doc_path;
    
    public $editingNoteId = null;
    public $isEditing = false;
    public $noteToDelete = null;
    
    // Modal state
    public $showModal = false;
    
    // For chapter selection
    public $existingChapters = [];
    public $addNewChapter = false;
    public $selectedChapter = null;
    
    // For title selection
    public $existingTitles = [];
    public $addNewTitle = false;
    public $selectedTitle = null;

    protected function rules()
    {
        return [
            'title' => $this->addNewTitle ? 'required|string|max:255' : 'nullable|string|max:255',
            'selectedTitle' => !$this->addNewTitle ? 'required' : 'nullable',
            'document' => $this->isEditing ? 'nullable|file|mimes:pdf,doc,docx|max:10240' : 'required|file|mimes:pdf,doc,docx|max:10240',
            'chapter' => $this->addNewChapter ? 'required|string|max:255' : 'nullable|string|max:255',
            'selectedChapter' => !$this->addNewChapter ? 'required' : 'nullable',
        ];
    }

    public function mount()
    {
        $this->loadExistingChapters();
        $this->loadExistingTitles();
    }

    public function loadExistingChapters()
    {
        $chapters = Chapter::orderBy('name')->get();
        $this->existingChapters = $chapters->map(function ($chapter) {
            return [
                'id' => $chapter->id,
                'name' => $chapter->name
            ];
        })->toArray();
    }

    public function loadExistingTitles()
    {
        $titles = Title::orderBy('name')->get();
        $this->existingTitles = $titles->map(function ($title) {
            return [
                'id' => $title->id,
                'name' => $title->name
            ];
        })->toArray();
    }

    public function render()
    {
        // Get notes with relationships, grouped by chapter
        $notes = Note::with(['chapter', 'title'])
            ->theory()
            ->get()
            ->groupBy(function($note) {
                return $note->chapter ? $note->chapter->name : 'Uncategorized';
            });
            
        return view('livewire.notes.teori.admin', compact('notes'));
    }
    
    public function openModal()
    {
        $this->resetForm();
        $this->showModal = true;
    }
    
    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }
    
    public function save()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            // Handle chapter
            $chapterId = null;
            if ($this->addNewChapter) {
                $chapter = Chapter::create(['name' => $this->chapter]);
                $chapterId = $chapter->id;
                $this->loadExistingChapters();
            } else {
                $chapterId = (int) $this->selectedChapter;
            }

            // Handle title
            $titleId = null;
            if ($this->addNewTitle) {
                $title = Title::create(['name' => $this->title]);
                $titleId = $title->id;
                $this->loadExistingTitles();
            } else {
                $titleId = (int) $this->selectedTitle;
            }

            // Handle document upload
            if ($this->document) {
                $path = $this->document->store('theory-notes', 'public');
            } else {
                $path = $this->doc_path;
            }

            if ($this->isEditing) {
                $note = Note::find($this->editingNoteId);
                
                // Delete old document if uploading new one
                if ($this->document && $note->doc_path) {
                    Storage::delete($note->doc_path);
                }
                
                $note->update([
                    'chapter_id' => $chapterId,
                    'title_id' => $titleId,
                    'doc_path' => $path,
                    'type' => 'theory'
                ]);
                
                $this->notification()->success(
                    $title = 'Note Updated',
                    $description = 'The note has been updated successfully.'
                );
            } else {
                Note::create([
                    'chapter_id' => $chapterId,
                    'title_id' => $titleId,
                    'doc_path' => $path,
                    'type' => 'theory'
                ]);
                
                $this->notification()->success(
                    $title = 'Note Added',
                    $description = 'The note has been added successfully.'
                );
            }
            
            DB::commit();
            $this->closeModal();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->notification()->error(
                $title = 'Error',
                $description = 'Error saving note: ' . $e->getMessage()
            );
        }
    }
    
    public function edit($id)
    {
        $this->isEditing = true;
        $this->editingNoteId = $id;
        
        $note = Note::with(['chapter', 'title'])->find($id);
        
        // Set chapter data
        if ($note->chapter) {
            if (collect($this->existingChapters)->contains('id', $note->chapter_id)) {
                $this->selectedChapter = $note->chapter_id;
                $this->addNewChapter = false;
            } else {
                $this->chapter = $note->chapter->name;
                $this->addNewChapter = true;
            }
        }
        
        // Set title data
        if ($note->title) {
            if (collect($this->existingTitles)->contains('id', $note->title_id)) {
                $this->selectedTitle = $note->title_id;
                $this->addNewTitle = false;
            } else {
                $this->title = $note->title->name;
                $this->addNewTitle = true;
            }
        }
        
        $this->doc_path = $note->doc_path;
        $this->openModal();
    }
    
    public function confirmDelete($id)
    {
        $this->noteToDelete = $id;
        
        $this->dialog()->confirm([
            'title' => 'Are you sure?',
            'description' => 'This action cannot be undone.',
            'icon' => 'question',
            'accept' => [
                'label' => 'Yes, delete it',
                'method' => 'delete',
                'params' => $id,
                'color' => 'negative'
            ],
            'reject' => [
                'label' => 'No, cancel',
            ]
        ]);
    }
    
    public function delete($id)
    {
        $note = Note::find($id);
        if ($note) {
            if ($note->doc_path) {
                Storage::delete($note->doc_path);
            }
            $note->delete();
        }
        
        $this->notification()->success(
            $title = 'Success!',
            $description = 'Note deleted successfully!'
        );
        
        // Refresh the chapters list as we might have deleted the last note in a chapter
        $this->loadExistingChapters();
    }
    
    public function resetForm()
    {
        $this->reset([
            'chapter', 
            'title', 
            'document',
            'doc_path',
            'editingNoteId', 
            'isEditing', 
            'selectedChapter',
            'selectedTitle',
            'addNewChapter',
            'addNewTitle'
        ]);
        $this->resetValidation();
    }

    public function updatedAddNewChapter($value)
    {
        if ($value == 0) {
            $this->chapter = '';
            if (count($this->existingChapters) > 0) {
                $firstChapter = collect($this->existingChapters)->first();
                $this->selectedChapter = $firstChapter['id'];
            }
        } else {
            if ($this->selectedChapter) {
                $chapter = collect($this->existingChapters)->firstWhere('id', $this->selectedChapter);
                if ($chapter) {
                    $this->chapter = $chapter['name'];
                }
            }
            $this->selectedChapter = null;
        }
    }

    public function updatedAddNewTitle($value)
    {
        if ($value == 0) {
            $this->title = '';
            if (count($this->existingTitles) > 0) {
                $firstTitle = collect($this->existingTitles)->first();
                $this->selectedTitle = $firstTitle['id'];
            }
        } else {
            if ($this->selectedTitle) {
                $title = collect($this->existingTitles)->firstWhere('id', $this->selectedTitle);
                if ($title) {
                    $this->title = $title['name'];
                }
            }
            $this->selectedTitle = null;
        }
    }

    #[On('chapter-created')]
    public function handleNewChapter()
    {
        $this->loadExistingChapters();
    }

    #[On('title-created')]
    public function handleNewTitle()
    {
        $this->loadExistingTitles();
    }
}