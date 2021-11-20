<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoworxUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moworx_users', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('firstName', 50)->nullable();
            $table->string('lastName', 50)->nullable();
            $table->string('email')->nullable()->unique('email_UNIQUE');
            $table->string('phone', 10)->nullable();
            $table->string('userAddress')->nullable();
            $table->dateTime('createdAt')->useCurrent();
            $table->dateTime('updatedAt')->useCurrent();
            $table->string('userPassword', 2550)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('moworx_users');
    }
}
