<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('size',8,2)->nullable();
            $table->unsignedBigInteger('parent')->nullable();
            $table->foreign('parent')->references('id')->on('units')->onDelete('cascade');
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
        Schema::dropIfExists('units');
    }
}