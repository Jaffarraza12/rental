<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    //
    protected $table = 'applicant';
    public $timestamps = true;
    protected $primaryKey = "applicant_id";
}
