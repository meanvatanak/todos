<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Publisher extends Model
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

    public function getPublisherInELibrary()
    { 
        $publisherELibraries = DB::table("e_libraries")
            ->select(
                "e_libraries.publisher_id as id",
                "publishers.name as name"
            )
            ->Join('publishers', 'e_libraries.publisher_id', '=', 'publishers.id')
            ->where(function ($q) {
                $q->where('e_libraries.status', 1);
                $q->where('e_libraries.delete_status', 0);
            });

        $results = $publisherELibraries->distinct()->get();

        return $results;
    }
}
