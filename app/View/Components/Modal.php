<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Modal extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $trigger = false,
        public $label = 'Modal',
        public $close = false,
        public $class = false
    )
    {
        $this->trigger = $trigger;
        $this->label = $label;
        $this->close = $close;
        $this->class = $class ? ' '. $class : false;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal');
    }
}
