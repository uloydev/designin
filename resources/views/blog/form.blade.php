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
    <div id="blog-content">{!! $article->contents ?? '' !!}</div>
    <textarea name="contents" id="blog-content"
              style="position:absolute; visibility: hidden; height: 0; width: 0; padding: 0"></textarea>
</div>
<div class="mb-3">
    <img src="" alt="cover preview">
    <div class="file-custom">
        <input accept="image/*" class="file-custom__input" id="blog-cover" name="header_image" type="file">
        <label class="file-custom__label" for="blog-cover">
            Pick a cover
        </label>
    </div>
    @isset($article)
    <p>
        Old cover:
        <a href="{{ Storage::url($article->header_image) }}" class="text-link" target="_blank">
            See cover
        </a>
    </p>
    @endisset
</div>
<div class="mb-3 checkbox-custom">
    <input type="checkbox" name="is_main" class="checkbox-custom__input" id="is_main"
           value="1" {{ $article->is_main == true ? 'checked' : '' }}>
    <label class="checkbox-custom__label" for="is_main">
        <span class="checkbox-custom__icon"><i class='bx bx-check' ></i></span>
        Make article primary
    </label>
</div>
