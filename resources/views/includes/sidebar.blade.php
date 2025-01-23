<!-- Desktop sidebar -->
<aside
    class="hidden overflow-y-auto z-20 flex-shrink-0 w-64 bg-white shadow-md dark:bg-gray-800 md:block"
>
    <div class="flex flex-col py-4 h-full text-gray-500 dark:text-gray-400">
        <a
            class="flex justify-center mx-8 text-lg font-bold text-gray-800 dark:text-gray-200"
            href="{{ route('home')}}"
        >
            <x-logo class="h-10" />
        </a>
        <ul class="mt-6">
            <x-sidebar-menu-item 
                icon="home" 
                label="Dashboard" 
                route="home" 
                :active="request()->routeIs('home')" 
            />
        </ul>
        <ul>
            <x-sidebar-menu-item 
                icon="document-duplicate" 
                label="History" 
                route="history"
                :active="request()->routeIs('history')"
            />

            <x-sidebar-menu-item 
                icon="identification" 
                label="Student Details"
                route="student-detail"
                :active="request()->routeIs('student-detail')"
            />

            <x-sidebar-menu-item 
                icon="shield-exclamation" 
                label="Rules" 
                route="rules"
                :active="request()->routeIs('rules')"
            />

            <x-sidebar-menu-item 
                icon="information-circle" 
                label="About Us" 
                route="about-us"
                :active="request()->routeIs('about-us')"
            />
        </ul>
    </div>
</aside>