<?php

namespace App;

use App\Http\Controllers\FlashToOld;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    use \App\CanFillOld;

    //the values that can be filled directly from requests
    protected $fillable = [ 'url' ];
}
