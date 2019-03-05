<?php

namespace App\http\Model;

use Illuminate\Database\Eloquent\Model;

class PaymentCredit extends Model
{
    protected $table = 'payment_credit';
    public $timestamps = true;
    protected $primaryKey = "id";
}
