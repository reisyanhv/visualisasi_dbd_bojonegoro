<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('subdistrict_id')->unsigned();
            $table->foreign('subdistrict_id')->references('id')->on('subdistricts')->onDelete('CASCADE');
            $table->bigInteger('year_id')->unsigned();
            $table->foreign('year_id')->references('id')->on('years')->onDelete('CASCADE');
            $table->integer('risk');
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
        Schema::dropIfExists('results');
    }
}
