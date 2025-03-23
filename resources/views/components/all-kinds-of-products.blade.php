<div class="title section-t-space">
    <h2>ALL KINDS OF PRODUCTS</h2>

</div>



<div class="product-box-slider-2 no-arrow">
    @foreach ($allProducts->take(5) as $product)
        <div>

            <div class="product-box product-box-bg wow fadeInUp" data-wow-delay="0.1s">
                <div class="product-image mb-2">
                    <a href="{{ route('product.show', [$product->slug]) }}" class="product-image">
                        @isset($product->productAttribute->image)
                            <img src="{{ asset('storage/' . $product->productAttribute->image) }}"
                                class="img-fluid blur-up lazyload" style="width: 300px; height: 300px; object-fit: cover;"
                                alt="{{ $product->name }}">
                        @else
                            <img src="{{ asset('default_images/product_image.png') }}" class="img-fluid blur-up lazyload"
                                style="width: 300px; height: 300px; object-fit: cover;" alt="{{ $product->name }}">
                        @endisset
                    </a>

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
                    </div>


                </div>
            </div>
        </div>
    @endforeach

</div>


<div class="product-box-slider-2 no-arrow mt-4">
    @foreach ($allProducts->skip(5)->take(5) as $product)
        <div>

            <div class="product-box product-box-bg wow fadeInUp" data-wow-delay="0.1s">
                <div class="product-image mb-2">
                    <a href="{{ route('product.show', [$product->slug]) }}" class="product-image">
                        @isset($product->productAttribute->image)
                            <img src="{{ asset('storage/' . $product->productAttribute->image) }}"
                                class="img-fluid blur-up lazyload" style="width: 300px; height: 300px; object-fit: cover;"
                                alt="{{ $product->name }}">
                        @else
                            <img src="{{ asset('default_images/product_image.png') }}" class="img-fluid blur-up lazyload"
                                style="width: 300px; height: 300px; object-fit: cover;" alt="{{ $product->name }}">
                        @endisset
                    </a>

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
                    </div>


                </div>
            </div>
        </div>
    @endforeach
</div>
