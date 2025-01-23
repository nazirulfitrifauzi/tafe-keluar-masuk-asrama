<div class="container flex flex-col px-6 pb-4 mx-auto h-full min-h-0">
    <!-- 1) Static top area (title, etc.) -->
    <div class="my-6">
        <h1 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Rules
        </h1>
    </div>

    <!-- 2) Tabs wrapper (fills leftover space) -->
    <div class="flex flex-col flex-1 p-4 min-h-0 bg-white rounded-md shadow-md"> 
        <div x-data="{ tab: 'dormitory-rule' }" class="flex flex-col flex-1 min-h-0">
            <!-- 2a) Tab buttons (no scrolling, fixed height) -->
            <div class="hidden border-b border-gray-200 sm:block">
                <nav class="flex -mb-px space-x-8" aria-label="Tabs">
                    <!-- Dormitory Rules tab -->
                    <a href="#"
                    :class="tab === 'dormitory-rule'
                        ? 'border-red-500 text-red-600'
                        : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                    @click.prevent="tab = 'dormitory-rule'"
                    class="px-1 py-4 text-sm font-medium whitespace-nowrap border-b-2"
                    >
                        Dormitory Rules
                    </a>

                    <!-- Prohibited Things tab -->
                    <a href="#"
                    :class="tab === 'prohibited-thing'
                        ? 'border-red-500 text-red-600'
                        : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                    @click.prevent="tab = 'prohibited-thing'"
                    class="px-1 py-4 text-sm font-medium whitespace-nowrap border-b-2"
                    >
                        Prohibited Things
                    </a>
                </nav>
            </div>

            <!-- 2b) Scrollable content area -->
            <div class="overflow-y-auto flex-1 min-h-0">
                <div x-show="tab === 'dormitory-rule'" class="mt-4">
                    <livewire:rules.dormitory-rule />
                </div>

                <!-- Tab #2: Prohibited Things -->
                <div x-show="tab === 'prohibited-thing'" class="mt-4" style="display: none;">
                    <livewire:rules.prohibited-thing />
                </div>
            </div>
        </div>
    </div>
</div>
