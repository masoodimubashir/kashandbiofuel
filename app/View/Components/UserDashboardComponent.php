<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UserDashboardComponent extends Component
{

    public int $cancelled_count;
    public int $delivered_count;
    public int $confirmed_count;
    public int $shipped_count;
    public int $pending_count;


    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $user = auth()->user();

        $this->cancelled_count = $user->orders()->where('is_cancelled', true)->count();
        $this->delivered_count = $user->orders()->where('is_delivered', true)->count();
        $this->confirmed_count = $user->orders()->where('is_confirmed', true)->count();
        $this->shipped_count = $user->orders()->where('is_shipped', true)->count();
        $this->pending_count = $user->orders()->where('is_pending', true)->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user-dashboard-component');
    }
}
