@section('title', 'Sign in to your account')

<div class="flex relative justify-center items-center px-4 py-12 min-h-screen bg-gradient-to-br from-purple-700 to-purple-900 sm:px-6 lg:px-8">
    <!-- Background image with overlay -->
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0" style="
            background-image: url('{{ asset('image/logo.png') }}');
            background-repeat: space;
            background-size: 130px;
            background-position: center;
            padding: 50px;
            opacity: 0.2;
        "></div>
    </div>
    
    <!-- Form container -->
    <div class="relative z-10 p-8 space-y-8 w-full max-w-md bg-white rounded-lg shadow-xl">
        <div>
            <a href="{{ route('home') }}">
                <x-logo class="mx-auto w-auto h-16 text-purple-600" />
            </a>
            <h2 class="mt-6 text-3xl font-extrabold text-center text-gray-900">
                Sign in to your account
            </h2>
            <p class="mt-2 text-sm text-center text-gray-600">
                Or
                <a href="{{ route('register') }}" class="font-medium text-purple-600 transition duration-150 ease-in-out hover:text-purple-500 focus:outline-none focus:underline">
                    create a new account
                </a>
            </p>
        </div>
        
        <form class="mt-8 space-y-6" wire:submit.prevent="authenticate">
            <div class="space-y-6">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">
                        Email address
                    </label>
                    <div class="mt-1">
                        <input wire:model.lazy="email" id="email" name="email" type="email" required autofocus class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-purple-500 focus:border-purple-300 transition duration-150 ease-in-out sm:text-sm @error('email') border-purple-300 text-purple-900 placeholder-purple-300 focus:border-purple-300 focus:ring-purple @enderror" />
                    </div>
                    @error('email')
                        <p class="mt-2 text-sm text-purple-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">
                        Password
                    </label>
                    <div class="mt-1">
                        <input wire:model.lazy="password" id="password" type="password" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-purple-500 focus:border-purple-300 transition duration-150 ease-in-out sm:text-sm @error('password') border-purple-300 text-purple-900 placeholder-purple-300 focus:border-purple-300 focus:ring-purple @enderror" />
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-purple-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <button type="submit" class="flex relative justify-center px-4 py-2 w-full text-sm font-medium text-white bg-purple-600 rounded-md border border-transparent transition duration-150 ease-in-out group hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                    Sign in
                </button>
            </div>
        </form>
    </div>
</div>
