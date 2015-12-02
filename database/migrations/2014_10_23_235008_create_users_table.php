<?php

use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('users', function ($table) {
            $table->increments('id');
            $table->string('username', 100)->unique();
            $table->string('name', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('tel', 30)->nullable();
            $table->string('password', 255);

            $table->string('url_photo', 255)->nullable();

            $table->string('type', 20)->enum(['admin', 'shopkeeper', 'producer'])->default('admin');
            $table->boolean('terms')->default(0);

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('users');
    }
}
