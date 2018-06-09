<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SiteAvailableTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSiteUpAndRunning()
    {
        $this->get("/")->assertResponseStatus(200); //site is running
    }

    public function testSeeLogo()
    {
        $this->visit("/")
            ->see('ANT')
            ->see('Store')
            ->see('Find Your Favorite Or Discover Something New'); //we should see the logo and slogan
    }

    public function testAllProductsPage()
    {
        $this->visit('all' )
            ->see('All products availble');
    }
    public function testSaleoffPage()
    {
        $this->visit('sale_off' )
            ->see('Sale off');
    }
}
