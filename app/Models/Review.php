<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table ='ulasan';
    protected $primaryKey = 'ulasan_id';
    protected $fillable = [
        'user_id',
        'buku_id',
        'review',
        'rating'
    ];

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
