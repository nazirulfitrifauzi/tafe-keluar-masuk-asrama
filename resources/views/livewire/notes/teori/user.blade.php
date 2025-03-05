<div class="flex flex-col min-h-screen bg-gradient-to-br from-purple-50 to-purple-100">
    <!-- Chapter Tabs -->
    <div class="bg-white shadow-md">
        <div class="overflow-x-auto">
            <div class="flex p-2 space-x-1">
                @forelse($chapters as $chapter)
                    <button 
                        wire:click="setActiveChapter('{{ $chapter }}')" 
                        class="px-4 py-2 text-sm font-medium rounded-t-lg transition-colors duration-200 
                        {{ $activeChapter === $chapter 
                            ? 'bg-purple-600 text-white' 
                            : 'bg-purple-100 text-purple-700 hover:bg-purple-200' }}"
                    >
                        {{ $chapter }}
                    </button>
                @empty
                    <div class="px-4 py-2 text-sm text-gray-500">No chapters available</div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Content Area -->
    <div class="flex overflow-hidden flex-1">
        <!-- Notes List -->
        <div class="overflow-y-auto p-4 w-full bg-white border-r border-gray-200">
            <h2 class="mb-4 text-lg font-semibold text-purple-800">
                {{ $activeChapter ? "Chapter: $activeChapter" : "Select a chapter" }}
            </h2>
            
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                @forelse($notes as $note)
                    <div class="p-4 bg-white rounded-lg border border-gray-200 shadow-md transition-shadow duration-200 hover:shadow-lg">
                        <h3 class="mb-2 text-lg font-medium text-gray-900">{{ $note->title->name }}</h3>
                        <a 
                            href="{{ Storage::url($note->doc_path) }}" 
                            target="_blank"
                            class="inline-flex items-center px-4 py-2 text-white bg-purple-600 rounded-md transition-colors duration-200 hover:bg-purple-700"
                        >
                            <svg class="mr-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                            Download
                        </a>
                    </div>
                @empty
                    <div class="col-span-full text-center text-gray-500">
                        No notes available for this chapter
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
