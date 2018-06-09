<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bread extends Model
{
    protected $casts = ['ingredient' => 'array'];
    protected $fillable=['ingredient'];
}
