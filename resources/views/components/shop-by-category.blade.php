<div class="container-fluid-lg">

    <style>
        .gradient-bg {
            background: linear-gradient(to right, #80a81b, #770a0f, #fff);
            color: white;
            /* Ensure text is visible */
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
                @foreach ($categories as $category)
                    <div>
                        <div class="shop-category-box border-0 wow fadeIn"
                            @if (!$loop->first) data-wow-delay="0.35s" @endif>
                            <a href="{{ route('category.index') }}" class="circle-1">

                                @isset($category->image_path)
                                    <img src="{{ asset('storage/' . $category->image_path) }}"
                                        class="img-fluid blur-up lazyload" alt="" style="width: 110px; height: 110px;">
                                @else
                                    <img src="{{ asset('default_images/product_image.png') }}"
                                        class="img-fluid blur-up lazyload" alt="" style="width: 110px; height: 110px;">
                                @endisset


                      
                        </a>
                        <div class="category-name">
                            <h6>{{ $category->name }}</h6>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="category-slider arrow-slider">


            <div>
                <div class="shop-category-box border-0 wow fadeIn">

                </div>
            </div>



        </div>
    </div>
</div>


</div>
