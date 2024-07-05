<?php

namespace App\Livewire\Input;

use Livewire\Component;

class Editor extends Component
{
    public $id;
    public $name;
    public $value;
    public $texteditor;
    
    public function render()
    {
        return view('livewire.input.editor', [
            'id' => $this->id,
            'name' => $this->name,
            'value' => $this->value
        ]);
    }
}
