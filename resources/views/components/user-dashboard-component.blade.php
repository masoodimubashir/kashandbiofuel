<div class="col-xxl-9 col-lg-8">

    <button class="btn left-dashboard-show btn-animation btn-md fw-bold d-block mb-4 d-lg-none">Show
        Menu
    </button>
    <div class="dashboard-right-sidebar">
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-dashboard" role="tabpanel">
                <div class="dashboard-home">
                    <div class="title">
                        <h2>My Dashboard</h2>
                        <span class="title-leaf">
                            <svg class="icon-width bg-gray">
                                <use xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf"></use>
                            </svg>
                        </span>
                    </div>


                    <div class="total-box">
                        <div class="row g-sm-4 g-3">



                            <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                                <div class="total-contain text-center">
                                    <i class="fas fa-ban fa-3x mb-2 text-danger"></i>
                                    <div class="total-detail">
                                        <h5>Cancelled Orders</h5>
                                        <h3>{{ $cancelled_count }}</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                                <div class="total-contain text-center">
                                    <i class="fas fa-box-open fa-3x mb-2 text-success"></i>
                                    <div class="total-detail">
                                        <h5>Delivered Orders</h5>
                                        <h3>{{ $delivered_count }}</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                                <div class="total-contain text-center">
                                    <i class="fas fa-check-circle fa-3x mb-2 text-primary"></i>
                                    <div class="total-detail">
                                        <h5>Confirmed Orders</h5>
                                        <h3>{{ $confirmed_count }}</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                                <div class="total-contain text-center">
                                    <i class="fas fa-truck-moving fa-3x mb-2 text-warning"></i>
                                    <div class="total-detail">
                                        <h5>Shipped Orders</h5>
                                        <h3>{{ $shipped_count }}</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                                <div class="total-contain text-center">
                                    <i class="fas fa-hourglass-half fa-3x mb-2 text-secondary"></i>
                                    <div class="total-detail">
                                        <h5>Pending Orders</h5>
                                        <h3>{{ $pending_count }}</h3>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>

                </div>
            </div>


            <div class="tab-pane fade" id="pills-order" role="tabpanel">
                <x-user-order-component />
            </div>

            <div class="tab-pane fade" id="pills-address" role="tabpanel">
                <x-user-address-component />
            </div>

            <div class="tab-pane fade" id="pills-profile" role="tabpanel">
                <x-user-profile-component />
            </div>

            <div class="tab-pane fade" id="pills-download" role="tabpanel">

                <x-recent-orders />

            </div>


        </div>
    </div>

</div>
