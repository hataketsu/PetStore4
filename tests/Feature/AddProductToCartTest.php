<?php

namespace Tests\Feature;

use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddProductToCartTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAddAndRremoveProduct()
    {
        $product=Product::first();
        $number='129';
        $this->visit("/cart/add/$product->id/$number" )->seeStatusCode(200); //ajax api adding product to cart
        $this->visit('/cart')->see('Added to cart!')->see($product->name)->see($number);  //in cart we should see the product now
        $this->visit("/cart/remove/$product->id" )->seeStatusCode(200); //ajax api removing product from cart
        $this->visit('/cart')->dontSee($product->name);  //in cart we shouldn't see the product now
    }
}
