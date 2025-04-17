@extends('welcome')
@section('main')
    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Search</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Search</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Search Bar Section Start -->
    <section class="search-section">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-xxl-6 col-xl-8 mx-auto">
                    <div class="title d-block text-center">
                        <h2>Search for products</h2>
                        <span class="title-leaf">
                            <svg class="icon-width">
                                <use xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf"></use>
                            </svg>
                        </span>
                    </div>

                    <div class="search-box">
                        <div class="input-group search-input">
                            <input type="text" class="form-control" placeholder="">
                            <button class="btn theme-bg-color text-white m-0" type="button"
                                id="button-addon1">Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Search Bar Section End -->

    <!-- Product Section Start -->
    <section class="section-b-space">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="search-product product-wrapper">


                        <div>
                            <div class="product-box-3 h-100">
                                <div class="product-header">
                                    <div class="product-image">
                                        <a href="product-left-2.html">
                                            <img src="../assets/images/cake/product/11.png"
                                                class="img-fluid blur-up lazyload" alt="">
                                        </a>

                                        <ul class="product-option">
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                                    <i data-feather="eye"></i>
                                                </a>
                                            </li>

                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                                <a href="compare.html">
                                                    <i data-feather="refresh-cw"></i>
                                                </a>
                                            </li>

                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                                <a href="wishlist.html" class="notifi-wishlist">
                                                    <i data-feather="heart"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="product-footer">
                                    <div class="product-detail">
                                        <span class="span-name">Cake</span>
                                        <a href="product-left-thumbnail.html">
                                            <h5 class="name">Chocolate Chip Cookies 250 g</h5>
                                        </a>
                                        <div class="product-rating mt-2">
                                            <ul class="rating">
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                            </ul>
                                            <span>(5.0)</span>
                                        </div>
                                        <h6 class="unit">500 G</h6>
                                        <h5 class="price"><span class="theme-color">$10.25</span> <del>$12.57</del>
                                        </h5>
                                        <div class="add-to-cart-box bg-white">
                                            <button class="btn btn-add-cart addcart-button">Add
                                                <span class="add-icon bg-light-gray">
                                                    <i class="fa-solid fa-plus"></i>
                                                </span>
                                            </button>
                                            <div class="cart_qty qty-box">
                                                <div class="input-group bg-white">
                                                    <button type="button" class="qty-left-minus bg-gray" data-type="minus"
                                                        data-field="">
                                                        <i class="fa fa-minus"></i>
                                                    </button>
                                                    <input class="form-control input-number qty-input" type="text"
                                                        name="quantity" value="0">
                                                    <button type="button" class="qty-right-plus bg-gray" data-type="plus"
                                                        data-field="">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
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
        </div>
    </section>
    <!-- Product Section End -->

    @push('frontend.scripts')
        <script>
            $(document).ready(function() {
                // Handle search when button is clicked
                $('#button-addon1').on('click', function() {
                    performSearch();

                });

                // Also handle search when Enter key is pressed in the search input
                $('.search-input input').on('keypress', function(e) {
                    if (e.which === 13) {
                        performSearch();
                    }
                });

                function performSearch() {

                    const searchQuery = $('.search-input input').val().trim();

                    console.log(searchQuery);


                    // Clear previous search results if query is empty
                    if (searchQuery === '') {
                        $('.search-product').html('');
                        return;
                    }

                    // Show loading indicator
                    $('.search-product').html(
                        '<div class="text-center my-4"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>'
                    );

                    // Make AJAX request
                    $.ajax({
                        url: '/search-product',
                        method: 'GET',
                        data: {
                            query: searchQuery
                        },
                        success: function(response) {

                            console.log(response);

                            if (!response.success && response.message === 'No Product Found') {
                                $('.search-product').html(
                                    '<div class="text-center my-4">No products found. Try a different search term.</div>'
                                );
                                return;
                            }

                            // If response is successful and has products
                            displayProducts(response);
                        },
                        error: function(error) {
                            console.error('Search error:', error);
                            $('.search-product').html(
                                '<div class="text-center my-4">An error occurred while searching. Please try again.</div>'
                            );
                        }
                    });
                }

                function displayProducts(products) {
                    if (!products || products.length === 0) {
                        $('.search-product').html('<div class="text-center my-4">No products found.</div>');
                        return;
                    }

                    let productsHTML = '';

                    // Loop through the products and create HTML for each
                    $.each(products, function(index, product) {
                        const productSlug = product.slug || 'product-detail';
                        const productName = product.name || 'Product Name';
                        const productImage = product.image || '../assets/images/cake/product/11.png';
                        const productCategory = product.category || 'Category';
                        const productPrice = product.price || '0.00';
                        const productOldPrice = product.old_price || (parseFloat(productPrice) * 1.2).toFixed(
                            2);
                        const productUnit = product.unit || 'Unit';

                        productsHTML += `
                <div>
                    <div class="product-box-3 h-100">
                        <div class="product-header">
                            <div class="product-image">
                                <a href="${productSlug}">
                                    <img src="${productImage}" class="img-fluid blur-up lazyload" alt="${productName}">
                                </a>
                                <ul class="product-option">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                            <i data-feather="eye"></i>
                                        </a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                        <a href="compare.html">
                                            <i data-feather="refresh-cw"></i>
                                        </a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                        <a href="wishlist.html" class="notifi-wishlist">
                                            <i data-feather="heart"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-footer">
                            <div class="product-detail">
                                <span class="span-name">${productCategory}</span>
                                <a href="${productSlug}">
                                    <h5 class="name">${productName}</h5>
                                </a>
                                <div class="product-rating mt-2">
                                    <ul class="rating">
                                        <li><i data-feather="star" class="fill"></i></li>
                                        <li><i data-feather="star" class="fill"></i></li>
                                        <li><i data-feather="star" class="fill"></i></li>
                                        <li><i data-feather="star" class="fill"></i></li>
                                        <li><i data-feather="star" class="fill"></i></li>
                                    </ul>
                                    <span>(5.0)</span>
                                </div>
                                <h6 class="unit">${productUnit}</h6>
                                <h5 class="price"><span class="theme-color">$${productPrice}</span> <del>$${productOldPrice}</del></h5>
                                <div class="add-to-cart-box bg-white">
                                    <button class="btn btn-add-cart addcart-button" data-product-id="${product.id}">Add
                                        <span class="add-icon bg-light-gray">
                                            <i class="fa-solid fa-plus"></i>
                                        </span>
                                    </button>
                                    <div class="cart_qty qty-box">
                                        <div class="input-group bg-white">
                                            <button type="button" class="qty-left-minus bg-gray" data-type="minus" data-field="">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                            <input class="form-control input-number qty-input" type="text" name="quantity" value="0">
                                            <button type="button" class="qty-right-plus bg-gray" data-type="plus" data-field="">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
                    });

                    // Update the search results container
                    $('.search-product').html(productsHTML);

                    // Reinitialize Feather icons if needed
                    if (typeof feather !== 'undefined') {
                        feather.replace();
                    }
                }
            });
        </script>
    @endpush
@endsection
