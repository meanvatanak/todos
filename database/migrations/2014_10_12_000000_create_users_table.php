<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('phone');
            $table->string('email');
            $table->timestamp('verified_at')->nullable();
            $table->string('token');
            $table->string('name');
            $table->integer('address_id');
            $table->integer('role_id');

            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('delete_status')->default(0);
            
            $table->timestamp('created_at')->nullable();
            $table->integer('created_id')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('updated_id')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->integer('deleted_id')->nullable();
            
            
            // $table->rememberToken();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
