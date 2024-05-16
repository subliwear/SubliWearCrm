<x-mail::message>
# Order #{{$order->id}} status changed to {{$order->status->title}}

Your order for project {{$order->project->title}} status has been changed. Please check the order page.


Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
