<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori::paginate(7);
    
        return view('Backend.kategori', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Backend.tambahkategori');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima dari formulir
        $request->validate([
            'nama_kategori' => 'required|min:5'
        ]);

        // Membuat kategori baru berdasarkan data yang valid
        $kategori = new Kategori();
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->save();

        // Redirect ke halaman yang sesuai dengan pesan sukses
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
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
    public function edit(string $kategori_id): View
    {
        //    //get post by ID
        $kategori = Kategori::findOrFail($kategori_id);
        //    //render view with post
        return view('backend.editkategori', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi form
        $this->validate($request, [
            'nama_kategori' => 'required|min:5'
        ]);

        // Ambil kategori berdasarkan ID
        $kategori = Kategori::findOrFail($id);

        // Perbarui data kategori
        $kategori->update([
            'nama_kategori' => $request->input('nama_kategori')
        ]);

        // Redirect ke halaman index dengan kategori yang telah diperbarui
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //        //get post by ID
        $kategori = Kategori::findOrFail($id);
        //delete post
        $kategori->delete();
        //redirect to index
        return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
