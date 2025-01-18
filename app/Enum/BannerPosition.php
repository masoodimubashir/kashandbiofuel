<?php

namespace App\Enum;


enum BannerPosition: string
{
    case HEADER = 'header';
    case SLIDER = 'slider';
    case FEATURED = 'featured';
    case PROMOTION = 'promotion';
    case FOOTER = 'footer';
}