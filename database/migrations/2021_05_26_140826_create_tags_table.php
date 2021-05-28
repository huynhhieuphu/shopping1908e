<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            /*
             * id	int unsigned	NO	PRI		auto_increment
                name	varchar(150)	NO
                slug	varchar(180)	NO
                title_seo	varchar(200)	YES
                meta_seo	varchar(200)	YES
                description	text	YES
                status	tinyint	NO
                created_at	datetime	YES
                updated_at	datetime	YES
             * */
            $table->increments('id');
            $table->string('tentruong', 150)->unique(); // sửa tên column
            $table->string('slug', 150)->unique();
            $table->string('title_seo', 200)->nullable();
            $table->text('meta_seo')->nullable(); // sửa type column
            $table->text('description'); // thêm null
            $table->tinyInteger('status')->default(1);
            // thêm 2 column created_at, updated_at
            $table->dateTime('login_at')->nullable(); // xoá column
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
    }
}
