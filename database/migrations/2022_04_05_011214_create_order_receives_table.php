<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderReceivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_receives', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->unsignedBigInteger('product_buy_id')->nullable();
            $table->foreign('product_buy_id')->references('id')->on('product_buys')->onDelete('cascade');
            $table->date('date_receive');
            $table->unsignedBigInteger('clearance_id')->nullable();
            $table->foreign('clearance_id')->references('id')->on('clearance_comps')->onDelete('cascade');
            $table->double('clearance_cost',8,2)->nullable();
            $table->unsignedBigInteger('transfer_id')->nullable();
            $table->foreign('transfer_id')->references('id')->on('transfer_comps')->onDelete('cascade');
            $table->double('transfer_cost',8,2)->nullable();
            $table->unsignedBigInteger('admin_id');
            $table->foreign('admin_id')->references('id')->on('admin')->onDelete('cascade');
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('order_receives');
    }
}
