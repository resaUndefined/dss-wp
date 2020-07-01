<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKriteriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kriteria', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode')->unique();
            $table->string('nama');
            $table->boolean('jenis')->default(1);
            $table->integer('bobot');
            $table->boolean('kluster')->default(0);
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
        Schema::dropIfExists('kriteria');
    }
}
