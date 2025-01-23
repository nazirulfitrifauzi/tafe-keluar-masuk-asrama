<div class="p-4">
    <ul class="space-y-2 list-disc list-inside">
        <li class="text-lg font-semibold">IT IS FORBIDDEN TO BRING ELECTRICAL EQUIPMENT SUCH AS:</li>
        <div class="grid grid-cols-3 gap-4">
            @for($i = 1; $i <= 3; $i++)
                <div class="grid place-items-center">
                    <img src="{{ asset('image/prohibited/' . $i . '.png') }}" class="h-40">
                </div>
            @endfor
        </div>
        <li class="mt-2 text-lg font-semibold">RESIDENTS ARE NOT ALLOWED TO COOK IN THE DORMITORY ROOM.</li>
        <div class="grid grid-cols-3 gap-4">
            <div class="grid place-items-center">
                <img src="{{ asset('image/prohibited/4.png') }}" class="h-40">
            </div>
        </div>
    </ul>
    
</div>
