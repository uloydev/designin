@extends('layouts.blog-master')
@section('page-id', 'blogCategory')
@section('page-title')
    {{ $articleCategory->name }} Category
@endsection
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css"
          rel="stylesheet">
@stop
@section('header')
    <header>
        <div class="container py-4 px-0">
            <div class="category-header__content">
                <h1 class="text-center mb-3 mb-md-0">{{ $articleCategory->name }}</h1>
                <form action="" method="get">
                    @csrf
                    <select name="filter" class="category-header__filter wide">
                        <option value="" disabled selected>Filter Article</option>
                        <option value="">Latest</option>
                        <option value="">Oldest</option>
                        <option value="">Most Popular</option>
                    </select>
                </form>
            </div>
        </div>
    </header>
@stop
@section('content')
    <section>
        <div class="container py-4">
            <div class="row">
                @forelse ($articles as $article)
                    <div class="col-12 col-md-6 col-lg-4">
                        <article class="category-article">
                            <a href="" class="category-article__open category-article__img">
                                <img src="{{ Storage::url($article->header_image) }}" alt="Article Image">
                            </a>
                            <div class="category-article__caption">
                                <p class="category-article__title">
                                    <a href="" class="category-article__open">
                                        {{ Str::words($article->title, 10) }}
                                    </a>
                                </p>
                                <p class="category-article__content">
                                    {!! Str::words($article->contents, 22) !!}
                                </p>
                                <div class="category-article__action">
                                    <a href="">{{ $articleCategory->name }}</a>
                                    <time>{{ date('d-M-Y') }}</time>
                                </div>
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="alert alert--light col text-center">
                        No article
                    </div>
                @endforelse
            </div>
            {{ $articles->links() }}
        </div>
    </section>
@endsection
