<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pinjam;
use App\Models\Buku;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FrontPinjamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all(); // Menggunakan model User Anda
        $buku = Buku::all(); // Menggunakan model Buku Anda
        return view('Frontend.pinjam', compact('users', 'buku'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $users = User::all(); // Menggunakan model User Anda
        // $buku = Buku::all(); // Menggunakan model Buku Anda
        // return view('Frontend.pinjam', compact('users', 'buku'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Mendapatkan user yang sedang login
        $user = Auth::user();
    
        $request->validate([
            'buku_id' => 'required',
            'tanggal_peminjaman' => 'required', 
            'tanggal_pengembalian' => 'nullable',
            'status_peminjaman' => 'required'
        ]);
    
        $buku = Buku::find($request->buku_id);
        if ($buku && $buku->jumlah_tersedia <= 0) {
            // Jika jumlah tersedia buku adalah 0, kembalikan pesan kesalahan
            return redirect()->route('home.index')->with('success', 'Buku tidak tersedia untuk dipinjam, Stok Habis.');
        }

        // Membuat instance baru dari model Pinjam
        $pinjam = new Pinjam();
    
        // Menetapkan user_id dengan ID pengguna yang saat ini login
        $pinjam->user_id = $user->id;
    
        // Menetapkan buku_id dengan nilai yang diterima dari permintaan
        $pinjam->buku_id = $request->buku_id;
    
        // Menetapkan tanggal_peminjaman dengan nilai yang diterima dari permintaan
        $pinjam->tanggal_peminjaman = $request->tanggal_peminjaman;
    
        // Menetapkan tanggal_pengembalian dengan nilai yang diterima dari permintaan
        $pinjam->tanggal_pengembalian = $request->tanggal_pengembalian;
    
        // Menetapkan status_peminjaman dengan nilai yang diterima dari permintaan
        $pinjam->status_peminjaman = $request->status_peminjaman;
    
        // Menyimpan instance baru dari model Pinjam ke database
        $pinjam->save();
    
        if ($request->status_peminjaman == 'diPinjam') {
            $buku = Buku::find($request->buku_id);
            if ($buku) {
                // Kurangi jumlah tersedia jika buku ditemukan
                $buku->jumlah_tersedia -= 1;
                $buku->save();
            }
        }

        // Redirect ke halaman yang sesuai dengan pesan sukses
        return redirect()->route('home.index')->with('success', 'Peminjaman berhasil ditambahkan.');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
