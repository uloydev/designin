@extends('layouts.blog-master')
@section('page-id', 'blogCategory')
@section('page-title')
    {{ $articleCategory->name }} Category
@endsection
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css"
          rel="stylesheet">
@endsection
@section('script')
<script>
    let filter = $('#filter-blog select[name=filter]').val();
    $('#filter-blog select[name=filter]').change(function(){
        if($(this).val() !== 'disabled' && $(this).val() !== filter){
            $('#filter-blog').submit();
        }
    });
</script>
@endsection
@section('header')
    <header>
        <div class="container py-5 px-0">
            <div class="row mb-5">
                <div class="col">
                    <form action="{{ route('blog-category.show', $articleCategory->id) }}" class="search-service" method="get">
                        <input type="search" class="search-service__input" name="search_blog"
                               placeholder="Find any article..." value="{{ $query ?? '' }}">
                        <button class="search-service__btn"><i class='bx bx-search-alt'></i></button>
                    </form>
                </div>
            </div>
            <div class="category-header__content">
                <h1 class="text-center mb-3 mb-md-0">{{ $articleCategory->name }}</h1>
                <form action="{{ route('blog-category.show', $articleCategory->id) }}" method="get" id="filter-blog">
                    <select name="filter" class="category-header__filter wide">
                        <option value="disabled" disabled selected>Filter Article</option>
                        <option value="latest">Latest</option>
                        <option value="oldest">Oldest</option>
                        <option value="popular">Most Popular</option>
                    </select>
                </form>
            </div>
        </div>
    </header>
@endsection
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
                                    <a href="{{ route('blog.show', $article->id) }}" class="category-article__open">
                                        {{ Str::words($article->title, 10) }}
                                    </a>
                                </p>
                                <p class="category-article__content">
                                    {!! Str::words($article->contents, 10) !!}
                                </p>
                                <div class="category-article__action">
                                    <a href="{{ route('blog.show', $article->id) }}">{{ $article->category->name }}</a>
                                    <time class="ml-2">{{ $article->created_at->format('d F Y') }}</time>
                                    <span class="ml-auto">
                                        <i class='bx bxs-happy-heart-eyes'></i>
                                        <var class="font-style-normal">{{ $article->hits }}</var>
                                    </span>
                                </div>
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <article class="category-article flex-column align-items-center">
                            <img src="{{ asset('img/not-found.jpg') }}" alt="Article not found" height="200" class="d-block">
                            <h4>
                                No article found.
                                <a href="{{ url()->previous() }}" class="text-link d-block mt-2 align-items-center d-flex">
                                    <i class='bx bx-left-arrow-alt'></i> Back to previous page
                                </a>
                            </h4>
                        </article>
                    </div>
                @endforelse
            </div>
            {{ $articles->links() }}
        </div>
    </section>
@endsection
