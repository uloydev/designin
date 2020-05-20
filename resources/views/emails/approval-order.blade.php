@component('mail::message')
# Your order has been {{ $data->status }} by {{ $data->agent->name }}!

@if ($data->status == 'canceled')
    We are really sorry, but we forced to cancelled your order. If you still wanna order from us, please re-order
    with different detail order or order something else
@else
    Yeayy your order has been accept by our worker. Please check your desainin account!
@endif

Thank you for your order, <br>
{{ config('app.name') . ' Admin' }}
@endcomponent
