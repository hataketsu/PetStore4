<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogRevenue extends Model
{
    protected $fillable = ['day'];
    public $timestamps = false;
}
