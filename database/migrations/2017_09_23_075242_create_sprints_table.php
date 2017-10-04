<?php 
 
use Illuminate\Support\Facades\Schema; 
use Illuminate\Database\Schema\Blueprint; 
use Illuminate\Database\Migrations\Migration; 
 
class CreateSprintsTable extends Migration 
{ 
    /** 
     * Run the migrations. 
     * 
     * @return void 
     */ 
    public function up() 
    { 
        Schema::create('sprints', function (Blueprint $table) { 
            $table->increments('id'); 
            $table->string('kode_sprint'); 
            $table->string('nama_sprint');
            $table->date('tanggal_mulai')->nullable(); 
            $table->string('durasi')->nullable(); 
            $table->string('waktu_mulai')->nullable(); 
            $table->integer('team')->nullable(); 
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
        Schema::dropIfExists('sprints'); 
    } 
} 