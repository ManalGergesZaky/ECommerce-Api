<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            // id
            // name
            // price
            // quantity
            // detailes
            // image
            // cat_id
           // $table->foreign('user_id')->references('id')->on('users');
            $table->id();
            $table->string('name')->nullable();
            $table->double('price', 8, 2 )->default(0);
            $table->integer('quantity')->default(0);
            $table->longText("details")->nullable();
            $table->string('image')->nullable();

            $table->unsignedBigInteger('cat_id');
            $table->foreign('cat_id')->references('id')->on('categories');
            
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
        Schema::dropIfExists('_products');
    }
};
