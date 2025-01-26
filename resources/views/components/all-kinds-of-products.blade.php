<div class="title section-t-space">
    <h2>ALL KINDS OF Products</h2>
    <span class="title-leaf">
            <svg class="icon-width">
                 <use xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#cake">
                 </use>
            </svg>
    </span>
</div>


<div class="slider-3_2 product-wrapper">
    @foreach($allProducts as $product)
        <div>
            <div class="product-box-2 wow fadeIn" data-wow-delay="{{ $loop->iteration * 0.1 . 's' }}">
                <a href="{{ route('product.show', [$product->slug]) }}" class="product-image">
                    <img src="{{ asset('storage/' . $product->productAttributes()->first()->image_path) }}"
                         class="img-fluid blur-up lazyload" alt="{{ $product->name }}">
                </a>

                <div class="product-detail">
                    <a href="{{ route('product.show', [$product->slug]) }}">
                        <h6>{{ $product->name }}</h6>
                    </a>
                    <ul class="rating">
                        @for ($i = 1; $i <= 5; $i++)
                            <li>
                                <i data-feather="star" class="{{ $i <= $product->rating ? 'fill' : '' }}"></i>
                            </li>
                        @endfor
                    </ul>
                    <h5>${{ $product->selling_price }}
                        @if($product->price)
                            <del>${{ $product->price }}</del>
                        @endif
                    </h5>
                </div>
            </div>
        </div>
    @endforeach
</div>
