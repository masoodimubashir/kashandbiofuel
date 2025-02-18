@extends('welcome')
@section('main')
    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        {{--                        <h2>Shop By {{$subcategory->name}}</h2>--}}
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                {{--                                <li class="breadcrumb-item active">Shop By {{$subcategory->name}}</li>--}}
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->



    <!-- Shop Section Start -->
    <section class="section-b-space shop-section">
        <div class="container-fluid-lg">
            <div class="row">

                <div class="col-custom- wow fadeInUp">
                    <div
                        class="row g-sm-4 g-3 row-cols-xxl-4 row-cols-xl-3 row-cols-lg-2 row-cols-md-3 row-cols-2 product-list-section"
                        id="product-list">

                        @foreach ($products as $product)

                            <div>
                                <div class="product-box-3 h-100 wow fadeInUp" data-wow-delay="0.4s">
                                    <div class="product-header">
                                        <div class="product-image">
                                            <a href="{{ route('product.show', $product->slug) }}">
                                                <img
                                                    src="{{asset('storage/' . $product->productAttribute->image_path)}}"
                                                    class="img-fluid blur-up lazyload" alt="{{ $product->name }}">
                                            </a>

                                        </div>
                                    </div>

                                    <div class="product-footer">
                                        <div class="product-detail">
                                            <span class="span-name">{{ $product->category->name }}</span>
                                            <a href="{{ route('product.show', $product->slug) }}">
                                                <h5 class="name">{{ $product->name }}</h5>
                                            </a>
                                            <p class="text-content mt-1 mb-2 product-content">{{ $product->description }}
                                            </p>
                                            <div class="product-rating mt-2">
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
                                            </div>
                                            <h6 class="unit">{{ $product->unit }}</h6>
                                            <h5 class="price">
                                                <span class="theme-color">${{ $product->selling_price }}</span>
                                                <del>${{ $product->price }}</del>
                                            </h5>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>

                    <nav class="custom-pagination">
                        <ul class="pagination justify-content-center align-items-center">
                            <li class="page-item {{ $products->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $products->previousPageUrl() }}" tabindex="-1">
                                    <i class="fa-solid fa-angles-left"></i>
                                </a>
                            </li>

                            @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                <li class="page-item {{ $page == $products->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach

                            <li class="page-item {{ $products->hasMorePages() ? '' : 'disabled' }}">
                                <a class="page-link" href="{{ $products->nextPageUrl() }}">
                                    <i class="fa-solid fa-angles-right"></i>
                                </a>
                            </li>
                        </ul>


                    </nav>
                </div>
            </div>
        </div>
    </section>


    <!-- Shop Section End -->
@endsection
