<?php

namespace App;

use App\Http\Controllers\FlashToOld;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Category
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereCreatedAt( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereId( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereName( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereUpdatedAt( $value )
 */
class Category extends Model {
    use \App\CanFillOld;


    protected $fillable = [ 'name', 'sort' ];

	public function products() {
		return $this->hasMany( 'App\Product' );
	}

}
