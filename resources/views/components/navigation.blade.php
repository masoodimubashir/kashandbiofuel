<div class="container-fluid-lg">
    <div class="row">
        <div class="col-12">
            <div class="header-nav">

                <div class="header-nav-left">

                    <button class="dropdown-category btn-sm">
                        <i data-feather="align-left"></i>
                        <span>Main Menu</span>
                    </button>

                    <div class="category-dropdown">
                        <div class="category-title">
                            <h5>Categories</h5>
                            <button type="button" class="btn p-0 close-button text-content">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>

                        <ul class="category-list">

                            <li class="onhover-category-list">
                                <a href="{{ route('home') }}" class="category-name">

                                    <h6>Home</h6>
                                </a>

                            </li>
                            <li class="onhover-category-list">
                                <a href="{{ route('contact-us.index') }}" class="category-name">

                                    <h6>Contact Us</h6>
                                </a>

                            </li>

                            <li class="onhover-category-list">
                                <a href="{{ route('ship.policy') }}" class="category-name">

                                    <h6>Shipping Policy</h6>
                                </a>

                            </li>

                            <li class="onhover-category-list">
                                <a href="{{ route('terms.and.conditions') }}" class="category-name">

                                    <h6>Shopping FAQs</h6>
                                </a>

                            </li>



                            <li class="onhover-category-list">

                                <a href="javascript:void(0)" class="category-name">
                                    <h6>Sub Categories</h6>
                                    <i class="fa-solid fa-angle-right"></i>
                                </a>

                                <div class="onhover-category-box">
                                    <div class="list-1">
                                       
                                        <ul>

                                            @foreach ($subCategories as $subCategory)
                                                <li>
                                                    <a href="{{ route('sub-category-shopping.index', $subCategory->slug) }}">{{ $subCategory->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>

                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>

                <div class="header-nav-middle">
                    <div class="main-nav navbar navbar-expand-xl navbar-light navbar-sticky">
                        <div class="offcanvas offcanvas-collapse order-xl-2" id="primaryMenu">
                            <div class="offcanvas-header navbar-shadow">
                                <h5>Menu</h5>
                                <button class="btn-close lead" type="button" data-bs-dismiss="offcanvas"></button>
                            </div>
                            <div class="offcanvas-body">

                                <ul class="navbar-nav">



                                    @foreach ($navigation as $category)
                                        <li
                                            class="nav-item {{ $category->subCategories->count() > 0 ? 'dropdown' : '' }}">
                                            <a class="nav-link {{ $category->subCategories->count() > 0 ? 'dropdown-toggle' : '' }}"
                                                href="javascript:void(0)"
                                                {{ $category->subCategories->count() > 0 ? 'data-bs-toggle=dropdown' : '' }}>
                                                {{ $category->name }}
                                            </a>

                                            @if ($category->subCategories->count() > 0)
                                                @if ($category->subCategories->count() <= 6)
                                                    <ul class="dropdown-menu">
                                                        @foreach ($category->subCategories as $subCategory)
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('sub-category-shopping.index', $subCategory->slug) }}">
                                                                    {{ $subCategory->name }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    <div class="dropdown-menu dropdown-menu-2">
                                                        <div class="row">
                                                            @foreach ($category->subCategories->chunk(ceil($category->subCategories->count() / 3)) as $chunk)
                                                                <div class="dropdown-column col-xl-3">
                                                                    @foreach ($chunk as $subCategory)
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('sub-category-shopping.index', $subCategory->slug) }}">
                                                                            {{ $subCategory->name }}
                                                                        </a>
                                                                    @endforeach
                                                                </div>
                                                            @endforeach

                                                            <div class="dropdown-column dropdown-column-img col-3">
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>


                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
