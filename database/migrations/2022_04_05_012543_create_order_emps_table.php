<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderEmpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_emps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_rec_id');
            $table->foreign('order_rec_id')->references('id')->on('order_receives')->onDelete('cascade');
            $table->unsignedBigInteger('employ_id');
            $table->foreign('employ_id')->references('id')->on('employs')->onDelete('cascade');
            $table->double('cost',8,2)->nullable();
            $table->unsignedBigInteger('admin_id');
            $table->foreign('admin_id')->references('id')->on('admin')->onDelete('cascade');
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
        Schema::dropIfExists('order_emps');
    }
}