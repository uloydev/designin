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
                <form action="{{--routing on js--}}" class="d-none" method="post" id="form-approval-job">
                    @csrf @method('PUT')
                    <input type="hidden" name="customer_email" readonly required>
                    <input type="hidden" name="url_desainin" required readonly>
                    <input type="hidden" name="approval" value="accept" required readonly>
                </form>
                <p class="text-center">Are you sure wanna approve this project?</p>
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
                {{-- route is route('agent.list-request.approval', $id) --}}
                <form class="d-none" action="{{--routing on js--}}" method="post" id="form-rejection-job">
                    @csrf @method('PUT')
                    <input type="hidden" name="customer_email" readonly required>
                    <input type="hidden" name="approval" value="reject" readonly required>
                </form>
                <p class="text-center">Are you sure wanna reject this project?</p>
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

<div class="modal fade" id="modal-revision" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Send revision for job <span class="modal-job-title"></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="form-revision-job" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="custom-file">
                        <input type="file" class="custom-file-input invisible file-custom__input" id="revision"
                        accept="image/*, .psd, .xd, .sketch, video/mp4, video/x-m4v, video/*, .zip, .rar, .7z">
                        <label class="custom-file-label" for="revision">Send Revision file</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-between">
                <button type="button" class="btn btn-link text-gray" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success" form="form-revision-job">
                    Send
                </button>
            </div>
        </div>
    </div>
</div>
