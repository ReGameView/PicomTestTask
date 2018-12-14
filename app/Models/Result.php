<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $table = "result";
    public $timestamps = false;

    public function Country()
    {
        return $this->hasOne('App\Models\Country');
    }
}
