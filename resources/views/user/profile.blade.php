<aside class="profile-aside">
    <figure class="profile-aside__box">
        @isset($profile)
            @if(Auth::user()->provider === NULL)
                <img src="{{ Storage::url($profile->avatar) }}" alt="Profile Picture" class="profile-aside__img">
            @else
                <img src="{{ url($profile->avatar) }}" alt="Profile Picture" class="profile-aside__img">
            @endif
        @else
            <img src="{{ Storage::url('files/people.webp') }}" alt="Profile Picture" class="profile-aside__img">
        @endempty
        <figcaption class="profile-aside__detail">
            <a href="" class="profile-aside__name">{{ Auth::user()->name }}</a>
            <button class="btn-modal btn-link d-block text-center col" data-target="#modal-edit-profile">
                <i class='bx bxs-edit-alt' ></i> Edit profile
            </button>
        </figcaption>
    </figure>
    <div class="profile-aside__contact">
        <p class="profile-aside__text">
            Email: <a href="mailto:{{ Auth::user()->email }}" class="profile-aside__link">{{ Auth::user()->email }}</a>
        </p>
        <p class="profile-aside__text">
            Your bank: <span>{{ Auth::user()->profile->bank }}</span>
        </p>
        <p class="profile-aside__text">
            Phone number:
            <a href="tel:+{{ $profile->handphone ?? '-' }}" class="profile-aside__link">
                {{ $profile->handphone ?? '-' }}
            </a>
        </p>
        <p class="profile-aside__text">
            Address live: <span>{{ Auth::user()->profile->address ?? '-' }}</span>
        </p>
    </div>
    <div class="profile-aside__box-info">
        <p class="profile-aside__text flex-row">
            My token:
            <var class="profile-aside__info">
                {{ Auth::user()->subscribe_token . ' token' }}
            </var>
        </p>
        <p class="profile-aside__text flex-row">
            Finished order:
            <span class="profile-aside__info">{{ count($orders->where('status', 'finished')) . ' order(s)' }}</span>
        </p>
        <p class="profile-aside__text flex-row">
            Current order:
            <span class="profile-aside__info">{{ count($orders->where('status', 'process')) . ' order(s)' }}</span>
        </p>
        <p class="profile-aside__text flex-row">
            Join on: <time class="profile-aside__info">{{ Auth::user()->created_at->format('d F Y') }}</time>
        </p>
    </div>
</aside>
@push('element')
    <div class="modal" id="modal-edit-profile">
        <div class="modal__content">
            <div class="modal__header">
                Edit your profile
                <a href="" class="btn-close-modal"><i class='bx bx-x'></i></a>
            </div>
            <div class="modal__body">
                <form action="{{ route('user.profile.update') }}" method="post" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <input type="text" class="input-custom mb-3" name="name" value="{{ Auth::user()->email }}"
                           placeholder="Your email" required>
                    <input type="text" class="input-custom mb-3" name="username" value="{{ Auth::user()->username }}"
                           placeholder="Your username" required>
                    <input type="text" class="input-custom mb-3" name="email" value="{{ Auth::user()->name }}"
                           placeholder="Your name" required>
                    <input type="tel" class="input-custom mb-3" name="handphone"
                           value="{{ Auth::user()->profile->handphone ?? '' }}" placeholder="Your phone number" required>
                    <input type="number" class="input-custom mb-3" name="account_number"
                           value="{{ Auth::user()->profile->account_number ?? '' }}" placeholder="Your account number" required>
                    <select class="nice-select wide mb-3" name="bank">
                        <option value="" @if (Auth::user()->profile->bank === '') selected @endif disabled>
                            Your bank
                        </option>
                        @foreach ($listBank as $bank)
                            <option value="{{ $bank->value }}" @if (Auth::user()->profile->bank === $bank->value) selected @endif>
                                {{ $bank->label }}
                            </option>
                        @endforeach
                    </select>
                    <textarea name="address" rows="8" class="input-custom mb-3"
                              placeholder="Your Address" required>{{ Auth::user()->profile->address }}</textarea>
                    <div class="file-custom">
                        <input type="file" name="avatar" class="file-custom__input" id="avatar-file"
                               data-label="Upload photo profile">
                        <label for="avatar-file" class="file-custom__label">Upload photo profile</label>
                    </div>
                    <div class="file-custom">
                        <input type="file" name="name_card" class="file-custom__input" data-label="Upload name card">
                        <label for="avatar-file" class="file-custom__label">Upload name card</label>
                    </div>
                    <button type="submit" class="profile-aside__edit-btn col">Update your profile</button>
                </form>
            </div>
        </div>
    </div>
@endpush
