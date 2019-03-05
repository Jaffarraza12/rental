<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class PaymentReceived extends Model
{
    protected $table = 'payment_Debit';
    public $timestamps = true;
    protected $primaryKey = "id";
}
