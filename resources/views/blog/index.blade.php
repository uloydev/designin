@extends('layouts.blog-master')
@section('page-title', 'Official Blog From Desainin')
@section('page-id', 'blogIndex')
@section('header')
  <header>
    <div class="container">
      <div class="row justify-content-center" id="main-article">
        {{-- main article --}}
        <div class="col-12">
          <article>
            <img src="{{ asset('img/article.jpg') }}" alt="Desainin article image" class="article__cover">
            <div class="article__caption">
              <p class="article__title mb-3">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam, sapiente, maiores. Quod, dignissimos.
              </p>
              <span class="article__category">News</span>
              <time class="article__time">April 23, 2020</time>
            </div>
            <a href="" class="article__link"></a>
          </article>
        </div>
        <div class="col-12">
          <article>
            <img src="{{ asset('img/article.jpg') }}" alt="Desainin article image" class="article__cover">
            <div class="article__caption">
              <p class="article__title mb-3">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe deserunt, voluptas qui repudiandae.
              </p>
              <span class="article__category">News</span>
              <time class="article__time">April 23, 2020</time>
            </div>
            <a href="" class="article__link"></a>
          </article>
        </div>
        <div class="col-12">
          <article>
            <img src="{{ asset('img/article.jpg') }}" alt="Desainin article image" class="article__cover">
            <div class="article__caption">
              <p class="article__title mb-3">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur odit, quae neque laudantium?
              </p>
              <span class="article__category">News</span>
              <time class="article__time">April 23, 2020</time>
            </div>
            <a href="" class="article__link"></a>
          </article>
        </div>
        <div class="col-12">
          <article>
            <img src="{{ asset('img/article.jpg') }}" alt="Desainin article image" class="article__cover">
            <div class="article__caption">
              <p class="article__title mb-3">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni nemo qui inventore dolor.
              </p>
              <span class="article__category">News</span>
              <time class="article__time">April 23, 2020</time>
            </div>
            <a href="" class="article__link"></a>
          </article>
        </div>
        <div class="col-12">
          <article>
            <img src="{{ asset('img/article.jpg') }}" alt="Desainin article image" class="article__cover">
            <div class="article__caption">
              <p class="article__title mb-3">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita suscipit perferendis blanditiis sequi.
              </p>
              <span class="article__category">News</span>
              <time class="article__time">April 23, 2020</time>
            </div>
            <a href="" class="article__link"></a>
          </article>
        </div>
        <div class="col-12">
          <article>
            <img src="{{ asset('img/article.jpg') }}" alt="Desainin article image" class="article__cover">
            <div class="article__caption">
              <p class="article__title mb-3">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum deleniti, reiciendis sapiente laborum?
              </p>
              <span class="article__category">News</span>
              <time class="article__time">April 23, 2020</time>
            </div>
            <a href="" class="article__link"></a>
          </article>
        </div>
        {{-- end of main article --}}
      </div>
    </div>
  </header>
@endsection
@section('content')
  <div class="container">
    <div class="row justify-content-md-between">
      <section class="col-12 col-md-8">
        <article>
          <img src="{{ asset('img/article2.jpg') }}" class="article__img">
          <div class="article__detail">
            <p class="article__title">
              <a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi</a>
            </p>
            <p class="article__content">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi ab ad ipsam tempora fugit, magnam aliquam optio
              consequuntur dolores commodi!
            </p>
            <span class="article__category">News</span>
            <time class="article__time">April 23, 2020</time>
          </div>
        </article>
        <article>
          <img src="{{ asset('img/article2.jpg') }}" class="article__img">
          <div class="article__detail">
            <p class="article__title">
              <a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est, enim.</a>
            </p>
            <p class="article__content">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae quis sapiente tenetur laudantium veritatis inventore
              dolorem ad fugiat architecto minima.
            </p>
            <span class="article__category">News</span>
            <time class="article__time">April 23, 2020</time>
          </div>
        </article>
        <article>
          <img src="{{ asset('img/article2.jpg') }}" class="article__img">
          <div class="article__detail">
            <p class="article__title">
              <a href="">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident, sunt.</a>
            </p>
            <p class="article__content">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam facilis deserunt perferendis nostrum
              temporibus similique fuga, exercitationem soluta minima ducimus.
            </p>
            <span class="article__category">News</span>
            <time class="article__time">April 23, 2020</time>
          </div>
        </article>
      </section>
      <aside class="col-12 col-md-4">
        <div class="article-popular">
          <h3 class="article-popular__heading">
            <span>Most Popular</span>
          </h3>
          <article class="mb-5">
            <div class="article__detail">
              <p class="article__title article__title--popular">
                <a href="">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident, sunt.</a>
              </p>
              <span class="article-popular__category">News</span>
              <time class="article-popular__time">April 23, 2020</time>
            </div>
            <img src="{{ asset('img/article2.jpg') }}" class="article__img article__img--popular">
          </article>
          <article class="mb-5">
            <div class="article__detail">
              <p class="article__title article__title--popular">
                <a href="">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident, sunt.</a>
              </p>
              <span class="article-popular__category">News</span>
              <time class="article-popular__time">April 23, 2020</time>
            </div>
            <img src="{{ asset('img/article2.jpg') }}" class="article__img article__img--popular">
          </article>
          <article class="mb-5">
            <div class="article__detail">
              <p class="article__title article__title--popular">
                <a href="">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident, sunt.</a>
              </p>
              <span class="article-popular__category">News</span>
              <time class="article-popular__time">April 23, 2020</time>
            </div>
            <img src="{{ asset('img/article2.jpg') }}" class="article__img article__img--popular">
          </article>
        </div>
        <div class="article-category">
          <h3 class="article-popular__heading">
            <span>Category</span>
          </h3>
          <ul>
            <li class="article-category__item mb-3">
              <a href="#">news</a>
            </li>
            <li class="article-category__item mb-3">
              <a href="#">promo</a>
            </li>
          </ul>
        </div>
      </aside>
    </div>
  </div>
@endsection
