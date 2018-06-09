<?php

namespace Tests\Unit;

use App\Product;
use Tests\TestCase;


class ProductTest extends TestCase
{
    private $product_name = 'New test product';
    private $product_price = 110;
    private $product_sale = 100;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testNewProduct()
    {
        Product::whereName($this->product_name)->delete();
        $product = Product::create(
            [
                'name' => $this->product_name,
                'price' => $this->product_price,
                'sale_off' => $this->product_sale,
                'full_html_detail' => 'nope',
                'image_urls' => 'no-thumbnail.png',
                'short_detail' => '_',
                'sold' => 0,
                'views' => 0,
            ]
        );

        self::assertTrue(true);
    }

    public function testCkeckCreatedProduct()
    {
        $product = $this->findProduct();
        $this->assertTrue($product->name == $this->product_name);
        $this->assertTrue($product->price == $this->product_price);
    }

    public function testViewProduct()
    {
        $product = $this->findProduct();
        $this->visit('/products/' . $product->id)
            ->see($this->product_name)
            ->dontSee('Sorry, the page you are looking for could not be found.')
            ->see("Sale-off")
            ->see( $product->category->name)
            ->see('(0 customs reviews)');
    }

    public function testDeleteProduct()
    {
        Product::whereName($this->product_name)->delete();
        self::assertTrue(true);
    }

    public function findProduct()
    {
        return Product::whereName($this->product_name)->get()->first();
    }

}
