<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::paginate(7);
    
        return view('Backend.user', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Backend.tambahuser');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima dari formulir
        $request->validate([
            'username' => 'required|min:2',
            'email' => 'required|email|min:5',
            'password' => 'required|min:8', 
            'nama_lengkap' => 'nullable|min:4',
            'alamat' => 'nullable|min:1',
            'level' => 'required'
        ]);

        // Membuat buku baru berdasarkan data yang valid
        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); // Menggunakan bcrypt untuk menyimpan kata sandi
        $user->nama_lengkap = $request->nama_lengkap;
        $user->alamat = $request->alamat;
        $user->level = $request->level; // Memastikan level sesuai dengan yang diizinkan dalam enum
        $user->save();
        

        // Redirect ke halaman yang sesuai dengan pesan sukses
        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan.');
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
               //get post by ID
               $user = User::findOrFail($id);
               //render view with post
               return view('backend.edituser', compact('user'));
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
                            return redirect()->route('user.index')->with('success', 'Profil berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
                        //        //get post by ID
                        $user = User::findOrFail($id);
                        //delete post
                        $user->delete();
                        //redirect to index
                        return redirect()->route('user.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
