@extends('layouts.admin-master')
@section('page-title', 'List Request | Job History')
@section('page-id', 'jobHistory')
@section('page-name', 'Finished Job')
@section('css') <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> @endsection
@section('header')
    @include('partials.job-header')
    @if (session('success'))
        <div class="mb-5 alert alert-default" role="alert">
            {{ session('success') }}
        </div>
    @endif
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-0 pb-0">
                    <h3 class="mb-0">Finished Job</h3>
                </div>
                <div class="card-body">
                    <div class="accordion" id="accordionJobHistory">
                        @forelse ($orders as $order)
                            <article class="accordion__item">
                                <div id="heading{{ $order->id }}" class="d-flex mb-2 align-items-center">
                                    <h2 class="mb-0 mr-auto job-history-title">
                                        <button class="btn p-0 shadow-none btn-link collapsed" type="button"
                                        data-toggle="collapse" aria-expanded="false"
                                        data-target="#collapse{{ $loop->index }}"
                                        aria-controls="collapse{{ $loop->index }}">
                                            <i class="fas fa-chevron-up rotate-180 mr-2"></i>
                                            {{ $order->package->service->title }}
                                            {{ '(' . $order->package->title . ')' }}
                                        </button>
                                    </h2>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#delete-history-job" data-id="{{$order->id}}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>

                                <div id="collapse{{ $loop->index }}" aria-labelledby="heading{{ $loop->index }}"
                                class="collapse" data-parent="#accordionJobHistory">
                                    <div class="card-body">
                                        {!! $order->request !!}
                                        <form action="{{ route('agent.list-request.send-review', $order->id) }}"
                                              class="mt-3 border-top pt-4" method="post">
                                             @csrf
                                            <div class="form-group">
                                                <label for="message-review" class="text-gray">
                                                    Message to customer : <span>{{ $order->user->email }}</span>
                                                </label>
                                                <textarea name="rating_review" class="form-control" id="message-review"
                                                placeholder="What do you think to your customer..."
                                                rows="10" required></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-default">Send Review</button>
                                        </form>
                                    </div>
                                    <div class="card-footer">
                                        <p class="d-flex justify-between text-default">
                                            Start date: <time class="font-weight-600">{{ $order->started_at }}</time>
                                        </p>
                                        <p class="d-flex justify-between text-default">
                                            End date: <time class="font-weight-600">{{ $order->deadline }}</time>
                                        </p>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <img src="{{ asset('img/finishing.jpg') }}" alt="No history job" height="250"
                                 class="mx-auto d-block">
                            <h1 class="text-center display-4 text-muted">
                                You have no finished job.
                                <a href="{{ route('agent.list-request.index') }}" class="text-link">
                                    Lets finish your job!
                                </a>
                            </h1>
                        @endforelse
                    </div>
                </div>
                @if ($totalOrderNotDone > 10)
                    <div class="card-footer border-top-0">
                        {{ $orders->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('element')
    <div class="modal fade" id="delete-history-job" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remove <span class="modal-job-history-title"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        You sure wanna remove
                        <span class="modal-job-history-title font-weight-600"></span> from  history ?
                    </p>
                    <form action="{{--routing on js--}}" method="post" id="form-delete-job-history" class="d-none">
                        @csrf @method('DELETE')
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link text-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger" form="form-delete-job-history">Remove it</button>
                </div>
            </div>
        </div>
    </div>
@endsection
