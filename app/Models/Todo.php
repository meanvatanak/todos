<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = array(
        'name',
        'due_date',
        'description',
        'status',
        'delete_status',
        'created_by',
        'updated_by',
        'deleted_at',
        'created_at',
        'updated_at',
        'deleted_at',
    );

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
