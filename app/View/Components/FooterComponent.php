<?php

namespace App\View\Components;

use App\Service\NavigationService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FooterComponent extends Component
{

    public $navigations;

    /**
     * Create a new component instance.
     */
    public function __construct(NavigationService $navigationService)
    {
        $this->navigations = $navigationService->getAllNavigationItems();

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.footer-component');
    }
}
