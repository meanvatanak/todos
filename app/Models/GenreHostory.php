<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenreHostory extends Model
{
    use HasFactory;

    protected $fillable = array(
        'id',
        'name',
        'genre_id',

        'status',
        'delete_status',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at',
    );

    public function genre()
    { return $this->belongsTo(Genre::class,'genre_id'); }
}
