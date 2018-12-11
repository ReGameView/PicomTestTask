<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = "history";

    protected $fillable = ['search', 'result'];

    public $timestamps = true;

    const UPDATED_AT=NULL;
}
