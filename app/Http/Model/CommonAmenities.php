<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class CommonAmenities extends Model
{
    //
    protected $table = 'common_amenities';
    public $timestamps = false;
    protected $primaryKey = "common_amenity_id";
}
