<div class="container flex flex-col px-6 pb-4 mx-auto h-full min-h-0">
    <!-- 1) Static top area (title, etc.) -->
    <div class="my-6">
        <h1 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Notes
        </h1>
    </div>

    <!-- 2) Tabs wrapper (fills leftover space) -->
    <div class="flex flex-col flex-1 p-4 min-h-0 bg-white rounded-md shadow-md"> 
        <div x-data="{
                tabSelected: 1,
                tabId: $id('tabs'),
                tabButtonClicked(tabButton) {
                    this.tabSelected = parseInt(tabButton.id.split('-').pop());
                    this.tabRepositionMarker(tabButton);
                },
                tabRepositionMarker(tabButton) {
                    this.$refs.tabMarker.style.width = tabButton.offsetWidth + 'px';
                    this.$refs.tabMarker.style.left = tabButton.offsetLeft + 'px';
                },
                tabContentActive(tabIndex) {
                    return this.tabSelected === tabIndex;
                },
                tabButtonActive(tabIndex) {
                    return this.tabSelected === tabIndex;
                }
            }"
            x-init="tabRepositionMarker($refs.tabButtons.children[0]);"
            class="flex relative flex-col flex-1 w-full min-h-0">
            
            <!-- Tab Buttons -->
            <div x-ref="tabButtons" class="inline-grid relative grid-cols-2 justify-center items-center p-1 w-full h-10 bg-white rounded-lg border border-gray-200 select-none dark:bg-gray-800 dark:border-gray-700">
                <button
                    id="tabs-1"
                    @click="tabButtonClicked($el)"
                    :class="{ 'bg-purple-600 text-purple-100': tabButtonActive(1) }"
                    class="inline-flex relative z-20 justify-center items-center px-3 w-full h-8 text-base font-bold text-gray-600 whitespace-nowrap rounded-md transition-all cursor-pointer dark:text-gray-300">
                    Theory
                </button>
                <button
                    id="tabs-2"
                    @click="tabButtonClicked($el)"
                    :class="{ 'bg-purple-600 text-purple-100': tabButtonActive(2) }"
                    class="inline-flex relative z-20 justify-center items-center px-3 w-full h-8 text-base font-bold text-gray-600 whitespace-nowrap rounded-md transition-all cursor-pointer dark:text-gray-300">
                    Practical
                </button>

                <!-- Marker for the active tab highlight -->
                <div x-ref="tabMarker" class="absolute left-0 z-10 w-1/2 h-full duration-300 ease-out" x-cloak>
                    <div class="w-full h-full bg-purple-600 rounded-md"></div>
                </div>
            </div>

            <!-- Tab Content -->
            <div class="overflow-y-auto flex-1 min-h-0">
                <div x-show="tabContentActive(1)" class="mt-4">
                    @admin
                        <livewire:notes.teori.admin />
                    @else
                        <livewire:notes.teori.user />
                    @endadmin
                </div>
                <div x-show="tabContentActive(2)" class="mt-4" style="display: none;">
                    @admin
                        <livewire:notes.amali.admin />
                    @else
                        <livewire:notes.amali.user />
                    @endadmin
                </div>
            </div>
        </div>
    </div>
</div>
