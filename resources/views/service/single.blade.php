@extends('layouts.customer-master')
@section('page-title')
    {{ $service->title }}
@endsection
@section('header')
    @include('partials.nav')
@endsection
@section('page-id', 'singleService')
@section('content')
    <div class="container">
        <div class="row mx-0 justify-content-between">
            <section class="service-single col-12 col-lg-8">
                <div class="service-single__top">
                    <h1 class="service-single__title">{{ $service->title }}</h1>
                    <div class="d-flex align-items-center flex-wrap py-4">
                        <img src="{{ Storage::url($service->agent->profile->avatar) }}"
                             alt="Service Agent Avatar" height="25">
                        <p class="ml-2">{{ $service->agent->name }}</p>
                        <div class="service-single__rating">
                            @if ($rating < 5)
                                @for ($i = 0; $i < $rating; $i++)
                                    {!! "<i class='bx bxs-star' ></i>" !!}
                                @endfor
                                @for ($i = 0; $i < 5 - $rating; $i++)
                                   {!! "<i class='bx bx-star' ></i>" !!}
                                @endfor
                            @endif
                            ( {{ $rating }} / 5 )
                        </div>
                    </div>
                    <img src="{{ Storage::url($service->image) }}" alt="Service image" height="400">
                </div>
                <div class="service-single__description">
                    <h2 class="service-single__subheading">About this service</h2>
                    <div>{!! $service->description !!}</div>
                </div>
                <div class="service-single__agent">
                    <h2 class="service-single__subheading">About the seller</h2>
                    <figure class="d-flex align-items-stretch">
                        <img src="{{ asset('img/people.webp') }}" class="service-single__photo-agent"
                             alt="Agent photo" height="100">
                        <figcaption class="service-single__agent-detail">
                            {{ $service->agent->name }}
                            <button class="btn-modal service-single__contact-btn" data-target="#modal-service-send-message">
                                Contact me
                            </button>
                        </figcaption>
                    </figure>
                    <div class="service-single__agent-info">
                        <div class="row mx-0">
                            <div class="col px-0">
                                From:
                                <address class="d-block">
                                    {{ $service->agent->profile->address }}
                                </address>
                            </div>
                            <div class="col px-0">
                                Member since:
                                <time class="d-block">
                                    {{ $service->agent->created_at->format('d M Y') }}
                                </time>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="service-single__review">
                    <div class="service-single__header-review">
                        <h2 class="service-single__subheading mb-0">Review</h2>
                        <form action="" method="get">
                            @csrf
                            <select class="service-single__filter-review wide" name="review_filter">
                                <option value="">Recent</option>
                                <option value="">Rating</option>
                            </select>
                        </form>
                    </div>
                    <article class="service-single__comment">
                        <img src="{{ asset('img/people.webp') }}" alt="People comment image" height="20">
                        <div class="service-single__comment-detail">
                            <p class="service-single__comment-title">People name</p>
                            <p class="service-single__comment-text">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Deserunt impedit quae recusandae rem. Optio, vero.
                            </p>
                        </div>
                    </article>
                    <article class="service-single__comment">
                        <img src="{{ asset('img/people.webp') }}" alt="People comment image" height="20">
                        <div class="service-single__comment-detail">
                            <p class="service-single__comment-title">People name</p>
                            <p class="service-single__comment-text">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Deserunt impedit quae recusandae rem. Optio, vero.
                            </p>
                        </div>
                    </article>
                </div>
            </section>
            <aside class="single-package col-12 col-lg-4" id="service-package-tab">
                <div class="jq-tab-menu">
                    <div class="jq-tab-title active" data-tab="basic">Basic</div>
                    <div class="jq-tab-title" data-tab="standard">Standard</div>
                    <div class="jq-tab-title" data-tab="premium">Premium</div>
                </div>
                <div class="jq-tab-content-wrapper">
                    <div class="jq-tab-content active" data-tab="basic">
                        <div class="single-package__top mb-4">
                            <p class="mb-3 d-flex justify-content-between align-items-center">
                                Silver <var class="font-style-normal font-bold">IDR 300,000</var>
                            </p>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Aperiam cumque ex impedit iusto libero sint?
                            </p>
                        </div>
                        <ul class="single-service__bottom mb-4">
                            <li class="font-bold">What will you get</li>
                            {{--foreach--}}
                            <li>1 Initial Concept Included</li>
                            <li>Source File</li>
                            <li>High Resolution</li>
                            {{--end foreach--}}
                        </ul>
                        <a href="" class="single-package__btn">Continue (IDR 300,000)</a>
                        <del class="d-block mt-3 text-center text-gray">IDR 600,000</del>
                    </div>
                    <div class="jq-tab-content" data-tab="standard">
                        <div class="single-package__top mb-4">
                            <p class="mb-3 d-flex justify-content-between align-items-center">
                                Premium <var class="font-style-normal font-bold">IDR 300,000</var>
                            </p>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Aperiam cumque ex impedit iusto libero sint?
                            </p>
                        </div>
                        <ul class="single-service__bottom mb-4">
                            <li class="font-bold">What will you get</li>
                            {{--foreach--}}
                            <li>1 Initial Concept Included</li>
                            <li>Source File</li>
                            <li>High Resolution</li>
                            {{--end foreach--}}
                        </ul>
                        <a href="" class="single-package__btn">Continue (IDR 300,000)</a>
                        <del class="d-block mt-3 text-center text-gray">IDR 600,000</del>
                    </div>
                    <div class="jq-tab-content" data-tab="premium">
                        <div class="single-package__top mb-4">
                            <p class="mb-3 d-flex justify-content-between align-items-center">
                                Gold <var class="font-style-normal font-bold">IDR 300,000</var>
                            </p>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Aperiam cumque ex impedit iusto libero sint?
                            </p>
                        </div>
                        <ul class="single-service__bottom mb-4">
                            <li class="font-bold">What will you get</li>
                            {{--foreach--}}
                            <li>1 Initial Concept Included</li>
                            <li>Source File</li>
                            <li>High Resolution</li>
                            {{--end foreach--}}
                        </ul>
                        <a href="" class="single-package__btn">Continue (IDR 300,000)</a>
                        <del class="d-block mt-3 text-center text-gray">IDR 600,000</del>
                    </div>
                </div>
            </aside>
        </div>
    </div>
@endsection
@section('element')
    <div class="overlay overlay--nav-showed"></div>
    <div class="modal single-service__modal" id="modal-service-send-message">
        <div class="modal__content">
            <div class="modal__header">
                Send message
                <a href="javascript:void(0)" class="btn-close-modal"><i class='bx bx-x' ></i></a>
            </div>
            <div class="modal__body row mx-0">
                <div class="single-service__modal-message-info">
                    <figure class="text-center">
                        <img src="{{ asset('img/people.webp')  }}" alt="Agent Photo" height="70">
                        <figcaption class="mt-1">{{ $service->agent->name }}</figcaption>
                    </figure>
                    <p>Please include: </p>
                    <ul>
                        <li>Project description</li>
                        <li>Specific instructions</li>
                        <li>Relevant files</li>
                        <li>Your budget</li>
                    </ul>
                </div>
                <div class="col">
                    <form action="" method="post">
                        @csrf
                        <label for="send-message" class="d-block mb-3">Your message</label>
                        <textarea name="message_agent" id="send-message" cols="30" rows="10"
                                  maxlength="250" required></textarea>
                        <div class="d-flex align-items-center justify-content-between">
                            <label for="message_file" class="single-service__message-file"
                                   title="Attach a file">
                                <input type="file" id="message_file" class="d-none">
                                <i class='bx bx-cloud-upload'></i>
                                Insert attachment
                                <span class="ml-2"></span>
                            </label>
                            <button type="submit" class="btn service-single__message-btn">
                                Send
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
