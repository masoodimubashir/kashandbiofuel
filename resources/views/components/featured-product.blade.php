<div>
    <div class="row">
        <div class="col-12">
            <div class="top-selling-box">
                <div class="top-selling-title">
                    <h3>Featured Product</h3>
                </div>


                @foreach ($featuredProduct as $product)
                    <div class="top-selling-contain wow fadeInUp" data-wow-delay="0.4s">
                      
                        @isset($product->productAttribute->image_path)
                        <a href={{ route('product.show', $product->slug) }} class="top-selling-image">
                            <img src="{{ asset('storage/' . $product->productAttribute->image_path) }}"
                                class="img-fluid blur-up lazyload" alt="{{ $product->image_alt }}">
                                <img src="{{ asset('storage/' . $product->productAttribute->image_path) }}" alt="">
                        </a>
                    @else
                        <a href={{ route('product.show', $product->slug) }} class="top-selling-image">
                            <img src="{{ asset('default_images/product_image.png') }}"
                                class="img-fluid blur-up lazyload" alt="{{ $product->image_alt }}">
                        </a>
                    @endisset

                        <div class="top-selling-detail">
                            <a href={{ route('product.show', $product->slug) }}>
                                <h5>
                                    {{ $product->name }}
                                </h5>
                            </a>
                            <div class="product-rating">
                                <ul class="rating">
                                    @php
                                        $rating = $product->reviews_avg_rating;
                                    @endphp

                                    @for ($i = 1; $i <= 5; $i++)
                                        <li>
                                            <i data-feather="star" class="{{ $i <= $rating ? 'fill' : '' }}"></i>
                                        </li>
                                    @endfor
                                </ul>
                                <span>(
                                    {{ $product->reviews_count }}

                                    )</span>
                            </div>
                            <h6>{{ Number::currency($product->selling_price, 'INR') }}</h6>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>
</div>
