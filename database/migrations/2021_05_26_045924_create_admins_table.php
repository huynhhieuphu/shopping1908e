<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 100)->unique(); // kiểu varchar, độ dài 100, không null, không trùng tên
            $table->string('password', 100);
            $table->string('email', 100)->unique();
            $table->tinyInteger('Role')->default(1); // kiểu tinyint, không null, mặc định là 1,
            $table->string('phone', 20);
            $table->string('fullname', 100);
            $table->string('address', 200);
            $table->string('avatar', 255)->nullable(); // kiểu varchar, độ dài 255, null
            $table->date('birthday')->nullable();
            $table->datetime('created_at')->nullable();
            $table->datetime('updated_at')->nullable();
            $table->datetime('last_login')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
