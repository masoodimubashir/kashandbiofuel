<div class="title section-t-space">
    <h2>ALL KINDS OF PRODUCTS</h2>
   
</div>
{{-- 
<div class="slider-3_1 product-wrapper">
    @foreach ($allProducts->take(3) as $product)
        <div>
                <div class="product-box-2 wow fadeIn" data-wow-delay="{{ $loop->index * 0.1 . 's' }}">
                    <!-- Product Image -->


                    <a href="{{ route('product.show', [$product->slug]) }}" class="product-image">
                        @isset($product->productAttribute->image_path)
                            <img src="{{ asset('storage/' . $product->productAttribute->image_path) }}"
                                class="img-fluid blur-up lazyload " style="height: 150px; width: 150px;" alt="{{ $product->name }}">
                        @else
                            <img src="{{ asset('default_images/product_image.png') }}"
                                class="img-fluid blur-up lazyload " style="height: 150px; width: 150px;" alt="{{ $product->name }}">
                        @endisset
                    </a>

                    <!-- Product Details -->
                    <div class="product-detail">
                        <a href="{{ route('product.show', [$product->slug]) }}">
                            <h6>{{ $product->name }}</h6>
                        </a>

                        <!-- Ratings -->
                        <ul class="rating">
                            @for ($j = 1; $j <= 5; $j++)
                                <li>
                                    <i data-feather="star" class="{{ $j <= $product->rating ? 'fill' : '' }}"></i>
                                </li>
                            @endfor
                        </ul>

                        <!-- Price with Discount -->
                        <h5>{{ Number::currency($product->selling_price, 'INR') }}
                            @if ($product->price)
                                <del>{{ Number::currency( $product->price, 'INR') }}</del>
                            @endif
                        </h5>
                    </div>
                </div>
        </div>
        
        
    @endforeach
</div> --}}








<div class="product-box-slider-2 no-arrow">
    @foreach ($allProducts->take(5) as $product)
        <div>

            <div class="product-box product-box-bg wow fadeInUp" data-wow-delay="0.1s">
                <div class="product-image">
                    <a href="{{ route('product.show', [$product->slug]) }}" class="product-image">
                        @isset($product->productAttribute->image_path)
                            <img src="{{ asset('storage/' . $product->productAttribute->image_path) }}"
                                class="img-fluid blur-up lazyload" alt="{{ $product->name }}">
                        @else
                            <img src="{{ asset('default_images/product_image.png') }}" class="img-fluid blur-up lazyload"
                                alt="{{ $product->name }}">
                        @endisset
                    </a>

                    <ul class="product-option">
                        @foreach ([['title' => 'View', 'icon' => 'eye', 'link' => 'javascript:void(0)', 'modal' => '#view'], ['title' => 'Compare', 'icon' => 'refresh-cw', 'link' => 'compare.html'], ['title' => 'Wishlist', 'icon' => 'heart', 'link' => 'wishlist.html', 'class' => 'notifi-wishlist']] as $option)
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $option['title'] }}">
                                <a href="{{ $option['link'] }}"
                                    @if (isset($option['modal'])) data-bs-toggle="modal" data-bs-target="{{ $option['modal'] }}" @endif
                                    @if (isset($option['class'])) class="{{ $option['class'] }}" @endif>
                                    <i data-feather="{{ $option['icon'] }}"></i>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="product-detail">
                    <a href="{{ route('product.show', [$product->slug]) }}">
                        <h6 class="name">{{ $product->name }}</h6>
                    </a>

                    <h5 class="sold text-content">
                        <span class="theme-color price">{{ Number::currency($product->selling_price, 'INR') }}</span>
                        <del>{{ Number::currency($product->price, 'INR') }}</del>
                    </h5>

                    <div class="product-rating mt-2">
                        <ul class="rating">
                            @foreach (range(1, 5) as $star)
                                <li>
                                    <i data-feather="star" class="{{ $star <= $product->rating ? 'fill' : '' }}"></i>
                                </li>
                            @endforeach
                        </ul>
                        <h6 class="theme-color">In Stock</h6>
                    </div>

                    <div class="add-to-cart-box bg-white">
                        <button class="btn btn-add-cart addcart-button">
                            Add
                            <span class="add-icon bg-light-orange">
                                <i class="fa-solid fa-plus"></i>
                            </span>
                        </button>
                        <div class="cart_qty qty-box">
                            <div class="input-group">
                                <button type="button" class="qty-left-minus" data-type="minus" data-field="">
                                    <i class="fa fa-minus"></i>
                                </button>
                                <input class="form-control input-number qty-input" type="text" name="quantity"
                                    value="0">
                                <button type="button" class="qty-right-plus" data-type="plus" data-field="">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach



</div>


<div class="product-box-slider-2 no-arrow">


    @foreach ($allProducts->skip(5)->take(10) as $product)
        <div>

            <div class="product-box product-box-bg wow fadeInUp" data-wow-delay="0.1s">
                <div class="product-image">
                    <a href="{{ route('product.show', [$product->slug]) }}" class="product-image">
                        @isset($product->productAttribute->image_path)
                            <img src="{{ asset('storage/' . $product->productAttribute->image_path) }}"
                                class="img-fluid blur-up lazyload" alt="{{ $product->name }}">
                        @else
                            <img src="{{ asset('default_images/product_image.png') }}" class="img-fluid blur-up lazyload"
                                alt="{{ $product->name }}">
                        @endisset
                    </a>

                    <ul class="product-option">
                        @foreach ([['title' => 'View', 'icon' => 'eye', 'link' => 'javascript:void(0)', 'modal' => '#view'], ['title' => 'Compare', 'icon' => 'refresh-cw', 'link' => 'compare.html'], ['title' => 'Wishlist', 'icon' => 'heart', 'link' => 'wishlist.html', 'class' => 'notifi-wishlist']] as $option)
                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $option['title'] }}">
                                <a href="{{ $option['link'] }}"
                                    @if (isset($option['modal'])) data-bs-toggle="modal" data-bs-target="{{ $option['modal'] }}" @endif
                                    @if (isset($option['class'])) class="{{ $option['class'] }}" @endif>
                                    <i data-feather="{{ $option['icon'] }}"></i>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="product-detail">
                    <a href="{{ route('product.show', [$product->slug]) }}">
                        <h6 class="name">{{ $product->name }}</h6>
                    </a>

                    <h5 class="sold text-content">
                        <span class="theme-color price">{{ Number::currency($product->selling_price, 'INR') }}</span>
                        <del>{{ Number::currency($product->price, 'INR') }}</del>
                    </h5>

                    <div class="product-rating mt-2">
                        <ul class="rating">
                            @foreach (range(1, 5) as $star)
                                <li>
                                    <i data-feather="star" class="{{ $star <= $product->rating ? 'fill' : '' }}"></i>
                                </li>
                            @endforeach
                        </ul>
                        <h6 class="theme-color">In Stock</h6>
                    </div>

                    <div class="add-to-cart-box bg-white">
                        <button class="btn btn-add-cart addcart-button">
                            Add
                            <span class="add-icon bg-light-orange">
                                <i class="fa-solid fa-plus"></i>
                            </span>
                        </button>
                        <div class="cart_qty qty-box">
                            <div class="input-group">
                                <button type="button" class="qty-left-minus" data-type="minus" data-field="">
                                    <i class="fa fa-minus"></i>
                                </button>
                                <input class="form-control input-number qty-input" type="text" name="quantity"
                                    value="0">
                                <button type="button" class="qty-right-plus" data-type="plus" data-field="">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach



</div>
