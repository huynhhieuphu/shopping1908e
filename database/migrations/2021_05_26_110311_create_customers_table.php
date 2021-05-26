<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 60)->unique();
            $table->string('password', 60);
            $table->string('email', 200)->unique();
            $table->string('phone', 60);
            $table->string('fullname', 100);
            $table->string('address', 200);
            $table->string('avatar', 100)->nullable();
            $table->tinyInteger('gender')->default(1);
            $table->date('birthday')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->dateTime('last_login')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
