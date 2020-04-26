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
          <img src="{{ asset('img/article3.jpg') }}" alt="4 Ways to Enhance Customer Experience in 2020">
          <figcaption class="single-article__info">
            <h1 class="single-article__title">4 Ways to Enhance Customer Experience in 2020</h1>
            <a href="" class="single-article__category">news</a>
            <time class="single-article__time">April 19, 2020</time>
          </figcaption>
        </figure>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum lobortis nulla erat, nec elementum libero egestas at.
        Morbi ut purus tincidunt, dignissim libero placerat, consectetur ipsum. Sed efficitur vestibulum dolor suscipit varius.
        Interdum et malesuada fames ac ante ipsum primis in faucibus. Sed sed sodales nibh. Nulla lobortis metus in pharetra tempus.
        Maecenas viverra sapien ac tincidunt aliquam. Suspendisse neque felis, luctus sit amet risus sit amet, lacinia hendrerit lectus.
        Praesent placerat et metus quis dapibus. Nullam malesuada ornare lacus, eget tempus urna sollicitudin sed.
        Integer sit amet dignissim eros. Praesent pulvinar gravida nisi. Proin finibus tortor id magna consequat convallis.
        Donec nec metus aliquam, mattis dolor sed, commodo arcu.

        Ut a mauris scelerisque, molestie lorem eget, eleifend eros. Curabitur finibus maximus mauris a condimentum.
        Nulla suscipit ex at purus dapibus, nec molestie neque efficitur. Fusce diam justo, lacinia vitae dictum vitae, molestie a eros.
        Nullam eu eros volutpat, euismod neque et, tincidunt enim. Praesent dui mauris, euismod in nibh pellentesque, luctus imperdiet arcu.
        Suspendisse maximus mollis posuere. Aliquam congue mi eget ornare euismod. Sed tincidunt velit eget ipsum porta pretium.
        Sed vel imperdiet nulla. Curabitur turpis nulla, posuere non viverra a, auctor ut lorem.

        Duis mattis venenatis ligula, vitae efficitur eros. Phasellus efficitur, dui vitae dapibus ultrices, velit lorem pellentesque lacus,
        id lacinia mauris neque eu nulla. Quisque quis nulla feugiat, tristique mauris sit amet, facilisis nisl.
        Donec bibendum pulvinar porta. Sed porttitor aliquam sapien sit amet accumsan. Duis semper nulla non egestas porttitor.
        Pellentesque quis facilisis lacus. Integer turpis arcu, tempor sed diam in, efficitur accumsan sapien.

        Maecenas congue, felis id pharetra sollicitudin, purus ipsum condimentum leo, et euismod augue orci in tortor.
        Morbi venenatis semper ante, eu mollis nulla consectetur sed. Cras imperdiet gravida odio tincidunt interdum.
        Praesent ut velit et risus egestas tempor non a magna. Proin ac venenatis metus.
        Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Maecenas ultricies pellentesque
        velit non commodo. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
        Pellentesque neque est, aliquet sed augue ut, suscipit accumsan erat. Sed id ornare urna. Ut pellentesque dictum lacus,
        blandit pellentesque purus lacinia aliquam. Praesent eget nulla faucibus, vehicula tortor at, finibus neque.
        Donec pellentesque dui eget dolor dictum eleifend. Sed suscipit tellus nec orci tempor lobortis.

        Duis auctor maximus euismod. Donec nec mi eu ligula congue iaculis. Proin ac lectus mollis, pellentesque sapien et, bibendum nulla.
        Quisque malesuada interdum augue non consequat. Sed sollicitudin ipsum diam, sed iaculis diam tincidunt viverra.
        Aliquam aliquet neque rutrum, elementum tellus sit amet, porttitor nibh. Donec condimentum diam non mi convallis vehicula.
      </section>
      <aside class="col-12 col-md-4 col-lg-3 mt-4 mt-md-0">
        <div class="article-popular">
          <h3 class="article-popular__heading">
            <span>Most Popular</span>
          </h3>
          <article class="mb-5">
            <div class="article__detail pl-0">
              <p class="article__title article__title--popular">
                <a href="">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident, sunt.</a>
              </p>
              <span class="article-popular__category">News</span>
              <time class="article-popular__time">April 23, 2020</time>
            </div>
            <img src="{{ asset('img/article2.jpg') }}" class="article__img article__img--popular">
          </article>
          <article class="mb-5">
            <div class="article__detail pl-0">
              <p class="article__title article__title--popular">
                <a href="">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident, sunt.</a>
              </p>
              <span class="article-popular__category">News</span>
              <time class="article-popular__time">April 23, 2020</time>
            </div>
            <img src="{{ asset('img/article2.jpg') }}" class="article__img article__img--popular">
          </article>
          <article class="mb-5">
            <div class="article__detail pl-0">
              <p class="article__title article__title--popular">
                <a href="">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident, sunt.</a>
              </p>
              <span class="article-popular__category">News</span>
              <time class="article-popular__time">April 23, 2020</time>
            </div>
            <img src="{{ asset('img/article2.jpg') }}" class="article__img article__img--popular">
          </article>
        </div>
        <div class="article-popular">
          <h3 class="article-popular__heading">
            <span>Related stories</span>
          </h3>
          <article class="mb-5">
            <div class="article__detail pl-0">
              <p class="article__title article__title--popular">
                <a href="">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident, sunt.</a>
              </p>
              <span class="article-popular__category">News</span>
              <time class="article-popular__time">April 23, 2020</time>
            </div>
            <img src="{{ asset('img/article2.jpg') }}" class="article__img article__img--popular">
          </article>
          <article class="mb-5">
            <div class="article__detail pl-0">
              <p class="article__title article__title--popular">
                <a href="">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident, sunt.</a>
              </p>
              <span class="article-popular__category">News</span>
              <time class="article-popular__time">April 23, 2020</time>
            </div>
            <img src="{{ asset('img/article2.jpg') }}" class="article__img article__img--popular">
          </article>
          <article class="mb-5">
            <div class="article__detail pl-0">
              <p class="article__title article__title--popular">
                <a href="">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident, sunt.</a>
              </p>
              <span class="article-popular__category">News</span>
              <time class="article-popular__time">April 23, 2020</time>
            </div>
            <img src="{{ asset('img/article2.jpg') }}" class="article__img article__img--popular">
          </article>
        </div>
      </aside>
    </div>
  </div>
@endsection
