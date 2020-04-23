@extends('layouts.customer-master')
@section('page-title', 'FAQ')
@section('page-id', 'faq')
@section('header')
  <header>
    @include('partials.nav')
  </header>
@endsection
@section('content')
  <div class="container">
    <div class="row mb-3">
      <form class="question-answer__search-form" action="index.html" method="post">
        <input type="search" placeholder="How can we help you?" class="question-answer__search-input" name="search_faq" autofocus required>
        <button type="submit" class="question-answer__search-btn">search</button>
      </form>
    </div>
    <div class="jq-tab-wrapper px-0 mx-0 row justify-content-between" id="myTab">
      <aside class="jq-tab-menu question-cat col-12 col-md-9 col-lg-8">
        <div class="jq-tab-title active" data-tab="1">Tab 1</div>
        <div class="jq-tab-title" data-tab="2">Tab 2</div>
        <div class="jq-tab-title" data-tab="3">Tab 3</div>
      </aside>
      <section class="jq-tab-content-wrapper question-answer col-12 col-md-9 col-lg-8">
        <article class="jq-tab-content active question-answer__item" data-tab="1">
          <details>
            <summary class="question-answer__problem">Tab 1 content 1 <i class='bx bxs-chevron-down'></i></summary>
            <div class="question-answer__solution">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
              Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
              Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
              Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </div>
          </details>
        </article>
        <article class="jq-tab-content active question-answer__item" data-tab="1">
          <details>
            <summary class="question-answer__problem">Tab 1 content 2 <i class='bx bxs-chevron-down'></i></summary>
            <div class="question-answer__solution">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
              Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
              Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
              Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </div>
          </details>
        </article>
        <article class="jq-tab-content question-answer__item" data-tab="2">
          <details>
            <summary class="question-answer__problem">Tab 2 <i class='bx bxs-chevron-down'></i></summary>
            <div class="question-answer__solution">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
              Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
              Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
              Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </div>
          </details>
        </article>
        <article class="jq-tab-content question-answer__item" data-tab="3">
          <details>
            <summary class="question-answer__problem">Tab 3 <i class='bx bxs-chevron-down'></i></summary>
            <div class="question-answer__solution">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
              Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
              Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
              Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </div>
          </details>
        </article>
      </section>
    </div>
  </div>
@endsection
@section('script')
  <div class="overlay overlay--nav-showed"></div>
  <script>
    $(document).ready(function() {
      $('#myTab').jqTabs({
        direction: 'vertical'
      });
    });
  </script>
@endsection
