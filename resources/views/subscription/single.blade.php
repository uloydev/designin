@extends('layouts.admin-master')
@section('page-id', 'singleSubscription')
@section('page-title') {{ $subscription->title }} @endsection
@section('page-name')
    <a href="{{ route('manage.subscription.index') }}" class="mr-2 text-white">
        <i class="fas fa-long-arrow-alt-left"></i>
    </a>
    {{ $subscription->title }}
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <img class="card-img-top col-12 col-md-6 col-lg-4 mx-md-auto"
                src="{{ Storage::url($subscription->img) }}" alt="Card image cap">
                <div class="btn-group dropleft position-absolute top-1 right-1">
                    <button type="button" class="btn btn-secondary dropdown-toggle shadow-none before-none"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a href="{{ route('manage.subscription.edit', $subscription->id)}}"
                        class="dropdown-item">
                            edit
                        </a>
                        <form action="{{ route('manage.subscription.destroy', $subscription->id) }}"
                        role="form" method="post">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-link p-0">delete</button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <h2 class="card-title">{{ $subscription->title }}</h2>
                    <div class="card-text">
                        {!! $subscription->desc !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
