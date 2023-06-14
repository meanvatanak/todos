<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = array(
        'role_name',
        'remark',
        'status',
        'delete_status',
        'created_by',
        'updated_by',
        'deleted_at',
        'created_at',
        'updated_at',
        'deleted_at',
    );
}
