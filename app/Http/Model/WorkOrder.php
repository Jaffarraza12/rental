<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    //
    protected $table = 'work_order';
    public $timestamps = true;
    protected $primaryKey = "work_order_id";
}
