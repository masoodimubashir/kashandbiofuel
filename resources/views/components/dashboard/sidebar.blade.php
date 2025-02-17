<div class="sidebar-wrapper" data-layout="stroke-svg">
    <div>
        <div class="logo-wrapper">
            <a href="route('admin.dashboard')">
                <img class="img" style="height: 50px; 100px" src="{{ asset('front/assets/images/logo/kassh & biofuels (1) (1).png') }}" alt="">
            </a>
            <div class="toggle-sidebar" style="color:white;">
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>
        <div class="logo-icon-wrapper">
            <a href="index.html">
                <img class="img-fluid" src="{{ asset('front/assets/images/logo/kassh & biofuels (1) (1).png') }}" alt=""></a>
        </div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn"><a href="index.html"><img class="img-fluid"
                                                                   src="../assets/images/logo/logo-icon.png" alt=""></a>
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                                                              aria-hidden="true"></i></div>
                    </li>
                    <li class="pin-title sidebar-main-title">
                        <div>
                            <h6>Pinned</h6>
                        </div>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6 class="lan-1">General</h6>
                        </div>
                    </li>
                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title" href="{{ route('admin.dashboard') }}">
                            <svg class="stroke-icon">
                                <use href="https://admin.pixelstrap.net/kabul/assets/svg/icon-sprite.svg#stroke-home">
                                </use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="https://admin.pixelstrap.net/kabul/assets/svg/icon-sprite.svg#fill-home">
                                </use>
                            </svg>
                            <span>Dashboard </span>
                        </a>

                    </li>


                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack">
                        </i><a class="sidebar-link sidebar-title link-nav" href="{{ route('categories.index') }}">
                            <svg class="stroke-icon">
                                <use
                                    href="https://admin.pixelstrap.net/kabul/assets/svg/icon-sprite.svg#stroke-bookmark">
                                </use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="https://admin.pixelstrap.net/kabul/assets/svg/icon-sprite.svg#fill-bookmark">
                                </use>
                            </svg>
                            <span>Categories</span></a>
                    </li>

                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack">
                        </i><a class="sidebar-link sidebar-title link-nav" href="{{ route('sub-categories.index') }}">
                            <svg class="stroke-icon">
                                <use
                                    href="https://admin.pixelstrap.net/kabul/assets/svg/icon-sprite.svg#stroke-bookmark">
                                </use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="https://admin.pixelstrap.net/kabul/assets/svg/icon-sprite.svg#fill-bookmark">
                                </use>
                            </svg>
                            <span>Subcategories</span></a>
                    </li>

                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack">
                        </i><a class="sidebar-link sidebar-title link-nav" href="{{ route('products.index') }}">
                            <svg class="stroke-icon">
                                <use
                                    href="https://admin.pixelstrap.net/kabul/assets/svg/icon-sprite.svg#stroke-bookmark">
                                </use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="https://admin.pixelstrap.net/kabul/assets/svg/icon-sprite.svg#fill-bookmark">
                                </use>
                            </svg>
                            <span>Products</span></a>
                    </li>


                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title" href="{{ route('users.index') }}">
                            <svg class="stroke-icon">
                                <use href="https://admin.pixelstrap.net/kabul/assets/svg/icon-sprite.svg#stroke-user">
                                </use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="https://admin.pixelstrap.net/kabul/assets/svg/icon-sprite.svg#fill-user">
                                </use>
                            </svg>
                            <span>Users</span></a>
                    </li>

                    <li class="sidebar-main-title">
                        <div>
                            <h6>Orders</h6>
                        </div>
                    </li>

                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack">
                        </i><a class="sidebar-link sidebar-title link-nav" href="{{ route('order.index') }}">
                            <svg class="stroke-icon">
                                <use
                                    href="https://admin.pixelstrap.net/kabul/assets/svg/icon-sprite.svg#stroke-bookmark">
                                </use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="https://admin.pixelstrap.net/kabul/assets/svg/icon-sprite.svg#fill-bookmark">
                                </use>
                            </svg>
                            <span>Orders</span></a>
                    </li>
                  
                  


                    <li class="sidebar-main-title">
                        <div>
                            <h6>Coupons</h6>
                        </div>
                    </li>

                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack">
                        </i><a class="sidebar-link sidebar-title link-nav" href="{{ route('coupons.index') }}">
                            <svg class="stroke-icon">
                                <use
                                    href="https://admin.pixelstrap.net/kabul/assets/svg/icon-sprite.svg#stroke-bookmark">
                                </use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="https://admin.pixelstrap.net/kabul/assets/svg/icon-sprite.svg#fill-bookmark">
                                </use>
                            </svg>
                            <span>Coupons</span></a>
                    </li>

                    <li class="sidebar-main-title">
                        <div>
                            <h6>Miscellaneous</h6>
                        </div>
                    </li>
                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav" href="{{ url('/admin/banners') }}">
                            <svg class="stroke-icon">
                                <use
                                    href="https://admin.pixelstrap.net/kabul/assets/svg/icon-sprite.svg#stroke-landing-page">
                                </use>
                            </svg>
                            <svg class="fill-icon">
                                <use
                                    href="https://admin.pixelstrap.net/kabul/assets/svg/icon-sprite.svg#fill-landing-page">
                                </use>
                            </svg>
                            <span>Create Banner</span>
                        </a>
                    </li>


                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav" href="{{ route('dashboard.contact-us.index') }}">
                            <svg class="stroke-icon">
                                <use
                                    href="https://admin.pixelstrap.net/kabul/assets/svg/icon-sprite.svg#stroke-landing-page">
                                </use>
                            </svg>
                            <svg class="fill-icon">
                                <use
                                    href="https://admin.pixelstrap.net/kabul/assets/svg/icon-sprite.svg#fill-landing-page">
                                </use>
                            </svg>
                            <span>Queries</span>
                        </a>
                    </li>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
