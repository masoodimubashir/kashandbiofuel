<div>
    <div class="row">
        <div class="col-12">
            <div class="top-selling-box">
                <div class="top-selling-title">
                    <h3>New Arrival</h3>
                </div>

                @foreach ($new_arrivals as $product)
                    <div class="top-selling-contain wow fadeInUp" data-wow-delay="0.4s">
                        <a href={{ route('product.show', $product->slug) }} class="top-selling-image">
                            <img src="{{ asset('storage/' . $product->productAttribute->image_path ?? null) }}"
                                 class="img-fluid blur-up lazyload" alt="{{ $product->name }}">
                        </a>

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
