<div class="dashboard-order">
    <div class="title">
        <h2>My Current Orders</h2>
        <span class="title-leaf title-leaf-gray">
            <svg class="icon-width bg-gray">
                <use xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf">
                </use>
            </svg>
        </span>
    </div>

    <div class="order-contain">

        @if (count($orderedItems) > 0)
            @foreach ($orderedItems as $ordered_item)
                <div class="order-box dashboard-bg-box">
                    <div class="order-container">
                        <div class="order-icon">
                            <i data-feather="box"></i>
                        </div>

                        <div class="order-detail">
                            <h4>Delivers <span>{{ $ordered_item->order->status }}</span></h4>
                        </div>
                    </div>

                    <div class="product-order-detail">
                        <a href="{{ route('product.show', ['slug' => $ordered_item->product->slug]) }}" class="order-image">
                            @isset($ordered_item->product->productAttribute->image_path)
                                <img src="{{ asset('storage/' . $ordered_item->product->productAttribute->image_path) }}"
                                    class="img-fluid blur-up lazyload" alt="{{ $ordered_item->product->name }}">
                            @else
                                <img src="{{ asset('default_images/product_image.png') }}"
                                    class="img-fluid blur-up lazyload" alt="{{ $ordered_item->product->name }}">
                            @endisset
                        </a>

                        <div class="order-wrap">
                            <a href="{{ route('product.show', ['slug' => $ordered_item->product->slug]) }}">
                                <h3>{{ $ordered_item->product->name }}</h3>
                            </a>
                            <p class="text-content">
                                {{ $ordered_item->product->short_description }}
                            </p>
                            <ul class="product-size">
                                <li>
                                    <div class="size-box">
                                        <h6 class="text-content">Price : </h6>
                                        <h5>{{ $ordered_item->price }}</h5>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="order-box dashboard-bg-box">

                No Items Found

            </div>
        @endif

    </div>
</div>
