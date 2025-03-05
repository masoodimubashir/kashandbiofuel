<div class="title section-t-space">
    <h2>ALL KINDS OF PRODUCTS</h2>
    {{--    <span class="title-leaf"> --}}
    {{--        <svg class="icon-width"> --}}
    {{--            <use xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#cake"></use> --}}
    {{--        </svg> --}}
    {{--    </span> --}}
</div>




<div class="product-box-slider-2 no-arrow">
    <div>
        @foreach ($allProducts->take(2) as $product)
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
        @endforeach
    </div>

    <div>
        @foreach ($allProducts->skip(2)->take(2) as $product)
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
        @endforeach
    </div>


</div>
