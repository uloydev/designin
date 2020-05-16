<div class="modal fade" id="modal-approval" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Acception Job <span class="modal-job-title"></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" class="d-none" method="post" id="form-approval-job">
                    @csrf @method('PUT')
                    <input type="hidden" name="approval" value="accept" required readonly>
                </form>
                <p>Are you sure wanna approve this project?</p>
            </div>
            <div class="modal-footer d-flex justify-between">
                <button type="button" class="btn btn-link text-gray" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-success" form="form-approval-job">
                    Yes
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-rejection" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Reject Job <span class="modal-job-title"></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" class="d-none" method="post" id="form-rejection-job">
                    @csrf @method('PUT')
                    <input type="hidden" name="approval" value="reject" readonly required>
                </form>
                <p>Are you sure wanna reject this project?</p>
            </div>
            <div class="modal-footer d-flex justify-between">
                <button type="button" class="btn btn-link text-gray" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-danger" form="form-rejection-job">
                    Yes
                </button>
            </div>
        </div>
    </div>
</div>
