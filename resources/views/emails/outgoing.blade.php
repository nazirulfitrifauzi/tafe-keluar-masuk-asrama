<x-mail::message>
# Movement Notification

Hello {{ $name }}'s parent,

Your child's movement details are as follows:

- **Name:** {{ $name }}
- **Destination:** {{ $destination }}
- **Out Time:** {{ $outTime }}
- **Out Date:** {{ $outDate }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
