<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    public function index(): View
    {
        return view('page.auth.login');
    }
    
    public function post(Request $request): RedirectResponse
    {
        $request->validate([
           'username' => 'required|email',
           'password' => 'required' 
        ]);
        
        if (Auth::attempt(['email' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
            
            return redirect()->intended(route('dashboard.index'));
        }
        
        return redirect()->back()->with('error', 'Username or Password is Invalid');
    }
}
