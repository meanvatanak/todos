<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ELibraryHistory extends Model
{
    use HasFactory;

    protected $fillable = array(
        'id',
        'elibrary_id',
        'title',
        'sub_title',
        'year',
        'page',
        'author',
        'publisher',
        'genre',
        'book_cover',
        'book_file',

        'status',
        'delete_status',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at',
    );

    public function elibrary()
    { return $this->belongsTo(ELibrary::class, 'elibrary_id'); }
}
