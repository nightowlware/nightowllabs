<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');
        $response->assertRedirect('/login');
    }

    public function testLogin() {
        $response = $this->get('/login')
            ->assertSee('Quickly Register')
            ->assertSee('Login')
            ->assertSee('Forgot Your Password');
    }

//    public function testRegister() {
//    }
}
