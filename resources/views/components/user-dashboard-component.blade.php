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
                                <div class="total-contain">
                                    <img src="https://themes.pixelstrap.com/fastkart/assets/images/svg/order.svg"
                                        class="img-1 blur-up lazyload" alt="">
                                    <img src="https://themes.pixelstrap.com/fastkart/assets/images/svg/order.svg"
                                        class="blur-up lazyload" alt="">
                                    <div class="total-detail">
                                        <h5>Total Order</h5>
                                        <h3>{{ $order_count }}</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                                <div class="total-contain">
                                    <img src="https://themes.pixelstrap.com/fastkart/assets/images/svg/pending.svg"
                                        class="img-1 blur-up lazyload" alt="">
                                    <img src="https://themes.pixelstrap.com/fastkart/assets/images/svg/pending.svg"
                                        class="blur-up lazyload" alt="">
                                    <div class="total-detail">
                                        <h5>Total Pending Order</h5>
                                        <h3>254</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                                <div class="total-contain">
                                    <img src="https://themes.pixelstrap.com/fastkart/assets/images/svg/wishlist.svg"
                                        class="img-1 blur-up lazyload" alt="">
                                    <img src="https://themes.pixelstrap.com/fastkart/assets/images/svg/wishlist.svg"
                                        class="blur-up lazyload" alt="">
                                    <div class="total-detail">
                                        <h5>Total Wishlist</h5>
                                        <h3>32158</h3>
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
