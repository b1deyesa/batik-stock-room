<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisterController extends Controller
{
    public function index(): View
    {
        return view('page.auth.register', [
            'roles' => Role::all()->pluck('name', 'id')->toArray()
        ]);
    }
    
    public function post(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'role' => 'required'
        ]);
        
        $role_code = Role::where('id', $request->role)->first()->code;
        $role_last_code = User::latest()->where('role_id', $request->role)->first()?->code;
        $user_code = $role_code . sprintf('%03d', (int) substr($role_last_code, 2) + 1);
        
        User::create([
            'role_id' => $request->role,
            'code' => $user_code,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        
        return redirect()->route('auth.login.index')->with('success', 'Successfuly create account');
    }
}
