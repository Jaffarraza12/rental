<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    //
    protected $table = 'expense';
    public $timestamps = true;
    protected $primaryKey = "expense_id";
}
