<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    //
    protected $table = 'attribute';
    public $timestamps = false;
    protected $primaryKey = "attribute_id";
}
