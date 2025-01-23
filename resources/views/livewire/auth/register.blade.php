@section('title', 'Create a new account')

<div class="flex min-h-screen bg-white">
    <div class="hidden relative flex-1 w-0 lg:block">
        <img class="object-cover absolute inset-0 w-full h-full" src="{{ asset('image/kolej-tafe.jpg') }}" alt="">
    </div>
    <div class="relative z-10 pb-8 bg-white max-w-1 sm:pb-16 lg:w-full">
        <svg class="hidden absolute inset-y-0 right-1 w-48 h-full text-white transform translate-x-1/2 lg:block" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none">
            <polygon points="50,0 100,0 50,100 0,100"></polygon>
        </svg>
    </div>
    <div class="flex flex-col flex-1 justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
        <div class="mx-auto w-full max-w-sm lg:w-96">
            <div class="sm:mx-auto sm:w-full sm:max-w-md">
                <a href="{{ route('home') }}">
                    <x-logo class="mx-auto w-auto h-16 text-indigo-600" />
                </a>

                <h2 class="mt-6 text-3xl font-extrabold leading-9 text-center text-gray-900">
                    Create a new account
                </h2>

                <p class="mt-2 text-sm leading-5 text-center text-gray-600 max-w">
                    Or
                    <a href="{{ route('login') }}" class="font-medium text-indigo-600 transition duration-150 ease-in-out hover:text-indigo-500 focus:outline-none focus:underline">
                        sign in to your account
                    </a>
                </p>
            </div>

            <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
                <form wire:submit.prevent="register">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="name" class="block text-sm font-medium leading-5 text-gray-700">
                                Name
                            </label>

                            <div class="mt-1 rounded-md shadow-sm">
                                <input wire:model.lazy="name" id="name" type="text" required autofocus class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-red-500 focus:border-red-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('name') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                            </div>

                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phoneNo" class="block text-sm font-medium leading-5 text-gray-700">
                                Phone Number
                            </label>

                            <div class="mt-1 rounded-md shadow-sm">
                                <input wire:model.lazy="phoneNo" id="phoneNo" type="text" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-red-500 focus:border-red-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('phoneNo') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                            </div>

                            @error('phoneNo')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="course" class="block text-sm font-medium leading-5 text-gray-700">
                                Course
                            </label>

                            <div class="mt-1 rounded-md shadow-sm">
                                <input wire:model.lazy="course" id="course" type="text" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-red-500 focus:border-red-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('course') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                            </div>

                            @error('course')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium leading-5 text-gray-700">
                                Email
                            </label>

                            <div class="mt-1 rounded-md shadow-sm">
                                <input wire:model.lazy="email" id="email" type="email" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-red-500 focus:border-red-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('email') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                            </div>

                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="icNo" class="block text-sm font-medium leading-5 text-gray-700">
                                IC Number
                            </label>

                            <div class="mt-1 rounded-md shadow-sm">
                                <input wire:model.lazy="icNo" id="icNo" type="text" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-red-500 focus:border-red-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('icNo') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                            </div>

                            @error('icNo')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="username" class="block text-sm font-medium leading-5 text-gray-700">
                                Username
                            </label>

                            <div class="mt-1 rounded-md shadow-sm">
                                <input wire:model.lazy="username" id="username" type="text" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-red-500 focus:border-red-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('username') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                            </div>

                            @error('username')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="roomNo" class="block text-sm font-medium leading-5 text-gray-700">
                                Room No
                            </label>

                            <div class="mt-1 rounded-md shadow-sm">
                                <input wire:model.lazy="roomNo" id="roomNo" type="text" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-red-500 focus:border-red-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('roomNo') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                            </div>

                            @error('roomNo')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium leading-5 text-gray-700">
                                Password
                            </label>

                            <div class="mt-1 rounded-md shadow-sm">
                                <input wire:model.lazy="password" id="password" type="password" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-red-500 focus:border-red-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('password') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                            </div>

                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <label for="beneficiaryEmail" class="block text-sm font-medium leading-5 text-gray-700">
                            Beneficiary Email
                        </label>

                        <div class="mt-1 rounded-md shadow-sm">
                            <input wire:model.lazy="beneficiaryEmail" id="beneficiaryEmail" type="beneficiaryEmail" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-red-500 focus:border-red-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('beneficiaryEmail') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                        </div>

                        @error('beneficiaryEmail')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-6">
                        <span class="block w-full rounded-md shadow-sm">
                            <button type="submit" class="flex justify-center px-4 py-2 w-full text-sm font-medium text-white bg-red-600 rounded-md border border-transparent transition duration-150 ease-in-out hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring-red active:bg-red-700">
                                Register
                            </button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
