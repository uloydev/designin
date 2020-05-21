<div class="modal fade" id="delete-article" tabindex="-1" role="dialog"
     aria-labelledby="delete-article" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-default">
                    Delete article <span class="modal-article-title"></span>
                </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure wanna delete article with title
                <strong class="modal-article-title"></strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Cancel</button>
                <form action="{{--routing on js--}}" method="post">
                    @csrf @method("DELETE")
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div aria-hidden="true" aria-labelledby="delete-category-article" class="modal fade" id="delete-category-article"
     role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-default">
                    Delete category <span class="modal-category-name"></span>
                </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure wanna delete category with title
                <strong class="modal-category-name"></strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Cancel</button>
                <form action="{{--routing on js--}}" method="post">
                    @csrf @method("DELETE")
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

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
                    <label for="add_category">Name Category</label>
                    <input class="form-control" name="name" id="add_category" placeholder="Insert Category Name"
                    type="text" required>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" form="form-add-category">Add new category</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-category-article" tabindex="-1" role="dialog"
     aria-labelledby="edit-category-article" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Edit category <span class="modal-category-name"></span></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="form-edit-category">
                    @csrf @method('PUT')
                    <label for="edit_category">Name Category</label>
                    <input class="form-control" name="edit_category" placeholder="Insert Category Name"
                    id="edit_category" type="text" required>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-link text-gray" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success" form="form-edit-category">Update category</button>
            </div>
        </div>
    </div>
</div>
