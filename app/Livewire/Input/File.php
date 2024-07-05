<?php

namespace App\Livewire\Input;

use Livewire\Component;
use Livewire\WithFileUploads;

class File extends Component
{
    use WithFileUploads;
    
    public $id;
    public $name;
    public $value;
    public $file;
    
    public $showTool;
    public $showRename;
    public $new_name;
    
    public function mount()
    {
        $this->value = json_decode(old($this->name, $this->value) ?? "", true);
        $this->new_name = $this->value['name'] ?? null;
    }
    
    public function updatedFile()
    {
        $this->validate([
           'file' => 'max:100000' 
        ]);
        
        $this->value = [
            'name' => pathinfo($this->file->getClientOriginalName(), PATHINFO_FILENAME),
            'extension' => pathinfo($this->file->getClientOriginalName(), PATHINFO_EXTENSION),
            'filename' => $this->file->getFilename(),
        ];
        
        $this->file->storeAs('public', $this->value['filename']);
        $this->new_name = $this->value['name'];
    }
    
    public function rename()
    {   
        $this->value['name'] = trim($this->new_name) !== "" ? $this->new_name : $this->value['name'];
        $this->new_name = $this->value['name'];
        $this->showTool = false;
        $this->showRename = false;
    }
    
    public function download()
    {
        return response()->download(storage_path('app/public/'. $this->value['filename']), $this->value['name'] .'.'. $this->value['extension']);
        $this->showTool = false;
    }
    
    public function delete()
    {
        $this->value = [];
        $this->showTool = false;
    }
    
    public function render()
    {   
        return view('livewire.input.file', [
            'id' => $this->id,
            'name' => $this->name,
            'value' => $this->value
        ]);
    }
}
