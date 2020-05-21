@extends('layouts.customer-master')
@section('page-title', 'FAQ')
@section('page-id', 'faq')
@section('header')
  <header>
    @include('partials.nav')
    <div class="container">
      <div class="row mx-0">
        <img src="{{ asset('img/faq.png') }}" class="faq-header__cover">
        <div class="col-12 col-lg-6 faq-header__caption pr-0">
          <h1 class="faq-header__heading">How can we <br class="d-lg-none"> <strong>help you?</strong></h1>
          <form class="faq-header__search-form" action="index.html" method="post">
            <input type="search" placeholder="Find anything you want..." class="faq-header__search-input"
                   name="search_faq" autofocus required>
            <button type="submit" class="faq-header__search-btn"><i class='bx bx-search-alt'></i></button>
          </form>
        </div>
      </div>
    </div>
  </header>
@endsection
@section('content')
  <div class="container">
    <div class="jq-tab-wrapper px-0 mx-0 row justify-content-between" id="faqs">
      <aside class="jq-tab-menu question-cat mb-5 mb-md-0">
        @foreach ($faqCategories as $category)
          <div class="jq-tab-title {{ $loop->first ? 'active' : '' }}" data-tab="{{ $category->id }}">
              {{ $category->category }}
          </div>
        @endforeach
      </aside>
      <section class="jq-tab-content-wrapper question-answer px-0">
          @forelse ($faqs as $faq)
              <article class="jq-tab-content question-answer__item {{ $faq->faqCategory->id == 1 ? 'active' : '' }}"
                       data-tab="{{ $faq->faqCategory->id }}" data-faq="{{ $faq->id }}">
                  <details>
                      <summary class="question-answer__problem">
                          {{ $faq->question }} <i class='bx bxs-chevron-down'></i>
                      </summary>
                      <div class="question-answer__solution">{{ $faq->answer }}</div>
                  </details>
              </article>
          @empty
              <div class="alert alert--light">
                  No faq found
              </div>
          @endforelse
          <a href="" class="question-answer__show-more">Show more</a>
      </section>
    </div>
  </div>
  <div class="overlay overlay--nav-showed"></div>
@endsection
