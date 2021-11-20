<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWpngWcCustomerLookupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wpng_wc_customer_lookup', function (Blueprint $table) {
            $table->bigIncrements('customer_id');
            $table->unsignedBigInteger('user_id')->nullable()->unique('user_id');
            $table->string('username', 60)->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email', 100)->nullable()->index('email');
            $table->timestamp('date_last_active')->nullable();
            $table->timestamp('date_registered')->nullable();
            $table->char('country', 2)->nullable();
            $table->string('postcode', 20)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('state', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wpng_wc_customer_lookup');
    }
}
