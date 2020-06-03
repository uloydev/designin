@extends('layouts.admin-master')
@section('page-id', 'readMessage')
@section('page-name', 'Message From Customer')
@section('page-title', 'Message From Customer')
@section('css')
    <style>
        .loader {
            height: 100px;
            width: 100%;
            text-align: center;
            padding: 1em;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 200ms;
        }
        /* Set the color of the icon */
        svg path,
        svg rect {
            fill: #FF6700;
        }

    </style>
@endsection
@section('header')
    <header>
        <div class="alert alert-default" role="alert" style="display: none">
            Successfully reply message from customer
        </div>
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
                            value="{{ $searching ?? '' }}" name="search"
                            placeholder="Search by email, name sender, or date like 2020-05-16">
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
                <a href="{{ route('manage.contact-us.index') }}">
                    <div class="card card-stats">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-link mb-0">Unanswered message</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $totalNotAnswered }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6">
                <a href="{{ route('manage.contact-us.search') . '?search=is_answered=true' }}">
                    <div class="card card-stats">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-link mb-0">Answered message</h5>
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
                </a>
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
                                              class="mt-3 border-top pt-4" method="post">
                                            @csrf @method('PUT')
                                            <div class="form-group">
                                                <label for="message-review" class="text-gray">
                                                    Reply to their email
                                                </label>
                                                <textarea name="answer" class="form-control" id="message-review"
                                                placeholder="Oooh thanks for your advice, we will ..."
                                                rows="10" {{ $message->is_answered == true ? 'readonly' : '' }} required></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-default">Send Review</button>
                                            <span class="text-info d-none is-answered">You answer this on {{ $message->updated_at->format('d M Y H:i') }}</span>
                                        </form>
                                    </div>
                                    <div class="card-footer border-top-0 d-flex justify-between text-default">
                                        <p>
                                            From:
                                            <span class="font-weight-600">
                                            {{ $message->email . ' (' . $message->name . ')' }}
                                        </span>
                                        </p>
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
                <div class="card-footer border-top-0 py-0">
                    {{ $messages->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('element')
    <div class="modal fade" id="modalLoader" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="loader loader--style3" title="2">
                        <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                             width="40px" height="40px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
                            <path fill="#000" d="M43.935,25.145c0-10.318-8.364-18.683-18.683-18.683c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615c8.072,0,14.615,6.543,14.615,14.615H43.935z">
                                <animateTransform attributeType="xml" attributeName="transform" type="rotate"
                                from="0 25 25" to="360 25 25" dur="0.6s" repeatCount="indefinite"/>
                            </path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
