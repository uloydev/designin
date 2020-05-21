@component('mail::message')
# Result for your order {{ $order->package->title }}

Your order has been finished. Please check you desainin account.

Order result:
- {{ $order->package->title }}
- Order at : {{ $order->created_at }}
- Agent : {{ $order->agent->name }}

Message from {{ $order->agent->name }}:
> {{ $result->message }}

Thank you for your order, <br>
{{ config('app.name') }}
@endcomponent
