<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use Illuminate\Contracts\View\View;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buku = Buku::paginate(7);
    
        return view('Backend.buku', compact('buku'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Backend.tambahbuku');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima dari formulir
        $request->validate([
            'judul' => 'required|min:5',
            'penulis' => 'required|min:5',
            'penerbit' => 'nullable',
            'tahun_terbit' => 'required|integer|min:4',
            'jumlah_tersedia' => 'required|integer|min:1'
        ]);

        // Membuat buku baru berdasarkan data yang valid
        $buku = new Buku();
        $buku->judul = $request->judul; // Menggunakan 'judul' bukan 'nama_kategori'
        $buku->penulis = $request->penulis;
        $buku->penerbit = $request->penerbit;
        $buku->tahun_terbit = $request->tahun_terbit;
        $buku->jumlah_tersedia = $request->jumlah_tersedia;
        $buku->save();

        // Redirect ke halaman yang sesuai dengan pesan sukses
        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan.');
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
    public function edit(string $id): View
    {
        //get post by ID
        $buku = Buku::findOrFail($id);
        //render view with post
        return view('backend.editbuku', compact('buku'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi form
        $this->validate($request, [
            'judul' => 'required|min:5',
            'penulis' => 'required|min:5',
            'penerbit' => 'nullable',
            'tahun_terbit' => 'required|integer|min:4',
            'jumlah_tersedia' => 'required|integer|min:1'
        ]);

        // Ambil kategori berdasarkan ID
        $buku = Buku::findOrFail($id);

        // Perbarui data kategori
        $buku->update([
            'judul' => $request->input('judul'),
            'penulis' => $request->input('penulis'),
            'penerbit' => $request->input('penerbit'),
            'tahun_terbit' => $request->input('tahun_terbit'),
            'jumlah_tersedia' => $request->input('jumlah_tersedia')
        ]);

        // Redirect ke halaman index dengan kategori yang telah diperbarui
        return redirect()->route('buku.index')->with('success', 'Kategori berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //        //get post by ID
        $buku = Buku::findOrFail($id);
        //delete post
        $buku->delete();
        //redirect to index
        return redirect()->route('buku.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
