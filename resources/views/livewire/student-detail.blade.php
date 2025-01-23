<div class="flex flex-col flex-1 m-4 min-h-0 bg-white rounded-md shadow-md">
    <div class="p-4">
        <div class="flex justify-between">
            <h1 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Student Details
            </h1>
            <x-input
                label="Name"
                placeholder="student name"
                class="w-1/5"
            />
        </div>
        <div class="overflow-hidden mt-4 ring-1 shadow ring-black/5 sm:rounded-lg">
            <table class="w-full divide-y divide-gray-300">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="py-3.5 pr-3 pl-4 text-sm font-semibold text-left text-gray-900 sm:pl-6">
                            No
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-left text-gray-900">
                            Name
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-left text-gray-900">
                            Course
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-left text-gray-900">
                            Ic Number
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-left text-gray-900">
                            Room Number
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-left text-gray-900">
                            Phone Number
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-left text-gray-900">
                            Email
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-left text-gray-900">
                            Beneficiary Email
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($users as $index => $user)
                        <tr>
                            <td class="py-4 pr-3 pl-4 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">
                                {{ $users->firstItem() + $index }}
                            </td>
                            <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                {{ $user->name }}
                            </td>
                            <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                {{ $user->course }}
                            </td>
                            <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                {{ $user->ic_no }}
                            </td>
                            <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                {{ $user->room_no }}
                            </td>
                            <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                {{ $user->phone_no }}
                            </td>
                            <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                {{ $user->email }}
                            </td>
                            <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                {{ $user->beneficiary_email }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $users->links() }}
    </div>
</div>