<div>
    <div class="row">
        <div class="col-12">
            <div class="top-selling-box">
                <div class="top-selling-title">
                    <h3>New Arrivals</h3>
                </div>

                @foreach($new_arrivals as $new_arrival)
                    <div class="top-selling-contain wow fadeInUp " @if(!$loop->first) data-wow-delay="0.4s" @endif>
                        <a href="{{route('product.show', $new_arrival->slug)}}" class="top-selling-image">
                            <img src="{{asset('storage/' . $new_arrival->productAttributes->first()->image_path)}}"
                                 class="img-fluid blur-up lazyload" alt="">
                        </a>

                        <div class="top-selling-detail">
                            <a href="{{route('product.show', $new_arrival->slug)}}">
                                <h5>{{$new_arrival->name}}</h5>
                            </a>
                            <div class="product-rating">
                                <ul class="rating">
                                    @for($i = 1; $i <= $new_arrival->rating; $i++)
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                    @endfor
                                </ul>
                                <span>review count here</span>
                            </div>
                            <h6>{{Number::currency($new_arrival->selling_price, 'INR')}}</h6>
                        </div>
                    </div>

                @endforeach

            </div>
        </div>
    </div>
</div>
