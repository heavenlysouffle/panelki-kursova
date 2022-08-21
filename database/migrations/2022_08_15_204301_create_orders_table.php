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
            $table->integer('order_id')->unsigned();
            $table->unsignedBigInteger('panel_id')->unsigned()->nullable();
            $table->foreign('panel_id')
                ->references('id')
                ->on('panels')
                ->onDelete('cascade');
            $table->integer('price');
            $table->string('first_name');
            $table->string('second_name');
            $table->string('phone');
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
