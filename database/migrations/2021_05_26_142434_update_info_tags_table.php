<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateInfoTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tags', function (Blueprint $table) {
            // sửa tên column
            $table->renameColumn('tentruong', 'name');
            // sửa kiểu dữ column
            $table->string('meta_seo', 200)->nullable()->change();
            $table->text('description')->nullable()->change();
            // thêm column
            $table->dateTime('created_at')->nullable()->after('status');
            $table->dateTime('updated_at')->nullable()->after('status');
            // xoá column
            $table->dropColumn('login_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tags', function (Blueprint $table) {
            //
        });
    }
}
