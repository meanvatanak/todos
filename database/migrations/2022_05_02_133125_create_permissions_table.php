<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('header');
            $table->string('name');
            $table->integer('role_id');
            $table->unique(['name','role_id']);

            $table->boolean('optView')->default(0);
            $table->boolean('optCreate')->default(0);
            $table->boolean('optShow')->default(0);
            $table->boolean('optEdit')->default(0);
            $table->boolean('optDelete')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
