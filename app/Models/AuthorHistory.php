<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorHistory extends Model
{
    use HasFactory;

    protected $fillable = array(
        'id',
        'name',
        'author_id',

        'status',
        'delete_status',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at',
    );

    public function author()
    { return $this->belongsTo(Author::class,'author_id'); }
}
