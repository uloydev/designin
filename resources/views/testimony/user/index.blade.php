@foreach ($testimonies as $testimony)
<p>name : {{$testimony->user->name}}</p>
<p>service : {{$testimony->service->title}}</p>
<p>feedback : {{$testimony->content}}</p>
<p>rating : {{$testimony->rating}}</p>
@endforeach