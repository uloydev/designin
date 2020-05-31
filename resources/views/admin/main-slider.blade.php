<div class="modal fade" id="addSlider" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add slider</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('manage.main-slider.store') }}" method="post"
                      enctype="multipart/form-data" id="form-add-slider">
                    @csrf
                    <div class="custom-file">
                        <input type="file" class="custom-file-input d-none file-custom__input" id="addSlider"
                               name="slider" accept="image/*">
                        <label class="custom-file-label" for="addSlider">Update this slider</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-link text-gray" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" form="form-add-slider">Add new tslider</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="updateSlider" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update slider</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data" id="form-update-slider">
                    @csrf @method('PUT')
                    <div class="custom-file">
                        <input type="file" class="custom-file-input d-none file-custom__input" id="slider"
                               name="slider" accept="image/*">
                        <label class="custom-file-label" for="slider">Update this slider</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-link text-gray" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="form-update-slider">Update this slider</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteSlider" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update slider</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="h3 text-center">Are you sure wanna delete this slider?</p>
                <form method="post" enctype="multipart/form-data"
                      class="d-none" id="form-delete-slider">
                    @csrf @method('DELETE')
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-link text-gray" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger" form="form-delete-slider">Yes, delete</button>
            </div>
        </div>
    </div>
</div>
