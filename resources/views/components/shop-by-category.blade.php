<div class="container-fluid-lg">

    <style>
        .gradient-bg {
            background: linear-gradient(to right, #80a81b, #770a0f, #fff);
            color: white; /* Ensure text is visible */
            padding: 20px;
            text-align: center;
        }

        /* Gradient Text */
        .gradient-text {
            background: linear-gradient(to right, #80a81b, #770a0f, #fff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 2rem;
            font-weight: bold;
        }
    </style>

    <div class="title ">
        <h2 style="color: #1A1A19">Shop By Categories</h2>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="category-slider arrow-slider">
                @foreach($categories as $category)

                    <div>
                        <div class="shop-category-box border-0 wow fadeIn"
                             @if(!$loop->first)data-wow-delay="0.35s" @endif>
                            <a href="{{route('category.index')}}" class="circle-1">
                                <img src="{{asset('front/assets/images/veg-3/category/1.png')}}"
                                     class="img-fluid blur-up lazyload"
                                     alt="">
                            </a>
                            <div class="category-name">
                                <h6>{{$category->name}}</h6>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>


</div>
