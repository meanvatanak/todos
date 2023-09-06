<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublisherHostory extends Model
{
    use HasFactory;

    protected $fillable = array(
        'id',
        'name',
        'publisher_id',

        'status',
        'delete_status',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at',
    );

    public function publisher()
    { return $this->belongsTo(Publisher::class,'publisher_id'); }
}
