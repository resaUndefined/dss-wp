<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveColumnTableDatamining extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('datamining', function (Blueprint $table) {
            $table->dropColumn('riwayat_penyakit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('datamining', function (Blueprint $table) {
            $table->string('riwayat_penyakit');
        });
    }
}
