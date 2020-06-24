@forelse($messages as $message)
    @if ($message->sender->role == 'agent')
        <div class="order-chat__wrapper">
            <div class="order-chat__agent">
                <img class="order-chat__avatar" src="{{ Storage::url($message->sender->profile->avatar ?? 'files/men.jpg') }}"
                     alt="Agent avatar">
                <div class="order-chat__box">
                    @if ($message->image)
                    {{-- need to style --}}
                        <a href="{{Storage::url($message->image)}}" target="_blank" class="text-link">Click to see attachment</a>
{{--                        <img src="{{Storage::url($message->image)}}" alt="image" height="300">--}}
                    @endif
                    @if ($message->content)
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
                    @if ($message->image)
                        {{-- need to style --}}
                        <a href="{{Storage::url($message->image)}}" target="_blank" class="text-link">Click to see attachment</a>
{{--                        <img src="{{Storage::url($message->image)}}" alt="image" height="300">--}}
                    @endif
                    @if ($message->content)
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
    <img src="{{ asset('img/loader.svg') }}" alt="Loader">
</div>
