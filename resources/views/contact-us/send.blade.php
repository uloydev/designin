@extends('layouts.customer-master')
@section('page-title', 'Contact us')
@section('page-id', 'contactUs')
@section('header')
    @include('partials.nav')
@endsection
@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert--success mb-5">
                {{ session('success') }}
            </div>
        @endif
        <div class="row justify-content-between contact-us">
            <section class="contact-us__illustration col-12 col-lg-6 col-xl-5">
                <img src="{{ asset('img/contact-us.jpg') }}" class="contact-us__img" alt="Contact us Desainin"
                     draggable="false">
            </section>
            <section class="contact-us__message col-12 col-lg-6">
                <h1 class="contact-us__heading">Have any idea? <br> We glad to hear that</h1>
                <form class="contact-us__form" action="{{ route('contact-us.store' )}}" method="post">
                    @csrf
                    <input type="text" class="contact-us__input" name="name" placeholder="What's your name"
                           autocomplete="name" required autofocus>
                    <input type="email" class="contact-us__input" name="email" placeholder="What's your email"
                           autocomplete="email" required>
                    <textarea name="message" class="contact-us__input" rows="15" placeholder="Message..."></textarea>
                    <button type="submit" class="contact-us__submit-btn">Send your message</button>
                </form>
            </section>
        </div>
    </div>
@endsection
@section('element')
    <div class="overlay overlay--nav-showed"></div>
@endsection
