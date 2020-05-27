@extends('layouts.customer-master')
@section('page-title') {{ $service->title }} @endsection
@section('header') @include('partials.nav') @endsection
@section('page-id', 'singleService')
@section('script')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script>
        // call this function if not using token payment
        function payment(){
            let data = $('#modal-single-order form').serialize();
            console.log(data);
            data += '&user_id={{Auth::id() ?? ''}}';
            $.ajax({
                type: "POST",
                url: $("#modal-single-order form").attr('action') + '/payment',
                data: {
                    _token:'{{csrf_token()}}',
                    user_id:'{{Auth::id()}}',
                    extras:'[2,4]',
                    agent_id:'2',
                    message_agent:'wkwkwkw',
                    quantity:'4'
                },
                beforeSend: function(){
                    console.log(data);
                },
                success: function (response) {
                    console.log(response);
                    console.log(response.status);
                    console.log(response.token);
                    if (response.status == 'success') {
                        snap.pay(response.token);
                        // redirect to user/order after payment
                    }else{
                        alert('something went wrong with your order');
                        // snap.hide();
                    }
                },
                error: function(response){
                    console.log(response);
                    // snap.hide();
                }
            });
        }
    </script>
@endsection
@section('content')
    <div class="container">
        <div class="row mx-0 justify-content-between">
            <section class="service-single col-12 col-lg-8">
                <div class="service-single__top">
                    <h1 class="service-single__title">{{ $service->title }}</h1>
                    <div class="d-flex align-items-center flex-wrap py-4">
                        <img src="{{ Storage::url($service->agent->profile->avatar) }}"
                             alt="Service Agent Avatar" height="25">
                        <p class="ml-2">{{ $service->agent->email }}</p>
                        <div class="service-single__rating">
                            @if ($rating < 5)
                                @for ($i = 0; $i < $rating; $i++)
                                    {!! "<i class='bx bxs-star' ></i>" !!}
                                @endfor
                                @for ($i = 0; $i < 5 - $rating; $i++)
                                   {!! "<i class='bx bx-star' ></i>" !!}
                                @endfor
                            @endif
                            ( {{ ceil($rating) }} / 5 )
                        </div>
                    </div>
                    <img src="{{ Storage::url($service->image) }}" alt="Service image" class="service-single__img">
                </div>
                <div class="service-single__description">
                    <h2 class="service-single__subheading">About this service</h2>
                    <div>{!! $service->description !!}</div>
                </div>
                <div class="service-single__review">
                    <div class="service-single__header-review">
                        <h2 class="service-single__subheading mb-0">Review</h2>
                        <form action="" method="get">
                            @csrf
                            <label for="review-filer" class="d-none">Review filter</label>
                            <select id="review-filer" name="review_filter"
                            class="service-single__filter-review wide">
                                <option value="">Recent</option>
                                <option value="">Rating</option>
                            </select>
                        </form>
                    </div>
                    @forelse ($testimonies as $testimony)
                    <article class="service-single__comment">
                        <img src="{{ Storage::url($testimony->user->profile->avatar ?? 'temporary/people.webp') }}"
                            height="20" alt="People comment image">
                        <div class="service-single__comment-detail">
                            <p class="service-single__comment-title">{{ $testimony->user->name }}</p>
                            <p class="service-single__comment-text">{{ $testimony->content }}</p>
                        </div>
                    </article>
                    @empty
                        <img src="{{ asset('img/review.jpg') }}" alt="No review"
                        height="150" class="mx-auto d-block">
                        <h1 class="mt-4 text-center">There are no review about this service</h1>
                    @endforelse
                </div>
            </section>
            <aside class="single-package col-12 col-lg-4" id="service-package-tab">
                <div class="jq-tab-menu">
                    @foreach ($packages as $package)
                    <div class="jq-tab-title {{$loop->first ? 'active' : ''}}"
                    data-tab="package-{{$package->id}}">
                        {{ $package->title }}
                    </div>
                    @endforeach
                </div>
                <div class="jq-tab-content-wrapper">
                    @foreach ($packages as $package)
                    <div class="jq-tab-content {{ $loop->first ? 'active' : '' }}"
                    data-tab="package-{{ $package->id }}">
                        <div class="single-package__top mb-4">
                            <p class="mb-3 d-flex justify-content-between align-items-center">
                                {{ $package->title }}
                                <var class="font-style-normal font-bold order-price">
                                    IDR {{ $package->price }}
                                </var>
                            </p>
                            <p>{{ $package->description }}</p>
                        </div>
                        <button class="btn-modal single-package__btn" data-target="#modal-single-extras"
                        data-package-id="{{ $package->id }}" data-agent-id="{{ $service->agent_id }}"
                        data-package-title="{{ $package->title }}">
                            Continue (IDR {{ $package->price }})
                        </button>
                        {{-- edit discounted price if subscribe --}}
                        {{-- <del class="d-block mt-3 text-center text-gray">IDR 600,000</del> --}}
                    </div>
                    @endforeach
                </div>
            </aside>
        </div>
    </div>
@endsection
@push('element')
    <div class="overlay overlay--nav-showed"></div>
    <datalist id="list-promo">
        @foreach($promos as $promo)
            <option value="{{ $promo->code }}">{{ $promo->code }}</option>
        @endforeach
    </datalist>
    @include('service.form-order')
@endpush
