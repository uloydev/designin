@extends('layouts.admin-master')
@section('page-id', 'readMessage')
@section('page-name', 'Message From Customer')
@section('page-title', 'Message From Customer')
@section('header')
    <header>
        <div class="row mb-5 justify-content-between">
            <div class="col-12">
                <form class="navbar-search d-block navbar-search-light mr-sm-3 transform-none"
                action="{{ route('manage.contact-us.search') }}" id="navbar-search-main" method="get">
                    <div class="form-group mb-0">
                        <div class="input-group input-group-alternative input-group-merge">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="search-message">
                                    <i class="fas fa-search"></i>
                                </label>
                            </div>
                            <input class="form-control" type="text" id="search-message"
                            value="{{ $query ?? '' }}" name="search"
                            placeholder="Search by email sender, name sender, or date like 2020-05-16">
                        </div>
                    </div>
                    <button type="button" class="close" data-action="search-close"
                            data-target="#navbar-search-main" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Unanswered message</h5>
                                <span class="h2 font-weight-bold mb-0">{{ count($messages) }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                    <i class="fas fa-envelope"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Answered message</h5>
                                <span class="h2 font-weight-bold mb-0">{{ $totalAnswered }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-success text-white rounded-circle shadow">
                                    <i class="far fa-envelope-open"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-0 pb-0">
                    <h3 class="mb-0">Unanswered</h3>
                </div>
                <div class="card-body">
                    <div class="accordion" id="accordionJobHistory">
                        @forelse ($messages as $message)
                            <article class="accordion__item">
                                <div id="heading{{ $message->id }}" class="d-flex mb-2 align-items-center">
                                    <h2 class="mb-0 mr-auto job-history-title">
                                        <button class="btn p-0 shadow-none btn-link collapsed" type="button"
                                        data-toggle="collapse" aria-expanded="false"
                                        data-target="#collapse{{ $loop->index }}"
                                        aria-controls="collapse{{ $loop->index }}">
                                            <i class="fas fa-chevron-up rotate-180 mr-2"></i>
                                            {{ 'Delivered at : ' . $message->created_at->format('d M Y') }}
                                        </button>
                                    </h2>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#delete-history-job" data-id="{{ $message->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>

                                <div id="collapse{{ $loop->index }}" aria-labelledby="heading{{ $loop->index }}"
                                     class="collapse" data-parent="#accordionJobHistory">
                                    <div class="card-body">
                                        {{ $message->message }}
                                        <form action="{{ route('manage.contact-us.update', $message->id) }}"
                                              class="mt-3 border-top pt-4">
                                            <div class="form-group">
                                                <label for="message-review" class="text-gray">
                                                    Reply to their email
                                                </label>
                                                <textarea name="rating_review" class="form-control" id="message-review"
                                                placeholder="Oooh thanks for your advice, we will ..."
                                                rows="10" required></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-default">Send Review</button>
                                        </form>
                                    </div>
                                    <div class="card-footer border-top-0 d-flex justify-between text-default">
                                        From:
                                        <span class="font-weight-600">
                                            {{ $message->email . ' (' . $message->name . ')' }}
                                        </span>
                                    </div>
                                </div>
                            </article>
                        @empty
                            @if (Route::currentRouteName() === 'manage.contact-us.index')
                                <img src="{{ asset('img/empty-state.svg') }}" alt="No history job" height="230"
                                     class="mx-auto d-block">
                                <h1 class="text-center h2 mt-5 text-muted">
                                    Yeayy you have unanswered message from customer!
                                    <a href="{{ route('manage.contact-us.index') }}" class="text-link d-block">
                                        Refresh <i class="fas fa-sync"></i>
                                    </a>
                                </h1>
                            @else
                                <img src="{{ asset('img/not-found.jpg') }}" alt="No message found" height="230"
                                     class="mx-auto d-block">
                                <h1 class="text-center h2 mt-5 text-muted">
                                    Message not found / you type a wrong format
                                    <a href="{{ route('manage.contact-us.index') }}" class="text-link d-block mt-2">
                                        Back to prev <i class="fas fa-undo-alt ml-1"></i>
                                    </a>
                                </h1>
                            @endif
                        @endforelse
                    </div>
                </div>
                @if (count($messages) > 10)
                    <div class="card-footer border-top-0">
                        {{ $messages->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
