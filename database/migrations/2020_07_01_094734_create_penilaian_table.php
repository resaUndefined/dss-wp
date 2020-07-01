<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenilaianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('alternatif_id')->unsigned();
            $table->integer('periode_id')->unsigned();
            $table->integer('kriteria_id');
            $table->integer('sub_kriteria_id')->unsigned();
            $table->timestamps();

            $table->foreign('alternatif_id')->references('id')
                    ->on('alternatif')->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->foreign('periode_id')->references('id')
                    ->on('nilai_alternatif')->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->foreign('sub_kriteria_id')->references('id')
                    ->on('sub_kriteria')->onDelete('cascade')
                    ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penilaian');
    }
}
