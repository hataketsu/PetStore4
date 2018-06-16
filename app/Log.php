<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{

    const USER_REGISTER = "user_reg";
    const USER_CREATED = 'user_created';
    const CHECKOUT = 'checkout';
    const SEARCH = 'search';
    const ORDER_DISPOSE = 'order_dispose';
    const ORDER_CONFIRMED = 'order_confirm';
    const ORDER_SHIP = 'order_ship';
    const ORDER_DONE = 'order_done';
    const REVENUE = 'revenue';
    const SELL = 'sell';
    const PRODUCT_VIEW = 'p_view';
    const PRODUCT_CREATED = 'p_created';
    const VIEWS = 'views';
    const DATE = 'DATE';

    protected $fillable = [
        Log::USER_REGISTER,
        Log::USER_CREATED,
        Log::ORDER_DISPOSE,
        Log::ORDER_CONFIRMED,
        Log::ORDER_SHIP,
        Log::ORDER_DONE,
        Log::PRODUCT_CREATED,
        Log::REVENUE,
        Log::VIEWS,
        Log::DATE,
        Log::CHECKOUT,
    ];
    protected $attributes = [
        Log::USER_REGISTER => 0,
        Log::USER_CREATED => 0,
        Log::ORDER_DISPOSE => 0,
        Log::ORDER_CONFIRMED => 0,
        Log::ORDER_SHIP => 0,
        Log::ORDER_DONE => 0,
        Log::PRODUCT_CREATED => 0,
        Log::REVENUE => 0,
        Log::VIEWS => 0,
        Log::DATE => 0,
        Log::CHECKOUT => 0,
    ];

    public static function logInc($key, $value = 1)
    {
        $log = self::_get();
        $log[$key] += $value;
        $log->save();
    }

    /**
     * @return Model|\Illuminate\Support\Collection
     */
    public static function _get(): Model
    {
        return Log::firstOrCreate(['date' => Carbon::today()->timestamp]);
    }


}
