@php
    $notifications = auth()->user()->unreadNotifications;
@endphp


<div class="page-header">
    <div class="header-wrapper row m-0">
        <div class="header-logo-wrapper col-auto p-0">
            <div class="logo-wrapper"><a href="index.html">
                    <img class="img-fluid for-light"
                        src="{{ asset('front/assets/images/logo/kassh & biofuels (1) (1).png') }}" alt="">
                    <img class="img-fluid for-dark"
                        src="{{ asset('front/assets/images/logo/kassh & biofuels (1) (1).png') }}" alt=""></a>
            </div>
            <div class="toggle-sidebar">
                <svg class="sidebar-toggle">
                    <i class="fa-solid fa-bars"
                        style="color: white; display: flex;align-items: center; justify-content: center;"></i>
                </svg>
            </div>
        </div>

        <div class="nav-right col-xxl-7 col-xl-6 col-auto box-col-6 pull-right right-header p-0 ms-auto">
            <ul class="nav-menus">

                <li class="profile-nav onhover-dropdown p-0 " ">
                    <div class=" d-flex align-items-center profile-media">
                    <div class="flex-grow-1">
                        <p class="mb-0">
                            {{ ucwords(auth()->user()->name) }}
                            <i class="middle fa fa-angle-down"></i>
                        </p>
                    </div>
        </div>
        <ul class="profile-dropdown onhover-show-div">

            <li>
                <a href="{{ route('profile.edit') }}"><i data-feather="user">
                    </i><span> {{ __('Profile') }} </span>
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    this.closest('form').submit();"><i data-feather="log-in">
                        </i><span>
                            {{ __('Log Out') }}

                        </span></a>
                </form>


            </li>
        </ul>
        </li>

        <li class="onhover-dropdown">
            <div class="notification-box">
                <svg>
                    <i class="fa-solid fa-bell"></i>
                </svg>
                <span class="badge rounded-pill badge-primary">
                    {{ $notifications->count() }}
                </span>
            </div>
            <div class="onhover-show-div notification-dropdown">
                <h4 class="f-18 mb-0 dropdown-title">Notifications</h4>
                <ul>
                    @foreach ($notifications as $notification)
                        <li class="b-l-primary bg-light-primary border-4">
                            <p class="font-primary">
                                {{ $notification->data['message'] }}
                                <span class="font-primary">{{ $notification->created_at->diffForHumans() }}</span>
                            </p>
                        </li>
                    @endforeach

                    <li><a class="f-w-700" href="{{ route('admin.notifications') }}">Check all</a></li>

                </ul>
            </div>
        </li>

        <li>
            <div class="mode">
                <i class="fa-solid fa-moon"></i>
            </div>
        </li>



        </ul>
    </div>
    <script class="result-template" type="text/x-handlebars-template">
        <div class="ProfileCard u-cf">                        
        <div class="ProfileCard-avatar">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
        <div class="ProfileCard-details">
        <div class="ProfileCard-realName">name</div>
        </div>
        </div>
      </script>
    <script class="empty-template"
        type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
</div>
</div>