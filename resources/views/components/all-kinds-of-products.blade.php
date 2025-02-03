<div class="title section-t-space">
    <h2>ALL KINDS OF PRODUCTS</h2>
    <span class="title-leaf">
        <svg class="icon-width">
            <use xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#cake"></use>
        </svg>
    </span>
</div>

<div class="slider-3_2 product-wrapper">
    @foreach($allProducts as $product)
        <div>
            @for($i = 0; $i < 1; $i++)
                <div class="product-box-2 wow fadeIn" data-wow-delay="{{ ($loop->index * 0.1) . 's' }}">
                    <!-- Product Image -->
                    <a href="{{ route('product.show', [$product->slug]) }}" class="product-image">
                        <img
                            src="{{ asset('storage/' . ($product->productAttributes->first()?->image_path ?? 'default-product.jpg')) }}"
                            class="img-fluid blur-up lazyload"
                            alt="{{ $product->name }}">
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
                        <h5>${{ $product->selling_price }}
                            @if($product->price)
                                <del>${{ $product->price }}</del>
                            @endif
                        </h5>
                    </div>
                </div>
            @endfor
        </div>
    @endforeach
</div>
