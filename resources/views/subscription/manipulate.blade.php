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
                <form role="form" method="post" action="{{ route('manage.subscription.store') }}" id="form-add-subscription"
                enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="addTitle">Subscription Title</label>
                        <input type="text" name="title" id="addTitle" class="form-control" value="{{ old('title') }}"
                        placeholder="Ex: Discovery – Langganan" required>
                    </div>
                    <div class="form-group">
                        <label for="addPrice">How much the price?</label>
                        <input type="number" name="price" id="addPrice" class="form-control" placeholder="Ex: 300000"
                        value="{{ old('price') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="addDesc">Subscription Description</label>
                        <textarea name="desc" id="addDesc" rows="10" class="form-control textarea-summernote"
                        required>{{ old('desc') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="addDuration">For how long?</label>
                        <div class="input-group">
                            <input type="number" name="duration" id="addDuration" aria-label="subscription duration" class="form-control"
                            placeholder="Ex: 30 days" aria-describedby="addon-duration" value="{{ old('duration') }}" required>
                            <div class="input-group-append">
                                <span class="input-group-text" id="addon-duration">days</span>
                            </div>
                        </div>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input invisible" id="addImg" name="img" required>
                        <label class="custom-file-label" for="addImg">Subscription Image</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-between align-items-center">
                <button type="button" class="btn btn-link text-gray" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" form="form-add-subscription">Add new subscription</button>
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
                <form role="form" method="post" id="form-update-subscription" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <input type="hidden" class="form-control" id="token" placeholder="Token" name="token" required readonly>
                    <div class="form-group">
                        <label for="title">What is the subscription title?</label>
                        <input type="text" name="title" id="title" class="form-control"
                        placeholder="Ex: Discovery – Langganan" required>
                    </div>
                    <div class="form-group">
                        <label for="price">How much the price?</label>
                        <input type="number" name="price" id="price" class="form-control" placeholder="Ex: 300000" required>
                    </div>
                    <div class="form-group">
                        <label for="duration">For how long?</label>
                        <div class="input-group">
                            <input type="number" name="duration" id="duration" aria-label="subscription duration" class="form-control"
                            placeholder="Ex: 30 days" aria-describedby="addon-duration" required>
                            <div class="input-group-append">
                                <span class="input-group-text" id="addon-duration">days</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="desc">Subscription Description</label>
                        <textarea name="desc" id="desc" rows="10" class="form-control"
                        placeholder="Everything include in this subscription" required></textarea>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input invisible" id="img" name="img">
                        <label class="custom-file-label" for="img">Change Subscription Image</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-between align-items-center">
                <button type="button" class="btn btn-link text-gray" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" form="form-update-subscription">Update subscription</button>
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
                <form role="form" class="d-none" id="form-delete-subscription" method="post">
                    @csrf @method('DELETE')
                </form>
            </div>
            <div class="modal-footer d-flex justify-between align-items-center">
                <button type="button" class="btn btn-link text-gray" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger" form="form-delete-subscription">Delete</button>
            </div>
        </div>
    </div>
</div>
