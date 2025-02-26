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
                            <a href={{ route('product.show', $product->slug) }} class="top-selling-image">
                                <img src="{{ asset('storage/' . $product->productAttribute->image_path) }}"
                                    class="img-fluid blur-up lazyload" alt="{{ $product->image_alt }}">
                            </a>
                        @else
                            <a href={{ route('product.show', $product->slug) }} class="top-selling-image">
                                <img src="{{ asset('default_images/product_image.png') }}"
                                    class="img-fluid blur-up lazyload" alt="{{ $product->image_alt }}">
                            </a>
                        @endisset

                        <div class="top-selling-detail">
                            <a href="{{ route('product.show', $product->slug) }}">
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
                            <h6>{{ Number::currency($product->selling_price, 'INR') }}</h6>
                        </div>
                    </div>
                @endforeach



            </div>
        </div>
    </div>
</div>
