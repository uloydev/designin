@foreach ($services as $service)
<div>service : {{$service->title}}</div>
<div>description : {{$service->description}}</div>
<div>agent : {{$service->agent->name}}</div>
<div>package :</div>
<div>
    <ul>
        @foreach ($service->package as $package)
        <li>{{ $package->title }} seharga {{ $package->price }}</li>
        @endforeach
    </ul>
</div>
<hr>
@endforeach