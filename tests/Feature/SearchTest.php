<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SearchTest extends TestCase
{
    public $search_name = 'Eye';


    /**
     * A basic test example.
     *
     * @return void
     */
    public function testQuery()
    {
        $this->visit('search?query=' . $this->search_name)
            ->see('Results of searching for "Eye"');
    }


}
