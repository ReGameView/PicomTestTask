<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = "history";
    public $timestamps = true;
    const UPDATED_AT=NULL;

    public function result()
    {
        return $this->hasMany('App\Models\Result');
    }

    public function country()
    {
        return $this->belongsToMany('App\Models\Country', 'result')->withPivot('percents');
    }
}
