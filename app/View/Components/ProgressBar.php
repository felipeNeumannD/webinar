<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProgressBar extends Component
{

    public $percentage;
    public $min_percentage;
    public $color;

    /**
     * Create a new component instance.
     */
    public function __construct($percentage = 0, $min_percentage = 60)
    {
        $this->percentage = $percentage;
        $this->min_percentage = $min_percentage;

        $this->renderColor();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.progress-bar');
    }

    public function renderColor(){
       $this->color =  ( $this->min_percentage < $this->percentage ) ? "bg-success" : ($this->min_percentage > $this->percentage)? "bg-danger" : "grey";
    }
}
