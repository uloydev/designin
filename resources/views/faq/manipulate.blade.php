<div class="modal fade" id="modalEditFaq" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit FAQ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{--routing on js--}}" method="post" id="form-edit-faq">
                    @csrf @method('PUT')
                    <div class="form-group">
                        <label for="question-edit" class="mb-3">Question</label>
                        <input type="text" name="question" class="form-control text-dark"
                               id="question-edit" placeholder="FAQ Question">
                    </div>
                    <div class="form-group">
                        <label for="faq-category">Choose category</label>
                        <select class="custom-select" name="faq_category_id" id="faq-category">
                            <option value="" disabled>Choose category</option>
                            @foreach($faqCategory as $category)
                                <option value="{{ $category->id }}">{{ $category->category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="answer-edit" class="mb-3">Answer</label>
                        <textarea name="answer" id="answer-edit" class="form-control"
                                  rows="10" placeholder="FAQ Answer" required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="form-edit-faq">Update FAQ</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalCreateFaqCategory" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add new category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('manage.faq.store-category') }}" method="post" id="form-create-faq-category">
                    @csrf
                    <div class="form-group">
                        <label for="faq-category" class="mb-3">Category</label>
                        <input type="text" name="category" class="form-control text-dark"
                               id="faq-category" placeholder="FAQ category">
                    </div>
                    <div class="form-group">
                        Category right now:
                        @foreach($faqCategory as $category)
                            <span class="badge badge-primary">
                                    {{ $category->category }}
                                    <a href="{{ route('manage.faq.destroy-category', $category->id) }}" class="text-primary">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </span>
                        @endforeach
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" form="form-create-faq-category">Create new category</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalCreateFaq" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add new FAQ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('manage.faq.store') }}" method="post" id="form-create-faq">
                    @csrf
                    <div class="form-group">
                        <label for="question" class="mb-3">Question</label>
                        <input type="text" name="question" class="form-control text-dark"
                               id="question" placeholder="FAQ Question">
                    </div>
                    <div class="form-group">
                        <label for="faq-category">Choose category</label>
                        <select class="custom-select" name="faq_category_id" id="faq-category">
                            <option value="" disabled selected>Choose category</option>
                            @foreach($faqCategory as $category)
                                <option value="{{ $category->id }}">{{ $category->category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="answer" class="mb-3">Answer</label>
                        <textarea name="answer" id="answer" class="form-control"
                                  rows="10" placeholder="FAQ Answer" required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="form-create-faq">Create new FAQ</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalDeleteFaq" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete FAQ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure wanna delete this faq?</p>
                <form action="{{-- routing on js --}}" method="post" id="form-delete-faq">
                    @csrf @method('DELETE')
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger" form="form-delete-faq">Yes, delete it</button>
            </div>
        </div>
    </div>
</div>
