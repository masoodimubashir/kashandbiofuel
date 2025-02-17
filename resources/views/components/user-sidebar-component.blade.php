<div class="col-xxl-3 col-lg-4">
    <div class="dashboard-left-sidebar">
        <div class="close-button d-flex d-lg-none">
            <button class="close-sidebar">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <div class="profile-box">
            <div class="cover-image">
                <img src="../assets/images/inner-page/cover-img.jpg" class="img-fluid blur-up lazyload"
                     alt="">
            </div>

            <div class="profile-contain">
                <div class="profile-image">
                    <form id="profileImageForm" method="POST" action="{{ route('user.update.photo') }}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="position-relative">
                            <!-- Display the existing profile image -->
                            <img id="profileImagePreview"
                                 src="{{ asset( 'storage/' . auth()->user()->image_path) }}"
                                 class="blur-up lazyload update_img" alt="Profile Image">
                            <div class="cover-icon">
                                <i class="fa-solid fa-pen">
                                    <!-- Input field to select a new image -->
                                    <input type="file" name="image" onchange="readURL(this)" accept="image/*">
                                </i>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="profile-name">
                    <h3>{{ auth()->user()->name }}</h3>
                    <h6 class="text-content">{{ auth()->user()->email }}</h6>
                </div>
            </div>
        </div>

        <ul class="nav nav-pills user-nav-pills" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-dashboard-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-dashboard" type="button"><i data-feather="home"></i>
                    DashBoard
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-order-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-order" type="button"><i data-feather="shopping-bag"></i>Order
                </button>
            </li>


            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-address-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-address" type="button" role="tab"><i
                        data-feather="map-pin"></i>Address
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-profile" type="button" role="tab"><i
                        data-feather="user"></i>
                    Profile
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-download-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-download" type="button" role="tab"><i
                        data-feather="download"></i>Download
                </button>
            </li>

        </ul>
    </div>


</div>
