<div class="container flex flex-col px-6 pb-4 mx-auto h-full min-h-0">
    <!-- Static top area (title) -->
    <div class="my-6">
        <h1 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Pop Quiz
        </h1>
    </div>

    <!-- Main content area (fills leftover space) -->
    <div class="flex flex-col flex-1 p-6 min-h-0 bg-white rounded-md shadow-md">
        @if($showAdminPanel)
            <!-- Admin Interface -->
            <div class="flex flex-col h-full min-h-0">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold">Manage Quiz Questions</h2>
                    <x-button primary label="Add Question" icon="plus" wire:click="createQuestion" />
                </div>
                
                <div class="overflow-auto flex-1 min-h-0">
                    @if(count($questions) > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Question</th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Image</th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Answers</th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($questions as $question)
                                        <tr>
                                            <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                                                {{ $question->question }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                @if($question->image_path)
                                                    <img src="{{ Storage::url($question->image_path) }}" alt="Question Image" class="w-auto h-10">
                                                @else
                                                    No image
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                <ul class="pl-5 list-disc">
                                                    @foreach($question->answers as $answer)
                                                        <li class="{{ $answer->is_correct ? 'font-bold text-green-600' : '' }}">
                                                            {{ $answer->answer_text }}
                                                            @if($answer->is_correct)
                                                                <span class="ml-1 text-xs">(correct)</span>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                                <x-button primary icon="pencil" wire:click="editQuestion({{ $question->id }})" class="mr-2" size="sm" />
                                                <x-button negative icon="trash" wire:click="deleteQuestion({{ $question->id }})" size="sm" />
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="py-8 text-center text-gray-500">
                            No questions added yet. Click "Add Question" to create your first quiz question.
                        </div>
                    @endif
                </div>
            </div>
        @else
            <!-- User Interface -->
            <div class="flex flex-col h-full min-h-0">
                <!-- Quiz Progress -->
                <div class="flex justify-between items-center mb-6">
                    <div class="text-sm font-medium">
                        Question {{ $currentQuestionIndex + 1 }} of {{ count($userQuestions) }}
                    </div>
                    <div class="flex space-x-4">
                        <div class="flex items-center">
                            <span class="inline-flex justify-center items-center mr-2 w-6 h-6 text-green-800 bg-green-100 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </span>
                            <span>{{ $correctCount }} Correct</span>
                        </div>
                        <div class="flex items-center">
                            <span class="inline-flex justify-center items-center mr-2 w-6 h-6 text-red-800 bg-red-100 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </span>
                            <span>{{ $wrongCount }} Wrong</span>
                        </div>
                    </div>
                </div>
                
                <div class="overflow-auto flex-1 min-h-0">
                    @if(count($userQuestions) > 0)
                        <div class="flex flex-col h-full">
                            <!-- Question with side-by-side layout -->
                            <div class="flex flex-col gap-6 mb-6 md:flex-row">
                                <!-- Question Image (if any) - Left side -->
                                @if($userQuestions[$currentQuestionIndex]->image_path)
                                    <div class="flex justify-center md:w-1/3">
                                        <img src="{{ Storage::url($userQuestions[$currentQuestionIndex]->image_path) }}" 
                                            alt="Question Image" 
                                            class="object-contain max-w-full h-auto max-h-60 rounded-lg">
                                    </div>
                                @endif
                                
                                <!-- Question Text and Answers - Right side (or full width if no image) -->
                                <div class="{{ $userQuestions[$currentQuestionIndex]->image_path ? 'md:w-2/3' : 'w-full' }}">
                                    <!-- Question -->
                                    <h2 class="mb-4 text-xl font-semibold">{{ $userQuestions[$currentQuestionIndex]->question }}</h2>
                                    
                                    <!-- Answer Options -->
                                    <div class="mt-4 space-y-3">
                                        @foreach($userQuestions[$currentQuestionIndex]->answers as $answer)
                                            <button 
                                                wire:click="selectAnswer({{ $answer->id }})"
                                                class="w-full text-left p-4 rounded-lg border transition-colors duration-200 
                                                    {{ $selectedAnswer == $answer->id ? 'bg-purple-100 border-purple-500' : 'bg-white border-gray-300 hover:bg-gray-50' }}
                                                    {{ $isAnswered && $answer->is_correct ? 'bg-green-100 border-green-500' : '' }}
                                                    {{ $isAnswered && $selectedAnswer == $answer->id && !$isCorrect ? 'bg-red-100 border-red-500' : '' }}"
                                                {{ $isAnswered ? 'disabled' : '' }}
                                            >
                                                {{ $answer->answer_text }}
                                                
                                                @if($isAnswered)
                                                    @if($selectedAnswer == $answer->id && $isCorrect)
                                                        <span class="float-right text-green-600">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                            </svg>
                                                        </span>
                                                    @elseif($selectedAnswer == $answer->id && !$isCorrect)
                                                        <span class="float-right text-red-600">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                            </svg>
                                                        </span>
                                                    @elseif($answer->is_correct && !$isCorrect)
                                                        <span class="float-right text-green-600">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                            </svg>
                                                        </span>
                                                    @endif
                                                @endif
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Navigation Buttons -->
                            <div class="flex justify-end mt-8">
                                @if(!$isAnswered && $selectedAnswer !== null)
                                    <x-button 
                                        primary 
                                        label="Submit Answer" 
                                        wire:click="submitAnswer" 
                                    />
                                @endif
                                
                                @if($isAnswered && $currentQuestionIndex < count($userQuestions) - 1)
                                    <x-button 
                                        primary 
                                        label="Next Question" 
                                        wire:click="nextQuestion" 
                                        icon="arrow-right"
                                        icon-right
                                    />
                                @endif
                                
                                @if($isAnswered && $currentQuestionIndex >= count($userQuestions) - 1)
                                    <x-button 
                                        positive 
                                        label="Complete Quiz" 
                                        wire:click="completeQuiz" 
                                        icon="check"
                                    />
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="py-8 text-center text-gray-500">
                            No quiz questions available. Please check back later.
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>

    <!-- Question Form Modal -->
    <x-modal wire:model.defer="showQuestionForm" max-width="4xl" align="center">
        <x-card title="{{ $questionId ? 'Edit Question' : 'Add New Question' }}" class="w-full min-w-[600px]">
            <div class="space-y-6">
                <!-- Question Text -->
                <div>
                    <x-input 
                        label="Question" 
                        placeholder="Enter your question here" 
                        wire:model.defer="questionText"
                    />
                    @error('questionText') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>
                
                <!-- Question Image -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Question Image (optional)</label>
                    <div class="flex justify-center items-center px-6 py-4 rounded-md border-2 border-gray-300 border-dashed">
                        <div class="space-y-1 text-center">
                            @if($questionImage)
                                <div class="mb-4">
                                    <img src="{{ $questionImage->temporaryUrl() }}" class="object-cover mx-auto w-auto h-48 rounded">
                                    <button type="button" wire:click="$set('questionImage', null)" class="mt-2 text-sm text-red-600 hover:text-red-800">
                                        Remove Image
                                    </button>
                                </div>
                            @else
                                <svg class="mx-auto w-12 h-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex justify-center text-sm text-gray-600">
                                    <label for="file-upload" class="relative font-medium text-purple-600 bg-white rounded-md cursor-pointer hover:text-purple-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-purple-500">
                                        <span>Upload an image</span>
                                        <input id="file-upload" wire:model="questionImage" type="file" class="sr-only" accept="image/*">
                                    </label>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF up to 1MB</p>
                            @endif
                        </div>
                    </div>
                    @error('questionImage') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>
                
                <!-- Answers -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Answers (select one correct answer)</label>
                    @error('answers') <span class="block mb-2 text-sm text-red-500">{{ $message }}</span> @enderror
                    
                    @foreach($answers as $index => $answer)
                        <div class="flex items-center mb-3 space-x-3">
                            <div class="flex-grow">
                                <x-input 
                                    placeholder="Answer option {{ $index + 1 }}" 
                                    wire:model.defer="answers.{{ $index }}.text"
                                />
                                @error("answers.$index.text") <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div class="flex items-center">
                                <input 
                                    type="radio" 
                                    name="correct_answer" 
                                    wire:model.defer="correctAnswerIndex" 
                                    value="{{ $index }}"
                                    class="w-4 h-4 text-purple-600 rounded-full border-gray-300 focus:ring-purple-500"
                                >
                                <span class="ml-2 text-sm text-gray-700">Correct</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <x-slot name="footer">
                <div class="flex justify-end space-x-2">
                    <x-button flat label="Cancel" wire:click="cancelQuestionForm" />
                    <x-button primary label="Save" wire:click="saveQuestion" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>

    <!-- Quiz Completion Modal -->
    <x-modal wire:model.defer="showCompletionModal" max-width="md" align="center">
        <x-card class="text-center border-0">
            <div class="relative px-4 pt-8 pb-6">
                <!-- Trophy icon -->
                <div class="relative mx-auto mb-6 w-20 h-20">
                    <div class="absolute inset-0 bg-yellow-100 rounded-full opacity-50"></div>
                    <div class="flex relative z-10 justify-center items-center w-full h-full">
                        <x-icon name="trophy" class="w-16 h-16 text-yellow-500" />
                    </div>
                </div>
                
                <h3 class="mb-4 text-2xl font-bold text-purple-800">Quiz Completed!</h3>
                
                <p class="mb-4 text-lg">
                    You answered <span class="font-bold text-green-600">{{ $correctCount }}</span> out of <span class="font-bold">{{ count($userQuestions) }}</span> questions correctly.
                </p>
                
                <!-- Score progress bar -->
                <div class="flex justify-center items-center my-6">
                    <div class="overflow-hidden relative w-full max-w-xs h-8 bg-gray-200 rounded-full">
                        @php
                            $percentage = count($userQuestions) > 0 ? ($correctCount / count($userQuestions)) * 100 : 0;
                            $color = $percentage >= 80 ? 'bg-green-500' : ($percentage >= 60 ? 'bg-yellow-500' : 'bg-red-500');
                        @endphp
                        <div class="absolute top-0 left-0 h-full {{ $color }}" style="width: {{ $percentage }}%"></div>
                        <div class="flex absolute inset-0 justify-center items-center text-sm font-medium text-white">
                            {{ round($percentage) }}% Score
                        </div>
                    </div>
                </div>
                
                <!-- Feedback message -->
                <p class="font-medium text-purple-600">
                    @if($percentage >= 80)
                        Excellent work! You've mastered this topic!
                    @elseif($percentage >= 60)
                        Good job! Keep practicing to improve your score.
                    @else
                        Keep learning! You'll do better next time.
                    @endif
                </p>
            </div>
            
            <x-slot name="footer">
                <div class="flex justify-center">
                    <x-button primary label="Try Again" wire:click="restartQuiz" class="px-8 py-2 text-base" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>

    <!-- Confetti Script -->
    <script>
        document.addEventListener('livewire:initialized', function() {
            @this.on('quiz-completed', function() {
                confetti({
                    particleCount: 150,
                    spread: 70,
                    origin: { y: 0.6 },
                    colors: ['#9333ea', '#4f46e5', '#06b6d4', '#10b981', '#f59e0b']
                });
            });
        });
    </script>
</div>
