<x-mail::message>
# New user created

Hello {{ $admin->name }},
A new user has been created with the following details:
- Name: {{ $user->name }}
- Email: {{ $user->email }}


<x-mail::button :url="''">
    View User
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
