@extends('layouts.customer-master')
@section('page-title', 'FAQ')
@section('page-id', 'faq')
@section('header')
  <header>
    @include('partials.nav')
    <div class="container">
      <h1 class="faq-header__heading">How can we <strong>help you?</strong></h1>
      <form class="faq-header__search-form" action="index.html" method="post">
        <input type="search" placeholder="How can we help you?" class="faq-header__search-input" name="search_faq" autofocus required>
        <button type="submit" class="faq-header__search-btn"><i class='bx bx-search-alt'></i></button>
      </form>
    </div>
  </header>
@endsection
@section('content')
  <div class="container">
    <div class="jq-tab-wrapper px-0 mx-0 row justify-content-between" id="faqs">
      <aside class="jq-tab-menu question-cat mb-5 mb-md-0">
        @foreach ($faqCategories as $category)
          <div class="jq-tab-title {{ $loop->first ? 'active' : '' }}" data-tab="{{ $category->id }}">{{ $category->category }}</div>
        @endforeach
      </aside>
      <section class="jq-tab-content-wrapper question-answer px-0">
        @foreach ($faqs as $faq)
          <article class="jq-tab-content question-answer__item {{ $faq->faqCategory->id == 1 ? 'active' : '' }}"
          data-tab="{{ $faq->faqCategory->id }}" data-faq="{{ $faq->id }}">
            <details>
              <summary class="question-answer__problem">{{ $faq->question }} <i class='bx bxs-chevron-down'></i></summary>
              <div class="question-answer__solution">{{ $faq->answer }}</div>
            </details>
          </article>
        @endforeach
      </section>
    </div>
  </div>
@endsection
@section('script')
  <div class="overlay overlay--nav-showed"></div>
  <script>
    $(document).ready(function() {
      if ($(window).width() > 768) {
        $('#faqs').jqTabs({
          direction: 'vertical'
        });
      }
      else {
        $('#faqs').jqTabs({
          direction: 'horizontal'
        });
      }
    });
  </script>
@endsection
