<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class CrudUserTest extends TestCase
{
	use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCrudUser()
    {
    	// untuk proses tambah 
    	$user = User::create([
    		'name' => 'khoirul',
    		'password' => 'rahasiaku',
    		'email' => 'khoirul@gmail.com',
    		'is_verified' => '1'
    	]);

    	$this->assertDatabaseHas('users', [
    		'name' => 'khoirul',
    		'email' => 'khoirul@gmail.com',
    		'is_verified' => '1'
    	]);

    	// untuk proses edit
    	$userUpdate = User::find($user->id);
    	$userUpdate->update([
    		'name' => 'irul',
    		'email' => 'irul@gmail.com',
    		'is_verified' => '0'
    	]);
    	$this->assertDatabaseHas('users', [
    		'name' => 'irul',
    		'email' => 'irul@gmail.com',
    		'is_verified' => '0'
    	]);

    	// untuk hapus
    	$hapus_user = User::destroy($user->id);
    	$this->assertEquals('1', $hapus_user);
    }
}
