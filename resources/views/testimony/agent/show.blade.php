<h1>testimonies</h1>
    @foreach ($testimonies as $testimony)
    <div>
        <p>name : {{$testimony->user->name}}</p>
        <p>service : {{$testimony->service->title}}</p>
        <p>feedback : {{$testimony->content}}</p>
        <p>rating : {{$testimony->rating}}</p>
    </div>
    @endforeach