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
            $table->increments('id');
            $table->string('name_customer', 100);
            $table->string('address_customer', 200);
            $table->string('phone_customer', 20);
            $table->string('email_customer', 20);
            $table->text('note_customer')->nullable();
            $table->integer('quantity_buy');
            $table->integer('type_payment')->default(1);
            $table->integer('status')->default(0);
            $table->string('code', 100);
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
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
