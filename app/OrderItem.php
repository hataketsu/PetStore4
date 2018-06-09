<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//the item in an order
class OrderItem extends Model {
	protected $fillable = [ 'product_id' ];
	protected $attributes = [
		'quantity'    => 0, //quantity of product
		'final_price' => 0  //the product'price at checkout time
	];

	public function product() {
		return $this->belongsTo( 'App\\Product' );
	}

	//save product's price to this final_price
	public function saveFinalPrice() {
		$this->final_price = $this->product->getCost();
	}
}
