<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_points', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('action_type_id')->unsigned();
            //Defined in the globals array
            $table->integer('source_id')->unsigned();
            $table->integer('points');

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('action_type_id')->references('id')->on('action_types');
            
            //Index created to speed up the search
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_points');
    }
}
