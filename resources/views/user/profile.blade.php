<aside class="profile-aside">
    <figure class="profile-aside__box">
        <img src="{{ asset('img/people.webp') }}" alt="Profile Picture" class="profile-aside__img">
        <figcaption class="profile-aside__detail">
            <a href="" class="profile-aside__name">Bariq Dharmawan</a>
            <button class="btn-modal btn-link d-block text-center col" data-target="#modal-edit-profile">
                <i class='bx bxs-edit-alt' ></i> Edit profile
            </button>
        </figcaption>
    </figure>
    <div class="profile-aside__contact">
        <p class="profile-aside__text">
            Email: <a href="mailto:email@gmail.com" class="profile-aside__link">email@gmail.com</a>
        </p>
        <p class="profile-aside__text">
            Phone number: <a href="tel:+6287776196047" class="profile-aside__link">087776196047</a>
        </p>
        <p class="profile-aside__text">
            Address live: <span>DKI Jakarta</span>
        </p>
    </div>
    <div class="profile-aside__box-info">
        <p class="profile-aside__text">
            Finished order: <span class="profile-aside__info">10 order</span>
        </p>
        <p class="profile-aside__text">
            Current order: <span class="profile-aside__info">10 order</span>
        </p>
        <p class="profile-aside__text">
            Join on: <time>Mei 27 2019</time>
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
                        <input type="file" name="avatar" class="file-custom__input" id="avatar-file">
                        <label for="avatar-file" class="file-custom__label">Choose file</label>
                    </div>
                    <input type="file" name="name_card">
                    <button type="submit" class="profile-aside__edit-btn">Update your profile</button>
                </form>
            </div>
        </div>
    </div>
@endpush
