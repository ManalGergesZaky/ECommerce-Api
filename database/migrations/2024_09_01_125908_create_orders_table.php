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
        Schema::create('orders', function (Blueprint $table) {
            // id 
            // user_id
            // total_price 
            // order_date
            // stats ----->tinyInteger

            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->double('total_price', 8, 2 )->default(0);

            $table->timestamp("order_date")->nullable();

            $table->tinyInteger('paid')
                ->comment(" 0 => paid , 1 => unpaid")
                ->nullable();

            $table->tinyInteger('status')
                ->comment(" 0 => PENDING , 1 => DELEIVERED TO CLIENT")
                ->nullable();
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
        Schema::dropIfExists('orders');
    }
};
