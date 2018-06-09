<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller {

    //show all users to admin
	public function index() {
		return view( 'user.list', [ 'items' => User::all(), 'title' => 'Manage users' ] );
	}


	//delete user
	public function delete( $id ) {
		User::destroy( $id );

		return redirect( '/manage/users' );
	}

    //promote this user to admin
	public function make_admin( $id ) {
		$user = User::findOrFail( $id );

		$user->is_admin = 1;
		$user->save();

		return redirect( '/manage/users' );
	}

    //make this user a normal user
	public function unmake_admin( $id ) {
		$user           = User::findOrFail( $id );
		$user->is_admin = 0;
		$user->save();

		return redirect( '/manage/users' );
	}
}
