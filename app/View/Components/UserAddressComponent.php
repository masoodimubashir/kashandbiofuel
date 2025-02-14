<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UserAddressComponent extends Component
{


    public $address;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        
        $user = auth()->user();

        $this->address = $user->address;


    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user-address-component');
    }
}
