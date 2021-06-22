<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('slug', 255);
            $table->string('images', 255);
            $table->integer('quantity');
            $table->integer('price')->unsigned();
            $table->integer('brand_id')->unsigned();
            $table->integer('sale_off')->nullable();
            $table->string('code', 100)->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('count_view')->unsigned();
            $table->datetime('created_at')->nullable();
            $table->datetime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
