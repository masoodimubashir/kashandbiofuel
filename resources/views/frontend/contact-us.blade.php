@extends('welcome')

@section('main')
    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Contact Us</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="index.html">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Contact Us</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Contact Box Section Start -->
    <section class="contact-box-section">
        <div class="container-fluid-lg">
            <div class="row g-lg-5 g-3">
                <div class="col-lg-6">
                    <div class="left-sidebar-box">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="contact-image">
                                    <img src="../assets/images/inner-page/contact-us.png"
                                         class="img-fluid blur-up lazyloaded" alt="">
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="contact-title">
                                    <h3>Get In Touch</h3>
                                </div>

                                <div class="contact-detail">
                                    <div class="row g-4">
                                        <div class="col-xxl-6 col-lg-12 col-sm-6">
                                            <div class="contact-detail-box">
                                                <div class="contact-icon">
                                                    <i class="fa-solid fa-phone"></i>
                                                </div>
                                                <div class="contact-detail-title">
                                                    <h4>Phone</h4>
                                                </div>

                                                <div class="contact-detail-contain">
                                                    <p>(+1) 618 190 496</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xxl-6 col-lg-12 col-sm-6">
                                            <div class="contact-detail-box">
                                                <div class="contact-icon">
                                                    <i class="fa-solid fa-envelope"></i>
                                                </div>
                                                <div class="contact-detail-title">
                                                    <h4>Email</h4>
                                                </div>

                                                <div class="contact-detail-contain">
                                                    <p>geweto9420@chokxus.com</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xxl-6 col-lg-12 col-sm-6">
                                            <div class="contact-detail-box">
                                                <div class="contact-icon">
                                                    <i class="fa-solid fa-location-dot"></i>
                                                </div>
                                                <div class="contact-detail-title">
                                                    <h4>London Office</h4>
                                                </div>

                                                <div class="contact-detail-contain">
                                                    <p>Cruce Casa de Postas 29</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xxl-6 col-lg-12 col-sm-6">
                                            <div class="contact-detail-box">
                                                <div class="contact-icon">
                                                    <i class="fa-solid fa-building"></i>
                                                </div>
                                                <div class="contact-detail-title">
                                                    <h4>Bournemouth Office</h4>
                                                </div>

                                                <div class="contact-detail-contain">
                                                    <p>Visitación de la Encina 22</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <form id="contactForm" class="col-lg-6" action="{{ route('contact-us.store') }}" method="POST">
                    @csrf
                    <div class="title d-xxl-none d-block">
                        <h2>Contact Us</h2>
                    </div>
                    <div class="right-sidebar-box">
                        <div class="row">
                            <!-- First Name Input -->
                            <div class="col-xxl-6 col-lg-12 col-sm-6">
                                <div class="mb-md-4 mb-3 custom-form">
                                    <label for="firstname" class="form-label">First Name</label>
                                    <div class="custom-input">
                                        <input type="text" class="form-control" id="firstname" name="firstname"
                                               placeholder="Enter First Name" value="{{ old('firstname') }}">
                                        <i class="fa-solid fa-user"></i>
                                    </div>
                                    <div id="error-firstname" class="text-danger mt-3 text-red fw-bold"></div>
                                </div>
                            </div>

                            <!-- Last Name Input -->
                            <div class="col-xxl-6 col-lg-12 col-sm-6">
                                <div class="mb-md-4 mb-3 custom-form">
                                    <label for="lastname" class="form-label">Last Name</label>
                                    <div class="custom-input">
                                        <input type="text" class="form-control" id="lastname" name="lastname"
                                               placeholder="Enter Last Name" value="{{ old('lastname') }}">
                                        <i class="fa-solid fa-user"></i>
                                    </div>
                                    <div id="error-lastname" class="text-danger mt-3 text-red fw-bold"></div>
                                </div>
                            </div>

                            <!-- Email Input -->
                            <div class="col-xxl-6 col-lg-12 col-sm-6">
                                <div class="mb-md-4 mb-3 custom-form">
                                    <label for="email" class="form-label">Email Address</label>
                                    <div class="custom-input">
                                        <input type="email" class="form-control" id="email" name="email"
                                               placeholder="Enter Email Address"
                                               value="{{ old('email', auth()->user()->email ?? null) }}">
                                        <i class="fa-solid fa-envelope"></i>
                                    </div>
                                    <div id="error-email" class="text-danger mt-3 text-red fw-bold"></div>
                                </div>
                            </div>

                            <!-- Phone Input -->
                            <div class="col-xxl-6 col-lg-12 col-sm-6">
                                <div class="mb-md-4 mb-3 custom-form">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <div class="custom-input">
                                        <input type="tel" class="form-control" id="phone" name="phone" maxlength="10"
                                               placeholder="Enter Your Phone Number"
                                               oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                               value="{{ old('phone') }}">
                                        <i class="fa-solid fa-mobile-screen-button"></i>
                                    </div>
                                    <div id="error-phone" class="text-danger mt-3 text-red fw-bold"></div>
                                </div>
                            </div>

                            <!-- Message Input -->
                            <div class="col-12">
                                <div class="mb-md-4 mb-3 custom-form">
                                    <label for="message" class="form-label">Message</label>
                                    <div class="custom-textarea">
                        <textarea class="form-control" id="message" name="message" rows="6"
                                  placeholder="Enter Your Message"></textarea>
                                        <i class="fa-solid fa-message"></i>
                                    </div>
                                    <div id="error-message" class="text-danger mt-3 text-red fw-bold"></div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-animation btn-md fw-bold ms-auto" type="submit">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Contact Box Section End -->

    <!-- Map Section Start -->
    <section class="map-section">
        <div class="container-fluid p-0">
            <div class="map-box">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d2994.3803116994895!2d55.29773782339708!3d25.222534631321!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m5!1s0x3e5f43496ad9c645%3A0xbde66e5084295162!2sDubai%20-%20United%20Arab%20Emirates!3m2!1d25.2048493!2d55.2707828!4m0!5e1!3m2!1sen!2sin!4v1652217109535!5m2!1sen!2sin"
                    style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>
    <!-- Map Section End -->


    <!-- Location Modal Start -->
    <div class="modal location-modal fade theme-modal" id="locationModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Choose your Delivery Location</h5>
                    <p class="mt-1 text-content">Enter your address and we will specify the offer for your area.</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="location-list">
                        <div class="search-input">
                            <input type="search" class="form-control" placeholder="Search Your Area">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>

                        <div class="disabled-box">
                            <h6>Select a Location</h6>
                        </div>

                        <ul class="location-select custom-height">
                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Alabama</h6>
                                    <span>Min: $130</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Arizona</h6>
                                    <span>Min: $150</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>California</h6>
                                    <span>Min: $110</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Colorado</h6>
                                    <span>Min: $140</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Florida</h6>
                                    <span>Min: $160</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Georgia</h6>
                                    <span>Min: $120</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Kansas</h6>
                                    <span>Min: $170</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Minnesota</h6>
                                    <span>Min: $120</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>New York</h6>
                                    <span>Min: $110</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Washington</h6>
                                    <span>Min: $130</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Location Modal End -->

    @push('frontend.scripts')
        <script>
            $(document).ready(function () {
                // Handle Contact Form submission
                $('#contactForm').on('submit', function (e) {
                    e.preventDefault(); // Prevent default form submission

                    const $form = $(this);
                    const formData = new FormData(this);

                    clearErrors(); // Clear previous errors

                    // AJAX request
                    $.ajax({
                        url: $form.attr('action'),
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            // Show success message
                            Swal.fire({
                                title: 'Success!',
                                text: response.message || 'Your message has been sent successfully!',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });

                            // Reset the form fields
                            $form.trigger('reset');
                        },
                        error: function (xhr) {
                            if (xhr.status === 422) {
                                // Validation errors
                                showValidationErrors(xhr.responseJSON.errors);
                            } else {
                                // Generic error alert
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

                // Clear error messages
                function clearErrors() {
                    $('[id^="error-"]').text(''); // Clear all error text
                }

                // Display validation errors
                function showValidationErrors(errors) {
                    $.each(errors, function (field, messages) {
                        $(`#error-${field}`).text(messages[0]); // Show the first validation error for each field
                    });
                }
            });
        </script>
    @endpush

@endsection
