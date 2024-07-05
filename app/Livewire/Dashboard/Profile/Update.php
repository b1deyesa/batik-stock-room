<?php

namespace App\Livewire\Dashboard\Profile;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Update extends Component
{
    public User $user;
    
    public $first_name;
    public $last_name;
    public $email;
    public $age;
    public $phone;
    public $address;
    
    public function mount()
    {
        $this->user = Auth::user();
        
        $this->first_name = $this->user->first_name;
        $this->last_name = $this->user->last_name;
        $this->email = $this->user->email;
        $this->age = $this->user->age;
        $this->phone = $this->user->phone;
        $this->address = $this->user->address;
    }
    
    public function save()
    {
        $this->user->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'age' => $this->age,
            'phone' => $this->phone,
            'address' => $this->address
        ]);
        
        return redirect()->route('dashboard.profile.index')->with('success', 'Successfuly update profile');
    }
    
    public function render()
    {
        return view('livewire.dashboard.profile.update');
    }
}
