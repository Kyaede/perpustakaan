<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Buku;
use App\Models\User;

class UlasanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $review = Review::paginate(7);
    
        return view('Backend.review', compact('review'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all(); // Menggunakan model User Anda
        $buku = Buku::all(); // Menggunakan model Buku Anda
        return view('Backend.tambahreview', compact('users', 'buku'));
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
    'review' => 'required', 
    'rating' => 'nullable|integer'
]);

// Membuat buku baru berdasarkan data yang valid
$review = new Review();
$review->user_id = $request->user_id; // Menggunakan 'judul' bukan 'nama_kategori'
$review->buku_id = $request->buku_id;
$review->review = $request->review;
$review->rating = $request->rating;
$review->save();

// Redirect ke halaman yang sesuai dengan pesan sukses
return redirect()->route('ulasan.index')->with('success', 'Ulasan berhasil ditambahkan.');
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
                               $review = Review::findOrFail($id);

                               $users = User::all(); // Menggunakan model User Anda
                               $buku = Buku::all(); // Menggunakan model Buku Anda
                               //render view with post
                               return view('backend.editreview', compact('review', 'users', 'buku'));
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
                                    'review' => 'required', 
                                    'rating' => 'nullable|integer'
                                ]);
                        
                                // Ambil kategori berdasarkan ID
                                $review = Review::findOrFail($id);
                        
                                // Perbarui data kategori
                                $review->update([
                                    'user_id' => $request->input('user_id'),
                                    'buku_id' => $request->input('buku_id'),
                                    'review' => $request->input('review'),
                                    'rating' => $request->input('rating')
                                ]);
                        
                                // Redirect ke halaman index dengan kategori yang telah diperbarui
                                return redirect()->route('ulasan.index')->with('success', 'Kategori berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
                                //get post by ID
                                $review = Review::findOrFail($id);
                                //delete post
                                $review->delete();
                                //redirect to index
                                return redirect()->route('ulasan.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
