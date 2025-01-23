@section('title', 'Sign in to your account')

<div class="flex min-h-screen bg-white">
    <div class="flex flex-col flex-1 justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
        <div class="mx-auto w-full max-w-sm lg:w-96">
            <div class="sm:mx-auto sm:w-full sm:max-w-md">
                <a href="{{ route('home') }}">
                    <x-logo class="mx-auto w-auto h-16 text-indigo-600" />
                </a>

                <h2 class="mt-6 text-3xl font-extrabold leading-9 text-center text-gray-900">
                    Sign in to your account
                </h2>

                @if (Route::has('register'))
                    <p class="mt-2 text-sm leading-5 text-center text-gray-600 max-w">
                        Or
                        <a href="{{ route('register') }}" class="font-medium text-indigo-600 transition duration-150 ease-in-out hover:text-indigo-500 focus:outline-none focus:underline">
                            create a new account
                        </a>
                    </p>
                @endif
            </div>

            <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
                <form wire:submit.prevent="authenticate">
                    <div>
                        <label for="username" class="block text-sm font-medium leading-5 text-gray-700">
                            Username
                        </label>

                        <div class="mt-1 rounded-md shadow-sm">
                            <input wire:model.lazy="username" id="username" name="username" type="text" required autofocus class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('username') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                        </div>

                        @error('username')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-6">
                        <label for="password" class="block text-sm font-medium leading-5 text-gray-700">
                            Password
                        </label>

                        <div class="mt-1 rounded-md shadow-sm">
                            <input wire:model.lazy="password" id="password" type="password" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('password') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                        </div>

                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-between items-center mt-6">
                        <div class="flex items-center">
                            <input wire:model.lazy="remember" id="remember" type="checkbox" class="w-4 h-4 text-indigo-600 transition duration-150 ease-in-out form-checkbox" />
                            <label for="remember" class="block ml-2 text-sm leading-5 text-gray-900">
                                Remember
                            </label>
                        </div>

                        <div class="text-sm leading-5">
                            <a href="{{ route('password.request') }}" class="font-medium text-indigo-600 transition duration-150 ease-in-out hover:text-indigo-500 focus:outline-none focus:underline">
                                Forgot your password?
                            </a>
                        </div>
                    </div>

                    <div class="mt-6">
                        <span class="block w-full rounded-md shadow-sm">
                            <button type="submit" class="flex justify-center px-4 py-2 w-full text-sm font-medium text-white bg-red-600 rounded-md border border-transparent transition duration-150 ease-in-out hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring-red active:bg-red-700">
                                Sign in
                            </button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="relative z-10 pb-8 bg-white max-w-1 sm:pb-16 lg:w-full">
        <svg class="hidden absolute inset-y-0 right-0 w-48 h-full text-white transform translate-x-1/2 lg:block" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none">
            <polygon points="50,0 100,0 50,100 0,100"></polygon>
        </svg>
    </div>
    <div class="hidden relative flex-1 w-0 lg:block">
        <img class="object-cover absolute inset-0 w-full h-full" src="{{ asset('image/kolej-tafe.jpg') }}" alt="">
    </div>
</div>
