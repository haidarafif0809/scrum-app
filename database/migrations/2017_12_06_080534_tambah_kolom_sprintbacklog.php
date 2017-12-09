<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TambahKolomSprintbacklog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sprintbacklogs', function (Blueprint $table) {
            $table->integer('total_waktu')->default(0);
            $table->integer('pause')->default(0);
            $table->integer('waktu_pause')->default(0);
            $table->integer('waktu_play')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
