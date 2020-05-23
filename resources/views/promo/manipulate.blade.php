<div class="modal fade" id="deletePromo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete promo <strong class="modal-promo-title"></strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure wanna delete promo <strong class="modal-promo-title"></strong></p>
                <form action="{{-- routing on js --}}" method="post" class="d-none" id="form-delete-promo">
                    @csrf @method('DELETE')
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-link text-gray-dark" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger" id="form-delete-promo">Delete</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addPromo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add new promo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('manage.promo.store') }}" method="post" id="form-add-promo">
                    @csrf
                    <div class="form-group">
                        <label for="promo-name">Promo name</label>
                        <input id="promo-name" type="text" placeholder="Ex: Lebira (Lebaran Gembira)"
                               class="form-control" name="promo_name" required>
                    </div>
                    <div class="form-group">
                        <label for="add-promo-start">Start date</label>
                        <input type="text" id="add-promo-start" class="form-control datepicker-here"
                               placeholder="Promo Start date" name="promo_start" required>
                    </div>
                    <div class="form-group">
                        <label for="add-promo-end">End date</label>
                        <input type="text" id="add-promo-end" class="form-control datepicker-here"
                               placeholder="Promo End date" name="promo_end" required>
                    </div>
                    <div class="form-group">
                        <label for="promo-code">Promo Code</label>
                        <input id="promo-code" type="text" placeholder="Ex: puasbanget"
                                class="form-control" name="promo_code" required>
                    </div>
                    <div class="form-group">
                        <label for="promo-discount">Promo discount (%)</label>
                        <input id="promo-discount" type="text" placeholder="Ex: 10"
                                class="form-control" name="promo_discount" required>
                    </div>
                    <div class="form-group">
                        <label for="promo-limit">Promo limit</label>
                        <input id="promo-limit" type="text" placeholder="Ex: 100"
                                class="form-control" name="promo_limit" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-between">
                <button type="button" class="btn btn-link text-gray-dark" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" form="form-add-promo">Add new promo</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editPromo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit promo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- set form input value using js --}}
                <form action="{{-- route using js --}}" method="post" id="form-edit-promo">
                    @csrf @method('PUT')
                    <div class="form-group">
                        <label for="promo-name">Promo name</label>
                        <input id="promo-name" type="text" placeholder="Ex: Lebira (Lebaran Gembira)"
                        class="form-control" name="promo_name" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-promo-start">Start date</label>
                        <input type="text" id="edit-promo-start" class="form-control datepicker-here"
                                placeholder="Promo Start date" name="promo_start" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-promo-end">End date</label>
                        <input type="text" id="edit-promo-end" class="form-control datepicker-here"
                                placeholder="Promo End date" name="promo_end" required>
                    </div>
                    <div class="form-group">
                        <label for="promo-code">Promo Code</label>
                        <input id="promo-code" type="text" placeholder="Ex: puasbanget"
                                class="form-control" name="promo_code" required>
                    </div>
                    <div class="form-group">
                        <label for="promo-discount">Promo discount (%)</label>
                        <input id="promo-discount" type="text" placeholder="Ex: 10"
                                class="form-control" name="promo_discount" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-between">
                <button type="button" class="btn btn-link text-gray-dark" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" form="form-edit-promo">Edit promo</button>
            </div>
        </div>
    </div>
</div>
