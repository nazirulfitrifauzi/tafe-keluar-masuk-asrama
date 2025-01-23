<div class="h-screen bg-center bg-cover" style="background-image: url({{ asset('image/kolej-tafe.jpg') }});">
    <div class="flex justify-center items-center h-screen backdrop-blur-md bg-white/30">
        <div class="w-full">
            <div class="items-center sm:mx-auto sm:w-full sm:max-w-md">
                <x-logo class="mx-auto w-auto h-16 text-indigo-600" />
            </div>
            <div class="m-4 mt-8 sm:mx-auto sm:w-full sm:max-w-md">
                <div class="px-4 py-8 bg-white rounded-lg shadow sm:rounded-lg sm:px-10">
                    <h2 class="text-3xl font-extrabold leading-9 text-center text-gray-900">
                        Outgoing
                    </h2>
                    @if($status == 'sent')
                        <h2 class="text-xl font-extrabold leading-9 text-center text-green-700">
                            Successfully submitted
                        </h2>
                    @endif
                    
                    <div class="grid grid-cols-2 gap-4 mt-4">
                        <div>
                            <label for="roomNo" class="block text-sm font-medium leading-5 text-gray-700">
                                Name
                            </label>

                            <div class="mt-1 rounded-md shadow-sm">
                                <input type="text" wire:model="name" class="block px-3 py-2 w-full placeholder-gray-400 rounded-md border border-gray-300 transition duration-150 ease-in-out appearance-none focus:outline-none focus:ring-red-500 focus:border-red-300 sm:text-sm sm:leading-5" disabled />
                            </div>
                        </div>
                        <div>
                            <label for="roomNo" class="block text-sm font-medium leading-5 text-gray-700">
                                Phone Number
                            </label>

                            <div class="mt-1 rounded-md shadow-sm">
                                <input type="text" wire:model="phoneNo" class="block px-3 py-2 w-full placeholder-gray-400 rounded-md border border-gray-300 transition duration-150 ease-in-out appearance-none focus:outline-none focus:ring-red-500 focus:border-red-300 sm:text-sm sm:leading-5" disabled />
                            </div>
                        </div>
                        <div>
                            <label for="roomNo" class="block text-sm font-medium leading-5 text-gray-700">
                                Course
                            </label>

                            <div class="mt-1 rounded-md shadow-sm">
                                <input type="text" wire:model="course" class="block px-3 py-2 w-full placeholder-gray-400 rounded-md border border-gray-300 transition duration-150 ease-in-out appearance-none focus:outline-none focus:ring-red-500 focus:border-red-300 sm:text-sm sm:leading-5" disabled />
                            </div>
                        </div>
                        <div>
                            <label for="roomNo" class="block text-sm font-medium leading-5 text-gray-700">
                                Destination
                            </label>

                            <div class="mt-1 rounded-md shadow-sm">
                                @if($status == 'sent')
                                    <input 
                                        type="text" 
                                        wire:model="destination" 
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-red-500 focus:border-red-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('destination') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" 
                                        disabled
                                    />
                                @else
                                    <input 
                                        type="text" 
                                        wire:model="destination" 
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-red-500 focus:border-red-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('destination') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" 
                                    />
                                @endif
                            </div>
                        </div>
                        <div>
                            <label for="roomNo" class="block text-sm font-medium leading-5 text-gray-700">
                                IC Number
                            </label>

                            <div class="mt-1 rounded-md shadow-sm">
                                <input type="text" wire:model="icNo" class="block px-3 py-2 w-full placeholder-gray-400 rounded-md border border-gray-300 transition duration-150 ease-in-out appearance-none focus:outline-none focus:ring-red-500 focus:border-red-300 sm:text-sm sm:leading-5" disabled />
                            </div>
                        </div>
                        <div>
                            <label for="roomNo" class="block text-sm font-medium leading-5 text-gray-700">
                                Out Time
                            </label>

                            
                            @if($status == 'sent')
                                <div class="mt-1 rounded-md shadow-sm">
                                    <input 
                                        type="text" 
                                        wire:model="outTime" 
                                        class="block px-3 py-2 w-full placeholder-gray-400 rounded-md border border-gray-300 transition duration-150 ease-in-out appearance-none focus:outline-none focus:ring-red-500 focus:border-red-300 sm:text-sm sm:leading-5" 
                                        disabled
                                    />
                                </div>
                            @else
                                <div class="mt-1 rounded-md shadow-sm" x-data="{ time: new Date().toLocaleTimeString() }" x-init="setInterval(() => time = new Date().toLocaleTimeString(), 1000)">
                                    <input type="text" x-model="time" class="block px-3 py-2 w-full placeholder-gray-400 rounded-md border border-gray-300 transition duration-150 ease-in-out appearance-none focus:outline-none focus:ring-red-500 focus:border-red-300 sm:text-sm sm:leading-5" disabled />
                                </div>
                            @endif
                        </div>
                        <div>
                            <label for="roomNo" class="block text-sm font-medium leading-5 text-gray-700">
                                Room Number
                            </label>

                            <div class="mt-1 rounded-md shadow-sm">
                                <input type="text" wire:model="roomNo" class="block px-3 py-2 w-full placeholder-gray-400 rounded-md border border-gray-300 transition duration-150 ease-in-out appearance-none focus:outline-none focus:ring-red-500 focus:border-red-300 sm:text-sm sm:leading-5" disabled />
                            </div>
                        </div>
                        <div>
                            <label for="roomNo" class="block text-sm font-medium leading-5 text-gray-700">
                                Out Date
                            </label>

                            <div class="mt-1 rounded-md shadow-sm">
                            @if($status == 'sent')
                                    <input 
                                        type="text" 
                                        wire:model="outDate" 
                                        class="block px-3 py-2 w-full placeholder-gray-400 rounded-md border border-gray-300 transition duration-150 ease-in-out appearance-none focus:outline-none focus:ring-red-500 focus:border-red-300 sm:text-sm sm:leading-5" 
                                        disabled
                                    />
                                @else
                                    <input type="text" value="{{ now()->format('d/m/Y') }}" class="block px-3 py-2 w-full placeholder-gray-400 rounded-md border border-gray-300 transition duration-150 ease-in-out appearance-none focus:outline-none focus:ring-red-500 focus:border-red-300 sm:text-sm sm:leading-5" disabled />
                                @endif
                            </div>
                        </div>
                    </div>

                    @if($status == 'sent')
                        <div class="mt-6">
                            <span class="block w-full rounded-md shadow-sm">
                                <button type="submit" wire:click="logout" class="flex justify-center px-4 py-2 w-full text-sm font-medium text-white bg-red-600 rounded-md border border-transparent transition duration-150 ease-in-out hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring-red active:bg-red-700">
                                    Log Out
                                </button>
                            </span>
                        </div>
                    @else
                        <div class="mt-6">
                            <span class="block w-full rounded-md shadow-sm">
                                <button type="submit" wire:click="recordInfo" class="flex justify-center px-4 py-2 w-full text-sm font-medium text-white bg-red-600 rounded-md border border-transparent transition duration-150 ease-in-out hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring-red active:bg-red-700">
                                    Submit
                                </button>
                            </span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
