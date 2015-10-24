<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->enum('input_type', ['text', 'select', 'radio', 'checkbox', 'image', 'document']);
            $table->json('default_values');
            $table->json('validation_rules');
            $table->json('help_message');
            $table->string('type_products');
            $table->smallInteger('max_num_values')->default(1);
            $table->enum('status', ['active', 'inactive']);
            $table->timestamps();
        });
    }
    // public function up()
    // {
    //     Schema::create('product_details', function (Blueprint $table) {
    //         $table->increments('id');
    //         $table->string('name', 100);
    //         $table->string('input_type', 20);
    //         $table->string('data_type', 20);
    //         $table->smallInteger('max_num_values');
    //         $table->timestamps();
    //     });
    // }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('product_details');
    }
}
