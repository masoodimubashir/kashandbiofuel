<?php

namespace App\View\Components;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Navigation extends Component
{

    public $navigation;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->navigation = Category::with(['subCategories' => function ($query) {
            $query->where([
                'status' => 1,
                'show_on_navbar' => 1
            ]);
        }])
            ->where([
                'status' => 1,
                'show_on_navbar' => 1
            ])
            ->orderBy('name')
            ->take(5)
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navigation');
    }
}
