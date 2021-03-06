@extends('layouts.customer-master')
@section('page-title') {{ $service->title }} @endsection
@section('header') @include('partials.nav') @endsection
@section('page-id', 'singleService')
@section('script')
    <script src="https://app.midtrans.com/snap/snap.js"
            data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script>
        // call this function if not using token payment
        function payment(){
            let ajaxData = {
                    _token:'{{csrf_token()}}',
                    user_id:'{{Auth::id()}}',
                    extras: $("#modal-single-order #data-extras").val() === '' ? '[]' : $("#modal-single-order #data-extras").val(),
                    agent_id: $("input[name='agent_id']").val(),
                    message_agent: $("#modal-single-order textarea[name='message_agent']").val(),
                    quantity: $("#modal-single-extras #quantity").val(),
                    brief_file: $("#message_file")[0].files[0],
                    promo_code: $("#modal-single-order input[name='promo_code']").val()
            };
            let formData = new FormData();
            for (const [key, value] of Object.entries(ajaxData)) {
                formData.append(key, value);
            }
            $.ajax({
                type: "POST",
                url: $("#modal-single-order form").attr('action') + '/payment',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function(){
                    $("#progress-payment").addClass('show-modal');
                },
                success: function (response) {
                    $("#progress-payment").removeClass('show-modal');
                    if (response.status === 'success') {
                        snap.pay(response.token);
                    }
                    else if(response === ''){
                        alert('something went wrong with internal server');
                    }
                    else{
                        alert('something went wrong with your order');
                        console.log(response);
                    }
                },
                error: function(response){
                    console.log(response);
                    $("#progress-payment").removeClass('show-modal');
                    alert('failed to get payment token');
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
                            @if ($rating <= 5)
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
                <div class="service-single__compare">
                    <h2 class="service-single__subheading">Compare package</h2>
                    <div class="service-single__package">
                        @foreach($packages as $package)
                            <article class="mb-3">
                                <p class="mb-3 d-flex justify-content-between align-items-center font-bold text-capitalize">
                                    {{ $package->title }}
                                    <var class="font-style-normal font-bold order-price money-formatting">
                                        {{ $package->price }}
                                    </var>
                                </p>
                                <p>{!! $package->description !!}</p>
                            </article>
                        @endforeach
                    </div>
                </div>
                <div class="service-single__review">
                    <div class="service-single__header-review">
                        <h2 class="service-single__subheading mb-0">Review</h2>
                        <form action="{{ route('service.filter-service', $service->id) }}" method="get" class="col-lg-5">
                            <label for="review-filter" class="d-none">Review filter</label>
                            <select name="review_filter" class="nice-select wide" id="review-filter" required>
                                @isset($filtering)
                                    <option value="recent" {{ $filtering == 'recent' ? 'selected' : '' }}>Recent</option>
                                    <option value="desc" {{ $filtering == 'desc' ? 'selected' : '' }}>Highest Rating</option>
                                    <option value="asc" {{ $filtering == 'asc' ? 'selected' : '' }}>Lowest Rating</option>
                                @else
                                    <option value="recent">Recent</option>
                                    <option value="desc">Highest Rating</option>
                                    <option value="asc">Lowest Rating</option>
                                @endisset
                            </select>
                        </form>
                    </div>
                    @forelse ($testimonies as $testimony)
                        <article class="service-single__comment">
                            <img src="{{ Storage::url($testimony->user->profile->avatar ?? 'files/people.webp') }}"
                                 height="20" alt="People comment image">
                            <div class="service-single__comment-detail">
                                <p class="service-single__comment-title">{{ $testimony->user->name }}</p>
                                <p class="service-single__comment-text">{{ $testimony->content }}</p>
                                <p class="mt-3">Review date: <time>{{ $testimony->created_at->format('d M Y') }}</time></p>
                                <p class="mt-3">
                                    Review Quality:
                                    <span>
                                        @for ($i = 0; $i < $testimony->rating; $i++)
                                            {!! "<i class='bx bxs-star' ></i>" !!}
                                        @endfor
                                        @for ($i = 0; $i < 5 - $testimony->rating; $i++)
                                            {!! "<i class='bx bx-star' ></i>" !!}
                                        @endfor
                                    </span>
                                </p>
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
                                    <var class="font-style-normal font-bold order-price money-formatting"
                                         data-price-package="{{ $package->price }}">
                                        {{ $package->price }}
                                    </var>
                                </p>
                                <p>{!! $package->description !!}</p>
                            </div>
                            @auth
                                <button class="btn-modal single-package__btn" data-target="#modal-single-extras"
                                data-package-id="{{ $package->id }}" data-agent-id="{{ $service->agent_id }}"
                                data-package-title="{{ $package->title }}">
                                    Continue (<var class="money-formatting">{{ $package->price }}</var>)
                                </button>
                                @if (Auth::user()->subscription->count() > 0)
                                <p class="mt-3 text-gray text-center">
                                    Token you have: {{ Auth::user()->subscription->sum('token') . ' token' ?? 0 . ' token' }}
                                    <span class="text-small d-block mt-2">
                                        (1 token = IDR <var class="money-formatting">{{ $tokenConversion->numeral }}</var>)
                                    </span>
                                </p>
                                @endif
                            @endauth
                            @guest
                                <a class="btn-modal single-package__btn"
                                   href="{{route('login').'?redirect='.URL::current()}}">
                                    Continue (<var class="money-formatting">{{ $package->price }}</var>)
                                </a>
                            @endguest
                        </div>
                    @endforeach
                </div>
            </aside>
        </div>
    </div>
@endsection
@push('element')
    <datalist id="list-promo">
        @foreach($promos as $promo)
            <option value="{{ $promo->code }}" data-code-discount="{{ $promo->discount }}">
                {{ $promo->code }}
            </option>
        @endforeach
    </datalist>
    @include('service.form-order')
@endpush
