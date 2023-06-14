<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'password',
        'phone',
        'image',
        'email',
        'name',
        'gender',
        'address',
        'role',

        'status',
        'delete_status',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by',
    ];

    public function created_name()
    { return $this->belongsTo(User::class,'created_by'); }

    public function updated_name()
    { return $this->belongsTo(User::class,'updated_by'); }

    public function deleted_name()
    { return $this->belongsTo(User::class,'deleted_by'); }

}
