<?php

namespace App\View\Components;

use App\Action\ProductAction;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AllKindsOfProducts extends Component
{

    use ProductAction;

    public $allProducts;

    public function __construct()
    {
        $this->allProducts = $this->getProducts();

    }

    public function render(): View
    {
        return view('components.all-kinds-of-products');
    }
}
