<?php

namespace App\View\Components;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class CategoryNav extends Component
{
    public $categories;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // Get categories from cache, otherwise query the database
        // and store it in cache for 1 hour
        $data = Cache::remember('nav_categories', now()->addHours(1), function () {
            return Category::select('id', 'name', 'slug')
                // Order categories by name
                ->orderBy('name', 'ASC')
                // Get the categories
                ->get();
        });

        // Split categories into 3 equal chunks
        $this->categories = $data->chunk(ceil($data->count() / 3));
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.category-nav');
    }
}
