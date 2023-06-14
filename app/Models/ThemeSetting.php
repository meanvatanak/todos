<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThemeSetting extends Model
{
    use HasFactory;
    protected $fillable = array(
        'user_id',
        'theme',
        'compact',

        'active',
        'delete_status',
        'created_by',
        'updated_by',
        'deleted_at',
        'created_at',
        'updated_at',
        'deleted_at',
    );
}
