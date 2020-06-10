<div class="modal fade" id="modal-manipulate-package" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <span class="modal-manipulate-title"></span> package
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="form-manipulate-package">
                    @csrf @method('PUT')
                    <input type="hidden" name="service_id" value="{{ $service->id }}" required readonly>
                    <div class="form-group">
                        <label for="name-edit">package name</label>
                        <input type="text" class="form-control" id="name" name="name_package"
                               placeholder="Ex: Reduce delivery by 1 day" autofocus required>
                    </div>
                    <div class="input-group form-group">
                        <label class="col-12 px-0" for="price">package price</label>
                        <div class="input-group-prepend">
                            <div class="input-group-text">Rp</div>
                        </div>
                        <input type="number" class="form-control" name="price_package" min="1000"
                               id="price" placeholder="package price" required>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="number" class="form-control" name="duration_package" placeholder="Duration"
                                   min="1" max="999" aria-label="duration" aria-describedby="duration">
                            <div class="input-group-append">
                                <span class="input-group-text" id="duration">day(s)</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Price token</label>
                        <input type="number" class="form-control" id="name" name="token_package" min="0" value="0"
                               placeholder="Price for this package if they are using token">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <div id="benefit_package" data-name="benefit_package"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-between">
                <button type="button" class="btn btn-link text-gray" data-dismiss="modal">
                    Cancel
                </button>
                <button type="submit" class="btn btn-success" form="form-manipulate-package">Save</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-delete-package" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Delete package <span class="modal-package-title"></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure to delete this package?</p>
                <p class="text-danger">You can't undo this</p>
                <form action="" method="post" id="form-delete-package">
                    @csrf @method('DELETE')
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Close
                </button>
                <button type="submit" class="btn btn-danger" form="form-delete-package">
                    Yes, delete it
                </button>
            </div>
        </div>
    </div>
</div>
