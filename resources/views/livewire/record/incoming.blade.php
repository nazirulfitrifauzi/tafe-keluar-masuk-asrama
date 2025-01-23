<div class="p-4 mt-4">
    <div class="overflow-hidden ring-1 shadow ring-black/5 sm:rounded-lg">
        <table class="w-full divide-y divide-gray-300">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-left text-gray-900">
                        Name
                    </th>
                    <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-left text-gray-900">
                        IC Number
                    </th>
                    <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-left text-gray-900">
                        Phone Number
                    </th>
                    <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-left text-gray-900">
                        Destination
                    </th>
                    <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-left text-gray-900">
                        Out At
                    </th>
                    <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-left text-gray-900">
                        In At
                    </th>
                    <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-left text-gray-900">
                        Duration
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($datas as $data)
                    <tr>
                        <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $data->user->name }}</td>
                        <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $data->user->ic_no }}</td>
                        <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $data->user->phone_no }}</td>
                        <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $data->destination }}</td>
                        <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $data->out->format('d/m/Y h:i:s A') }}</td>
                        <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $data->in->format('d/m/Y h:i:s A') }}</td>
                        <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $data->out->diff($data->in)->format('%h hours %i minutes') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-3 py-4 text-sm text-center text-gray-500 whitespace-nowrap">NO DATA</td>
                    </tr>
                @endforelse
                
            </tbody>
        </table>
    </div>
</div>
