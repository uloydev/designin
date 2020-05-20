@component('mail::message')
# You get reviewed from our agent {{ '(' . $data->agent->name . ')' }}

{{ $message }}

<hr>

<h3>Order detail:</h3>
<p>{{ $data->package->title }}</p>
<p>Order at: <time>{{ $data->created_at }}</time></p>

Regards, <br>
{{ config('app.name') . ' ' . $data->agent->name }}
@endcomponent
