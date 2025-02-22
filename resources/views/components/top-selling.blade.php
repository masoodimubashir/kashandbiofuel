<div>



    <div class="row">
        <div class="col-12">
            <div class="top-selling-box">
                <div class="top-selling-title">
                    <h3>Latest Products</h3>
                </div>

                @foreach ($topSellingProducts as $product)
                    <div class="top-selling-contain wow fadeInUp">

                        @isset($product->productAttribute->image_path)
                            <a href="product-left-thumbnail.html" class="top-selling-image">
                                <img src="{{ asset('storage/' . $product->productAttribute->image_path) }}" class="img-fluid blur-up lazyload"
                                    alt="">
                            </a>
                        @else
                            <a href="product-left-thumbnail.html" class="top-selling-image">
                                <img src="{{ asset('default_images/product_image.png') }}" class="img-fluid blur-up lazyload"
                                    alt="">
                            </a>
                        @endisset

                        <div class="top-selling-detail">
                            <a href="product-left-thumbnail.html">
                                <h5>{{ $product->name }}</h5>

                            </a>
                            <div class="product-rating">
                                <ul class="rating">
                                    @for ($j = 1; $j <= 5; $j++)
                                        <li>
                                            <i data-feather="star"
                                                class="{{ $j <= $product->rating ? 'fill' : '' }}"></i>
                                        </li>
                                    @endfor
                                </ul>
                                <span>{{ $product->reviews_count }}</span>
                            </div>
                            <h6>{{ Number::currency($product->selling_price) }}</h6>
                        </div>
                    </div>
                @endforeach



            </div>
        </div>
    </div>
</div>
