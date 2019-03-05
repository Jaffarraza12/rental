<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = 'inventory';
    public $timestamps = true;
    protected $primaryKey = "id";
}
