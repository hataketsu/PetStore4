<?php

namespace Tests\Feature;

use App\Bread;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BreadTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $bread=Bread::create(['ingredient'=>['aa','bb']]);
        print_r($bread->ingredient[0]);
        $this->assertTrue(true);
    }
}
