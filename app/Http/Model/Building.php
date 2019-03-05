<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    //
    protected $table = 'building';
    public $timestamps = true;
    protected $primaryKey = "building_id";
}
