<div class="col-sm-12">
    <div class="card">
        <div class="card-body">
            <div class="horizontal-wizard-wrapper">
                <div class="row g-3">

                    <div class="col-12">
                        <div class="tab-content dark-field" id="horizontal-wizard-tabContent">
                            <div class="tab-pane fade show active" id="wizard-info" role="tabpanel"
                                aria-labelledby="wizard-info-tab">

                                @if (session('status') === 'password-updated')
                                    <div class="text-success">Profile Updated....</div>
                                @endif

                                <form class="row g-3" method="post" action="{{ route('password.update') }}">
                                    @csrf
                                    @method('put')
                                    <div class="col-xl-4 col-sm-6">

                                        <label class="form-label" for="current_password">Name<span
                                                class="txt-danger">*</span></label>
                                        <input class="form-control" id="current_password" type="password"
                                            name="current_password" placeholder="current password">

                                        @error('current_password')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror


                                    </div>
                                    <div class="col-xl-4 col-sm-6">
                                        <label class="form-label" for="update_password_password">Last Name<span
                                                class="txt-danger">*</span></label>
                                        <input class="form-control" type="password" id="update_password_password"
                                            name="password" placeholder=" new password">



                                        @error('password')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>

                                    <div class="col-xl-4 col-sm-6">
                                        <x-input-error class="text-danger" :messages="$errors->updatePassword->get('password')" />

                                        <label class="form-label" for="update_password_password_confirmation">Last
                                            Name<span class="txt-danger">*</span></label>
                                        <input class="form-control" type="password"
                                            id="update_password_password_confirmation" name="password_confirmation"
                                            placeholder=" new password">


                                        @error('password_confirmation')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror

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
