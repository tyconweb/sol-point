<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Noc extends Model
{
    protected $fillable = [
        'empid','category', 'details', 'bottom',
    ];
}
