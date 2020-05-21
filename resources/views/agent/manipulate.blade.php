<div class="modal fade" id="modal-remove-agent" tabindex="-1" role="dialog"
     aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">
                    Remove agent
                </h6>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    You sure wanna remove agent with name
                    <strong class="agent-name"></strong>
                </p>
                <form action="{{-- routing on js --}}" method="post" id="form-remove-agent">
                    @csrf @method('DELETE')
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link text-muted" data-dismiss="modal">
                    Cancel
                </button>
                <button type="button" class="btn btn-danger" form="form-remove-agent">Delete Agent</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edit-agent" tabindex="-1" role="dialog"
     aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Edit agent with name <strong class="agent-name"></strong></h6>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{-- routing on js --}}" method="post" id="form-edit-agent">
                    @csrf @method('UPDATE')
                    <div class="form-group">
                        <label for="agent-email">Email address</label>
                        <input type="email" name="agent_email" class="form-control" id="agent-email"
                        placeholder="Agent email">
                    </div>
                    <div class="form-group">
                        <label for="agent-name">Fullname</label>
                        <input type="email" name="agent_name" class="form-control" id="agent-name"
                        placeholder="Agent fullname">
                    </div>
                    <div class="form-group">
                        <label for="agent-phone">Phone Number</label>
                        <input type="tel" name="agent_phone" class="form-control" id="agent-phone"
                        placeholder="Agent phone number">
                    </div>
                    <div class="form-group">
                        <label for="agent-email">Bank Name</label>
                        <input type="email" name="agent_bank" class="form-control" id="agent-email"
                        placeholder="Agent Bank Using">
                    </div>
                    <div class="form-group">
                        <label for="agent-email">Account number</label>
                        <input type="number" name="agent_account" class="form-control" id="agent-email"
                        placeholder="Agent account number">
                    </div>
                    <div class="form-group">
                        <label for="agent-address">Address live</label>
                        <textarea name="agent_address" id="agent-address" rows="10"
                        class="form-control" placeholder="Agent address"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link text-muted" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" form="form-edit-agent">Update Agent Details</button>
            </div>
        </div>
    </div>
</div>
