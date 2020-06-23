<div class="modal fade" id="loadingApprove" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <svg class="spinner" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                    <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
                </svg>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-progress" tabindex="-1" role="dialog" aria-labelledby="modalProgressTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Report progress for job <span class="modal-job-title"></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" class="pr-3" method="post" id="form-update-job-progress">
                    @csrf @method('PUT')
                    <div class="form-row mx-0 justify-content-between align-items-center">
                        <div class="col-9">
                            <input name='progress' type="text" class="progress-job" data-slider-value="0">
                        </div>
                        <div id="progress-job-val">0</div>
                    </div>
                </form>
                <div class="row mx-0 align-items-center mt-2">
                    <p class="mb-0">Progress right now: </p>
                    <div class="col">
                        <div class="progress mt-3">
                            <div class="progress-bar">{{-- value on js --}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-between">
                <button type="button" class="btn btn-link text-gray" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-default" form="form-update-job-progress">
                    Update progress
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-result" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Send result for job <span class="modal-job-title"></span> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{-- routing on js --}}" id="form-send-job" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="result-message">Message to customer</label>
                        <textarea name="message" id="result-message" placeholder="Message result"
                                  class="form-control" rows="10" required></textarea>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input invisible file-custom__input"
                               id="sendResult" name="result_file"
                               accept="image/*, .psd, .xd, .sketch, .mp4, .zip, .rar, .7z, .pdf">
                        <label class="custom-file-label" for="sendResult">Result file</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-between">
                <button type="button" class="btn btn-link text-gray" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-default" form="form-send-job">
                    Send result
                </button>
            </div>
        </div>
    </div>
</div>
