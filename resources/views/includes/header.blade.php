<header class="z-10 py-4 bg-center bg-cover shadow-md dark:bg-gray-800" style="background-image: url('/image/bg-purple.png');">
    <div
        class="container flex justify-between items-center px-6 mx-auto h-full text-purple-600 dark:text-purple-300"
    >
        <!-- Title -->
        <div class="flex flex-1 lg:mr-32">
            <p class="text-2xl font-black leading-tight text-white dark:text-gray-200">Welcome to the E-Learning System, {{ Auth::user()->name }}</p>
        </div>
    </div>
</header>