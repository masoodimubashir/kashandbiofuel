@extends('welcome')
@section('main')
    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Shop By Category</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Shop By Category</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->


    <section class="section-b-space shop-section">
        <div class="container-fluid-lg">
            <div class="row">


                <div class="col-custom-3 wow fadeInUp">
                    <div class="shop-left-sidebar">

                        <form action="{{ route('category.index', ['category_id' => request()->category_id]) }}"
                            method="GET">

                            <div class="row mb-4" >
                                <div class="col-6">
                                    <h2>
                                        <button type="submit" class="btn btn-sm">Search</button>
                                    </h2>
                                </div>

                                <div class="col-6">
                                    <a  class="btn btn-sm" href="{{ route('category.index', ['category_id' => $category_id]) }}"
                                        id="clear-filters">
                                        Clear All
                                    </a>
                                </div>

                            </div>

                            <div class="accordion custom-accordion" id="accordionExample">

                                <!-- Categories -->
                                {{-- <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingCategories">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseCategories">
                                            <span>Categories</span>
                                        </button>
                                    </h2>
                                    <div id="collapseCategories" class="accordion-collapse collapse show">
                                        <div class="accordion-body">
                                            <ul class="category-list custom-padding custom-height">
                                                @foreach ($categories as $category)
                                                    <li>
                                                        <div class="form-check ps-0 m-0 category-list-box">
                                                            <input class="checkbox_animated filter-category-checkbox"
                                                                type="checkbox" name="categories[]"
                                                                id="category-{{ $category->id }}"
                                                                value="{{ $category->id }}"
                                                                {{ in_array($category->id, request()->get('categories', [])) ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="category-{{ $category->id }}">
                                                                <span class="name">{{ $category->name }}</span>
                                                            </label>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div> --}}

                                <!-- Subcategories -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingSubCategories">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseSubCategories">
                                            <span>Sub Category</span>
                                        </button>
                                    </h2>
                                    <div id="collapseSubCategories" class="accordion-collapse collapse show">
                                        <div class="accordion-body">
                                            <ul class="category-list custom-padding custom-height">
                                                @foreach ($subCategories as $subCategory)
                                                    <li>
                                                        <div class="form-check ps-0 m-0 category-list-box">
                                                            <input class="checkbox_animated filter-subcategory-checkbox"
                                                                type="checkbox" name="subcategories[]"
                                                                id="subcategory-{{ $subCategory->id }}"
                                                                value="{{ $subCategory->id }}"
                                                                {{ in_array($subCategory->id, request()->get('subcategories', [])) ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="subcategory-{{ $subCategory->id }}">
                                                                <span class="name">{{ $subCategory->name }}</span>
                                                            </label>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- Price Filter -->
                                <div class="accordion-item">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapsePrice">
                                            <span>Price</span>
                                        </button>
                                    </h2>
                                    <div id="collapsePrice" class="accordion-collapse collapse show">
                                        <div class="accordion-body">
                                            <div class="range-slider">
                                                <input type="text" class="js-range-slider" name="price"
                                                    value="{{ request()->get('price') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Rating Filter -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingRating">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseRating">
                                            <span>Rating</span>
                                        </button>
                                    </h2>
                                    <div id="collapseRating" class="accordion-collapse collapse show">
                                        <div class="accordion-body">
                                            <ul class="category-list custom-padding">
                                                @foreach (range(5, 1) as $rating)
                                                    <li>
                                                        <div class="form-check ps-0 m-0 category-list-box">
                                                            <input class="checkbox_animated filter-rating-checkbox"
                                                                type="checkbox" name="rating[]"
                                                                value="{{ $rating }}"
                                                                {{ in_array($rating, request()->get('rating', [])) ? 'checked' : '' }}>
                                                            <div class="form-check-label">
                                                                <ul class="rating">
                                                                    @for ($i = 0; $i < $rating; $i++)
                                                                        <li><i data-feather="star" class="fill"></i>
                                                                        </li>
                                                                    @endfor
                                                                    @for ($i = 0; $i < 5 - $rating; $i++)
                                                                        <li><i data-feather="star"></i></li>
                                                                    @endfor
                                                                </ul>
                                                                <span class="text-content">({{ $rating }}
                                                                    Star)</span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>



                    </div>
                </div>

                <div class="col-custom- wow fadeInUp">
                    <div class="show-button">
                        <div class="filter-button-group mt-0">
                            <div class="filter-button d-inline-block d-lg-none">
                                <a><i class="fa-solid fa-filter"></i> Filter Menu</a>
                            </div>
                        </div>

                        <div class="top-filter-menu">
                            <div class="category-dropdown">
                                <h5 class="text-content">Sort By :</h5>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" id="dropdownMenuButton1"
                                        data-bs-toggle="dropdown">
                                        <span>Most Popular</span> <i class="fa-solid fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" id="pop"
                                                href="javascript:void(0)">Popularity</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" id="low" href="javascript:void(0)">Low - High
                                                Price</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" id="high" href="javascript:void(0)">High - Low
                                                Price</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" id="rating" href="javascript:void(0)">Average
                                                Rating</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" id="aToz" href="javascript:void(0)">A - Z
                                                Order</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" id="zToa" href="javascript:void(0)">Z - A
                                                Order</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" id="off" href="javascript:void(0)">% Off -
                                                Hight To
                                                Low</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="grid-option d-none d-md-block">
                                <ul>
                                    <li class="three-grid">
                                        <a href="javascript:void(0)">
                                            <img src="https://themes.pixelstrap.com/fastkart/assets/svg/grid-3.svg"
                                                class="blur-up lazyload" alt="">
                                        </a>
                                    </li>
                                    <li class="grid-btn d-xxl-inline-block d-none active">
                                        <a href="javascript:void(0)">
                                            <img src="https://themes.pixelstrap.com/fastkart/assets/svg/grid-4.svg"
                                                class="blur-up lazyload d-lg-inline-block d-none" alt="">
                                            <img src="https://themes.pixelstrap.com/fastkart/assets/svg/grid.svg"
                                                class="blur-up lazyload img-fluid d-lg-none d-inline-block"
                                                alt="">
                                        </a>
                                    </li>
                                    <li class="list-btn">
                                        <a href="javascript:void(0)">
                                            <img src="https://themes.pixelstrap.com/fastkart/assets/svg/list.svg"
                                                class="blur-up lazyload" alt="">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div
                        class="row g-sm-4 g-3 row-cols-xxl-4 row-cols-xl-3 row-cols-lg-2 row-cols-md-3 row-cols-2 product-list-section">
                        @foreach ($products as $product)
                            <div>
                                <div class="product-box-3 h-100 wow fadeInUp" data-wow-delay="0.4s">
                                    <div class="product-header">
                                        <div class="product-image">
                                            <a href="/product/{{ $product->slug }}">
                                                <img src="{{ $product->productAttribute->image_path ? asset('storage/' . $product->productAttribute->image_path) : asset('default_images/product_image.png') }}"
                                                    class="img-fluid blur-up lazyload" alt="{{ $product->name }}">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-footer">
                                        <div class="product-detail">
                                            <span class="span-name">{{ $product->category->name }}</span>
                                            <a href="/product/{{ $product->slug }}">
                                                <h5 class="name">{{ $product->name }}</h5>
                                            </a>
                                            <p class="text-content mt-1 mb-2 product-content">
                                                {!! $product->short_description !!}
                                            </p>
                                            <div class="product-rating mt-2">
                                                <ul class="rating">
                                                    @for ($i = 0; $i < 5; $i++)
                                                        <li>
                                                            <i data-feather="star"
                                                                class="{{ $i < round($product->review_avg_rating) ? 'fill' : '' }}"></i>
                                                        </li>
                                                    @endfor
                                                </ul>
                                                <span>({{ round($product->review_avg_rating, 1) }})</span>
                                            </div>
                                            <h6 class="unit">Quantity - {{ $product->qty }}</h6>
                                            <h5 class="price">
                                                <span class="theme-color">&#8377;{{ $product->selling_price }}</span>
                                                <del>&#8377;{{ $product->price }}</del>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <nav class="custom-pagination">
                        {{ $products->links() }}

                    </nav>
                </div>


                <div class="col-custom-3 wow fadeInUp">
                    <div class="left-box">

                    </div>
                </div>



            </div>
        </div>
    </section>



    <!-- Shop Section End -->
@endsection
