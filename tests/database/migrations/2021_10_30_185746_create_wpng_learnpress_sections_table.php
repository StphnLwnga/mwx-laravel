<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWpngLearnpressSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wpng_learnpress_sections', function (Blueprint $table) {
            $table->bigIncrements('section_id');
            $table->string('section_name')->nullable();
            $table->unsignedBigInteger('section_course_id')->default(0)->index('section_course_id');
            $table->unsignedBigInteger('section_order')->default(1);
            $table->longText('section_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wpng_learnpress_sections');
    }
}
