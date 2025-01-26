<?php

namespace App\View\Components;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ShopByCategory extends Component
{

    public $categories;

    public function __construct()
    {
        $this->categories = Category::query()
            ->where([
                'status' => 1,
            ])
            ->orderBy('name')
            ->get();
    }

    public function render(): View
    {
        return view('components.shop-by-category');
    }
}
