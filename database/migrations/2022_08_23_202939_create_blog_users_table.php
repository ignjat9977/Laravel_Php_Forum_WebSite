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
        Schema::create('blog_users', function (Blueprint $table) {
            $table->id("id_user")->autoIncrement();
            $table->string("first_name");
            $table->string("last_name");
            $table->string("email")->unique();
            $table->string("password");
            $table->string("street");
            $table->string("picture_href")->unique();
            $table->timestamps();
            $table->dateTime("deleted_at");
            $table->integer("id_role");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_users');
    }
};
