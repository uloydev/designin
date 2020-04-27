@section('css')
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugin/summernote/summernote-bs4.min.css') }}">
@endsection
<div class="form-group">
  <label for="blog-title">Title Article</label>
  <input type="text" class="form-control" name="title" id="blog-title" placeholder="Title of your article" value="{{ $blog->title ?? '' }}" required>
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
  <textarea id="blog-content" rows="8" name="content" required></textarea>
</div>
@section('script')
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('plugin/summernote/summernote-bs4.min.js') }}"></script>
@endsection
