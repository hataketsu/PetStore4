<?php

namespace App\Http\Controllers;

use App\Log;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    private static function getYears(Carbon $start, Carbon $end)
    {
        $years = $end->diffInYears($start);
        $result = collect();

        $log = new Log();
        $list = collect($log->getFillable())->except('date');
        for ($i = 0; $i <= $years; $i++) {
            $nextYear = $start->copy();
            $nextYear->addYear(1);
            $item = collect();
            $logs = Log::query()->whereBetween('date', [$start->timestamp, $nextYear->timestamp])->get();
            foreach ($list as $key) {
                $item[$key] = $logs->pluck($key)->sum();
            }
            $item->label = $start->year;
            $result[$i] = $item;
            $start = $nextYear;
        }
        return $result;
    }

    private static function getMonths(Carbon $start, Carbon $end)
    {
        $months = $end->diffInMonths($start);

        $result = collect();

        $log = new Log();
        $list = collect($log->getFillable())->except('date');
        for ($i = 0; $i <= $months; $i++) {
            $nextMonth = $start->copy();
            $nextMonth->addMonth(1);
            $item = collect();
            $logs = Log::query()->whereBetween('date', [$start->timestamp, $nextMonth->timestamp])->get();
            foreach ($list as $key) {
                $item[$key] = $logs->pluck($key)->sum();
            }
            $item->label = $start->year . '/' . $start->month;
            $result[$i] = $item;
            $start = $nextMonth;
        }
        return $result;
    }

    private function getDays(Carbon $start, Carbon $end)
    {
        $days = $end->diffInDays($start);

        $result = collect();

        for ($i = 0; $i <= $days; $i++) {
            $result[$i] = Log::firstOrNew(['date' => $start->timestamp]);
            $result[$i]->label = $start->toDateString();
            $start->addDay(1);
        }
        return $result;
    }

    public function index(Request $request)
    {

        if ($request->has('start')) {
            $start = $request->get('start');
        } else {
            $start = 'today - 6 day';
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

        $data = ['title' => 'Thống kê'];
        if ($end->diffInYears($start) > 2) {
            $data['logs'] = $this::getYears($start, $end);
        } else if ($end->diffInMonths($start) > 3) {
            $data['logs'] = $this::getMonths($start, $end);
        } else {
            $data['logs'] = $this::getDays($start, $end);
        }


        return view('stat.visits', $data);
    }
}
