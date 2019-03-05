<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class UserBuilding extends Model
{
    protected $table = 'user_building';
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $fillable = [
        'user_id', 'building_id',
    ];
}
