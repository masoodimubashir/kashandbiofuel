<div class="dashboard-profile">
    <div class="title">
        <h2>My Profile</h2>
        <span class="title-leaf">
            <svg class="icon-width bg-gray">
                <use
                    xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf">
                </use>
            </svg>
        </span>
    </div>


    <div class="row">
        <div class="col-12">
            <form id="send-verification" method="post"
                  action="{{ route('verification.send') }}">
                @csrf
            </form>

            @if (session('status') === 'profile-updated')
                <div class="text-success">Password Updated....</div>
            @endif

            <form id="profileUpdateForm">


                <div class="row g-4">


                    <div class="col-xxl-6">
                        <div class="form-floating theme-form-floating">
                            <input type="email" class="form-control" id="email"
                                   readonly
                                   name="email"
                                   value="{{ old('email', auth()->user()->email) }}">
                            <label for="email">Email address</label>
                        </div>
                        <div class="invalid-feedback">
                            test
                        </div>
                        @error('name')
                        <div class="text-danger">
                            {{ $message }}

                        </div>
                        @enderror
                    </div>

                    <div class="col-xxl-6">
                        <div class="form-floating theme-form-floating">
                            <input class="form-control" type="text"
                                   value="{{ old('name', auth()->user()->name) }}"
                                   name="name" id="name" maxlength="10">
                            <label for="name">Name</label>
                        </div>
                        @error('email')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>


                    <div>
                        <button class="btn theme-bg-color btn-sm fw-bold text-light">
                            Save
                            changes
                        </button>
                    </div>


                    @if (auth()->user() instanceof MustVerifyEmail && !auth()->user()->hasVerifiedEmail())
                        <div>
                            <p class="text-sm mt-2 text-gray-800">
                                {{ __('Your email address is unverified.') }}

                                <button form="send-verification"
                                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    {{ __('Click here to re-send the verification email.') }}
                                </button>
                            </p>

                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 font-medium text-sm text-green-600">
                                    {{ __('A new verification link has been sent to your email address.') }}
                                </p>
                            @endif
                        </div>
                    @endif

                </div>
            </form>


        </div>

    </div>

    <div class="row mt-5">
        <div class="col-12">

            <form id="updatePassword">

                <div class="row g-4">


                    <div class="col-xxl-6">

                        <div class="form-floating theme-form-floating">
                            <input class="form-control" type="password"
                                   name="password" id="password" maxlength="10">
                            <label for="password">New Password</label>
                        </div>


                    </div>

                    <div class="col-xxl-6">

                        <div class="form-floating theme-form-floating">
                            <input class="form-control" type="password"
                                   name="password_confirmation"
                                   id="password_confirmation" maxlength="10">
                            <label for="password_confirmation">Confirm Password</label>
                        </div>


                    </div>


                    <div>
                        <button class="btn theme-bg-color btn-sm fw-bold text-light">
                            Save Changes
                        </button>
                    </div>


                </div>
            </form>


        </div>

    </div>

</div>


