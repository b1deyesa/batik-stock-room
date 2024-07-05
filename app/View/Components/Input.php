<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $label = false,
        public $type = 'text',
        public $wire = false,
        public $live = false,
        public $name = false,
        public $id = false,
        public $rows = false,
        public $placeholder = false,
        public $value = false,
        public $autofocus = false,
        public $disabled = false,
        public $required = false,
        public $options = []
    )
    {
        $this->label = $label;
        $this->type = $type;
        $this->wire = $wire;
        $this->live = $live;
        
        $this->name = $name ? $name : $this->type;
        $this->name = $this->wire ? $this->wire : $this->name;
        $this->name = $this->live ? $this->live : $this->name;
        
        $this->id = $id ? $id : $this->name;
        $this->rows = $rows;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->autofocus = $autofocus;
        $this->disabled = $disabled;
        $this->required = $required;
        $this->options = $options;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input');
    }
}
