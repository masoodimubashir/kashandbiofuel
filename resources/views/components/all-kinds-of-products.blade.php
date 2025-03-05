<div class="title section-t-space">
    <h2>ALL KINDS OF PRODUCTS</h2>
   
</div>






<div class="product-box-slider-2 no-arrow">
    @for ($section = 0; $section < 5; $section++)
        <div>
            @foreach (range(1, 2) as $item)
                @php
                    $productIndex = ($section * 2) + $item;
                    $product = $allProducts[$productIndex - 1] ?? null;
                @endphp
                
                @if($product)
                <div class="product-box product-box-bg wow fadeInUp" @if($item == 2) data-wow-delay="0.1s" @endif>
                    <div class="product-image">
                        <a href="{{ route('product.show', [$product->slug]) }}" class="product-image">
                            @isset($product->productAttribute->image_path)
                                <img src="{{ asset('storage/' . $product->productAttribute->image_path) }}"
                                    class="img-fluid blur-up lazyload" style="height: 200px; width: 200px;" alt="{{ $product->name }}">
                            @else
                                <img src="{{ asset('default_images/product_image.png') }}"
                                    class="img-fluid blur-up lazyload" alt="{{ $product->name }}">
                            @endisset
                        </a>
                        
                    
                    </div>

                    <div class="product-detail">
                        <a href="{{ route('product.show', [$product->slug]) }}">
                            <h6 class="name">{{ $product->name }}</h6>
                        </a>

                        <h5 class="sold text-content">
                            <span class="theme-color price">{{ Number::currency($product->selling_price, 'INR') }}</span>
                            @if($product->price)
                                <del>{{ Number::currency($product->price, 'INR') }}</del>
                            @endif
                        </h5>

                        <div class="product-rating mt-2">
                            <ul class="rating">
                                @for($star = 1; $star <= 5; $star++)
                                    <li>
                                        <i data-feather="star" class="{{ $star <= $product->rating ? 'fill' : '' }}"></i>
                                    </li>
                                @endfor
                            </ul>
                            <h6 class="theme-color">In Stock</h6>
                        </div>

                      
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    @endfor
</div>

