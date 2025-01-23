<div class="container flex flex-col px-6 pb-4 mx-auto h-full min-h-0">
    <h1 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Record for today ({{ now()->format('d/m/Y') }})
    </h1>

    {{-- card container for tabs --}}
    <div class="flex flex-col flex-1 p-4 min-h-0 bg-white rounded-md shadow-md">
        <div x-data="{ tab: 'outgoing' }">
            <div class="hidden sm:block">
                <div class="border-b border-gray-200">
                    <nav class="flex -mb-px space-x-8" aria-label="Tabs">
                        <a href="#" :class="tab === 'outgoing' ? 'border-red-500 text-red-600' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700'" @click.prevent="tab = 'outgoing'" class="px-1 py-4 text-sm font-medium whitespace-nowrap border-b-2">Outgoing</a>
                        <a href="#" :class="tab === 'incoming' ? 'border-red-500 text-red-600' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700'" @click.prevent="tab = 'incoming'" class="px-1 py-4 text-sm font-medium whitespace-nowrap border-b-2">Incoming</a>
                    </nav>
                </div>
            </div>

                <div x-show="tab === 'outgoing'" class="mt-4" style="display: none;">
                    <livewire:record.outgoing />
                </div>
                <div x-show="tab === 'incoming'" class="mt-4">
                    <livewire:record.incoming />
                </div>
            </div>
        </div>
    </div>
    {{-- end of card container --}}
</div>