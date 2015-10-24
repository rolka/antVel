<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\ActionType;

class CreateActionTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_types', function (Blueprint $table) {
            $table->integer('id')->unsigned()->primary();
            $table->enum('source_type', array_keys(trans('globals.source_types')));
            $table->string('action');
        });

        ActionType::createMany(trans('globals.action_types'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('action_types');
    }
}
