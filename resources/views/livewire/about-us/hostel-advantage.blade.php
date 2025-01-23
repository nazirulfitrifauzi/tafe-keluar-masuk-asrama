<div class="p-4 mt-4">
    <div class="grid grid-cols-3 gap-4">
        @for($i = 1; $i <= 6; $i++)
            <div class="grid place-items-center">
                <img src="{{ asset('image/advantage/' . $i . '.png') }}" class="h-44">
            </div>
        @endfor
    </div>
</div>
