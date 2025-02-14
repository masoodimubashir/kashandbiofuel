<?php

namespace App\View\Components;

use App\Service\NavigationService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class footer extends Component
{

    public $navigation;

    public function __construct(NavigationService $navigationService)
    {
        $this->navigation = $navigationService->getAllNavigationItems();
    }

    public function render(): View
    {
        return view('components.footer');
    }
}
