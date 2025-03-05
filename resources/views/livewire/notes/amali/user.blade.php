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
        <div class="overflow-y-auto p-4 w-full bg-white border-r border-gray-200 md:w-1/3">
            <h2 class="mb-4 text-lg font-semibold text-purple-800">
                {{ $activeChapter ? "Chapter: $activeChapter" : "Select a chapter" }}
            </h2>
            
            <ul class="space-y-2">
                @forelse($notes as $note)
                    <li>
                        <button 
                            wire:click="setActiveNote({{ $note->id }})"
                            class="w-full text-left px-4 py-2 rounded-lg transition-colors duration-200
                            {{ $activeNote === $note->id 
                                ? 'bg-purple-600 text-white' 
                                : 'bg-white text-purple-700 hover:bg-purple-100' }}"
                        >
                            {{ $note->title->name }}
                        </button>
                    </li>
                @empty
                    <li class="px-4 py-2 text-gray-500">No notes available for this chapter</li>
                @endforelse
            </ul>
        </div>

        <!-- Content Viewer -->
        <div class="hidden p-4 bg-gray-100 md:block md:w-2/3">
            @if($activeLink)
                <div class="h-full bg-white rounded-lg shadow-md">
                    <a href="{{ $activeLink }}" target="_blank" class="block p-4 text-center text-purple-600 hover:text-purple-800">
                        Open in new window
                    </a>
                    <div class="h-[calc(100%-3rem)]">
                        @php
                            // Convert YouTube watch URLs to embed URLs
                            $embedLink = $activeLink;
                            if (strpos($activeLink, 'youtube.com/watch') !== false) {
                                $parts = parse_url($activeLink);
                                parse_str($parts['query'], $query);
                                if (isset($query['v'])) {
                                    $embedLink = "https://www.youtube.com/embed/" . $query['v'];
                                }
                            } else if (strpos($activeLink, 'youtu.be/') !== false) {
                                $parts = explode('/', $activeLink);
                                $videoId = end($parts);
                                $embedLink = "https://www.youtube.com/embed/" . $videoId;
                            }
                        @endphp
                        <iframe 
                            src="{{ $embedLink }}" 
                            class="w-full h-full rounded-lg"
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen
                        ></iframe>
                    </div>
                </div>
            @else
                <div class="flex justify-center items-center h-full bg-white rounded-lg shadow-md">
                    <p class="text-gray-500">Select a note to view its content</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Mobile Content Viewer (shows when a note is selected) -->
    @if($activeLink)
        <div class="p-4 h-96 bg-gray-100 md:hidden">
            <div class="h-full bg-white rounded-lg shadow-md">
                <a href="{{ $activeLink }}" target="_blank" class="block p-2 text-center text-purple-600 hover:text-purple-800">
                    Open in new window
                </a>
                <div class="h-[calc(100%-2.5rem)]">
                    @php
                        // Convert YouTube watch URLs to embed URLs
                        $embedLink = $activeLink;
                        if (strpos($activeLink, 'youtube.com/watch') !== false) {
                            $parts = parse_url($activeLink);
                            parse_str($parts['query'], $query);
                            if (isset($query['v'])) {
                                $embedLink = "https://www.youtube.com/embed/" . $query['v'];
                            }
                        } else if (strpos($activeLink, 'youtu.be/') !== false) {
                            $parts = explode('/', $activeLink);
                            $videoId = end($parts);
                            $embedLink = "https://www.youtube.com/embed/" . $videoId;
                        }
                    @endphp
                    <iframe 
                        src="{{ $embedLink }}" 
                        class="w-full h-full rounded-lg"
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen
                    ></iframe>
                </div>
            </div>
        </div>
    @endif
</div>
