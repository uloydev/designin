@component('mail::message')
# Your have new order with title {{ $order->package->title }}

Please check you agent desainin account to accept or decline this job

Order detail:
- {{ $order->package->title }}
- Delivered at : {{ $order->created_at }}

{{ config('app.name') . ' ' . $order->agent->name }}
@endcomponent
