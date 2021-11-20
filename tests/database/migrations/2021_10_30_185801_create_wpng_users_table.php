<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWpngUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wpng_users', function (Blueprint $table) {
            $table->bigIncrements('ID');
            $table->string('user_login', 60)->nullable()->index('user_login_key');
            $table->string('user_pass')->nullable();
            $table->string('user_nicename', 50)->nullable()->index('user_nicename');
            $table->string('user_email', 100)->nullable()->index('user_email');
            $table->string('user_url', 100)->nullable();
            $table->dateTime('user_registered')->default('0000-00-00 00:00:00');
            $table->string('user_activation_key')->nullable();
            $table->integer('user_status')->default(0);
            $table->string('display_name', 250)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wpng_users');
    }
}
