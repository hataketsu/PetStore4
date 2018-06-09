<?php

namespace App;

use App\Http\Controllers\FlashToOld;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use \App\CanFillOld;

    protected $fillable = ['name', 'code', 'type', 'discount'];

    //there're 2 types of discount code: by percent on total final price or discount directly by money on final price
    const TYPES = ['percent' => 'Tương đối (%)',
        'total' => 'Tuyệt đồi ($)'];

    //default values
    protected $attributes = ['used_time' => 0];

}
