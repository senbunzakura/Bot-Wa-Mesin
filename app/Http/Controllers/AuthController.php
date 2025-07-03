<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
     public function index(){
        return view('login');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|string|max:50',
            'password' => 'required|string|max:50',
        ], [
            'email.required' => 'email wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);
    
        $credentials = $request->only('email', 'password');
    
        if (Auth::guard('user')->attempt($credentials)) {
            $user = Auth::guard('user')->user();
    
            if ($user->role === "kepala_bagian" || $user->role === "admin" || $user->role === "mekanik") {
                // var_dump($user);
                return redirect('/dashboard')->with('status', 'Berhasil Login');
            }else {
                Auth::guard('user')->logout();
                return redirect('/')->withErrors(['role' => 'Role tidak valid'])->withInput();
            }
        } else {
            return redirect('/')->withErrors(['auth' => 'email atau Password Salah'])->withInput();
        }
    }

    public function logout(){
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    }
}
