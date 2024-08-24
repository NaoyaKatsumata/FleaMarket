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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('brand')->nullable();
            $table->string('img_path');
            $table->string('comment',255)->nullable();
            $table->integer('price');
            $table->integer('category_id');
            $table->integer('status_id');
            $table->integer('sell_flg')->default(0);//0->販売中,1->完売
            $table->integer('shipping_user_id');
            $table->integer('buy_user_id')->nullable();;
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
        Schema::dropIfExists('items');
    }
};
