<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ELibrary extends Model
{
    use HasFactory;

    protected $fillable = array(
        'id',
        'title',
        'sub_title',
        'year',
        'page',
        'book_cover',
        'book_file',
        'author_id',
        'publisher_id',
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

    public function author()
    { return $this->belongsTo(Author::class,'author_id'); }

    public function publisher()
    { return $this->belongsTo(Publisher::class,'publisher_id'); }

    public function genre()
    { return $this->belongsTo(Genre::class,'genre_id'); }

    public function created_byed()
    { return $this->belongsTo(User::class,'created_by'); }

    public function updated_byed()
    { return $this->belongsTo(User::class,'updated_by'); }
    
    public function deleted_byed()
    { return $this->belongsTo(User::class,'deleted_by'); }

    public function scopeActive($query)
    { return $query->where('status',1); }

    public function scopeInActive($query)
    { return $query->where('status',0); }

    public function scopeDeleted($query)
    { return $query->where('delete_status',1); }

    public function scopeNotDeleted($query)
    { return $query->where('delete_status',0); }

    // count number of reader increment
    public function reader()
    { 
        $this->view = $this->view + 1;
    }
}
