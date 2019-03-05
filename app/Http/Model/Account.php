<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    //
    protected $table = 'account';
    public $timestamps = true;
    protected $primaryKey = "id";
}
