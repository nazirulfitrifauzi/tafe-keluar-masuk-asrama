<!-- Desktop sidebar -->
<aside
    class="hidden overflow-y-auto z-20 flex-shrink-0 w-64 bg-center bg-cover shadow-md dark:bg-gray-800 md:block"
    style="background-image: url('/image/bg-sidebar.png');"
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
            @admin
                <x-sidebar-menu-item 
                    icon="identification" 
                    label="User"
                    route="user"
                    :active="request()->routeIs('user')"
                />
            @endadmin

            <x-sidebar-menu-item 
                icon="document-duplicate" 
                label="Notes" 
                route="notes"
                :active="request()->routeIs('notes')"
            />

            <x-sidebar-menu-item 
                icon="video-camera" 
                label="Gallery" 
                route="gallery"
                :active="request()->routeIs('gallery')"
            />

            <x-sidebar-menu-item 
                icon="question-mark-circle" 
                label="Pop Quiz" 
                route="pop-quiz"
                :active="request()->routeIs('pop-quiz')"
            />
        </ul>

        <!-- Logout button at the bottom -->
        <div class="px-6 py-4 mt-auto">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <button
                    class="flex justify-between items-center px-4 py-2 w-full text-sm font-medium leading-5 text-white bg-teal-600 rounded-lg border border-transparent transition-colors duration-150 active:bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500"
                >
                    Logout
                    <x-icon name="arrow-right-on-rectangle" class="ml-4 w-5 h-5" solid />
                </button>
            </a>
        </div>
    </div>
</aside>