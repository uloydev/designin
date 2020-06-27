@component('mail::message')
    # Your subscription for {{ $order->subscription->title }}
    Thank you for your subscription. For better communication about this subscription,
    please contact admin at number [087776196047](https://wa.web/6287776196047)

    Thank you for your order, <br>
    {{ config('app.name') }}
@endcomponent
