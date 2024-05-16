<x-mail::message>
# Here's your password

Use login {{$user->email}} and password: {{$password}} to login as a manager.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
