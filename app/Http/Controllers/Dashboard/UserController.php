<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('page.dashboard.user.index', [
            'users' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('page.dashboard.user.create', [
            'roles' => Role::all()->pluck('name', 'id')->toArray()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'role' => 'required',
        ]);
        
        $role_code = Role::where('id', $request->role)->first()->code;
        $role_last_code = User::latest()->where('role_id', $request->role)->first()?->code;
        $user_code = $role_code . sprintf('%03d', (int) substr($role_last_code, 2) + 1);
        
        User::create([
            'role_id' => (int) $request->role,
            'code' => $user_code,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'age' => $request->age,
            'phone' => $request->phone,
            'avatar' => $request->avatar
        ]);
        
        return redirect()->route('dashboard.user.index')->with('success', 'Successfuly add user');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('page.dashboard.user.show', [
           'user' => $user 
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('page.dashboard.user.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'required',
            'email' => 'required|email|unique:users,email,'. $user->id
        ]);
                       
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'address' => $request->address,
            'age' => $request->age,
            'phone' => $request->phone,
        ]);
        
        return redirect()->route('dashboard.user.index')->with('success', 'Successfuly update user');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->transaksis()->delete();
        $user->delete();
        
        return redirect()->route('dashboard.user.index')->with('success', 'Successfuly delete user');
    }
}
