<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{

     public function testRootRoute()
     {
         $response = $this->get('/');
         $response->assertStatus(302);
     }

     public function testLoginRoute()
     {
         $response = $this->get('/login');
         $response->assertStatus(200);
     }
}
