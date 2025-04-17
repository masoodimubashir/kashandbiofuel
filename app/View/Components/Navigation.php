<?php

namespace App\View\Components;

use App\Models\Category;
use App\Service\NavigationService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Navigation extends Component
{

    public $navigation;

    public $subCategories;

    /**
     * Create a new component instance.
     */
    public function __construct(NavigationService $navigationService)
    {
        $this->navigation = $navigationService->getAllNavigationItems();

        $this->subCategories = $navigationService->getAllSubCategories();

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navigation');
    }
}
