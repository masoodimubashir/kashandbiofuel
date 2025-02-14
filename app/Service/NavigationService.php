<?php

namespace App\Service;

use App\Models\Category;

class NavigationService
{

    private $navigation;

    public function __construct()
    {
        $this->navigation = $this->getNavigation();
    }

    /**
     * Get the navigation categories
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getNavigation()
    {
        return Category::with(['subCategories' => function ($query) {
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
     * Get all navigation items
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllNavigationItems()
    {
        return $this->navigation;
    }

   
}
