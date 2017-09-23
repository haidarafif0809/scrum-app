<?php 
 
use Illuminate\Support\Facades\Schema; 
use Illuminate\Database\Schema\Blueprint; 
use Illuminate\Database\Migrations\Migration; 
 
class CreateSprintbacklogsTable extends Migration 
{ 
    /** 
     * Run the migrations. 
     * 
     * @return void 
     */ 
    public function up() 
    { 
        Schema::create('sprintbacklogs', function (Blueprint $table) { 
            $table->increments('id'); 
            $table->string('backlog'); 
            $table->string('isi_kepentingan'); 
            $table->string('perkiraan_waktu'); 
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
        Schema::dropIfExists('sprintbacklogs'); 
    } 
} 
