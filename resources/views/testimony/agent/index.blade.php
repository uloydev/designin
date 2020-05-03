<div>
    <h1>all testimonies</h1>
    @foreach ($testimonies as $testimony)
    <div>
        <p>name : {{$testimony->user->name}}</p>
        <p>service : {{$testimony->service->title}}</p>
        <p>feedback : {{$testimony->content}}</p>
        <p>rating : {{$testimony->rating}}</p>
    </div>
    @endforeach
    <hr>
    <h1>all services</h1>
    @foreach ($services as $service)
    <div>
        <p>title : {{$service->title}}</p>
        <p>testimonies : <a href="{{route('agent.testimony.show', $service->id)}}">see testimonies</a></p>
    </div>
    @endforeach
</div>