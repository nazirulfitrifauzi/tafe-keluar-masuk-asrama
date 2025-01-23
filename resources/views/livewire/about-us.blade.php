<div class="container flex flex-col px-6 pb-4 mx-auto h-full min-h-0">
    <h1 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        About Us
    </h1>

    {{-- card container for tabs --}}
    <div class="flex flex-col flex-1 p-4 min-h-0 bg-white rounded-md shadow-md">
        <div x-data="{ tab: 'contact-details' }">
            <div class="hidden sm:block">
                <div class="border-b border-gray-200">
                    <nav class="flex -mb-px space-x-8" aria-label="Tabs">
                        <a href="#" :class="tab === 'contact-details' ? 'border-red-500 text-red-600' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700'" @click.prevent="tab = 'contact-details'" class="px-1 py-4 text-sm font-medium whitespace-nowrap border-b-2">Contact Details</a>
                        <a href="#" :class="tab === 'hostel-advantage' ? 'border-red-500 text-red-600' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700'" @click.prevent="tab = 'hostel-advantage'" class="px-1 py-4 text-sm font-medium whitespace-nowrap border-b-2">Hostel Advantage</a>
                    </nav>
                </div>
            </div>

            <div class="overflow-y-auto flex-1 min-h-0">
                <div x-show="tab === 'contact-details'" class="mt-4">
                    <livewire:about-us.contact-details />
                </div>
                <div x-show="tab === 'hostel-advantage'" class="mt-4" style="display: none;">
                    <livewire:about-us.hostel-advantage />
                </div>
            </div>
        </div>
    </div>
    {{-- end of card container --}}
</div>