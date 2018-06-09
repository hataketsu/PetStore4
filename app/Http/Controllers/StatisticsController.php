<?php

namespace App\Http\Controllers;

use App\LogProductSold;
use App\LogProductView;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Array_;
use PragmaRX\Tracker\Support\Minutes;

class StatisticsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('start')) {
            $start = $request->get('start');
        } else {
            $start = 'today';
        }
        $start = new Carbon($start);


        if ($request->has('end')) {
            $end = $request->get('end');
        } else {
            $end = 'today';
        }
        $end = new Carbon($end);
        $end = $end->addDay(1);
        $end = $end->addSecond(-1);

        FlashToOld::flash_to_old($start->format('M d, Y'), 'start');
        FlashToOld::flash_to_old($end->format('M d, Y'), 'end');

        $minutes = new Minutes();
        $minutes->setStart($start);
        $minutes->setEnd($end);

        $visits = \Tracker::pageViews($minutes);

        $top_view_product_logs = LogProductView::query()
            ->where('day', '>=', $start->timestamp)
            ->where('day', '<=', $end->timestamp)->get();

        $top_sold_product_logs = LogProductSold::query()
            ->where('day', '>=', $start->timestamp)
            ->where('day', '<=', $end->timestamp)->get();

        $data = ['visits' => $visits, 'title' => 'Statistics'];
        $data['top_views']=$top_view_product_logs;
        $data['top_solds']=$top_sold_product_logs;

        return view('stat.visits', $data);
    }
}
