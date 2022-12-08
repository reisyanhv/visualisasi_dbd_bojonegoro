<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePredictionCriteriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prediction_criterias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('subdistrict_id')->unsigned();
            $table->foreign('subdistrict_id')->references('id')->on('subdistricts')->onDelete('CASCADE');
            $table->bigInteger('year_id')->unsigned();
            $table->foreign('year_id')->references('id')->on('years')->onDelete('CASCADE');
            $table->float('death');
            $table->float('case');
            $table->float('population_density');
            $table->float('rainfall');
            $table->float('desa_sbs');
            $table->float('desa_stbm');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prediction_criterias');
    }
}
