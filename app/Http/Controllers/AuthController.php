<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{

    public function register()
    {
        return view('auth.register');
    }
    public function registerPost(Request $request)
    {
        // $user = new User();
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->password = Hash::make($request->password);
        // $user->save();
        // return back()->with('success', 'Register successfully');
        // Validasi data
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        // Buat objek User
        $user = new User();

        // Isi properti user
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        // Simpan user ke database
        $user->save();

        // Redirect dengan pesan sukses
        return redirect()->route('login')->with('success', 'Register successfully');
    }
    public function login()
    {
        return view('auth.login');
    }

    public function loginProses(Request $request): RedirectResponse
    {
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ],[
            'email.required'=>'Email wajib diisi',
            'password.required'=>'Password wajib diisi',
        ]);

        $infologin = [
            'email'=>$request->email,
            'password'=>$request->password,
        ];

        if (Auth::attempt($infologin)) {
            $request->session()->regenerate();
            // if (Auth::check()) {
            //     return "success";
            // } else {
            //     return "not";
            // }
            if (Auth::user()->level == 'Administrator') {
                return redirect()->intended('dashboard');
            } elseif (Auth::user()->level == 'Officer') {
                return redirect()->intended('dashboard');
            } elseif (Auth::user()->level == 'User') {
                return redirect()->intended('home');
            }
            
            // dd($infologin);
        }else{
            return redirect('')->withErrors('Username atau Password Salah')->withInput();
        }
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('dashboard');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    
    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush(); // Menghapus semua data sesi
        return redirect()->route('login')->with('success', 'Berhasil Logout');
    }
}
