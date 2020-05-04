<div class="modal fade" id="create-service" tabindex="-1" role="dialog"
     aria-labelledby="delete-category" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-default">Create new service</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('manage.service.store') }}" method="post" id="service-create-form">
                    @csrf
                    <div class="form-group">
                        <label for="category-name" class="mb-3">Service Name</label>
                        <input type="email" name="service_title" class="form-control text-dark"
                        id="category-name" placeholder="Insert category name">
                    </div>
                    <div class="form-group">
                        <label for="service-description"></label>
                        <textarea name="service_description" id="service-description" rows="7" class="form-control"
                        placeholder="Service content"></textarea>
                    </div>
                    <div class="form-group">
                        <p class="text-darker">Service Logo</p>
                        <div class="custom-file">
                            <input type="file" name="image_url" class="custom-file-input d-none" id="serviceLogo">
                            <label class="custom-file-label" for="serviceLogo">Choose Logo</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <select class="custom-select">
                            <option selected disabled>Category Service</option>
                            @foreach ($serviceCategories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-default" form="service-create-form">Add new service</button>
            </div>
        </div>
    </div>
</div>
