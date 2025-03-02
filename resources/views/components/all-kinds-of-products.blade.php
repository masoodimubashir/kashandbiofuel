<div class="title section-t-space">
    <h2>ALL KINDS OF PRODUCTS</h2>
    {{--    <span class="title-leaf"> --}}
    {{--        <svg class="icon-width"> --}}
    {{--            <use xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#cake"></use> --}}
    {{--        </svg> --}}
    {{--    </span> --}}
</div>

<div class="slider-3_1 product-wrapper">
    @foreach ($allProducts->take(3) as $product)
        <div>
                <div class="product-box-2 wow fadeIn" data-wow-delay="{{ $loop->index * 0.1 . 's' }}">
                    <!-- Product Image -->


                    <a href="{{ route('product.show', [$product->slug]) }}" class="product-image">
                        @isset($product->productAttribute->image)
                            <img src="{{ asset('storage/' . $product->productAttribute->image) }}"
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
</div>

<div class="slider-3_2 product-wrapper mt-3">
    @foreach ($allProducts->skip(3)->take(3) as $product)
        <div>

                <div class="product-box-2 wow fadeIn" data-wow-delay="{{ $loop->index * 0.1 . 's' }}">
                    <!-- Product Image -->


                    <a href="{{ route('product.show', [$product->slug]) }}" class="product-image">
                        @isset($product->productAttribute->image)
                            <img src="{{ asset('storage/' . $product->productAttribute->image) }}"
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
</div>
