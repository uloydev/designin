<div class="modal fade" id="delete-category" tabindex="-1" role="dialog"
     aria-labelledby="delete-category" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-default">
                    Delete category with title <strong class="service-category-title"></strong>
                </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Are you sure wanna delete service category
                    <strong class="service-category-title"></strong>?
                </p>
                <p>
                    This also will <strong>delete any other service</strong>
                    who have category <strong class="service-category-title"></strong>
                </p>
                <form action="{{-- routing on js --}}" method="post" id="service-category-form">
                    @csrf @method('DELETE')
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" form="service-category-form">Delete</button>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="create-edit-category" tabindex="-1" role="dialog"
     aria-labelledby="create-edit-categoryLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add / edit category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{-- routing on js --}}" method="post">
                    <div class="form-group">
                        <label for="category-name" class="mb-3">Category Name</label>
                        <input type="email" name="service_category" class="form-control text-dark"
                               id="category-name" placeholder="Insert category name">
                    </div>
                    <div class="form-group">
                        <p class="text-darker">Image category</p>
                        <div class="custom-file">
                            <input type="file" name="image_url" class="custom-file-input d-none" id="imgCategory">
                            <label class="custom-file-label" for="imgCategory">Choose Image</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
