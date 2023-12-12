<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoCategory extends Model
{
    use HasFactory;

    protected $fillable = array(
        'id',
        'name',
        'user_id',

        'status',
        'delete_status',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at',
    );

    public function user()
    { return $this->belongsTo(User::class,'user_id'); }

    public function created_byed()
    { return $this->belongsTo(User::class,'created_by'); }

    public function updated_byed()
    { return $this->belongsTo(User::class,'updated_by'); }
    
    public function deleted_byed()
    { return $this->belongsTo(User::class,'deleted_by'); }
}
