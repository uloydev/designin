@extends('layouts.blog-master')
@section('page-title')
  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati, non.
@endsection
@section('page-id', 'blogSingle')
@section('content')
<div class="container">
    <div class="row justify-content-between py-5" id="single-article">
      <section class="col-12 col-md-8">
        <figure class="single-article__top">
          <img src="{{ Storage::url($blog->header_image) }}" alt="{{ $blog->title }}">
          <figcaption class="single-article__info">
            <h1 class="single-article__title">{{ $blog->title }}</h1>
            <a href="{{ route('blog-category.show', $blog->category_id) }}" class="single-article__category">
                {{ $blog->category->name }}
            </a>
            <time class="single-article__time">{{ $blog->updated_at->format('d M, Y') }}</time>
          </figcaption>
        </figure>
        <div class="singe-article__bottom">{!! $blog->contents !!}</div>
      </section>
      <aside class="col-12 col-md-4 col-lg-3 mt-4 mt-md-0">
        <div class="article-popular">
          <h3 class="article-popular__heading">
            <span>Most Popular</span>
          </h3>
          @foreach ($popular as $article)
          <article class="mb-5">
            <div class="article__detail pl-0">
              <p class="article__title article__title--popular">
                <a href="{{ route('manage.blog.show', $article->id) }}">{{ $article->title }}</a>
              </p>
              <span class="article-popular__category">{{ $article->category->name }}</span>
              <time class="article-popular__time">{{ $article->updated_at->format('d M, Y') }}</time>
            </div>
            <img src="{{ asset('img/article2.jpg') }}" class="article__img article__img--popular">
          </article>
          @endforeach
        </div>
        <div class="article-popular">
          <h3 class="article-popular__heading">
            <span>Related stories</span>
          </h3>
          @foreach ($relates as $related)
          <article class="mb-5">
            <div class="article__detail pl-0">
              <p class="article__title article__title--popular">
                <a href="{{ route('manage.blog.show', $related->id) }}">{{ $related->title }}</a>
              </p>
              <span class="article-popular__category">{{ $related->category->name }}</span>
              <time class="article-popular__time">{{ $related->updated_at->format('d M, Y') }}</time>
            </div>
            <img src="{{ asset('img/article2.jpg') }}" class="article__img article__img--popular">
          </article>
          @endforeach
        </div>
      </aside>
    </div>
  </div>
@endsection
