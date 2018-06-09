<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'products', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->string( 'name' );
			$table->longText( 'image_urls' );
			$table->longText( 'short_detail' );
			$table->longText( 'full_html_detail' );
			$table->float( 'price' );
			$table->float( 'sale_off' );

			$table->integer( "category_id" )->unsigned()->index();
			$table->foreign( 'category_id' )->references( 'id' )->on( 'categories' )->onDelete( 'no action' );

			$table->integer( 'sold' );
			$table->integer( 'views' );
			$table->timestamps();
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( 'products' );
	}
}
