<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UserDashboardComponent extends Component
{

    public int $order_count;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $user = auth()->user();

        $this->order_count = $user->orders()->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user-dashboard-component');
    }
}
