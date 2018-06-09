<?php

namespace Tests\Feature;

use App\Discount;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DiscountTest extends TestCase
{
    public $discount = 23;
    /**
     * A basic test example.
     *
     * @return void
     */
    public $code = 'NEVERALONE';

    public function testCreateDiscount()
    {
        $discount_code = $this->getCode('percent'); //get a new sample code

        $this->assertSame($discount_code->code, $this->code); //check if created code successfully or not

        $discount_code->delete();   //cleanup
    }

    public function testUsePercentDiscount()
    {
        $discount_code = $this->getCode('percent');

        $this->visit('/apply_discount?discount=' . $discount_code->code)//apply a code
        ->see('Discount code is applied!')
            ->see("-$this->discount%");

        $discount_code->delete();
    }

    public function testUseTotalDiscount()
    {
        $discount_code = $this->getCode('total');

        $this->visit('/apply_discount?discount=' . $discount_code->code)
            ->see('Discount code is applied!')
            ->see("-$this->discount$");

        $discount_code->delete();
    }

    public function testInvalidCode()
    {
        $discount_code = $this->getCode('total');
        $discount_code->delete();

        $this->visit('/apply_discount?discount=' . $discount_code->code)//apply code that doesn't exist
        ->dontSee('Discount code is applied!')
            ->see('Discount code is invalid!');                         //it shouldn't successful

    }

    public function getCode($type): \Illuminate\Database\Eloquent\Model //create a sample discount code
    {
        return Discount::query()->firstOrCreate(
            [
                'name' => 'Code sample',
                'code' => $this->code,
                'type' => $type,
                'discount' => $this->discount
            ]);
    }
}
