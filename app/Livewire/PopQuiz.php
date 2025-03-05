<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizAnswer;
use Illuminate\Support\Facades\Auth;

class PopQuiz extends Component
{
    use WithFileUploads;
    
    // Admin properties
    public $showAdminPanel = false;
    public $questions = [];
    public $currentAdminQuestion = null;
    
    // Question form properties
    public $questionId = null;
    public $questionText = '';
    public $questionImage = null;
    public $answers = [
        ['text' => '', 'is_correct' => false],
        ['text' => '', 'is_correct' => false],
        ['text' => '', 'is_correct' => false]
    ];
    public $correctAnswerIndex = 0; // Default first answer as correct
    public $showQuestionForm = false;
    
    // User properties
    public $userQuestions = [];
    public $currentQuestionIndex = 0;
    public $selectedAnswer = null;
    public $isAnswered = false;
    public $isCorrect = false;
    public $correctCount = 0;
    public $wrongCount = 0;
    public $showCompletionModal = false;
    public $existingImagePath = null;
    
    public function mount()
    {
        // Check if user is admin
        $this->showAdminPanel = Auth::check() && Auth::user()->is_admin;
        
        if ($this->showAdminPanel) {
            $this->loadAdminQuestions();
        } else {
            $this->loadUserQuestions();
        }
    }
    
    // Admin methods
    public function loadAdminQuestions()
    {
        $this->questions = QuizQuestion::with('answers')->get();
    }
    
    public function createQuestion()
    {
        $this->resetQuestionForm();
        $this->showQuestionForm = true;
    }
    
    public function editQuestion($questionId)
    {
        $question = QuizQuestion::with('answers')->find($questionId);
        
        if ($question) {
            $this->questionId = $question->id;
            $this->questionText = $question->question;
            
            // Reset answers array
            $this->answers = [
                ['text' => '', 'is_correct' => false],
                ['text' => '', 'is_correct' => false],
                ['text' => '', 'is_correct' => false]
            ];
            
            // Fill in existing answers and find the correct one
            foreach ($question->answers as $index => $answer) {
                if ($index < 3) {
                    $this->answers[$index]['text'] = $answer->answer_text;
                    $this->answers[$index]['is_correct'] = $answer->is_correct;
                    
                    if ($answer->is_correct) {
                        $this->correctAnswerIndex = $index;
                    }
                }
            }
            
            $this->showQuestionForm = true;
        }
    }
    
    public function saveQuestion()
    {
        $this->validate([
            'questionText' => 'required|min:3',
            'questionImage' => 'nullable|image|max:1024',
            'answers.0.text' => 'required',
            'answers.1.text' => 'required',
            'answers.2.text' => 'required',
            'correctAnswerIndex' => 'required|integer|min:0|max:2',
        ]);
        
        // Create or update question
        if ($this->questionId) {
            $question = QuizQuestion::find($this->questionId);
        } else {
            $question = new QuizQuestion();
        }
        
        $question->question = $this->questionText;
        
        // Handle image upload
        if ($this->questionImage) {
            $imagePath = $this->questionImage->store('quiz-images', 'public');
            $question->image_path = $imagePath;
        }
        
        $question->save();
        
        // Save answers
        if ($this->questionId) {
            // Delete existing answers
            QuizAnswer::where('question_id', $this->questionId)->delete();
        }
        
        // Set the correct answer based on correctAnswerIndex
        foreach ($this->answers as $index => $answer) {
            QuizAnswer::create([
                'question_id' => $question->id,
                'answer_text' => $answer['text'],
                'is_correct' => ($index == $this->correctAnswerIndex)
            ]);
        }
        
        $this->resetQuestionForm();
        $this->loadAdminQuestions();
        $this->showQuestionForm = false;
    }
    
    public function deleteQuestion($questionId)
    {
        $question = QuizQuestion::find($questionId);
        if ($question) {
            // Delete associated answers
            QuizAnswer::where('question_id', $questionId)->delete();
            $question->delete();
            $this->loadAdminQuestions();
        }
    }
    
    public function resetQuestionForm()
    {
        $this->questionId = null;
        $this->questionText = '';
        $this->questionImage = null;
        $this->correctAnswerIndex = 0;
        $this->answers = [
            ['text' => '', 'is_correct' => false],
            ['text' => '', 'is_correct' => false],
            ['text' => '', 'is_correct' => false]
        ];
    }
    
    public function cancelQuestionForm()
    {
        $this->resetQuestionForm();
        $this->showQuestionForm = false;
    }
    
    // User methods
    public function loadUserQuestions()
    {
        $this->userQuestions = QuizQuestion::with('answers')
            ->inRandomOrder()
            ->take(5)
            ->get();
        
        $this->currentQuestionIndex = 0;
        $this->selectedAnswer = null;
        $this->isAnswered = false;
        $this->isCorrect = false;
        $this->correctCount = 0;
        $this->wrongCount = 0;
        $this->showCompletionModal = false;
    }
    
    public function selectAnswer($answerId)
    {
        if (!$this->isAnswered) {
            $this->selectedAnswer = $answerId;
        }
    }
    
    public function submitAnswer()
    {
        if ($this->selectedAnswer === null) {
            return;
        }

        $this->isAnswered = true;
        
        $answer = QuizAnswer::find($this->selectedAnswer);
        $this->isCorrect = $answer && $answer->is_correct;
        
        if ($this->isCorrect) {
            $this->correctCount++;
        } else {
            $this->wrongCount++;
        }
    }
    
    public function completeQuiz()
    {
        $this->showCompletionModal = true;
        $this->dispatch('quiz-completed');
    }
    
    public function nextQuestion()
    {
        if ($this->currentQuestionIndex < count($this->userQuestions) - 1) {
            $this->currentQuestionIndex++;
            $this->selectedAnswer = null;
            $this->isAnswered = false;
        }
    }
    
    public function restartQuiz()
    {
        $this->loadUserQuestions();
        $this->showCompletionModal = false;
    }
    
    public function render()
    {
        return view('livewire.pop-quiz')->extends('layouts.app');
    }
}
