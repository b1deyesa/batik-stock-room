<?php

namespace App\Livewire\Input;

use Livewire\Component;
use Livewire\WithFileUploads;

class MultipleFile extends Component
{
    use WithFileUploads;
    
    public $id;
    public $name;
    public $value;
    public $files = [];
    
    public $new_name = [];
    public $showTool = [];
    public $showRename = [];
    
    public function mount()
    {
        if (old($this->name, $this->value)) {
            $values = json_decode(old($this->name, $this->value) ?? "", true);
            $this->value = [];
            foreach ($values as $item) {
                $this->value[] = [
                    'name' => $item['name'],
                    'extension' => $item['extension'],
                    'filename' => $item['filename']
                ];
                
                $this->new_name[] = $item['name'];
                $this->showTool[] = false;
                $this->showRename[] = false;
            }
        }
    }
    
    public function updatedFiles()
    {
        $this->validate([
            'files.*' => 'max:100000' 
        ], [
            'files.*.max' => 'The files field must not be greater than :max kilobytes.'
        ]);

        foreach ($this->files as $file) {
            $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            $filename = $file->getFilename();
            
            $this->value[] = [
                'name' => $name,
                'extension' => $extension,
                'filename' => $filename
            ];
            
            $file->storeAs('public', $filename);
            
            $this->new_name[] = $name;
            $this->showTool[] = false;
            $this->showRename[] = false;
        }
    } 
    
    public function rename($index)
    {
        $this->value[$index]['name'] = trim($this->new_name[$index]) !== "" ? $this->new_name[$index] : $this->value[$index]['name'];
        $this->new_name[$index] = $this->value[$index]['name'];
        $this->showTool[$index] = false;
        $this->showRename[$index] = false;
    }
    
    public function download($index)
    {
        return response()->download(storage_path('app/public/'. $this->value[$index]['filename']), $this->value[$index]['name'] .'.'. $this->value[$index]['extension']);
        $this->showTool[$index] = false;
    }
    
    public function delete($index)
    {
        unset($this->value[$index]);
        $this->showTool[$index] = false;
    }
    
    public function render()
    {
        return view('livewire.input.multiple-file', [
            'id' => $this->id,
            'name' => $this->name,
            'value' => $this->value
        ]);
    }
}
