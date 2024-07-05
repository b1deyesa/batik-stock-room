<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('page.dashboard.profile.index');
    }
    
    public function gantiPassword()
    {
        return view('page.dashboard.profile.ganti-password');
    }
    
    public function gantiPasswordPost(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);
        
        if (Hash::check($request->old_password, Auth::user()->password)) {
            Auth::user()->update([
                'password' => Hash::make($request->password)
            ]);
            
            return redirect()->route('dashboard.profile.index')->with('success', 'Successfuly change password');
        }
        
        return redirect()->route('dashboard.profile.ganti-password')->with('error', 'Old password is wrong');
    }
}
