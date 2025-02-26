<div class="col-sm-12">
    <div class="card">
        <div class="card-body">
            <div class="horizontal-wizard-wrapper">
                <div class="row g-3">

                    <div class="col-12">
                        <div class="tab-content dark-field" id="horizontal-wizard-tabContent">
                            <div class="tab-pane fade show active" id="wizard-info" role="tabpanel"
                                aria-labelledby="wizard-info-tab">

                                <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                                    @csrf
                                </form>

                                @if (session('status') === 'profile-updated')
                                    <div class="text-success">Prodile Updated....</div>
                                @endif

                                <form class="row g-3" method="post" action="{{ route('profile.update') }}">
                                    @csrf
                                    @method('patch')
                                    <div class="col-xl-4 col-sm-6">

                                        <label class="form-label" for="name">Name<span
                                                class="txt-danger">*</span></label>
                                        <input class="form-control" id="name" type="text" name="name" 
                                            value="{{ old('name', $user->name) }}" placeholder="Enter first name">
                                        @error('name')
                                            <div class="text-danger">
                                                {{ $message }}

                                            </div>
                                        @enderror


                                    </div>
                                    <div class="col-xl-4 col-sm-6">
                                        <label class="form-label" for="email">Email<span
                                                class="txt-danger">*</span></label>
                                        <input class="form-control" id="email" type="email" id="email" 
                                             name="email" value="{{ old('email', $user->email) }}"
                                            placeholder="Enter Email">

                                        @error('email')
                                            <div class="text-danger">
                                                {{ $message }}

                                            </div>
                                        @enderror


                                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
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

                                    <div class="col-12 ">
                                        <button class="btn btn-primary" type="submit">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
