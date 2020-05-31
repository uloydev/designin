@foreach($messages as $message)
    @if ($message->sender->role == 'agent')
        <div class="order-chat__wrapper">
            <div class="order-chat__agent">
                <img class="order-chat__avatar" src="{{ Storage::url('temporary/avatar-agent.jpg') }}"
                     alt="Agent avatar">
                <div class="order-chat__box">
                    <p class="order-chat__message">{{ $message->content }}</p>
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
                <img class="order-chat__avatar" src="{{ Storage::url('temporary/people.webp') }}"
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
@endforeach
