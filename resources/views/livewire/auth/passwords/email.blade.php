@section('title', 'Reset password')

<div class="h-screen bg-center bg-cover" style="background-image: url({{ asset('image/kolej-tafe.jpg') }});">
    <div class="flex justify-center items-center h-screen backdrop-blur-md bg-white/30">
        <div class="w-full">
            <div class="items-center sm:mx-auto sm:w-full sm:max-w-md">
                <a href="{{ route('home') }}">
                    <x-logo class="mx-auto w-auto h-16 text-indigo-600" />
                </a>

                <h2 class="mt-6 text-3xl font-extrabold leading-9 text-center text-gray-900">
                    Reset password
                </h2>
            </div>
            <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
                <div class="px-4 py-8 bg-white shadow sm:rounded-lg sm:px-10">
                    @if ($emailSentMessage)
                        <div class="p-4 bg-green-50 rounded-md">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                </div>

                                <div class="ml-3">
                                    <p class="text-sm font-medium leading-5 text-green-800">
                                        {{ $emailSentMessage }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @else
                        <form wire:submit.prevent="sendResetPasswordLink">
                            <div>
                                <label for="email" class="block text-sm font-medium leading-5 text-gray-700">
                                    Email address
                                </label>

                                <div class="mt-1 rounded-md shadow-sm">
                                    <input wire:model.lazy="email" id="email" name="email" type="email" required autofocus class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-red-500 focus:border-red-500 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('email') border-red-500 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror" />
                                </div>

                                @error('email')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mt-6">
                                <span class="block w-full rounded-md shadow-sm">
                                    <button type="submit" class="flex justify-center px-4 py-2 w-full text-sm font-medium text-white bg-red-600 rounded-md border border-transparent transition duration-150 ease-in-out hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring-red active:bg-red-700">
                                        Send password reset link
                                    </button>
                                </span>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
