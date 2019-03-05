<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class LeaseExpense extends Model
{
    //

    protected $table = 'lease_expense';
    public $timestamps = true;
    protected $primaryKey = "lease_exp_id";
}
