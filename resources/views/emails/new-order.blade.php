@component('mail::message')
# Your have new order with title {{ $order->package->title }}

Please check you agent desainin account to accept or decline this job

Order detail:
- {{ $order->package->title }}
- Customer email : {{ $order->user->email }}
- Customer name : {{ $order->user->name }}
- Customer email : {{ $order->user->profile->handphone }}
- Delivered at : {{ $order->created_at }}

{{ config('app.name') . ' ' . $order->agent->name }}
@endcomponent
