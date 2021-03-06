<div class="modal fade" id="create-service" tabindex="-1" role="dialog"
     aria-labelledby="create-edit-categoryLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <h5 class="modal-title">Add new service</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{-- routing on js --}}" method="post"
                id="form-add-service" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="agent_id" value="{{ Auth::id() }}" readonly required>
                    <div class="form-group">
                        <label for="category-name" class="mb-3">Service Title</label>
                        <input type="text" name="title" class="form-control text-dark"
                               id="category-name" placeholder="Insert Title Here">
                    </div>
                    @if (Auth::user()->role === 'agent')
                        <input type="hidden" name="agent_id" value="{{ Auth::id() }}" readonly>
                    @else
                        <div class="form-group">
                            <label for="agent_id">Agent</label>
                            <select class="custom-select" id="agent_id" name="agent_id" required>
                                <option value="" selected disabled>Choose agent</option>
                                @foreach ($agents as $agent)
                                    <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="categoryService">Service Category</label>
                        <select class="custom-select" id="categoryService" name="service_category_id" required>
                            <option value="" selected disabled>Choose category</option>
                            @foreach ($serviceCategories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="service-description" class="mb-3">Service Description</label>
                        {{-- textarea on js with name = description --}}
                        <div class="quill-editor" id="service-rich-desc" data-name="description"
                             data-placeholder="Place description here . . ."></div>
                    </div>
                    <div class="form-group">
                        <p class="text-darker">Service Icon</p>
                        <div class="custom-file">
                            <input type="file" name="image" class="custom-file-input d-none" id="imgService">
                            <label class="custom-file-label" for="imgService">Choose Icon</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="popular" name="is_popular">
                            <label class="custom-control-label" for="popular">Mark as popular for inspiration</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-default" form="form-add-service">Add new service</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-delete-service" tabindex="-1" role="dialog"
     aria-labelledby="modal-delete-service" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-default">
                    Delete service with title <strong class="modal-service-title"></strong>
                </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body text-center">
                <p>Are you sure wanna delete service with title
                    <strong class="modal-service-title"></strong>?
                    <span class="text-danger"><strong>You couldn't be undo this!</strong></span>
                </p>
                <form method="post" id="form-delete-service">
                    @csrf @method('DELETE')
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger" form="form-delete-service">Yes, remove it</button>
            </div>
        </div>
    </div>
</div>
