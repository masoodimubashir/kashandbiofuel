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
                    <div class="left-box">
                        <div class="shop-left-sidebar">
                            <div class="back-button">
                                <h3><i class="fa-solid fa-arrow-left"></i> Back</h3>
                            </div>

                            <form action="{{ route('category.index') }}" method="GET">
                                <div class="filter-category">
                                    <div class="filter-title">
                                        <h2>
                                            <button type="submit" class="btn btn-sm">Apply Filters</button>

                                        </h2>
                                        <a href="{{ route('category.index') }}" id="clear-filters">Clear All</a>
                                    </div>
                                </div>

                                <div class="accordion custom-accordion" id="accordionExample">
                                    {{-- Categories --}}
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseOne">
                                                <span>Categories</span>
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse show">
                                            <div class="accordion-body">
                                                <div class="form-floating theme-form-floating-2 search-box">
                                                    <input type="search" class="form-control" id="search-category"
                                                           placeholder="Search ..">
                                                    <label for="search-category">Search</label>
                                                </div>
                                                <ul class="category-list custom-padding custom-height">
                                                    @foreach ($categories as $category)
                                                        <li>
                                                            <div class="form-check ps-0 m-0 category-list-box">
                                                                <input
                                                                    class="checkbox_animated filter-category-checkbox"
                                                                    type="checkbox" name="categories[]"
                                                                    id="{{ $category->slug }}"
                                                                    value="{{ $category->id }}"
                                                                    {{ in_array($category->id, request()->get('categories', [])) ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                       for="{{ $category->slug }}">
                                                                    <span class="name">{{ $category->name }}</span>
                                                                    <span class="number">(15)</span>
                                                                </label>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Subcategories --}}
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="panelsStayOpen-headingFive">
                                            <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseFive">
                                                <span>Sub Category</span>
                                            </button>
                                        </h2>
                                        <div id="collapseFive" class="accordion-collapse collapse show">
                                            <div class="accordion-body">
                                                <ul class="category-list custom-padding custom-height">
                                                    @foreach ($subCategories as $subCategory)
                                                        <li>
                                                            <div class="form-check ps-0 m-0 category-list-box">
                                                                <input
                                                                    class="checkbox_animated filter-subcategory-checkbox"
                                                                    type="checkbox" name="subcategories[]"
                                                                    id="{{ $subCategory->slug }}"
                                                                    value="{{ $subCategory->id }}"
                                                                    {{ in_array($subCategory->id, request()->get('subcategories', [])) ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                       for="{{ $subCategory->slug }}">
                                                                    <span class="name">{{ $subCategory->name }}</span>
                                                                    <span class="number">(05)</span>
                                                                </label>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Price Filter --}}
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                                            <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseThree">
                                                <span>Price</span>
                                            </button>
                                        </h2>
                                        <div id="collapseThree" class="accordion-collapse collapse show">
                                            <div class="accordion-body">
                                                <div class="range-slider">
                                                    <input type="text" class="js-range-slider" name="price"
                                                           value="{{ request()->get('price') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Ratings Filter --}}
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="panelsStayOpen-headingSix">
                                            <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseSix">
                                                <span>Rating</span>
                                            </button>
                                        </h2>
                                        <div id="collapseSix" class="accordion-collapse collapse show">
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
                        class="row g-sm-4 g-3 row-cols-xxl-4 row-cols-xl-3 row-cols-lg-2 row-cols-md-3 row-cols-2 product-list-section h-screen"
                        id="product-list">


                    </div>

                    <div class="custom-pagination">
                        <ul class="pagination justify-content-center">
                            <!-- Pagination links will be dynamically injected here -->
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </section>

    @push('frontend.scripts')

        <script>
            $(document).ready(function () {

                const productList = $('#product-list');

                // Fetch Products Function
                function fetchProducts(pageUrl = '{{ route("category.index") }}') {
                    const formData = $('form').serialize();

                    // AJAX request
                    $.ajax({
                        url: pageUrl,
                        type: 'GET',
                        data: formData,
                        success: function (response) {
                            if (response.success) {
                                productList.empty(); // Clear existing products

                                // Append products dynamically
                                response.products.forEach(product => {
                                    const productHTML = generateProductHTML(product);
                                    productList.append(productHTML);
                                });

                                updatePagination(response.pagination); // Update pagination controls
                                feather.replace(); // Re-render Feather icons after dynamic HTML updates
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error('Error fetching products:', error);
                        }
                    });
                }

                // Generate Individual Product HTML
                function generateProductHTML(product) {
                    return `
                <div>
                    <div class="product-box-3 h-100 wow fadeInUp" data-wow-delay="0.4s">
                        <div class="product-header">
                            <div class="product-image">
                                <a href="/product/${product.slug}">
                                    <img src="/storage/${product.product_attribute.image_path}"
                                         class="img-fluid blur-up lazyload" alt="${product.name}">
                                </a>
                            </div>
                        </div>
                        <div class="product-footer">
                            <div class="product-detail">
                                <span class="span-name">${product.category.name}</span>
                                <a href="/product/${product.slug}">
                                    <h5 class="name">${product.name}</h5>
                                </a>
                                <p class="text-content mt-1 mb-2 product-content">${product.description}</p>
                                <div class="product-rating mt-2">
                                    <ul class="rating">
                                        ${generateRatingHTML(Math.round(product.review_avg_rating))}
                                    </ul>
                                    <span>(${Math.round(product.review_avg_rating * 10) / 10})</span>
                                </div>
                                <h6 class="unit">${product.unit}</h6>
                                <h5 class="price">
                                    <span class="theme-color">$${product.selling_price}</span>
                                    <del>$${product.price}</del>
                                </h5>
                            </div>
                        </div>
                    </div>
                 </div>
            `;
                }

                // Generate Product Rating Stars HTML
                function generateRatingHTML(rating) {
                    let html = '';
                    for (let i = 0; i < 5; i++) {
                        html += `
                    <li>
                        <i data-feather="star" class="${i < rating ? 'fill' : ''}"></i>
                    </li>`;
                    }
                    return html;
                }

                // Update Pagination
                function updatePagination(pagination) {
                    const paginationContainer = $('.custom-pagination .pagination');

                    paginationContainer.empty(); // Clear old pagination

                    // Previous Page
                    if (pagination.prev_page_url) {
                        paginationContainer.append(`
                    <li class="page-item">
                        <a class="page-link" href="javascript:void(0)" data-url="${pagination.prev_page_url}">&laquo;</a>
                    </li>
                `);
                    } else {
                        paginationContainer.append(`
                    <li class="page-item disabled">
                        <a class="page-link">&laquo;</a>
                    </li>
                `);
                    }

                    // Page Links
                    for (let i = 1; i <= pagination.last_page; i++) {
                        const isActive = i === pagination.current_page ? 'active' : '';
                        paginationContainer.append(`
                    <li class="page-item ${isActive}">
                        <a class="page-link" href="javascript:void(0)" data-url="${pagination.path}?page=${i}">${i}</a>
                    </li>
                `);
                    }

                    // Next Page
                    if (pagination.next_page_url) {
                        paginationContainer.append(`
                    <li class="page-item">
                        <a class="page-link" href="javascript:void(0)" data-url="${pagination.next_page_url}">&raquo;</a>
                    </li>
                `);
                    } else {
                        paginationContainer.append(`
                    <li class="page-item disabled">
                        <a class="page-link">&raquo;</a>
                    </li>
                `);
                    }

                    // Re-add click event listener for pagination links
                    $('.pagination .page-link').off('click').on('click', function (e) {
                        e.preventDefault(); // Stop default anchor behavior
                        const url = $(this).data('url'); // Get data URL
                        if (url) {
                            fetchProducts(url);
                        }
                    });
                }

                // Initial Fetch
                fetchProducts();

                // Trigger fetch on form inputs (filters, etc.)
                $('form').on('change', 'input, select', function () {
                    fetchProducts(); // Fetch products with updated filters
                });
            });
        </script>

    @endpush

    <!-- Shop Section End -->
@endsection
