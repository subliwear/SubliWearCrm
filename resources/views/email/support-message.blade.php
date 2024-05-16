<x-mail::message>
# New support message

Subject: {{$subject}}

Message: {{$message}}

User name: {{$user->name}}

User email: {{$user->email}}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
