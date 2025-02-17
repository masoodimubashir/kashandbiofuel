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
                                        <h3>{{$order_count}}</h3>
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
                <x-user-order-component/>
            </div>

            <div class="tab-pane fade" id="pills-address" role="tabpanel">
                <x-user-address-component/>
            </div>

            <div class="tab-pane fade" id="pills-profile" role="tabpanel">
                <x-user-profile-component/>
            </div>

            <div class="tab-pane fade" id="pills-download" role="tabpanel">

                <div class="dashboard-download">
                    <div class="title">
                        <h2>My Download</h2>
                        <span class="title-leaf">
                                            <svg class="icon-width bg-gray">
                                                <use
                                                    xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf">
                                                </use>
                                            </svg>
                                        </span>
                    </div>

                    <div class="download-detail dashboard-bg-box">
                        <form>
                            <div class="input-group download-form">
                                <input type="text" class="form-control"
                                       placeholder="Search your download">
                                <button class="btn theme-bg-color text-light" type="button"
                                        id="button-addon2">Search
                                </button>
                            </div>
                        </form>

                        <div class="select-filter-box">
                            <select class="form-select">
                                <option selected="">All marketplaces</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>


                            <ul class="nav nav-pills filter-box" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-data-tab"
                                            data-bs-toggle="pill" data-bs-target="#pills-data"
                                            type="button">Data Purchased
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-title-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-title" type="button">Title
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-rating-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-rating" type="button">My Rating
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-recent-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-recent" type="button">Recent
                                        Updates
                                    </button>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-data" role="tabpanel">
                                <div class="download-table">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>
                                                    <img src="../assets/images/theme-icon/1.png"
                                                         class="img-fluid" alt="">
                                                </td>
                                                <td>Sheltos - Real Estate Angular 17 Template</td>
                                                <td>
                                                    <div class="dropdown download-dropdown">
                                                        <button class="btn dropdown-toggle"
                                                                type="button"
                                                                data-bs-toggle="dropdown">Download
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="#">All files
                                                                    & documentation</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="#">License
                                                                    certificate & purchase code
                                                                    (PDF)</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="#">License
                                                                    certificate & purchase code
                                                                    (text)</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>
                                                    <img src="../assets/images/theme-icon/2.png"
                                                         class="img-fluid" alt="">
                                                </td>
                                                <td>Oslo - Multipurpose Shopify Theme. Fast, Clean,
                                                    and
                                                    Flexible. OS 2.0
                                                </td>
                                                <td>
                                                    <div class="dropdown download-dropdown">
                                                        <button class="btn dropdown-toggle"
                                                                type="button"
                                                                data-bs-toggle="dropdown">Download
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="#">All files
                                                                    & documentation</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="#">License
                                                                    certificate & purchase code
                                                                    (PDF)</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="#">License
                                                                    certificate & purchase code
                                                                    (text)</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>
                                                    <img src="../assets/images/theme-icon/3.png"
                                                         class="img-fluid" alt="">
                                                </td>
                                                <td>Boho - React JS Admin Dashboard Template</td>
                                                <td>
                                                    <div class="dropdown download-dropdown">
                                                        <button class="btn dropdown-toggle"
                                                                type="button"
                                                                data-bs-toggle="dropdown">Download
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="#">All files
                                                                    & documentation</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="#">License
                                                                    certificate & purchase code
                                                                    (PDF)</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="#">License
                                                                    certificate & purchase code
                                                                    (text)</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-title">
                                <div class="download-table">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>
                                                    <img src="../assets/images/theme-icon/1.png"
                                                         class="img-fluid" alt="">
                                                </td>
                                                <td>Sheltos - Real Estate Angular 17 Template</td>
                                                <td>
                                                    <div class="dropdown download-dropdown">
                                                        <button class="btn dropdown-toggle"
                                                                type="button"
                                                                data-bs-toggle="dropdown">Download
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="#">All files
                                                                    & documentation</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="#">License
                                                                    certificate & purchase code
                                                                    (PDF)</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="#">License
                                                                    certificate & purchase code
                                                                    (text)</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>
                                                    <img src="../assets/images/theme-icon/2.png"
                                                         class="img-fluid" alt="">
                                                </td>
                                                <td>Oslo - Multipurpose Shopify Theme. Fast, Clean,
                                                    and
                                                    Flexible. OS 2.0
                                                </td>
                                                <td>
                                                    <div class="dropdown download-dropdown">
                                                        <button class="btn dropdown-toggle"
                                                                type="button"
                                                                data-bs-toggle="dropdown">Download
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="#">All files
                                                                    & documentation</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="#">License
                                                                    certificate & purchase code
                                                                    (PDF)</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="#">License
                                                                    certificate & purchase code
                                                                    (text)</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>
                                                    <img src="../assets/images/theme-icon/3.png"
                                                         class="img-fluid" alt="">
                                                </td>
                                                <td>Boho - React JS Admin Dashboard Template</td>
                                                <td>
                                                    <div class="dropdown download-dropdown">
                                                        <button class="btn dropdown-toggle"
                                                                type="button"
                                                                data-bs-toggle="dropdown">Download
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="#">All files
                                                                    & documentation</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="#">License
                                                                    certificate & purchase code
                                                                    (PDF)</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="#">License
                                                                    certificate & purchase code
                                                                    (text)</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-rating">
                                <div class="download-table">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>
                                                    <img src="../assets/images/theme-icon/1.png"
                                                         class="img-fluid" alt="">
                                                </td>
                                                <td>Sheltos - Real Estate Angular 17 Template</td>
                                                <td>
                                                    <div class="dropdown download-dropdown">
                                                        <button class="btn dropdown-toggle"
                                                                type="button"
                                                                data-bs-toggle="dropdown">Download
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="#">All files
                                                                    & documentation</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="#">License
                                                                    certificate & purchase code
                                                                    (PDF)</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="#">License
                                                                    certificate & purchase code
                                                                    (text)</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>
                                                    <img src="../assets/images/theme-icon/2.png"
                                                         class="img-fluid" alt="">
                                                </td>
                                                <td>Oslo - Multipurpose Shopify Theme. Fast, Clean,
                                                    and
                                                    Flexible. OS 2.0
                                                </td>
                                                <td>
                                                    <div class="dropdown download-dropdown">
                                                        <button class="btn dropdown-toggle"
                                                                type="button"
                                                                data-bs-toggle="dropdown">Download
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="#">All files
                                                                    & documentation</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="#">License
                                                                    certificate & purchase code
                                                                    (PDF)</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="#">License
                                                                    certificate & purchase code
                                                                    (text)</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>
                                                    <img src="../assets/images/theme-icon/3.png"
                                                         class="img-fluid" alt="">
                                                </td>
                                                <td>Boho - React JS Admin Dashboard Template</td>
                                                <td>
                                                    <div class="dropdown download-dropdown">
                                                        <button class="btn dropdown-toggle"
                                                                type="button"
                                                                data-bs-toggle="dropdown">Download
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="#">All files
                                                                    & documentation</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="#">License
                                                                    certificate & purchase code
                                                                    (PDF)</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="#">License
                                                                    certificate & purchase code
                                                                    (text)</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-recent">
                                <div class="download-table">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>
                                                    <img src="../assets/images/theme-icon/1.png"
                                                         class="img-fluid" alt="">
                                                </td>
                                                <td>Sheltos - Real Estate Angular 17 Template</td>
                                                <td>
                                                    <div class="dropdown download-dropdown">
                                                        <button class="btn dropdown-toggle"
                                                                type="button"
                                                                data-bs-toggle="dropdown">Download
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="#">All files
                                                                    & documentation</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="#">License
                                                                    certificate & purchase code
                                                                    (PDF)</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="#">License
                                                                    certificate & purchase code
                                                                    (text)</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>
                                                    <img src="../assets/images/theme-icon/2.png"
                                                         class="img-fluid" alt="">
                                                </td>
                                                <td>Oslo - Multipurpose Shopify Theme. Fast, Clean,
                                                    and
                                                    Flexible. OS 2.0
                                                </td>
                                                <td>
                                                    <div class="dropdown download-dropdown">
                                                        <button class="btn dropdown-toggle"
                                                                type="button"
                                                                data-bs-toggle="dropdown">Download
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="#">All files
                                                                    & documentation</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="#">License
                                                                    certificate & purchase code
                                                                    (PDF)</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="#">License
                                                                    certificate & purchase code
                                                                    (text)</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>
                                                    <img src="../assets/images/theme-icon/3.png"
                                                         class="img-fluid" alt="">
                                                </td>
                                                <td>Boho - React JS Admin Dashboard Template</td>
                                                <td>
                                                    <div class="dropdown download-dropdown">
                                                        <button class="btn dropdown-toggle"
                                                                type="button"
                                                                data-bs-toggle="dropdown">Download
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="#">All files
                                                                    & documentation</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="#">License
                                                                    certificate & purchase code
                                                                    (PDF)</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                   href="#">License
                                                                    certificate & purchase code
                                                                    (text)</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

</div>
