<?php

namespace App\Http\Controllers;

use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $data = collect();
        $data=$data->merge(Product::get_sold());

        $data['products_added']=\App\Product::whereDate('updated_at','>',new Carbon('last month'))->count();

        return view('dashboard.dashboard', $data);
    }
}
