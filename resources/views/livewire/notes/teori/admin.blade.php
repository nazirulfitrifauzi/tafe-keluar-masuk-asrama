<div class="flex flex-col p-6 h-full">
    <!-- Notes Table -->
    <div>
        <!-- Header with Title and Add Button -->
        <div class="flex justify-between items-center mb-4">
            <div>
                <h2 class="text-lg font-medium text-gray-900">Theory Notes</h2>
                <p class="text-sm text-gray-500">
                    Total: {{ $notes->flatten()->count() }} {{ Str::plural('note', $notes->flatten()->count()) }} in {{ $notes->count() }} {{ Str::plural('chapter', $notes->count()) }}
                </p>
            </div>
            <x-button 
                primary
                label="Add New Note" 
                icon="plus"
                wire:click="openModal" 
            />
        </div>
        
        <div class="flex flex-col">
            <div class="overflow-x-auto">
                <div class="inline-block w-full align-middle">
                    <div class="overflow-hidden rounded-lg border border-gray-200 ring-1 ring-black ring-opacity-5 shadow">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="py-3.5 pr-3 pl-4 text-sm font-semibold text-left text-gray-900 sm:pl-6">Chapter</th>
                                    <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-left text-gray-900">Title</th>
                                    <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-left text-gray-900">Document</th>
                                    <th scope="col" class="relative py-3.5 pr-4 pl-3 w-24 sm:pr-6">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($notes as $chapter => $chapterNotes)
                                    <!-- Chapter Header Row -->
                                    <tr class="bg-purple-50">
                                        <td colspan="4" class="px-4 py-2 text-sm font-bold text-purple-800">
                                            Chapter: {{ $chapter }} <span class="ml-2 text-xs text-purple-600">({{ $chapterNotes->count() }} {{ Str::plural('note', $chapterNotes->count()) }})</span>
                                        </td>
                                    </tr>
                                    
                                    <!-- Notes for this chapter -->
                                    @foreach ($chapterNotes as $note)
                                        <tr>
                                            <td class="py-4 pr-3 pl-8 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-10">
                                                <!-- Indented to show it belongs to the chapter above -->
                                            </td>
                                            <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $note->title->name }}</td>
                                            <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                <a href="{{ Storage::url($note->doc_path) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900">Download</a>
                                            </td>
                                            <td class="relative py-4 pr-4 pl-3 text-sm font-medium text-right whitespace-nowrap sm:pr-6">
                                                <x-button icon="pencil" primary wire:click="edit({{ $note->id }})" size="sm" />
                                                <x-button icon="trash" negative wire:click="confirmDelete({{ $note->id }})" size="sm" />
                                            </td>
                                        </tr>
                                    @endforeach
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-4 pr-3 pl-4 text-sm font-medium text-center text-gray-900 whitespace-nowrap sm:pl-6">No notes found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Modal -->
    <x-modal wire:model.defer="showModal" align="center" blur="md" max-width="4xl">
        <x-card title="{{ $isEditing ? 'Edit Note' : 'Add New Note' }}" class="w-full min-w-[600px]">
            <div class="space-y-4">
                <!-- Chapter Selection -->
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Chapter Selection</label>
                    <div class="flex items-center space-x-4">
                        <label class="flex items-center">
                            <input type="radio" value="0" wire:model.live="addNewChapter" class="w-4 h-4 text-purple-600 form-radio">
                            <span class="ml-2 text-sm text-gray-700">Select Existing</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" value="1" wire:model.live="addNewChapter" class="w-4 h-4 text-purple-600 form-radio">
                            <span class="ml-2 text-sm text-gray-700">Add New</span>
                        </label>
                    </div>
                    
                    @if(!$addNewChapter)
                        <div class="mt-2">
                            <x-native-select
                                label="Select Chapter"
                                placeholder="Choose an existing chapter"
                                :options="$existingChapters"
                                option-label="name"
                                option-value="id"
                                wire:model.defer="selectedChapter"
                            />
                            @error('selectedChapter') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>
                    @else
                        <div class="mt-2">
                            <x-input 
                                label="New Chapter" 
                                placeholder="Enter chapter number or name" 
                                wire:model.defer="chapter"
                            />
                            @error('chapter') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>
                    @endif
                </div>

                <!-- Title Selection -->
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Title Selection</label>
                    <div class="flex items-center space-x-4">
                        <label class="flex items-center">
                            <input type="radio" value="0" wire:model.live="addNewTitle" class="w-4 h-4 text-purple-600 form-radio">
                            <span class="ml-2 text-sm text-gray-700">Select Existing</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" value="1" wire:model.live="addNewTitle" class="w-4 h-4 text-purple-600 form-radio">
                            <span class="ml-2 text-sm text-gray-700">Add New</span>
                        </label>
                    </div>
                    
                    @if(!$addNewTitle)
                        <div class="mt-2">
                            <x-native-select
                                label="Select Title"
                                placeholder="Choose an existing title"
                                :options="$existingTitles"
                                option-label="name"
                                option-value="id"
                                wire:model.defer="selectedTitle"
                            />
                            @error('selectedTitle') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>
                    @else
                        <div class="mt-2">
                            <x-input 
                                label="New Title" 
                                placeholder="Enter title" 
                                wire:model.defer="title"
                            />
                            @error('title') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>
                    @endif
                </div>

                <!-- Document Upload -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Document</label>
                    <div class="mt-1">
                        <input type="file" wire:model="document" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100"/>
                        <div wire:loading wire:target="document" class="mt-1 text-sm text-purple-600">
                            Uploading...
                        </div>
                        @error('document') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <x-slot name="footer">
                <div class="flex gap-x-4 justify-end">
                    <x-button flat label="Cancel" wire:click="closeModal" />
                    <x-button primary label="Save" wire:click="save" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>

    <!-- Delete Confirmation Modal -->
    <x-dialog id="confirmDeleteModal" title="Confirm Deletion" />
</div>