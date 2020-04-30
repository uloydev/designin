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
    <button type="button" class="btn btn-link px-0" data-toggle="modal" data-target="#blog-add-category">Add new category</button>
</div>
<div class="form-group">
  <label for="blog-content">Content</label>
  <textarea id="blog-content" rows="8" name="content" required>{{ $article->content ?? '' }}</textarea>
</div>
<div class="form-group">
  <img src="" alt="cover preview">
  <div class="custom-file">
    <input type="file" name="header_image" class="custom-file-input" id="blog-cover" accept="image/*">
    <label class="custom-file-label" for="blog-cover">Pick a cover</label>
  </div>
</div>

@section('script')
<script src="{{ asset('js/bootstrap.bundle.min.js') }}" charset="utf-8"></script>
@endsection
