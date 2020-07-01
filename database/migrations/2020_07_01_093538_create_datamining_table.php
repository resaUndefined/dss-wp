<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataminingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datamining', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->boolean('gender')->default(1);
            $table->integer('umur');
            $table->string('riwayat_penyakit');
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
        Schema::dropIfExists('datamining');
    }
}
