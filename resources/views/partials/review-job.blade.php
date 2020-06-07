<div class="modal" id="modal-review">
    <div class="modal__content">
        <div class="modal__header">
            <h2 class="modal__title">Review job</h2>
            <a href="" class="btn-close-modal"><i class='bx bx-x'></i></a>
        </div>
        <div class="modal__body">
            <form action="{{ route('user.order.review', $order->id) }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="content" class="d-block mb-2">What will you say to {{ $order->agent->name }}</label>
                    <textarea type="text" class="input-custom" id="content" name="content" rows="8"
                              placeholder="Ex: Good job! Hopefully we can work together again" required></textarea>
                </div>
                <div class="row justify-content-between align-items-center mx-0">
                    <div>
                        <label for="rating" class="d-block">Rating</label>
                        <div class="review-rating">{{--fieldname = rating --}}</div>
                    </div>
                    <button type="submit" class="btn-success">Send review</button>
                </div>
            </form>
        </div>
    </div>
</div>
