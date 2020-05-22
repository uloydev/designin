<div class="modal single-service__modal" id="modal-single-order">
    <div class="modal__content">
        <div class="modal__header pb-3">
            Order Brief
            <a href="javascript:void(0)" class="btn-close-modal"><i class='bx bx-x' ></i></a>
        </div>
        <div class="modal__body row mx-0">
            <div class="single-service__modal-message-info">
                <figure class="text-center">
                    <img src="{{ Storage::url('temporary/people.webp')  }}" alt="Agent Photo" height="70">
                    <figcaption class="mt-1">{{ $service->agent->name }}</figcaption>
                </figure>
                <p>Please include: </p>
                <ul>
                    <li>Project description</li>
                    <li>Specific instructions</li>
                    <li>Relevant files</li>
                    <li>Your budget</li>
                </ul>
            </div>
            <div class="col">
                <form action="{{-- url on js = '/service/show/$id' --}}" method="post">
                    @csrf
                    <input type="hidden" name="agent_id" value="{{$service->agent_id}}">
                    <label for="send-message" class="d-block mb-3">Your message</label>
                    <textarea name="message_agent" id="send-message" rows="10" required></textarea>
                    <div class="d-flex align-items-center justify-content-between">
                        <label for="message_file" class="single-service__message-file"
                               title="Attach a file">
                            <input type="file" id="message_file" class="d-none file-custom__input"
                                   data-label="Insert attachment" name="brief_file">
                            <i class='bx bx-cloud-upload'></i>
                            <b class="text-label">Insert attachment</b>
                            <span class="ml-2 file-value"></span>
                        </label>
                        <button type="submit" class="btn service-single__message-btn">
                            Send
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
