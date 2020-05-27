<aside class="profile-aside">
    <figure class="profile-aside__box">
        @empty($profile)
            <img src="{{ Storage::url('temporary/people.webp') }}" alt="Profile Picture" class="profile-aside__img">
        @else
            <img src="{{ Storage::url($profile->avatar) }}" alt="Profile Picture" class="profile-aside__img">
        @endempty
        <figcaption class="profile-aside__detail">
            <a href="" class="profile-aside__name">Bariq Dharmawan</a>
            <button class="btn-modal btn-link d-block text-center col" data-target="#modal-edit-profile">
                <i class='bx bxs-edit-alt' ></i> Edit profile
            </button>
        </figcaption>
    </figure>
    <div class="profile-aside__contact">
        <p class="profile-aside__text">
            Email: <a href="mailto:email@gmail.com" class="profile-aside__link">{{ Auth::user()->email }}</a>
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
        <p class="profile-aside__text">
            Finished order: <span class="profile-aside__info">{{ count($orders->where('status', 'finished')) }}</span>
        </p>
        <p class="profile-aside__text">
            Current order: <span class="profile-aside__info">{{ count($orders->where('status', 'process')) }}</span>
        </p>
        <p class="profile-aside__text">
            Join on: <time>{{ Auth::user()->created_at->format('d M Y') }}</time>
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
                <form action="{{ route('user.profile.update', Auth::id()) }}" method="post">
                    @csrf
                    <input type="text" class="input-custom mb-3" name="name" placeholder="Your email" required>
                    <input type="text" class="input-custom mb-3" name="email" placeholder="Your name" required>
                    <input type="tel" class="input-custom mb-3" name="handphone" placeholder="Your phone number" required>
                    <input type="number" class="input-custom mb-3" name="account_number"
                    placeholder="Your account number" required>
                    <select class="nice-select wide mb-3" name="bank">
                        @foreach ($listBank as $bank)
                            <option value="{{ $bank->value }}">{{ $bank->label }}</option>
                        @endforeach
                    </select>
                    <textarea name="address" rows="8" class="input-custom mb-3" placeholder="Your Address" required></textarea>
                    <div class="file-custom">
                        <input type="file" name="avatar" class="file-custom__input" id="avatar-file" data-label="Upload photo profile">
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
