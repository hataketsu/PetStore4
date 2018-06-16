<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_reg')->default(0);
            $table->integer('user_created')->default(0);
            $table->integer('checkout')->default(0);
            $table->integer('sell')->default(0);
            $table->integer('order_dispose')->default(0);
            $table->integer('order_confirm')->default(0);
            $table->integer('order_ship')->default(0);
            $table->integer('order_done')->default(0);
            $table->integer('revenue')->default(0);
            $table->integer('p_created')->default(0);
            $table->integer('views')->default(0);
            $table->integer('date');
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
        Schema::dropIfExists('logs');
    }
}
