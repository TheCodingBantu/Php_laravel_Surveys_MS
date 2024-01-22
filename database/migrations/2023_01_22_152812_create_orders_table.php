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
            $table->string('order_number');
            $table->json('product_ids');
            $table->string('user_id');
            $table->string('branch_id');
            $table->string('payment_method');
            $table->string('delivery_address');
            $table->json('item_names');
            $table->integer('redeemed_lp')->nullable();
            $table->json('item_prices');
            $table->json('item_quantities');
            $table->json('item_totals');
            $table->string('total');
            $table->integer('status');
            $table->json('tracking_dates')->nullable;

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
