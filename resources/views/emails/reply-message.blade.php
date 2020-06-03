@component('mail::message')
# Reply from admin desainin about your message

{!! $data->answer !!}

Regards,<br>
{{ config('app.name') . ' Admin' }}
@endcomponent
