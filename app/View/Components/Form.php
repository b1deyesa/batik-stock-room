<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Form extends Component
{
    public $method_type = false;
    
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $class = false,
        public $id = false,
        public $wire = false,
        public $action = false,
        public $method = 'GET',
        public $enctype = false,
    )
    {
        $this->class = $class ? ' '. $class : false;
        $this->id = $id;
        $this->wire = $wire;
        $this->action = $action;
        $this->method = $method;
        $this->enctype = $enctype;
        
        if ($this->method == 'PUT') {
            $this->method = 'POST';
            $this->method_type = 'PUT';
        } elseif ($this->method == 'DELETE') {
            $this->method = 'POST';
            $this->method_type = 'DELETE';
        }
    }
    
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form');
    }
}
