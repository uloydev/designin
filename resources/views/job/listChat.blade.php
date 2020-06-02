@forelse($messages as $message)
    @if ($message->sender->role == 'agent')
        <div class="order-chat__wrapper">
            <div class="order-chat__agent">
                <img class="order-chat__avatar" src="{{ Storage::url($message->sender->profile->avatar ?? 'files/men.jpg') }}"
                     alt="Agent avatar">
                <div class="order-chat__box">
                    <p class="order-chat__message">
                        @if (Auth::user()->name === $message->sender->name)
                            <span class="mr-1">You:</span>
                        @else
                            <span class="mr-1">{{ $message->sender->name . ':' }}</span>
                        @endif
                        {{ $message->content }}
                    </p>
                    @if (Auth::user()->role === 'agent')
                        @if ($message->is_read == false)
                            <span class="order-chat__delivery">
                                <i class='bx bx-check-double'></i>
                            </span>
                        @else
                            <span class="order-chat__read">
                                <i class='bx bx-check'></i>
                                {{ $message->updated_at->diffForHumans() }}
                            </span>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    @endif
    @if ($message->sender->role == 'user')
        <div class="order-chat__wrapper order-chat__wrapper--customer">
            <div class="order-chat__myself">
                <img class="order-chat__avatar" src="{{ Storage::url($message->sender->profile->avatar ?? 'files/people.webp') }}"
                     alt="Agent avatar">
                <div class="order-chat__box">
                    <p class="order-chat__message">{{ $message->content }}</p>
                    @if (Auth::user()->role === 'user')
                        @if ($message->is_read == false)
                            <span class="order-chat__delivery">
                                <i class='bx bx-check-double'></i>
                            </span>
                        @else
                            <span class="order-chat__read">
                                <i class='bx bx-check'></i>
                                {{ $message->updated_at->diffForHumans() }}
                            </span>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    @endif
@empty
    <article class="text-center">
        <h1>No chat before. Let's chat now!</h1>
    </article>
@endforelse
<div class="loader loader--style3 d-none" title="2" id="loader-sendChat">
    <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
         width="40px" height="40px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
                                <path fill="#000" d="M43.935,25.145c0-10.318-8.364-18.683-18.683-18.683c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615c8.072,0,14.615,6.543,14.615,14.615H43.935z">
                                    <animateTransform attributeType="xml" attributeName="transform" type="rotate"
                                                      from="0 25 25" to="360 25 25" dur="0.6s" repeatCount="indefinite"/>
                                </path>
                           </svg>
</div>
