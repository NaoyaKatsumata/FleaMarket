<?php

namespace App\View\Components\views\layouts;

use Illuminate\View\Component;

class heder.blade.php extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.views.layouts.heder.blade.php');
    }
}
