<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pinjam;
use App\Models\Buku;
use App\Models\User;

class PinjamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pinjam = Pinjam::paginate(7);
    
        return view('Backend.pinjam', compact('pinjam'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all(); // Menggunakan model User Anda
        $buku = Buku::all(); // Menggunakan model Buku Anda
        return view('Backend.tambahpinjam', compact('users', 'buku'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima dari formulir
$request->validate([
    'user_id' => 'required',
    'buku_id' => 'required',
    'tanggal_peminjaman' => 'required', 
    'tanggal_pengembalian' => 'nullable',
    'status_peminjaman' => 'required'
]);

// Membuat buku baru berdasarkan data yang valid
$pinjam = new Pinjam();
$pinjam->user_id = $request->user_id; // Menggunakan 'judul' bukan 'nama_kategori'
$pinjam->buku_id = $request->buku_id;
$pinjam->tanggal_peminjaman = $request->tanggal_peminjaman;
$pinjam->tanggal_pengembalian = $request->tanggal_pengembalian;
$pinjam->status_peminjaman = $request->status_peminjaman;
$pinjam->save();

if ($request->status_peminjaman == 'diPinjam') {
    $buku = Buku::find($request->buku_id);
    if ($buku) {
        // Kurangi jumlah tersedia jika buku ditemukan
        $buku->jumlah_tersedia -= 1;
        $buku->save();
    }
}elseif ($request->status_peminjaman == 'diKembalikan') {
    $buku = Buku::find($request->buku_id);
    if ($buku) {
        // Kurangi jumlah tersedia jika buku ditemukan
        $buku->jumlah_tersedia += 1;
        $buku->save();
    }
}

// Redirect ke halaman yang sesuai dengan pesan sukses
return redirect()->route('pinjam.index')->with('success', 'Peminjaman berhasil ditambahkan.');
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
                       $pinjam = Pinjam::findOrFail($id);

                       $users = User::all(); // Menggunakan model User Anda
                       $buku = Buku::all(); // Menggunakan model Buku Anda
                       //render view with post
                       return view('backend.editpinjam', compact('pinjam', 'users', 'buku'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi form
        $this->validate($request, [
            'user_id' => 'required',
            'buku_id' => 'required',
            'tanggal_peminjaman' => 'required', 
            'tanggal_pengembalian' => 'nullable',
            'status_peminjaman' => 'required'
        ]);
    
        // Ambil data peminjaman berdasarkan ID
        $pinjam = Pinjam::findOrFail($id);
    
        // Perbarui data peminjaman
        $pinjam->update([
            'user_id' => $request->input('user_id'),
            'buku_id' => $request->input('buku_id'),
            'tanggal_peminjaman' => $request->input('tanggal_peminjaman'),
            'tanggal_pengembalian' => $request->input('tanggal_pengembalian'),
            'status_peminjaman' => $request->input('status_peminjaman')
        ]);
    
        // Periksa apakah status peminjaman berubah menjadi 'diKembalikan'
        if ($request->status_peminjaman == 'diKembalikan' && $pinjam->status_peminjaman == 'diPinjam') {
            $buku = Buku::find($pinjam->buku_id);
            if ($buku) {
                // Tambah jumlah tersedia jika buku ditemukan
                $buku->jumlah_tersedia += 1;
                $buku->save();
            }
        } elseif ($request->status_peminjaman == 'diPinjam' && $pinjam->status_peminjaman == 'diKembalikan') {
            $buku = Buku::find($pinjam->buku_id);
            if ($buku) {
                // Kurangi jumlah tersedia jika buku ditemukan
                $buku->jumlah_tersedia -= 1;
                $buku->save();
            }
        }
    
        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('pinjam.index')->with('success', 'Data peminjaman berhasil diperbarui');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
                        //get post by ID
                        $pinjam = Pinjam::findOrFail($id);
                        //delete post
                        $pinjam->delete();
                        //redirect to index
                        return redirect()->route('pinjam.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
