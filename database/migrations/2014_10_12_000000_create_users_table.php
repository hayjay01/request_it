<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('first_name')->unique();
            $table->string('username')->unique()->nullable();
            $table->string('password');
            // $table->string('avatar')->default('default.jpg');
            $table->string('user_image')->nullable();
            //2 represent all users
             $table->integer('role_id')->default(2)->nullable();
        // $table->foreign('role_id')->references('id')->on('roles');
            $table->string('department');
            $table->string('gender');
            $table->rememberToken();
            $table->timestamps();

          



        //     $table->increments('id');
        //     $table->string('email')->unique();
        //     $table->string('username')->unique()->nullable();
        //     $table->string('password');
        //     // $table->string('avatar')->default('default.jpg');
        //     $table->string('user_image')->nullable();
        //     //2 represent all users
        //      $table->integer('role_id')->default(2)->nullable();
        // // $table->foreign('role_id')->references('id')->on('roles');
        //     $table->string('department');
        //     $table->string('gender');

        //     $table->rememberToken();
        //     $table->timestamps();

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
