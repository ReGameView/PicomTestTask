<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $table = "result";
    public $timestamps = false;

    public function Country()
    {
        return $this->hasOne('App\Country');
    }
}
