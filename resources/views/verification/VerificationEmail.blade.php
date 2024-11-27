<x-mail::message>
Hello {{$name}}

Blow its the link to veirify your email address

<x-mail::button :url="$verificationUrl">
Verify email address
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
