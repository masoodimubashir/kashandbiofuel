<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LimitTimeOffer extends Component
{
    public function render(): View
    {
        return view('components.limit-time-offer');
    }
}
