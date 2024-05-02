<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Navigation extends Component
{
    public $menu = [];

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->menu = [
            ['name' => 'Earth', 'url' => '/earth_states'],
            ['name' => 'Exoplanets', 'url' => '/exoplanets'],
            ['name' => 'Predictors', 'url' => '/predictors'],
            ['name' => 'Experiments', 'url' => '/experiments'],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navigation');
    }
}
