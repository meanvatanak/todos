<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Todo extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = array(
        'name',
        'due_date',
        'description',
        'user_id',
        'status',
        'delete_status',
        'created_by',
        'updated_by',
        'deleted_at',
        'created_at',
        'updated_at',
        'deleted_at',
    );

    public function user()
    { return $this->belongsTo(User::class,'user_id'); }

    public function createToken()
    {
        return $this->user->createToken('authToken')->accessToken;
    }

    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        Todo::factory()
                ->count(50)
                ->create();
    }
}
