<x-app-layout>

    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>
                     Dashboard
                </h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</li>

                </ol>
            </div>
        </div>
    </x-slot>


    <div class="container-fluid dashboard_ecommerce">
        <div class="row">
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-header card-no-border pb-0">
                        <div class="header-top daily-revenue-card">
                            <h4>Total Sells</h4>
                            <div class="dropdown icon-dropdown">
                                <button class="btn dropdown-toggle" id="userdropdown" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false"><i
                                        class="icon-more-alt"></i></button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userdropdown"><a
                                        class="dropdown-item" href="#">Weekly</a><a class="dropdown-item"
                                        href="#">Monthly</a><a class="dropdown-item" href="#">Yearly</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-0 total-sells">
                        <div class="d-flex align-items-center gap-3">
                            <div class="flex-shrink-0"><img src="../assets/images/dashboard-2/icon/coin1.png"
                                    alt="icon">
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center gap-2">
                                    <h2>12,463</h2>
                                    <div class="d-flex total-icon">
                                        <p class="mb-0 up-arrow bg-light-success"><i
                                                class="fa fa-arrow-up text-success"></i></p><span
                                            class="f-w-500 font-success">+ 20.08% </span>
                                    </div>
                                </div>
                                <p class="text-truncate">Compared to Jan 2023</p>
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
                            <h4>Orders Value</h4>
                            <div class="dropdown icon-dropdown">
                                <button class="btn dropdown-toggle" id="userdropdown2" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false"><i
                                        class="icon-more-alt"></i></button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userdropdown2"><a
                                        class="dropdown-item" href="#">Weekly</a><a class="dropdown-item"
                                        href="#">Monthly</a><a class="dropdown-item" href="#">Yearly</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-0 total-sells-2">
                        <div class="d-flex align-items-center gap-3">
                            <div class="flex-shrink-0"><img src="../assets/images/dashboard-2/icon/shopping1.png"
                                    alt="icon">
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center gap-2">
                                    <h2>78,596</h2>
                                    <div class="d-flex total-icon">
                                        <p class="mb-0 up-arrow bg-light-danger"><i
                                                class="fa fa-arrow-up text-danger"></i></p><span
                                            class="f-w-500 font-danger">- 10.02%</span>
                                    </div>
                                </div>
                                <p class="text-truncate">Compared to Aug 2023</p>
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
                                        href="#">Monthly</a><a class="dropdown-item" href="#">Yearly</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-0 total-sells-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="flex-shrink-0"><img src="../assets/images/dashboard-2/icon/sent1.png"
                                    alt="icon">
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center gap-2">
                                    <h2>95,789</h2>
                                    <div class="d-flex total-icon">
                                        <p class="mb-0 up-arrow bg-light-success"><i
                                                class="fa fa-arrow-up text-success"></i></p><span
                                            class="f-w-500 font-success">+ 13.23%</span>
                                    </div>
                                </div>
                                <p class="text-truncate">Compared to may 2023</p>
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
                                        href="#">Monthly</a><a class="dropdown-item" href="#">Yearly</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-0 total-sells-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="flex-shrink-0"><img src="../assets/images/dashboard-2/icon/revenue1.png"
                                    alt="icon">
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center gap-2">
                                    <h2>41,954</h2>
                                    <div class="d-flex total-icon">
                                        <p class="mb-0 up-arrow bg-light-danger"><i
                                                class="fa fa-arrow-up text-danger"></i></p><span
                                            class="f-w-500 font-danger">- 17.06%</span>
                                    </div>
                                </div>
                                <p class="text-truncate">Compared to july 2023</p>
                            </div>
                        </div>
                        <div id="daily-revenue"></div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-7 col-lg-12 box-col-12">
                <div class="card total-revenue">
                    <div class="card-header card-no-border pb-2">
                        <div class="header-top">
                            <h4>Total Revenue</h4>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="row gy-5">
                            <div class="col-lg-9 col-md-8">
                                <div class="revenue-legend">
                                    <ul>
                                        <li class="me-3">
                                            <div class="circle bg-primary me-1"> </div>
                                            <span>Earning</span>
                                        </li>
                                        <li>
                                            <div class="circle bg-secondary me-1"></div><span>Expense
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="revenue-chart" id="revenue-chart"></div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-4 increase ps-0">
                                <div class="d-flex pe-3"><span class="me-2">Year:</span><span>2024<i
                                            class="fa fa-caret-down ms-2"></i></span></div>
                                <div class="total-increase">
                                    <h2>$25,837</h2><span>Total : 23,000</span>
                                </div>
                                <div id="monthlychart"></div>
                                <button class="btn btn-primary">Increase</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-5 col-lg-12 col-md-6 box-col-6">
                <div class="card">
                    <div class="card-header card-no-border pb-0">
                        <div class="header-top">
                            <h4>Total Order</h4>
                            <div class="dropdown icon-dropdown">
                                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false"><i class="icon-more-alt"></i></button>
                                <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item"
                                        href="#">Weekly</a><a class="dropdown-item"
                                        href="#">Monthly</a><a class="dropdown-item" href="#">Yearly</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body selling-table checkbox-checked">
                        <div class="table-responsive custom-scrollbar">
                            <table class="table" id="sell-product">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="">
                                                <label class="form-check-label"></label>
                                            </div>
                                        </th>
                                        <th>Product Name</th>
                                        <th>Order Id</th>
                                        <th>Stock</th>
                                        <th>Amount </th>
                                        <th>Payment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="">
                                                <label class="form-check-label"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="flex-shrink-0"><img class="img-30 b-r-10"
                                                        src="../assets/images/dashboard-2/order/watch.png"
                                                        alt=""></div>
                                                <div class="flex-grow-1"><a href="product.html">
                                                        <h5 class="f-w-600">Mi Watch Revolve</h5><span>20
                                                            April 2024</span>
                                                    </a></div>
                                            </div>
                                        </td>
                                        <td>#748669</td>
                                        <td>4657</td>
                                        <td>$35.00</td>
                                        <td>
                                            <button class="bg-primary btn">Pending</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="">
                                                <label class="form-check-label"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="flex-shrink-0"><img class="img-30 b-r-10"
                                                        src="../assets/images/dashboard-2/order/flower.png"
                                                        alt=""></div>
                                                <div class="flex-grow-1"><a href="product.html">
                                                        <h5 class="f-w-600">Stylish Plant Pot</h5><span>10
                                                            June 2024</span>
                                                    </a></div>
                                            </div>
                                        </td>
                                        <td>#744U8F</td>
                                        <td>7637</td>
                                        <td>$25.00</td>
                                        <td>
                                            <button class="bg-secondary btn">Pending</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="">
                                                <label class="form-check-label"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="flex-shrink-0"><img class="img-30 b-r-10"
                                                        src="../assets/images/dashboard-2/order/bench.png"
                                                        alt=""></div>
                                                <div class="flex-grow-1"><a href="product.html">
                                                        <h5 class="f-w-600">Dark Oak Chair</h5><span>13
                                                            May 2024</span>
                                                    </a></div>
                                            </div>
                                        </td>
                                        <td>#329478</td>
                                        <td>3927</td>
                                        <td>$10.00</td>
                                        <td>
                                            <button class="bg-primary btn">Pending</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="">
                                                <label class="form-check-label"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="flex-shrink-0"><img class="img-30 b-r-10"
                                                        src="../assets/images/dashboard-2/order/shoes.png"
                                                        alt=""></div>
                                                <div class="flex-grow-1"><a href="product.html">
                                                        <h5 class="f-w-600">0 Sneakers For Men</h5>
                                                        <span>12 April 2023</span>
                                                    </a></div>
                                            </div>
                                        </td>
                                        <td>#742445</td>
                                        <td>6146</td>
                                        <td>$50.00</td>
                                        <td>
                                            <button class="bg-secondary btn">Pending </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-xl-6 col-md-6 box-col-6">
                <div class="card appointment-detail">
                    <div class="card-header card-no-border pb-0">
                        <div class="header-top">
                            <h4>Total appointment</h4>
                            <div class="dropdown icon-dropdown">
                                <button class="btn dropdown-toggle" id="userdropdown5" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false"><i
                                        class="icon-more-alt"></i></button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userdropdown3"><a
                                        class="dropdown-item" href="#">Weekly</a><a class="dropdown-item"
                                        href="#">Monthly</a><a class="dropdown-item" href="#">Yearly</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive custom-scrollbar">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex"><img class="img-fluid align-top circle"
                                                    src="../assets/images/dashboard-2/user/1.png" alt="">
                                                <div class="flex-grow-1 text-truncate"><a
                                                        href="user-profile.html"><span>James
                                                            Prather</span></a>
                                                    <p class="mb-0">1 Hour</p>
                                                </div>
                                                <div class="active-status active-online"></div>
                                            </div>
                                        </td>
                                        <td class="text-truncate">16 August </td>
                                        <td class="text-end">
                                            <button class="btn btn-primary" type="button"
                                                onclick="document.location='user-cards.html'">Pending</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex"><img class="img-fluid align-top circle"
                                                    src="../assets/images/dashboard-2/user/2.png" alt="">
                                                <div class="flex-grow-1 text-truncate"><a
                                                        href="user-profile.html"><span>Robert
                                                            Johnson</span></a>
                                                    <p class="mb-0">Now</p>
                                                </div>
                                                <div class="active-status active-busy"></div>
                                            </div>
                                        </td>
                                        <td class="text-truncate">21 September </td>
                                        <td class="text-end">
                                            <button class="btn btn-secondary" type="button"
                                                onclick="document.location='user-cards.html'">Done<i
                                                    class="fa fa-check-circle"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex"><img class="img-fluid align-top circle"
                                                    src="../assets/images/dashboard-2/user/3.png" alt="">
                                                <div class="flex-grow-1 text-truncate"><a
                                                        href="user-profile.html"><span>Brian
                                                            McKamey</span></a>
                                                    <p class="mb-0">2 Day After</p>
                                                </div>
                                                <div class="active-status active-offline"></div>
                                            </div>
                                        </td>
                                        <td class="text-truncate">06 March</td>
                                        <td class="text-end">
                                            <button class="btn btn-success" type="button"
                                                onclick="document.location='user-cards.html'">Pending</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex"><img class="img-fluid align-top circle"
                                                    src="../assets/images/dashboard-2/user/4.png" alt="">
                                                <div class="flex-grow-1 text-truncate"><a
                                                        href="user-profile.html"><span>Graham
                                                            Wolfe</span></a>
                                                    <p class="mb-0">Day End</p>
                                                </div>
                                                <div class="active-status active-online"></div>
                                            </div>
                                        </td>
                                        <td class="text-truncate">12 February</td>
                                        <td class="text-end">
                                            <button class="btn btn-info" type="button"
                                                onclick="document.location='user-cards.html'">Pending</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex"><img class="img-fluid align-top circle"
                                                    src="../assets/images/dashboard-2/user/5.png" alt="">
                                                <div class="flex-grow-1 text-truncate"><a
                                                        href="user-profile.html"><span>Walter
                                                            Kendall</span></a>
                                                    <p class="mb-0">2 Day After</p>
                                                </div>
                                                <div class="active-status active-offline"></div>
                                            </div>
                                        </td>
                                        <td class="text-truncate">06 March</td>
                                        <td class="text-end">
                                            <button class="btn btn-danger" type="button"
                                                onclick="document.location='user-cards.html'">Pending</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-xl-6 col-lg-6 col-md-6 box-col-6">
                <div class="card user-country">
                    <div class="card-header card-no-border pb-0">
                        <div class="header-top">
                            <h4>User By Country</h4>
                            <div class="dropdown icon-dropdown">
                                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false"><i class="icon-more-alt"></i></button>
                                <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item"
                                        href="#">Weekly</a><a class="dropdown-item"
                                        href="#">Monthly</a><a class="dropdown-item" href="#">Yearly</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            <h2 class="me-2">216.459</h2><span class="bg-light-success">
                                <svg>
                                    <use href="https://admin.pixelstrap.net/kabul/assets/svg/icon-sprite.svg#up-arrow">
                                    </use>
                                </svg></span>
                            <h6 class="font-success">+ 5.09%</h6>
                        </div><span>Increase than last month</span>
                        <div class="jvector-map-height" id="world-map2"></div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-xl-12 col-sm-12 col-md-6 box-col-6">
                <div class="card">
                    <div class="card-header card-no-border pb-0">
                        <div class="header-top">
                            <h4>Over All Rating</h4>
                            <div class="dropdown icon-dropdown">
                                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false"><i class="icon-more-alt"></i></button>
                                <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item"
                                        href="#">Weekly</a><a class="dropdown-item"
                                        href="#">Monthly</a><a class="dropdown-item" href="#">Yearly</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="over-rating">
                            <p>A credit rating is a rating of a prospective debtor's credit risk, expecting
                                their ability to repay the debt.</p>
                            <div class="d-xxl-flex align-items-center">
                                <div class="over-all">
                                    <h3>4.6</h3><span class="d-block"><i class="fa fa-star font-warning"></i><i
                                            class="fa fa-star font-warning"></i><i
                                            class="fa fa-star font-warning"></i><i
                                            class="fa fa-star font-warning"></i><i
                                            class="fa fa-star font-warning"></i></span>
                                    <p>A sovereign credit rating refers to the creditworthiness of a
                                        sovereign body, such as the national government.</p>
                                </div>
                                <div class="rating-box d-xxl-block d-none">
                                    <div class="d-flex gap-2">
                                        <div class="flex-shrink-0">
                                            <h3>4.6</h3>
                                        </div>
                                        <div class="flex-grow-1"><span class="d-flex"><i
                                                    class="fa fa-star font-warning"></i><i
                                                    class="fa fa-star font-warning"></i><i
                                                    class="fa fa-star font-warning"></i><i
                                                    class="fa fa-star font-warning"></i><i
                                                    class="fa fa-star font-warning"></i></span></div>
                                        <p>95%</p>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <div class="flex-shrink-0">
                                            <h3>6.2</h3>
                                        </div>
                                        <div class="flex-grow-1"><span class="d-flex"><i
                                                    class="fa fa-star font-warning"></i><i
                                                    class="fa fa-star font-warning"></i><i
                                                    class="fa fa-star font-warning"></i><i
                                                    class="fa fa-star font-warning"></i><i
                                                    class="fa fa-star font-warning"></i></span></div>
                                        <p>61%</p>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <div class="flex-shrink-0">
                                            <h3>5.0</h3>
                                        </div>
                                        <div class="flex-grow-1"><span class="d-flex"><i
                                                    class="fa fa-star font-warning"></i><i
                                                    class="fa fa-star font-warning"></i><i
                                                    class="fa fa-star font-warning"></i><i
                                                    class="fa fa-star font-warning"></i><i
                                                    class="fa fa-star font-warning"></i></span></div>
                                        <p>34%</p>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <div class="flex-shrink-0">
                                            <h3>1.3</h3>
                                        </div>
                                        <div class="flex-grow-1"><span class="d-flex"><i
                                                    class="fa fa-star font-warning"></i><i
                                                    class="fa fa-star font-warning"></i><i
                                                    class="fa fa-star font-warning"></i><i
                                                    class="fa fa-star font-warning"></i><i
                                                    class="fa fa-star font-warning"></i></span></div>
                                        <p>91%</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-7 col-lg-6 box-col-6">
                <div class="card">
                    <div class="card-header card-no-border pb-0">
                        <div class="header-top">
                            <h4>Project Deliveries</h4>
                            <div class="dropdown icon-dropdown">
                                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false"><i class="icon-more-alt"></i></button>
                                <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item"
                                        href="#">Weekly</a><a class="dropdown-item"
                                        href="#">Monthly</a><a class="dropdown-item" href="#">Yearly</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div id="company-viewchart"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-lg-12 box-col-6 pre-order">
                <div class="card">
                    <div class="card-header card-no-border pb-0">
                        <div class="header-top">
                            <h4>Audit log </h4>
                            <div class="dropdown icon-dropdown">
                                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false"><i class="icon-more-alt"></i></button>
                                <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item"
                                        href="#">Weekly</a><a class="dropdown-item"
                                        href="#">Monthly</a><a class="dropdown-item" href="#">Yearly</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body py-0">
                        <ul class="message-box custom-scrollbar">
                            <li>
                                <div class="d-flex">
                                    <div class="flex-shrink-0 bg-primary"><i class="fa fa-check-circle"></i></div>
                                    <div class="flex-grow-1"> <a href="task.html">
                                            <h5>RP204_salesfores generated</h5>
                                            <p>Andre Sluczka </p>
                                        </a></div><span>2hr ago</span>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex">
                                    <div class="flex-shrink-0 bg-secondary"><i class="fa fa-exclamation-circle"></i>
                                    </div>
                                    <div class="flex-grow-1"> <a href="task.html">
                                            <h5>R304_salesforece undeployed</h5>
                                            <p>Andre Sluczka</p>
                                        </a></div><span>4hr ago</span>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex">
                                    <div class="flex-shrink-0 bg-danger"><i class="fa fa-times-circle"></i></div>
                                    <div class="flex-grow-1"> <a href="task.html">
                                            <h5>R304_salesforece loast...</h5>
                                            <p>Andre Sluczka</p>
                                        </a></div><span>10 Jun</span>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex">
                                    <div class="flex-shrink-0 bg-primary"><i class="fa fa-check-circle"></i></div>
                                    <div class="flex-grow-1"> <a href="task.html">
                                            <h5>Dev created a new environment.</h5>
                                            <p>Andre Sluczka</p>
                                        </a></div><span>22 Oct</span>
                                </div>
                            </li>
                            <li class="d-xxl-block d-xl-none d-lg-block">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 bg-primary"><i class="fa fa-check-circle"></i></div>
                                    <div class="flex-grow-1"> <a href="task.html">
                                            <h5>Project salesforce built.</h5>
                                            <p>Andre Sluczka</p>
                                        </a></div><span>25 Oct</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
