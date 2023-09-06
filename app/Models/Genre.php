<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = array(
        'id',
        'name',

        'status',
        'delete_status',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at',
    );

    public function created_byed()
    { return $this->belongsTo(User::class,'created_by'); }

    public function updated_byed()
    { return $this->belongsTo(User::class,'updated_by'); }
    
    public function deleted_byed()
    { return $this->belongsTo(User::class,'deleted_by'); }

    public function getGenreInELibrary()
    { 
        $genreELibraries = DB::table("e_libraries")
            ->select(
                "e_libraries.genre_id as id",
                "genres.name as name"
            )
            ->Join('genres', 'e_libraries.genre_id', '=', 'genres.id')
            ->where(function ($q) {
                $q->where('e_libraries.status', 1);
                $q->where('e_libraries.delete_status', 0);
            });

        $results = $genreELibraries->distinct()->get();

        return $results;
    }
}
