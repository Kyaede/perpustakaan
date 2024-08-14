<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\User;
use App\Models\Buku;
use Illuminate\Support\Facades\Auth;

class FrontReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('Backend.review', [
        //     'review' => Review::get(),
        // ]);
        // $review = Review::paginate(3);
    
        // return view('frontend.review', compact('review'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $buku = Buku::all(); // Menggunakan model Buku Anda
        $users = User::all(); // Menggunakan model User Anda
        $review = Review::with('buku', 'user')->get();
        $review = Review::paginate(1);
        return view('frontend.review', compact('users', 'buku', 'review'));
        // return view('frontend.review', compact('users', 'buku'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

$request->validate([
    'buku_id' => 'required',
    'review' => 'required', 
    'rating' => 'nullable|integer'
]);

// Membuat buku baru berdasarkan data yang valid
$review = new Review();
$review->user_id = $user->id;
$review->buku_id = $request->buku_id;
$review->review = $request->review;
$review->rating = $request->rating;
$review->save();

        return redirect()->route('home.index')->with('success', 'Review berhasil ditambahkan.');
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
