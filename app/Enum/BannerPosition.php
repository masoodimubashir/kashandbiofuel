<?php

namespace App\Enum;


/**
 * Represents the possible positions for a banner on the website.
 */
enum BannerPosition: string
{

//    Hero Banner
    case HEADER = 'hero-1';

//    Hero Banner 2
    case SLIDER = 'hero-2';

//
    case FEATURED = 'featured';


//    These Banners Are Shown Under Shop By Category
    case SLIDER_BANNER_1 = 'slider-1';

    case SLIDER_BANNER_2 = 'slider-2';

    case SLIDER_BANNER_3 = 'slider-3';

    case SLIDER_BANNER_4 = 'slider-4';

}
