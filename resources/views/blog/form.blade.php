@section('css')
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
@endsection
@csrf
<div class="form-group">
    <label for="blog-title">Title Article</label>
    <input type="text" class="form-control" name="title" id="blog-title" placeholder="Title of your article"
    value="{{ $article->title ?? '' }}" autofocus required>
</div>
<div class="form-group">
    <label for="blog-category">Category</label>
    <select class="custom-select" id="blog-category" name="category_id" required>
        @foreach ($categories as $category)
        <option value="{{$category->id}}">{{$category->name}}</option>
        @endforeach
    </select>
    <button type="button" class="btn btn-link px-0" data-toggle="modal" data-target="#blog-add-category">
        Add new category
    </button>
</div>
<div class="form-group">
  <label for="blog-content">Content</label>
  <textarea id="blog-content" rows="8" name="contents" required>{{ $article->contents ?? '' }}</textarea>
</div>
<div class="form-group">
  <img src="" alt="cover preview">
  <div class="custom-file">
    <input accept="image/*" class="custom-file-input" id="blog-cover" name="header_image" required type="file">
    <label class="custom-file-label" for="blog-cover">Pick a cover</label>
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
