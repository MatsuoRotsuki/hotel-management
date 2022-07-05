<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Rate extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $rate;
    public function __construct($rate)
    {
        $this->rate = $rate;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.rate');
    }
}
