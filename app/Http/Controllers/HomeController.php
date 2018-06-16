<?php

namespace App\Http\Controllers;

use App\Log;
use App\LogProductSold;
use App\LogProductView;
use Carbon\Carbon;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;
use Setting;

class HomeController extends Controller
{

    /**
     * Show the application home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];

        return view('home.home', $data);
    }
}
