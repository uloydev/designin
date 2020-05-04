<div class="modal fade" id="add-category-article" tabindex="-1" role="dialog"
     aria-labelledby="add-category-article" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Add new category</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('manage.blog-category.store') }}" method="post" id="form-add-category">
                    @csrf
                    <label for="category">Name Category</label>
                    <input class="form-control" name="name" id="category" placeholder="Insert Category Name" type="text" required>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" form="form-add-category">Add new category</button>
            </div>
        </div>
    </div>
</div>
