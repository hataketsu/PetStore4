<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'orders', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->integer( "user_id" )->unsigned()->nullable()->index();//author
			$table->foreign( 'user_id' )->references( 'id' )->on( 'users' )->onDelete( 'cascade' );
			$table->string('name');
			$table->string('email');
			$table->string('phone');
			$table->string('address');
			$table->longText('note');
			$table->string( 'status' ); //in order config

			$table->timestamps();
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( 'orders' );
	}
}
