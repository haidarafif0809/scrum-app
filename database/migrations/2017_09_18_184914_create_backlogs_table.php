<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBacklogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('backlogs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('aplikasi_id');
            $table->string('nama_backlog');
            $table->string('demo', 2500);
            $table->string('catatan', 2500);
            $table->integer('created_by')->nullable()->index();
            $table->integer('updated_by')->nullable()->index();
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
        Schema::dropIfExists('backlogs');
    }
}
