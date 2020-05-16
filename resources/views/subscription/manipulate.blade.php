<div class="modal fade" id="addSubscription" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add new subscription</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="form-group">
                        <label for="addTitle">Subscription Title</label>
                        <input type="text" name="title" id="addTitle" class="form-control"
                        placeholder="Ex: Discovery – Langganan" required>
                    </div>
                    <div class="form-group">
                        <label for="addDesc">Subscription Description</label>
                        <textarea name="desc" id="addDesc" rows="10" class="form-control"
                        placeholder="Everything include in this subscription" required>test</textarea>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input invisible" id="addImg" name="img" required>
                        <label class="custom-file-label" for="addImg">Subscription Image</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-between align-items-center">
                <button type="button" class="btn btn-link text-gray" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Add new subscription</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editSubscription" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit subscription <strong class="modal-subscription-title"></strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="form-group">
                        <label for="title">Subscription Title</label>
                        <input type="text" name="title" id="title" class="form-control"
                        placeholder="Ex: Discovery – Langganan" required>
                    </div>
                    <div class="form-group">
                        <label for="desc">Subscription Description</label>
                        <textarea name="desc" id="desc" rows="10" class="form-control"
                        placeholder="Everything include in this subscription" required></textarea>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input invisible" id="img" name="img" required>
                        <label class="custom-file-label" for="img">Change Subscription Image</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-between align-items-center">
                <button type="button" class="btn btn-link text-gray" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Update subscription</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteSubscription" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete subscription <strong class="modal-subscription-title"></strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <p>Are you sure wanna delete this subscription?</p>
                <form role="form" class="d-none" id="form-delete-subscription">
                    @csrf @method('DELETE')
                </form>
            </div>
            <div class="modal-footer d-flex justify-between align-items-center">
                <button type="button" class="btn btn-link text-gray" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" form="form-delete-subscription">Delete</button>
            </div>
        </div>
    </div>
</div>
