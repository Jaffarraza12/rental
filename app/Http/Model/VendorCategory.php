<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class VendorCategory extends Model
{
    //
    protected $table = 'vendor-category';
    public $timestamps = true;
    protected $primaryKey = "id";
}
