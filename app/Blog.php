<?php

namespace App;

use App\Http\Controllers\FlashToOld;
use Illuminate\Database\Eloquent\Model;


class Blog extends Model
{
    use \App\CanFillOld;

    protected $fillable = ['title', 'url', 'html_content', 'thumb'];

    //default values for a new created model
    protected $attributes = ['url' => '/', 'thumb' => 'No preview'];

}
