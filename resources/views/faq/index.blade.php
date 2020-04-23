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
    <div class="row">
      <aside class="question-cat col-12 col-md-3 col-lg-4 mb-3 mb-md-0">
        <h2 class="question-cat__heading">Question Category</h2>
        <a href="" class="question-cat__list">category 1</a>
        <a href="" class="question-cat__list">category 2</a>
        <a href="" class="question-cat__list">category 3</a>
      </aside>
      <section class="question-answer col-12 col-md-9 col-lg-8">
        <form class="question-answer__search-form" action="index.html" method="post">
          <input type="search" placeholder="How can we help you?" class="question-answer__search-input" name="search_faq" autofocus required>
          <button type="submit" class="question-answer__search-btn">search</button>
        </form>
        <article class="question-answer__item">
          <details>
            <summary class="question-answer__problem">Question 1 <i class='bx bxs-chevron-down'></i></summary>
            <div class="question-answer__solution">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
              Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
              Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
              Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </div>
          </details>
        </article>
        <article class="question-answer__item">
          <details>
            <summary class="question-answer__problem">Question 1 <i class='bx bxs-chevron-down'></i></summary>
            <div class="question-answer__solution">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
              Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
              Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
              Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </div>
          </details>
        </article>
        <article class="question-answer__item">
          <details>
            <summary class="question-answer__problem">Question 1 <i class='bx bxs-chevron-down'></i></summary>
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

    });
  </script>
@endsection
