<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Http\Controllers\HomeController;


class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $hc = new HomeController();
        $user_answer = $hc->makeAnswers(1, 1, 1);
        $this->assertTrue($user_answer->user_id == 1);
    }
}
