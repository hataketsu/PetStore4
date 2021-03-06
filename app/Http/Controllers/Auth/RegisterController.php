<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Log;
use App\User;
use Bestmomo\LaravelEmailConfirmation\Traits\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

//use Illuminate\Foundation\Auth\RegistersUsers;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        Log::logInc(Log::USER_CREATED);
        return $user;
    }

    //process confirm link from email
    public function confirm($id, $confirmation_code)
    {
        $model = $this->guard()->getProvider()->createModel();
        $user = $model->whereId($id)->whereConfirmationCode($confirmation_code)->firstOrFail(); //find the user with matched confirmation code
        $user->confirmation_code = null;    //remove the confirmation code
        $user->confirmed = true;            //confirm thìs user
        $user->save();                      //save to database
        \Auth::login($user);                //login this user
        Log::logInc(Log::USER_REGISTER);
        return redirect('/')->with('message', 'Đã xác nhận email. Có thể đăng nhập được '); //redirect user to home with success message
    }
}
