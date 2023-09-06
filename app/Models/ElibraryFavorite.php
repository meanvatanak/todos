<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElibraryFavorite extends Model
{
    use HasFactory;

    protected $table = 'elibrary_favorites';

    protected $fillable = [
        'user_id',
        'elibrary_id',
        'status',
        'delete_status',
    ];

    public function elibrary()
    { return $this->belongsTo(Elibrary::class, 'elibrary_id', 'id'); }

    public function user()
    { return $this->belongsTo(User::class, 'user_id', 'id'); }
}
