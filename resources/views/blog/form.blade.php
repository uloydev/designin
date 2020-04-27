@section('css')
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
@endsection
<div class="form-group">
  <label for="blog-title">Title Article</label>
  <input type="text" class="form-control" name="title" id="blog-title" placeholder="Title of your article"
  value="{{ $article->title ?? '' }}" autofocus required>
</div>
<div class="form-group">
  <label for="blog-category">Category</label>
  <select class="custom-select" id="blog-category" name="category" required>
    <option selected>News</option>
    <option>Promo</option>
  </select>
  <button type="button" class="btn btn-link px-0" data-toggle="modal" data-target="#blog-add-category">Add new category</button>
</div>
<div class="form-group">
  <label for="blog-content">Content</label>
  <textarea id="blog-content" rows="8" name="content" required></textarea>
</div>
<div class="form-group">
  <img src="" alt="cover preview">
  <div class="custom-file">
    <input type="file" name="header_image" class="custom-file-input" id="blog-cover" accept="image/*" required>
    <label class="custom-file-label" for="blog-cover">Pick a cover</label>
  </div>
</div>
@section('script')
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}" charset="utf-8"></script>
@endsection
