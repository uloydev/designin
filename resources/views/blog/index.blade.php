@extends('layouts.blog-master')
@section('page-title', 'Official Blog From Desainin')
@section('page-id', 'blogIndex')
@section('header')
  <header>
    <div class="container">
      <div class="row justify-content-center" id="main-article">
        @foreach ($mainArticle as $main)
        <div class="col-12">
            <a href="{{ route('blog.show', $main->id) }}" class="article__link">
                <article>
                    <img src="{{ asset('storage/' . $main->header_image) }}" alt="Desainin article image" class="article__cover">
                    <div class="article__caption">
                        <p class="article__title mb-3">
                            {{ Str::words($main->title, 10) }}
                        </p>
                        <span class="article__category">{{ $main->category->name }}</span>
                        <time class="article__time">{{ $main->created_at->format('D m, Y') }}</time>
                    </div>
                </article>
            </a>
        </div>
        @endforeach
      </div>
    </div>
  </header>
@endsection
@section('content')
  <div class="container">
    <div class="row justify-content-md-between">
      <section class="col-12 col-md-8">
          @foreach ($blogs as $blog)
          <article>
              <img src="{{ asset('storage/' . $main->header_image) }}" class="article__img">
              <div class="article__detail">
                <p class="article__title">
                  <a href="#">{{ Str::words($blog->title, 5) }}</a>
                </p>
                <p class="article__content">{{ Str::words($blog->contents, 20) }}</p>
                <span class="article__category">{{ $blog->category->name }}</span>
                <time class="article__time">{{ $blog->created_at->format('D m, Y') }}</time>
              </div>
          </article>
          @endforeach
          {{ $blogs->links() }}
      </section>
      <aside class="col-12 col-md-4">
        <div class="article-popular">
          <h3 class="article-popular__heading">
            <span>Most Popular</span>
          </h3>
          @foreach ($populars as $popular)
              <article class="mb-5">
                <div class="article__detail">
                  <p class="article__title article__title--popular">
                    <a href="">{{ Str::words($popular->title, 8) }}</a>
                  </p>
                  <span class="article-popular__category">{{ $popular->category->name }}</span>
                  <time class="article-popular__time">{{ $popular->created_at->format('D m, Y') }}</time>
                </div>
                <img src="{{ asset('storage/' . $popular->header_image) }}" class="article__img article__img--popular"
                     alt="{{ $popular->title }} Article Image">
              </article>
          @endforeach
        </div>
        <div class="article-category">
          <h3 class="article-popular__heading">
            <span>Category</span>
          </h3>
          <ul>
              @foreach ($categories as $category)
                  <li class="article-category__item mb-3">
                      <a href="{{ route('blog-category.show', $category->id) }}">{{ $category->name }}</a>
                  </li>
              @endforeach
          </ul>
        </div>
      </aside>
    </div>
  </div>
@endsection
