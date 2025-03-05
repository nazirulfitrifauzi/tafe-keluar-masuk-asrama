<div class="container flex flex-col px-6 pb-4 mx-auto h-full min-h-0">
    <!-- Page Title -->
    <div class="my-6">
        <h1 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Gallery
        </h1>
    </div>

    <!-- Main Content -->
    <div class="flex flex-col flex-1 p-6 min-h-0 bg-white rounded-md shadow-md">
        @if($isAdmin)
            <!-- Admin Layout: Side by Side -->
            <div class="flex flex-col gap-8 mb-8 md:flex-row">
                <!-- Upload Form -->
                <div class="w-full md:w-1/3">
                    <h2 class="mb-4 text-xl font-semibold">Upload New Image</h2>
                    
                    <div class="p-6 bg-gray-50 rounded-lg">
                        <form wire:submit.prevent="save" class="space-y-6">
                            <!-- Image Name -->
                            <div>
                                <x-input 
                                    label="Image Name" 
                                    placeholder="Enter a name for this image" 
                                    wire:model="name"
                                />
                                @error('name') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                            </div>
                            
                            <!-- Image Upload -->
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Image</label>
                                <div class="flex justify-center items-center px-6 py-4 rounded-md border-2 border-gray-300 border-dashed">
                                    <div class="space-y-1 text-center">
                                        @if($image)
                                            <div class="mb-4">
                                                <img src="{{ $image->temporaryUrl() }}" class="object-cover mx-auto w-auto h-48 rounded">
                                                <button type="button" wire:click="$set('image', null)" class="mt-2 text-sm text-red-600 hover:text-red-800">
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
                                                    <input id="file-upload" wire:model="image" type="file" class="sr-only" accept="image/*">
                                                </label>
                                            </div>
                                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 5MB</p>
                                        @endif
                                    </div>
                                </div>
                                @error('image') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                            </div>
                            
                            <div class="flex justify-end">
                                <x-button primary type="submit" label="Upload Image" />
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Gallery Preview for Admin -->
                <div class="w-full md:w-2/3">
                    <h2 class="mb-4 text-xl font-semibold">Gallery Images</h2>
                    <div class="overflow-auto max-h-[600px]">
                        @if(count($images) > 0)
                            <div class="masonry-grid">
                                @foreach($images as $image)
                                    <div class="overflow-hidden relative rounded-lg shadow-md transition-shadow duration-300 masonry-item group hover:shadow-lg">
                                        <img 
                                            src="{{ Storage::url($image->image_path) }}" 
                                            alt="{{ $image->name }}" 
                                            class="w-full h-auto cursor-pointer"
                                            wire:click="viewImage({{ $image->id }})"
                                            loading="lazy"
                                        >
                                        <div class="flex absolute inset-0 flex-col justify-between p-4 bg-gradient-to-t to-transparent opacity-0 transition-opacity duration-300 from-black/70 group-hover:opacity-100">
                                            <div class="flex justify-end">
                                                <button 
                                                    wire:click.stop="confirmDelete({{ $image->id }})" 
                                                    class="p-1 text-white bg-red-600 rounded-full hover:bg-red-700"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="font-medium text-white">{{ $image->name }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="flex flex-col justify-center items-center py-12 text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mb-4 w-16 h-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="text-xl">No images in the gallery yet.</p>
                                <p class="mt-2">Upload some images to get started!</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @else
            <!-- User Gallery Display -->
            <div class="overflow-auto flex-1 min-h-0">
                @if(count($images) > 0)
                    <div class="masonry-grid">
                        @foreach($images as $image)
                            <div class="overflow-hidden relative rounded-lg shadow-md transition-shadow duration-300 masonry-item group hover:shadow-lg">
                                <img 
                                    src="{{ Storage::url($image->image_path) }}" 
                                    alt="{{ $image->name }}" 
                                    class="w-full h-auto cursor-pointer"
                                    wire:click="viewImage({{ $image->id }})"
                                    loading="lazy"
                                >
                                <div class="flex absolute inset-0 flex-col justify-between p-4 bg-gradient-to-t to-transparent opacity-0 transition-opacity duration-300 from-black/70 group-hover:opacity-100">
                                    <div class="flex-grow"></div>
                                    <div class="font-medium text-white">{{ $image->name }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="flex flex-col justify-center items-center py-12 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mb-4 w-16 h-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <p class="text-xl">No images in the gallery yet.</p>
                    </div>
                @endif
            </div>
        @endif
    </div>
    
    <!-- Image View Modal -->
    <x-dialog wire:model="showImageModal" class="bg-black">
        <div class="flex fixed inset-0 z-50 justify-center items-center">
            <!-- Close button -->
            <button 
                wire:click="closeImageModal"
                class="absolute top-4 right-4 z-[60] p-2 text-white rounded-full transition-colors bg-black/50 hover:bg-black/70"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            @if($selectedImage)
                <div class="flex flex-col items-center w-full h-full">
                    <div class="relative w-full h-[85vh] flex items-center justify-center">
                        <img 
                            src="{{ Storage::url($selectedImage->image_path) }}" 
                            alt="{{ $selectedImage->name }}" 
                            class="max-w-[90vw] max-h-[85vh] object-contain"
                        >
                    </div>
                    <div class="py-4 text-lg font-medium text-center text-white">
                        {{ $selectedImage->name }}
                    </div>
                </div>
            @endif
        </div>
    </x-dialog>

    <!-- Masonry Layout CSS -->
    <style>
        .masonry-grid {
            width: 100%;
        }
        
        .masonry-item {
            width: 100%;
            padding-bottom: 10px;
        }
        
        @media (min-width: 640px) {
            .masonry-item {
                width: calc(50% - 10px);
            }
        }
        
        @media (min-width: 768px) {
            .masonry-item {
                width: calc(33.333% - 10px);
            }
        }
        
        @media (min-width: 1024px) {
            .masonry-item {
                width: calc(25% - 12px);
            }
        }
    </style>

    <!-- Masonry JS -->
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
    <script src="https://unpkg.com/imagesloaded@5/imagesloaded.pkgd.min.js"></script>
    <script>
        document.addEventListener('livewire:initialized', function () {
            initMasonry();
            
            // Re-initialize masonry when Livewire updates
            Livewire.hook('morph.updated', () => {
                initMasonry();
            });
        });
        
        function initMasonry() {
            const grids = document.querySelectorAll('.masonry-grid');
            
            grids.forEach(grid => {
                // Wait for images to load before initializing masonry
                imagesLoaded(grid, function() {
                    new Masonry(grid, {
                        itemSelector: '.masonry-item',
                        percentPosition: true,
                        columnWidth: '.masonry-item',
                        gutter: 16,
                        horizontalOrder: true,
                        transitionDuration: '0.3s'
                    });
                });
            });
        }
    </script>
</div>
