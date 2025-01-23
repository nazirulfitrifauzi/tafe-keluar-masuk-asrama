<header class="z-10 py-4 bg-white shadow-md dark:bg-gray-800">
    <div
        class="container flex justify-between items-center px-6 mx-auto h-full text-purple-600 dark:text-purple-300"
    >
        <!-- Title -->
        <div class="flex flex-1 lg:mr-32">
            <p class="text-2xl font-black leading-tight text-gray-700 dark:text-gray-200">Sistem Keluar Masuk Asrama</p>
        </div>
        <ul class="flex flex-shrink-0 items-center space-x-6">
            <!-- Profile menu -->
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <button
                    class="flex justify-between items-center px-4 py-2 w-full text-sm font-medium leading-5 text-white bg-red-600 rounded-lg border border-transparent transition-colors duration-150 active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-purple"
                >
                    Logout
                    <x-icon name="arrow-right-on-rectangle" class="ml-4 w-5 h-5" solid />
                </button>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </ul>
    </div>
</header>