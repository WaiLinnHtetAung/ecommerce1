<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
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
            $table->string('first_name');
            $table->string('last_name');
            $table->string('member_card')->nullable();
            $table->date('birthday')->nullable();
            $table->string('gender')->nullable();
            $table->string('company')->nullable();
            $table->string('street');
            $table->string('city');
            $table->string('town');
            $table->string('email');
            $table->string('phone');
            $table->string('payment');
            $table->json('records');
            $table->double('price');
            $table->double('qty');
            $table->double('tax');
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
}
