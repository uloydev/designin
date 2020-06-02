<div class="modal modal--xl modal-extras" id="modal-single-extras">
    <div class="modal__content modal-extras__content">
        <div class="modal__header pb-3">
            Customize your order
            <a href="javascript:void(0)" class="btn-close-modal"><i class='bx bx-x'></i></a>
        </div>
        <div class="modal__body">
            <figure class="row flex-column flex-md-row mx-0">
                <img src="{{ Storage::url('files/service-design2.jpg') }}" alt="Service Image" class="modal-extras__img">
                <figcaption class="col d-flex flex-column pl-md-5 align-items-start">
                    <p class="modal-order-title"></p>
                    {{-- quatity need to pass to $request --}}
                    <div class="d-flex align-items-center">
                        <label for="quantity" class="mr-2">Quantity</label>
                        <input type="number" id="quantity" min="1" value="1" max="20" form="form-last"
                        name="quantity" required>
                    </div>
                    <p class="my-3">
                        Price: IDR <var class="modal-order-price" data-original-price=""></var>
                    </p>

                    @auth
                        <p class="mb-3">
                            Your saving:
                            <var class="font-style-normal" id="user-token"
                            data-saving="{{ $tokenConversion->numeral * Auth::user()->subscribe_token ?? 0 }}"
                            data-token="{{ Auth::user()->subscribe_token ?? 0 }}"
                            data-token-conversion="{{ $tokenConversion->numeral }}">
                                {{ Auth::user()->subscribe_token ?? '0' }}
                            </var> token
                            @if (Auth::user()->subscribe_token > 0)
                                <span style="font-size: 0.8rem">(1 token = IDR {{ $tokenConversion->numeral }})</span>
                            @endif
                        </p>
                    @else
                        <p class="mb-3">
                            Your saving:
                            <var class="font-style-normal" id="user-token" data-saving="{{ 10000 * 0 }}">
                                {{ '0' }}
                            </var> token
                        </p>
                    @endauth
                    <p class="mb-3" id="grand-total-text">
                        Grand total: IDR <output id="grand-total" name="grand_total"></output>
                    </p>
                    <input type="hidden" name="modal_order_title">
                    @if (count($service->extras) > 0)
                        <p>Total extras: <output id="total_extras" name="total_extras">IDR 0</output></p>
                        <div id="form-extras-order">
                            <p class="text-gray mb-3">Add Extras: </p>
                            {{-- extras from admin template --}}
                            @foreach ($extras_template as $extra)
                                <div class="checkbox-custom flex-column align-items-start align-items-lg-center flex-lg-row">
                                    <input type="checkbox" id="extras-{{$extra->id}}" class="checkbox-custom__input"
                                           data-price-cash="{{ $extra->price }}"
                                           data-price-token="{{ $extra->price_token }}"
                                           value="{{$extra->id}}" name="extras">
                                    <label class="checkbox-custom__label" for="extras-{{$extra->id}}">
                                        <span class="checkbox-custom__icon"><i class='bx bx-check' ></i></span>
                                        {{ $extra->name }}
                                    </label>
                                    <span class="ml-lg-2 text-success mt-2 mt-lg-0" style="transform: translateX(-1.5rem)">
                                        Price
                                        (
                                        IDR
                                        <var class="form-extras-order__money extra-price-cash">
                                            {{ $extra->price }}
                                        </var>
                                        )
                                    </span>
                                </div>
                            @endforeach
                            {{-- extras from agent --}}
                            @foreach ($service->extras as $extra)
                                <div class="checkbox-custom flex-column align-items-start align-items-lg-center flex-lg-row">
                                    <input type="checkbox" id="extras-{{$extra->id}}" class="checkbox-custom__input"
                                           data-price-cash="{{ $extra->price }}"
                                           data-price-token="{{ $extra->price_token }}"
                                           value="{{$extra->id}}" name="extras">
                                    <label class="checkbox-custom__label" for="extras-{{$extra->id}}">
                                        <span class="checkbox-custom__icon"><i class='bx bx-check' ></i></span>
                                        {{ $extra->name }}
                                    </label>
                                    <span class="ml-lg-2 text-success mt-2 mt-lg-0" style="transform: translateX(-1.5rem)">
                                        Price
                                        (IDR
                                        <var class="form-extras-order__money extra-price-cash">
                                            {{ $extra->price }}
                                        </var>)
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <div class="my-4 mb-md-0">
                        <label for="promo-code" class="mb-2 d-block">Promo code (optional)</label>
                        <input type="text" id="promo-code" class="input-custom" placeholder="Ex: LEBARIN">
                    </div>
                    <button type="submit" class="modal-extras__submit-btn">Next</button>
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
                    <img src="{{ Storage::url($service->agent->profile->avatar)  }}" alt="Agent Photo"
                    height="70" width="70" style="border-radius: 50%">
                    <figcaption class="mt-1">{{ Str::words($service->agent->name, 3) }}</figcaption>
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
                <form action="{{-- url on js = '/service/show/$id' --}}" method="post" id="form-last" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="data-extras" name="extras">
                    <input type="hidden" name="promo_code">
                    <input type="hidden" name="token_usage">
                    <input type="hidden" name="payment" value="">
                    <input type="hidden" name="agent_id" value="{{ $service->agent_id }}">
                    <label for="send-message" class="d-block mb-3">Your message</label>
                    <textarea name="message_agent" id="send-message" rows="10"
                    placeholder="Put your message here..." required></textarea>
                    <div class="d-flex align-items-center justify-content-between">
                        <label for="message_file" class="single-service__message-file"
                               title="Attach a file">
                            <input type="file" id="message_file" class="file-custom__input"
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

<div class="modal" id="progress-payment">
    <div class="modal__content">
        <div class="loader loader--style3" title="2">
            <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                 width="40px" height="40px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
                <path fill="#000" d="M43.935,25.145c0-10.318-8.364-18.683-18.683-18.683c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615c8.072,0,14.615,6.543,14.615,14.615H43.935z">
                  <animateTransform attributeType="xml" attributeName="transform" type="rotate"
                  from="0 25 25" to="360 25 25" dur="0.6s" repeatCount="indefinite"/>
              </path>
           </svg>
        </div>
    </div>
</div>
