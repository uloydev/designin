@extends('layouts.admin-master')
@section('page-id', 'manageFaq')
@section('page-title', 'Manage FAQ')
@section('page-name', 'Manage FAQ')
@section('header')
    <header>
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @elseif($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        <div class="row mb-4">
            <div class="col-12">
                <button type="button" class="btn btn-secondary bg-white" data-toggle="modal" data-target="#modalCreateFaq">
                    Add new faq
                </button>
                <button type="button" class="btn btn-default" id="btn-manage-faq-category"
                        data-toggle="modal" data-target="#modalCreateFaqCategory">
                    Manage faq category
                </button>
            </div>
        </div>
    </header>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-0 pb-0">
                    <h3 class="mb-0">All FAQ</h3>
                </div>
                <div class="card-body">
                    <div class="accordion" id="accordionJobHistory">
                        @forelse ($faqs as $faq)
                            <article class="accordion__item faq-item">
                                <div id="heading{{ $faq->id }}" class="d-flex mb-2 align-items-center faq-question">
                                    <h2 class="mb-0 mr-auto">
                                        <button class="btn p-0 shadow-none btn-link collapsed" type="button"
                                                data-toggle="collapse" aria-expanded="false"
                                                data-target="#collapse{{ $loop->index }}"
                                                aria-controls="collapse{{ $loop->index }}">
                                            <i class="fas fa-chevron-up rotate-180 mr-2"></i>
                                            <span class="faq-item__title">{{ $faq->question }}</span>
                                        </button>
                                    </h2>
                                    <button type="button" class="btn btn-warning btn-sm btn-edit-faq"
                                            data-toggle="modal" data-target="#modalEditFaq" data-id="{{ $faq->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm btn-delete-faq"
                                            data-toggle="modal" data-target="#modalDeleteFaq" data-id="{{ $faq->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                <div id="collapse{{ $loop->index }}" aria-labelledby="heading{{ $loop->index }}"
                                     class="collapse" data-parent="#accordionJobHistory">
                                    <div class="card-body faq-item__answer">
                                        {!! $faq->answer !!}
                                    </div>
                                    <div class="card-footer py-0 border-top-0">
                                        <p>
                                            Category:
                                            <span class="faq-item__category" data-category-id="{{ $faq->faq_category_id }}">
                                                {{ $faq->faqCategory->category }}
                                            </span>
                                        </p>
                                        <p>Created at: <time>{{ $faq->created_at->format('d M Y') }}</time></p>
                                    </div>
                                </div>
                            </article>
                        @empty
                            @if (Route::currentRouteName() === 'manage.faq.index')
                                <img src="{{ asset('img/empty-state.svg') }}" alt="No history job" height="230"
                                     class="mx-auto d-block">
                                <h1 class="text-center h2 mt-5 text-muted">
                                    There are no faq
                                    <a href="{{ route('manage.faq.index') }}" class="text-link d-block">
                                        Refresh <i class="fas fa-sync"></i>
                                    </a>
                                </h1>
                            @else
                                <img src="{{ asset('img/not-found.jpg') }}" alt="No message found" height="230"
                                     class="mx-auto d-block">
                                <h1 class="text-center h2 mt-5 text-muted">
                                    Faq not found
                                    <a href="{{ route('manage.contact-us.index') }}" class="text-link d-block mt-2">
                                        Back to prev <i class="fas fa-undo-alt ml-1"></i>
                                    </a>
                                </h1>
                            @endif
                        @endforelse
                    </div>
                </div>
                <div class="card-footer border-top-0 py-0">
                    {{ $faqs->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('element')
    @includeWhen(Auth::user()->role == 'admin', 'faq.manipulate')
@endsection
