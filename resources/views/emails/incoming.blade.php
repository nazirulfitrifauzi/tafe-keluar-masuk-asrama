<x-mail::message>
# Movement Notification

Hello {{ $name }}'s parent,

Your child's movement details are as follows:

- **Name:** {{ $name }}
- **Destination:** {{ $destination }}
- **Out DateTime:** {{ $outDateTime }}
- **In DateTime:** {{ $inDateTime }}
- **Duration Outside:** {{ $duration }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
