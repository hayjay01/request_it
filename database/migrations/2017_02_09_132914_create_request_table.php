<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('requests',function(Blueprint $table){
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('category_id')->nullable();
            $table->index('user_id')->foreign('user_id')->refrences('id')->on('users')->nullable();
            $table->string('request_title');
            $table->string('request_type')->nullable();
            $table->text('body');
            $table->string('user_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
}
