<div class="col-xl-3 col-sm-6">
    <div class="card">
        <div class="card-header card-no-border pb-0">
            <div class="header-top daily-revenue-card">
                <h4>Total Sells</h4>
                <div class="dropdown icon-dropdown">
                    <button class="btn dropdown-toggle" id="userdropdown" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false"><i
                            class="icon-more-alt"></i></button>
                </div>
            </div>
        </div>
        <div class="card-body pb-0 total-sells">
            <div class="d-flex align-items-center gap-3">
                <div class="flex-shrink-0"><img src="{{asset('dashboard/assets/images/dashboard-2/icon/coin1.png')}}"
                                                alt="icon">
                </div>
                <div class="flex-grow-1">
                    <div class="d-flex align-items-center gap-2">
                        <h2>{{ $orders_confirmed }}</h2>
                    </div>
                </div>
            </div>
            <div id="admissionRatio"></div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-sm-6">
    <div class="card">
        <div class="card-header card-no-border pb-0">
            <div class="header-top daily-revenue-card">
                <h4>Total Revenue</h4>
                <div class="dropdown icon-dropdown">
                    <button class="btn dropdown-toggle" id="userdropdown2" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false"><i
                            class="icon-more-alt"></i></button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userdropdown2"><a
                            class="dropdown-item" href="#">Weekly</a><a class="dropdown-item"
                                                                        href="#">Monthly</a><a class="dropdown-item"
                                                                                               href="#">Yearly</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body pb-0 total-sells-2">
            <div class="d-flex align-items-center gap-3">
                <div class="flex-shrink-0"><img
                        src="{{asset('dashboard/assets/images/dashboard-2/icon/shopping1.png')}}"
                        alt="icon">
                </div>
                <div class="flex-grow-1">
                    <div class="d-flex align-items-center gap-2">
                        <h2>{{ $total_revenue }}</h2>
                    </div>
                </div>
            </div>
            <div id="order-value"></div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-sm-6">
    <div class="card">
        <div class="card-header card-no-border pb-0">
            <div class="header-top daily-revenue-card">
                <h4>Daily Orders</h4>
                <div class="dropdown icon-dropdown">
                    <button class="btn dropdown-toggle" id="userdropdown3" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false"><i
                            class="icon-more-alt"></i></button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userdropdown3"><a
                            class="dropdown-item" href="#">Weekly</a><a class="dropdown-item"
                                                                        href="#">Monthly</a><a class="dropdown-item"
                                                                                               href="#">Yearly</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body pb-0 total-sells-3">
            <div class="d-flex align-items-center gap-3">
                <div class="flex-shrink-0"><img src="{{asset('dashboard/assets/images/dashboard-2/icon/sent1.png')}}"
                                                alt="icon">
                </div>
                <div class="flex-grow-1">
                    <div class="d-flex align-items-center gap-2">
                        <h2>{{ $daily_orders }}</h2>
                    </div>
                </div>
            </div>
            <div id="daily-value"></div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-sm-6">
    <div class="card">
        <div class="card-header card-no-border pb-0">
            <div class="header-top daily-revenue-card">
                <h4>Daily Revenue</h4>
                <div class="dropdown icon-dropdown">
                    <button class="btn dropdown-toggle" id="userdropdown4" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false"><i
                            class="icon-more-alt"></i></button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userdropdown4"><a
                            class="dropdown-item" href="#">Weekly</a><a class="dropdown-item"
                                                                        href="#">Monthly</a><a class="dropdown-item"
                                                                                               href="#">Yearly</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body pb-0 total-sells-4">
            <div class="d-flex align-items-center gap-3">
                <div class="flex-shrink-0"><img
                        src="{{asset('dashboard/assets/images/dashboard-2/icon/revenue1.png')}}"
                        alt="icon">
                </div>
                <div class="flex-grow-1">
                    <div class="d-flex align-items-center gap-2">
                        <h2>
                            {{ $daily_revenue }}
                        </h2>
                    </div>
                </div>
            </div>
            <div id="daily-revenue"></div>
        </div>
    </div>
</div>
