<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sizes', function (Blueprint $table) {
            /*
             * id	int unsigned	NO	PRI		auto_increment
size_number	int unsigned	NO
size_text	varchar(10)	YES
description	text	NO
status	tinyint	NO		1
created_at	datetime	YES
updated_at	datetime	YES			*/
            $table->increments('id');
            $table->integer('size_number')->unsigned();
            $table->string('size_text', 10)->nullable();
            $table->text('description');
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('sizes');
    }
}
