<x-mail::message>
# Your request has been received

Subject: {{$subject}}

Message: {{$message}}

We will respond as soon as possible.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
