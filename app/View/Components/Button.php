<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $type = 'button',
        public $href = false,
        public $target = '_self',
        public $id = false,
        public $wire = false,
        public $class = false,
        public $disabled = false
    )
    {
        $this->type = $type;
        $this->href = $href;
        $this->target = $target;
        $this->id = $id;
        $this->wire = $wire;
        $this->class = $class ? ' '. $class : false;
        $this->disabled = $disabled;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button');
    }
}
