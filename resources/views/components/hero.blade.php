<div class="row g-4">
    <div class="col-xl-9 col-lg-8">
        <div class="">
            @php
                $banner = App\Models\Banner::where('position', App\Enum\BannerPosition::HEADER->value)->first();
            @endphp

            @if ($banner && $banner->image_path)
                <img src="{{ asset('storage/' . $banner->image_path) }}" class="img-fluid blur-up lazyload w-100"
                    style="height: 500px; object-fit: conatin;" alt="{{ $banner->title ?? 'Header Banner' }}">
            @endif
        </div>
    </div>

    <div class="col-xl-3 col-lg-4 d-lg-inline-block d-none ratio_156">
        <div class="home-contain h-100">
          @php
            $banner = App\Models\Banner::where('position', App\Enum\BannerPosition::SLIDER->value)->first();
          @endphp
          
          @if ($banner && $banner->image_path)
            <img 
              src="{{ asset('storage/' . $banner->image_path) }}"
              class="img-fluid blur-up lazyload w-100"
              style="height: 500px; object-fit: contain;"
              alt="{{ $banner->title ?? 'Slider Banner' }}"
            >
          @endif
        </div>
      </div>
</div>
