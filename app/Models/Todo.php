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
        'description',
        'due_date',
        'user_id',
        'category_id',
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

    public function todo_category()
    { return $this->belongsTo(TodoCategory::class,'category_id'); }

    public function created_byed()
    { return $this->belongsTo(User::class,'created_by'); }

    public function updated_byed()
    { return $this->belongsTo(User::class,'updated_by'); }
    
    public function deleted_byed()
    { return $this->belongsTo(User::class,'deleted_by'); }

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
