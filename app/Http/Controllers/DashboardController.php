<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Buku;
use App\Models\Pinjam;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $search = $request->search;
        
        // $posts = Post::where(function($query) use ($search){
        //     $query->where('title','like',"%$search%")
        //     ->orWhere('content','like',"%$search%");
        // })
        // ->paginate(3); // Paginate the query
        // $books = Buku::all();
        $totalBooks = Buku::count();
        $totalUser = User::count();
        $totalPinjam = Pinjam::count();
        // Misalnya, kita ingin menghitung jumlah pengguna baru dalam 30 hari terakhir
$newUsersCount = User::where('created_at', '>=', now()->subDays(30))->count();


        return view('backend.index', [
            'totalBooks' => $totalBooks,
            'totalUser' => $totalUser,
            'totalPinjam' => $totalPinjam,
            'newUsersCount' => $newUsersCount
        ]);       
         // echo"berhasil";
        // echo"<h1>". Auth::user()->username ."</h1>";
    }

    public function countBooks()
    {
        $totalBooks = Buku::table('buku')->count();

        return view('backend.index', ['totalBooks' => $totalBooks]);
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
