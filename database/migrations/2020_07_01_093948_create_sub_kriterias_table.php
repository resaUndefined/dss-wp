<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubKriteriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_kriteria', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kriteria_id')->unsigned();
            $table->string('keterangan');
            $table->integer('bobot');
            $table->timestamps();

            $table->foreign('kriteria_id')->references('id')
                    ->on('kriteria')->onDelete('cascade')
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
        Schema::dropIfExists('sub_kriteria');
    }
}
