<?php


use Laravel\BrowserKitTesting\TestCase;

class ViewTest extends TestCase
{
    use \Tests\CreatesApplication;

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->visit('/')
            ->see('PetStore')
            ->dontSee("Sorry, the page you are looking for could not be found.");

        $product = \App\Product::create([
            'name' => 'test',
            'image_urls' => 'no_image.png',
            'short_detail' => '_',
            'full_html_detail' => 'nope',
            'price' => 100,
            'sale_off' => 100,
        ]);
        $product->delete();
        $this->assertTrue(true);
    }

}
