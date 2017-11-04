<?php 

use Illuminate\Support\Facades\Schema; 
use Illuminate\Database\Schema\Blueprint; 
use Illuminate\Database\Migrations\Migration; 

class CreateSprintbacklogsTable extends Migration 
{ 

    public function up() 
    { 
        Schema::create('sprintbacklogs', function (Blueprint $table) { 
            $table->increments('id'); 
            $table->string('isi_kepentingan'); 
            $table->string('perkiraan_waktu'); 
            $table->integer('id_sprint');
            $table->integer('id_backlog');
            $table->integer('assign')->default(0);
            $table->integer('assign_user_id')->default(0);
            $table->integer('created_by')->nullable()->index();
            $table->integer('updated_by')->nullable()->index();
            $table->timestamps(); 
        }); 
    } 

    public function down() 
    { 
        Schema::dropIfExists('sprintbacklogs'); 
    } 
} 
