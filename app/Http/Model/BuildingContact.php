<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class BuildingContact extends Model
{
    //
    protected $table = 'building_contact';
    public $timestamps = false;
    protected $primaryKey = "building_contact_id";
}
