<!-- <?php

<<<<<<< HEAD:tests/ExampleTest.php
// use Illuminate\Foundation\Testing\WithoutMiddleware;
// use Illuminate\Foundation\Testing\DatabaseMigrations;
// use Illuminate\Foundation\Testing\DatabaseTransactions;
=======
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
>>>>>>> master:tests/Feature/ExampleTest.php

// class ExampleTest extends TestCase
{
<<<<<<< HEAD:tests/ExampleTest.php
    // *
     // * A basic functional test example.
     // *
     // * @return void
     
    // public function testBasicExample()
    {
        // $this->visit('/')
             // ->see('Laravel');
=======
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
>>>>>>> master:tests/Feature/ExampleTest.php
    }
}
 // -->