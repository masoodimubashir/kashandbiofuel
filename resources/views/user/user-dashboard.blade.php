@php use Illuminate\Contracts\Auth\MustVerifyEmail; @endphp
@extends('welcome')

@section('main')
    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>User Dashboard</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="index.html">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">User Dashboard</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- User Dashboard Section Start -->
    <section class="user-dashboard-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row">


                <x-user-sidebar-component/>

                <x-user-dashboard-component/>

            </div>
        </div>
    </section>
    <!-- User Dashboard Section End -->



    <!-- Tap to top and theme setting button start -->
    <div class="theme-option">

        <div class="back-to-top">
            <a id="back-to-top" href="#">
                <i class="fas fa-chevron-up"></i>
            </a>
        </div>
    </div>
    <!-- Tap to top and theme setting button end -->

    <!-- Bg overlay Start -->
    <div class="bg-overlay"></div>
    <!-- Bg overlay End -->





    <div class="modal fade theme-modal" id="editProfile" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <form id="addressForm">

                        <input type="hidden" id="address_id" name="address_id">

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating theme-form-floating">
                                    <input type="text" class="form-control" id="address" name="address"
                                           placeholder="Enter your address">
                                    <label for="address">Address</label>
                                    <div class="invalid-feedback" id="addressError"></div>
                                </div>
                            </div>

                            {{-- City Field --}}
                            <div class="col-md-6">
                                <div class="form-floating theme-form-floating">
                                    <input type="text" class="form-control" id="city" name="city"
                                           placeholder="Enter your city">
                                    <label for="city">City</label>
                                    <div class="invalid-feedback" id="cityError"></div>
                                </div>
                            </div>

                            {{-- State Field --}}
                            <div class="col-md-6">
                                <div class="form-floating theme-form-floating">
                                    <input type="text" class="form-control" id="state" name="state"
                                           placeholder="Enter your state">
                                    <label for="state">State</label>
                                    <div class="invalid-feedback" id="stateError"></div>
                                </div>
                            </div>

                            {{-- Pin Code Field --}}
                            <div class="col-md-6">
                                <div class="form-floating theme-form-floating">
                                    <input type="text" class="form-control" id="pin_code" name="pin_code"
                                           placeholder="Enter your pin code">
                                    <label for="pin_code">Pin Code</label>
                                    <div class="invalid-feedback" id="pinCodeError"></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating theme-form-floating">
                                    <input type="text" class="form-control" id="phone" name="phone"
                                           placeholder="Enter phone number">
                                    <label for="phone">Phone Number</label>
                                    <div class="invalid-feedback" id="phoneError"></div>
                                </div>
                            </div>

                        </div>

                        <button type="button" class="btn theme-bg-color btn-md fw-bold text-light mt-2"
                                id="submitAddress">Save Address
                        </button>

                    </form>
                </div>
            </div>
        </div>


        @push('frontend.scripts')
            <script>

                function readURL(input, type = 'profile') {
                    if (input.files && input.files[0]) {
                        const reader = new FileReader();

                        // Update the preview image
                        reader.onload = function (e) {
                            if (type === 'profile') {
                                document.getElementById('profileImagePreview').src = e.target.result;
                            } else if (type === 'cover') {
                                document.getElementById('coverImagePreview').src = e.target.result;
                            }
                        };

                        reader.readAsDataURL(input.files[0]);

                        // Automatically submit the form
                        if (type === 'profile') {
                            document.getElementById('profileImageForm').submit();
                        } else if (type === 'cover') {
                            document.getElementById('coverImageForm').submit();
                        }
                    }
                }

                $(document).ready(function () {


                    $('#profileUpdateForm').on('submit', function (e) {
                        e.preventDefault();

                        const formData = new FormData(this);
                        formData.append('_method', 'PUT');

                        $.ajax({
                            url: "{{ route('user.profile.update') }}",
                            type: 'POST',
                            data: formData,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            processData: false,
                            contentType: false,
                            success: function (response) {
                                if (response.status) {
                                    Swal.fire('Success!', 'Profile Updated...', 'success');
                                }
                            },
                            error: function (xhr) {
                                const errors = xhr.responseJSON.errors;

                                if (errors) {
                                    let errorMessage = '';
                                    Object.keys(errors).forEach(key => {
                                        errorMessage += errors[key].join('<br>');
                                    });
                                    Swal.fire('Error!', errorMessage, 'error');
                                } else {
                                    Swal.fire('Error!', 'Something went wrong.', 'error');
                                }
                            }
                        });
                    });

                    $('#updatePassword').on('submit', function (e) {
                        e.preventDefault(); // Prevent default form submission behavior

                        // Create FormData object from form elements
                        const formData = new FormData(this);
                        formData.append('_method', 'PUT'); // Include `_method` for Laravel PUT request

                        // Send the AJAX request
                        $.ajax({
                            url: "{{ route('user.password.update') }}", // Update password route
                            type: 'POST', // POST request for Laravel PUT support
                            data: formData,
                            processData: false, // Prevent jQuery from automatically processing data
                            contentType: false, // Disable automatic content type
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content') // Attach CSRF token
                            },
                            success: function (response) {
                                if (response.status) {
                                    Swal.fire('Success!', response.message, 'success');

                                    $('#updatePassword')[0].reset();
                                }
                            },
                            error: function (error) {

                                const message = error.responseJSON?.message;

                                if (error.status === 422) {
                                    Swal.fire('Error!', message, 'error');
                                } else {
                                    Swal.fire('Error!', 'Something went wrong. Please try again.',
                                        'error');
                                }
                            }
                        });
                    });

                    function resetFormAndErrors() {
                        $('.invalid-feedback').text('');
                        $('.form-control').removeClass('is-invalid');
                        $('#addressForm')[0].reset();
                        $('#address_id').val(''); // Clear the hidden address ID field
                    }

                    $('#submitAddress').on('click', function (e) {
                        e.preventDefault();

                        const addressId = $('#address_id').val();

                        let formData = {
                            address: $('#address').val(),
                            city: $('#city').val(),
                            state: $('#state').val(),
                            pin_code: $('#pin_code').val(),
                            phone: $('#phone').val(),
                        };

                        const isEdit = !!addressId;
                        const url = isEdit ? `/user/address/${addressId}` : '{{ route('address.store') }}';
                        const method = isEdit ? 'PUT' : 'POST';

                        $.ajax({
                            type: method,
                            url: url,
                            data: formData,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (response) {
                                if (response.status) {
                                    Swal.fire({
                                        title: 'Success!',
                                        text: response.message,
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    });

                                    $('#editProfile').modal('hide');
                                    resetFormAndErrors();
                                }
                            },
                            error: function (xhr) {
                                if (xhr.status === 422) {
                                    let errors = xhr.responseJSON.errors;
                                    $.each(errors, function (key, value) {
                                        $(`#${key}Error`).text(value[0]);
                                        $(`#${key}`).addClass('is-invalid');
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'Something went wrong. Please try again later.',
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                }
                            }
                        });
                    });

                    $('#edit-address-button').on('click', function (e) {

                        let addressId = $(this).data('id');
                        const url = `/user/address/${addressId}`;

                        resetFormAndErrors();

                        $.ajax({
                            type: 'GET',
                            url: url,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (response) {
                                if (response.status) {
                                    $('#address_id').val(response.data.id);
                                    $('#address').val(response.data.address);
                                    $('#city').val(response.data.city);
                                    $('#state').val(response.data.state);
                                    $('#pin_code').val(response.data.pin_code);
                                    $('#phone').val(response.data.phone);

                                    $('#editProfile').modal('show');
                                }
                            },
                            error: function (error) {
                                console.error('Error fetching address:', error);
                            }
                        });
                    });

                    $('#editProfile').on('hide.bs.modal', function () {
                        resetFormAndErrors();
                    });

                    $('#editProfile').on('show.bs.modal', function () {
                        resetFormAndErrors();
                    });


                })
            </script>
    @endpush
@endsection
