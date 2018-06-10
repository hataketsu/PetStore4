<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

//user's editing profile controller
class ProfileController extends Controller
{
    //show all user's info
    public function info(Request $request)
    {
        \Auth::user()->fill_olds();
        return view('profile.info');
    }

    //save edited info
    public function save_info(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric|min:10',
            'address' => 'required|string',
        ]);
        \Auth::user()->fill($request->all());
        \Auth::user()->save();

        \Session::flash('message', 'Đã đổi thông tin cá nhân!');

        return redirect('/profile/info');
    }

    //change password page
    public function change_password(Request $request)
    {
        return view('profile.password');
    }

    //save new password
    public function save_password(Request $request)
    {

        //validate inputs
        //the new password must be not null, different from old password
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed|different:old_password',
        ]);
        $user = \Auth::user(); //get the current logged-in user
        if (\Hash::check($request->get('old_pw'), $user->password)) { //check if old password is match with hashed password
            $user->password = \Hash::make($request->get('new_pw')); //update new password
            $user->save(); //save info
            \Session::flash('message', 'Đã đổi mật khẩu!');
        } else {
            \Session::flash('error', 'Sai mật khẩu cũ!');
        }
        return redirect('/profile/password');
    }

}
