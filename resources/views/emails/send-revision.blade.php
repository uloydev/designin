@component('mail::message')
# Your revision for order {{ $order->package->title }} by {{ $order->agent->name }}!

Your revision for order {{ $order->package->title }} has been finished. Please check your desainin account

Message from {{ $order->agent->name . ': ' }}
> {{ $revision->message }}

Thank you for your order, <br>
{{ config('app.name') . ' ' . $order->agent->name }}
@endcomponent
