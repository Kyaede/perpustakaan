<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
               //get post by ID
               $setting = Auth::user();
               //render view with post
               return view('backend.setting', compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
                       // Validasi form
                       $this->validate($request, [
                        'username' => 'required|min:2',
                        'email' => 'required|email|min:5',
                        'password' => 'required|min:8', 
                        'nama_lengkap' => 'nullable|min:4',
                        'alamat' => 'nullable|min:1',
                        'level' => 'required'
                    ]);
            
                    // Ambil kategori berdasarkan ID
                    $setting = User::findOrFail($id);
            
                    // Perbarui data kategori
                    $setting->update([
                        'username' => $request->input('username'),
                        'email' => $request->input('email'),
                        'password' => $request->input('password'),
                        'nama_lengkap' => $request->input('nama_lengkap'),
                        'alamat' => $request->input('alamat'),
                        'level' => $request->input('level')
                    ]);
            
                    // Redirect ke halaman index dengan kategori yang telah diperbarui
                    return redirect()->route('dashboard.index')->with('success', 'Profil berhasil diperbarui');
    }

    public function update2(Request $request, string $id)
    {
                       // Validasi form
                       $this->validate($request, [
                        'username' => 'required|min:2',
                        'email' => 'required|email|min:5',
                        'nama_lengkap' => 'nullable|min:4',
                        'alamat' => 'nullable|min:1'
                    ]);
            
                    // Ambil kategori berdasarkan ID
                    $setting = User::findOrFail($id);
            
                    // Perbarui data kategori
                    $setting->update([
                        'username' => $request->input('username'),
                        'email' => $request->input('email'),
                        'nama_lengkap' => $request->input('nama_lengkap'),
                        'alamat' => $request->input('alamat')
                    ]);
            
                    // Redirect ke halaman index dengan kategori yang telah diperbarui
                    return redirect()->route('frontend.index')->with('success', 'Profil berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
