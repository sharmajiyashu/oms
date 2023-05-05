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
            $table->id();
            $table->string('user_id');
            $table->string('order_id',50);
            $table->string('customer_name',50);
            $table->longtext('sh_address')->nullable();
            $table->string('sh_city')->nullable();
            $table->string('sh_state')->nullable();
            $table->string('sh_zip_code')->nullable();
            $table->longtext('bl_address')->nullable();
            $table->string('bl_city')->nullable();
            $table->string('bl_state')->nullable();
            $table->string('bl_zip_code')->nullable();
            $table->string('mobile')->nullable();
            $table->string('cellphone')->nullable();
            $table->string('email')->nullable();
            $table->string('product')->nullable();
            $table->string('quantity')->nullable();
            $table->string('delivery_method')->nullable();
            $table->string('card_number')->nullable();
            $table->string('card_exp')->nullable();
            $table->string('card_cvv')->nullable();
            $table->string('amount')->nullable();
            $table->longtext('comment')->nullable();
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
