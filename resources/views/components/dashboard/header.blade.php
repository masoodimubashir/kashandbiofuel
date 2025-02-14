


<div class="page-header">
    <div class="header-wrapper row m-0">
        <div class="header-logo-wrapper col-auto p-0">
            <div class="logo-wrapper"><a href="index.html">
                <img class="img-fluid for-light"
                src="{{ asset('front/assets/images/logo/kassh & biofuels (1) (1).png') }}" alt="">
                <img class="img-fluid for-dark"
                        src="{{ asset('front/assets/images/logo/kassh & biofuels (1) (1).png') }}" alt=""></a></div>
            <div class="toggle-sidebar">
                <svg class="sidebar-toggle">
                    <i class="fa-solid fa-bars" style="color: white; display: flex;align-items: center; justify-content: center;"></i>
                </svg>
            </div>
        </div>
        <div class="left-header col-xxl-5 col-xl-6 col-auto box-col-4 horizontal-wrapper p-0">
            <div class="left-menu-header">
                <ul class="header-left">
                    <li>
                        <div class="form-group w-100">
                            <div class="Typeahead Typeahead--twitterUsers">
                                <div class="u-posRelative d-flex">
                                    <svg class="search-bg svg-color me-2">
                                        <use
                                            href="https://admin.pixelstrap.net/kabul/assets/svg/icon-sprite.svg#fill-search">
                                        </use>
                                    </svg>
                                    <input class="demo-input py-0 Typeahead-input form-control-plaintext w-100"
                                        type="text" placeholder="Search Kabul .." name="q" title="">
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="nav-right col-xxl-7 col-xl-6 col-auto box-col-6 pull-right right-header p-0 ms-auto">
            <ul class="nav-menus">
                <li class="serchinput">
                    <div class="serchbox">
                        <svg>
                            <use href="https://admin.pixelstrap.net/kabul/assets/svg/icon-sprite.svg#fill-search">
                            </use>
                        </svg>
                    </div>
                    <div class="form-group search-form">
                        <input type="text" placeholder="Search here...">
                    </div>
                </li>
                <li class="onhover-dropdown">
                    <div class="notification-box">
                        <svg>
                            <i class="fa-solid fa-bell"></i>
                        </svg><span class="badge rounded-pill badge-primary">4 </span>
                    </div>
                    <div class="onhover-show-div notification-dropdown">
                        <h4 class="f-18 mb-0 dropdown-title">Notifications</h4>
                        <ul>
                            <li class="b-l-primary bg-light-primary border-4">
                                <p class="font-primary">Delivery processing <span class="font-primary">10
                                        min.</span></p>
                            </li>
                            <li class="b-l-secondary bg-light-secondary border-4 mt-3">
                                <p class="font-secondary">Order Complete<span class="font-secondary">1
                                        hr</span></p>
                            </li>
                            <li class="b-l-success bg-light-success border-4 mt-3">
                                <p class="font-success">Tickets Generated<span class="font-success">3
                                        hr</span></p>
                            </li>
                            <li class="b-l-info bg-light-info border-4 mt-3">
                                <p class="font-info">Delivery Complete<span class="font-info">6 hr</span></p>
                            </li>
                            <li><a class="f-w-700" href="private-chat.html">Check all</a></li>
                        </ul>
                    </div>
                </li>
                
              
                <li class="onhover-dropdown">
                    <div class="message">
                        <svg>
                        <i class="fa-solid fa-comment"></i>
                        </svg><span class="rounded-pill badge-secondary"> </span>
                    </div>
                    <div class="onhover-show-div message-dropdown">
                        <h4 class="f-18 mb-0 dropdown-title">Message </h4>
                        <ul>
                            <li class="px-0 pt-0">
                                <div class="d-flex align-items-start">
                                    <div class="message-img bg-light-primary"><img src="../assets/images/user/3.jpg"
                                            alt=""></div>
                                    <div class="flex-grow-1">
                                        <h5 class="mb-1"><a href="letter-box.html">{{ auth()->user()->name }}</a></h5>
                                        <p>Do you want to go see movie?</p>
                                    </div>
                                    <div class="notification-right"><i data-feather="x"></i></div>
                                </div>
                            </li>
                            <li class="px-0">
                                <div class="d-flex align-items-start">
                                    <div class="message-img bg-light-primary"><img src="../assets/images/user/6.jpg"
                                            alt=""></div>
                                    <div class="flex-grow-1">
                                        <h5 class="mb-1"><a href="letter-box.html">Jason Borne</a></h5>
                                        <p>Thank you for rating us.</p>
                                    </div>
                                    <div class="notification-right"><i data-feather="x"></i></div>
                                </div>
                            </li>
                            <li class="px-0">
                                <div class="d-flex align-items-start">
                                    <div class="message-img bg-light-primary"><img src="../assets/images/user/10.jpg"
                                            alt=""></div>
                                    <div class="flex-grow-1">
                                        <h5 class="mb-1"><a href="letter-box.html">Sarah Loren</a></h5>
                                        <p>What`s the project report update?</p>
                                    </div>
                                    <div class="notification-right"><i data-feather="x"></i></div>
                                </div>
                            </li>
                            <li><a class="f-w-700" href="letter-box.html">Check all</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="mode">
                        <svg>
                            <use href="https://admin.pixelstrap.net/kabul/assets/svg/icon-sprite.svg#moon">
                            </use>
                        </svg>
                    </div>
                </li>
                <li class="profile-nav onhover-dropdown p-0">
                    <div class="d-flex align-items-center profile-media"><img class="b-r-10 img-40"
                            src="../assets/images/dashboard/profile.png" alt="">
                        <div class="flex-grow-1"><span>{{ auth()->user()->name }}</span>
                            <p class="mb-0">Admin <i class="middle fa fa-angle-down"></i></p>
                        </div>
                    </div>
                    <ul class="profile-dropdown onhover-show-div">

                        <li>
                            <a href="{{ route('profile.edit') }}"><i data-feather="user">
                                </i><span>   {{ __('Profile') }} </span>
                            </a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    this.closest('form').submit();"><i
                                        data-feather="log-in"> </i><span>
                                        {{ __('Log Out') }}

                                    </span></a>
                            </form>


                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <script class="result-template" type="text/x-handlebars-template">
        <div class="ProfileCard u-cf">                        
        <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
        <div class="ProfileCard-details">
        <div class="ProfileCard-realName">name</div>
        </div>
        </div>
      </script>
        <script class="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
    </div>
</div>
