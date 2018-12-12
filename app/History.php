<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = "history";
    public $timestamps = true;
    const UPDATED_AT=NULL;

    public function result()
    {
        return $this->hasMany('App\Result');
    }

    public function country()
    {
        return $this->belongsToMany('App\Country', 'result')->withPivot('percents');
    }
}
