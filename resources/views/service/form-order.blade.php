<div class="modal modal--xl modal-extras" id="modal-single-extras">
    <div class="modal__content">
        <div class="modal__header pb-3">
            Customize your order
            <a href="javascript:void(0)" class="btn-close-modal"><i class='bx bx-x'></i></a>
        </div>
        <div class="modal__body">
            <figure class="row mx-0">
                <img src="{{ Storage::url('files/service-design2.jpg') }}" alt="Service Image">
                <figcaption class="col d-flex flex-column pl-5 align-items-start">
                    <p class="modal-order-title"></p>
                    <div class="d-flex align-items-center">
                        <label for="quantity" class="mr-2">Quantity</label>
                        <input type="number" id="quantity" min="1" value="1" max="20"
                               form="form-extras-order" required>
                    </div>
                    <p class="mt-2">Price <var class="modal-order-price"></var></p>
                    {{-- ini form gk ada actionnya, cmn buat box. Form aslinya ada dibawah --}}
                    <form action="" method="post" id="form-extras-order">
                        @csrf
                        <input type="hidden" name="modal_order_title" required readonly>
                        {{-- foreach --}}
                        <div class="checkbox-custom">
                            <label class="checkbox-custom__label" for="extras-1">Extra 2 Days</label>
                            <input type="checkbox" id="extras-1" class="checkbox-custom__input" value="yes">
                            <span class="custom-checkbox__icon"><i class='bx bx-check' ></i></span>
                        </div>
                        <div class="checkbox-custom">
                            <label class="checkbox-custom__label" for="extras-2">Addition Revision +1</label>
                            <input type="checkbox" id="extras-2" class="checkbox-custom__input" value="true">
                            <span class="custom-checkbox__icon"><i class='bx bx-check' ></i></span>
                        </div>
                        {{-- endforeach --}}
                        <button type="submit" class="modal-extras__submit-btn">Next</button>
                    </form>
                </figcaption>
            </figure>
        </div>
    </div>
</div>

<div class="modal single-service__modal" id="modal-single-order">
    <div class="modal__content">
        <div class="modal__header pb-3">
            Order Brief
            <a href="javascript:void(0)" class="btn-close-modal" id="show-modal-single-extras">
                <i class='bx bx-x'></i>
            </a>
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
                    <input type="hidden" data-extras="extras-1" name="order_extras[]">
                    <input type="hidden" data-extras="extras-2" name="order_extras[]">
                    <input type="hidden" name="agent_id" value="{{$service->agent_id}}">
                    <label for="send-message" class="d-block mb-3">Your message</label>
                    <textarea name="message_agent" id="send-message" rows="10"
                    placeholder="Put your message here..." required></textarea>
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
