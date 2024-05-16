<x-mail::message>
# Here's your invoice for order {{$order->id}}

Please find invoice attached.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
