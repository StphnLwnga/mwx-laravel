<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWpngWcAdminNoteActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wpng_wc_admin_note_actions', function (Blueprint $table) {
            $table->bigIncrements('action_id');
            $table->unsignedBigInteger('note_id')->index('note_id');
            $table->string('name')->nullable();
            $table->string('label')->nullable();
            $table->longText('query')->nullable();
            $table->string('status')->nullable();
            $table->boolean('is_primary')->default(0);
            $table->string('actioned_text')->nullable();
            $table->string('nonce_action')->nullable();
            $table->string('nonce_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wpng_wc_admin_note_actions');
    }
}
