@component('mail::message')
# Reply from admin desainin about your message

{!! $data->answer !!}

Thank you for your reply,<br>
{{ config('app.name') . ' Admin' }}
@endcomponent
