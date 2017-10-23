<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Backlog;

class crudBacklog extends TestCase
{
	use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCrudBacklog()
    {

    	$backlog = Backlog::create(
    		[
    			"aplikasi_id" => 5,
    			"nama_backlog" => "tes nama backlog",
    			"demo" => "tes demo",
    			"catatan" => "tes catatan"
    		]
    	);
		$this->assertDatabaseHas('backlogs', [
    			"aplikasi_id" => 5,
    			"nama_backlog" => "tes nama backlog",
    			"demo" => "tes demo",
    			"catatan" => "tes catatan"
		    ]);
		Backlog::where("id_backlog", $backlog->id_backlog)->update(
			[
    			"aplikasi_id" => 6,
    			"nama_backlog" => "tes nama backlog update",
    			"demo" => "tes demo update",
    			"catatan" => "tes catatan update"
			]
		);
		$this->assertDatabaseHas('backlogs', [
    			"aplikasi_id" => 6,
    			"nama_backlog" => "tes nama backlog update",
    			"demo" => "tes demo update",
    			"catatan" => "tes catatan update"
		      ]);
		$hapus_backlog = Backlog::destroy($backlog->id_backlog);
		$this->assertDatabaseMissing('backlogs', [
                "aplikasi_id" => 6,
                "nama_backlog" => "tes nama backlog update",
                "demo" => "tes demo update",
                "catatan" => "tes catatan update"
              ]);
    }
}
