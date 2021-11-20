<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWpngTermTaxonomyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wpng_term_taxonomy', function (Blueprint $table) {
            $table->bigIncrements('term_taxonomy_id');
            $table->unsignedBigInteger('term_id')->default(0);
            $table->string('taxonomy', 32)->nullable()->index('taxonomy');
            $table->longText('description')->nullable();
            $table->unsignedBigInteger('parent')->default(0);
            $table->bigInteger('count')->default(0);
            
            $table->unique(['term_id', 'taxonomy'], 'term_id_taxonomy');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wpng_term_taxonomy');
    }
}
