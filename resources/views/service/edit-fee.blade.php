<div class="modal fade" id="editServiceFee" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Service Fee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    @csrf @method('PUT')
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="currency">IDR</span>
                        </div>
                        <input type="number" class="form-control" placeholder="Ex: IDR 5000"
                               aria-label="Username" aria-describedby="currency">
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-between">
                <button type="button" class="btn btn-link text-gray-dark" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Edit Fee</button>
            </div>
        </div>
    </div>
</div>
