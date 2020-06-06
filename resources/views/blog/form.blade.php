@section('css')
{{--  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">--}}
@endsection
@csrf
<div class="mb-3">
    <label for="blog-title" class="mb-2 d-block">Title Article</label>
    <input type="text" class="input-custom" name="title" id="blog-title" placeholder="Title of your article"
    value="{{ $article->title ?? '' }}" autofocus required>
</div>
<div class="mb-3">
    <label for="blog-category" class="mb-2 d-block">Category</label>
    <select class="input-custom" id="blog-category" name="category_id" required>
        @foreach ($categories as $category)
        <option value="{{$category->id}}">{{$category->name}}</option>
        @endforeach
    </select>
    <button type="button" class="btn-link btn-modal px-0" data-target="#blog-add-category">
        Add new category
    </button>
</div>
<div class="mb-3">
  <label for="blog-content" class="mb-2 d-block">Content</label>
  <textarea id="blog-content" rows="8" name="contents" required>{!! $article->contents ?? '' !!}</textarea>
</div>
<div class="form-group">
  <img src="" alt="cover preview">
  <div class="file-custom">
    <input accept="image/*" class="file-custom__input" id="blog-cover" name="header_image" type="file">
    <label class="file-custom__label" for="blog-cover">Pick a cover</label>
  </div>
</div>
@if ($mainArticles <= 6)
<div class="custom-control custom-switch form-group">
    <input type="checkbox" name="is_main" class="custom-control-input" id="is_main">
    <label class="custom-control-label" for="is_main">Make article primary</label>
</div>
@endif

@section('script')
<script src="{{ asset('js/bootstrap.bundle.min.js') }}" charset="utf-8"></script>
@endsection
