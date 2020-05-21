@foreach ($testimonies as $testimony)
<p>name : {{$testimony->user->name}}</p>
<p>service : {{$testimony->service->title}}</p>
<p>feedback : {{$testimony->content}}</p>
<p>rating : {{$testimony->rating}}</p>
<form action="{{route('manage.testimony.update', $testimony->id)}}">
@csrf
@if ($testimony->is_main != 1)
<input type="hidden" name="is_main" value="1">
<button type="submit">show testimony in home page</button>
@else
<input type="hidden" name="is_main" value="0">
<button type="submit">hide testimony in home page</button>
@endif
</form>
<form action="{{route('manage.testimony.destroy', $testimony->id)}}">
    @csrf
    <button type="submit">hapus testimony</button>
</form>
@endforeach