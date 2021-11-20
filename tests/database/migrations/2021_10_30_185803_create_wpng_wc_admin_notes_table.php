<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWpngWcAdminNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wpng_wc_admin_notes', function (Blueprint $table) {
            $table->bigIncrements('note_id');
            $table->string('name')->nullable();
            $table->string('type', 20)->nullable();
            $table->string('locale', 20)->nullable();
            $table->longText('title')->nullable();
            $table->longText('content')->nullable();
            $table->longText('content_data')->nullable();
            $table->string('status', 200)->nullable();
            $table->string('source', 200)->nullable();
            $table->dateTime('date_created')->default('0000-00-00 00:00:00');
            $table->dateTime('date_reminder')->nullable();
            $table->boolean('is_snoozable')->default(0);
            $table->string('layout', 20)->nullable();
            $table->string('image', 200)->nullable();
            $table->boolean('is_deleted')->default(0);
            $table->string('icon', 200)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wpng_wc_admin_notes');
    }
}
