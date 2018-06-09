<?php

namespace App\Http\Controllers;

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
        $data['top_views'] = LogProductView::query()
            ->where('day', '>=', (new Carbon('yesterday'))->timestamp) //get only today data
            ->orderByDesc('views')  //sort by views number
            ->get()->take(4); //take top 4 products to fit in one line
        $data['top_sold'] = LogProductSold::query()
            ->where('day', '>=', (new Carbon('yesterday'))->timestamp)
            ->orderByDesc('solds')  //sort by sold number
            ->take(4)
            ->get();
        return view('home.home', $data);
    }
}
