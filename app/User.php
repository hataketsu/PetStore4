<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $about
 * @property string $phone
 * @property string $address
 * @property int $is_admin
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereAbout( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereAddress( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsAdmin( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePhone( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt( $value )
 */
class User extends Authenticatable {
	use Notifiable;
    use \App\CanFillOld;


    /**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'email',
		'phone',
		'address',
		'password'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];
	protected $attributes = [
		'phone'    => "000",
		'address'  => "chưa có ",
		'is_admin' => false
	];

	public function orders() {
		return $this->hasMany( 'App\\Order' );
	}

	public function liked_products() {
		return $this->belongsToMany( Product::class,'wishes' );
	}
}
