<?php

namespace App\Enum;


/**
 * Represents the possible positions for a banner on the website.
 */

 enum BannerPosition: string
{
    case HEADER = 'header';
    case SLIDER = 'slider';
    case FEATURED = 'featured';
    case PROMOTION = 'promotion';
    case FOOTER = 'footer';
}