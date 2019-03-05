<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Lease extends Model
{
    //

    protected $table = 'lease';
    public $timestamps = true;
    protected $primaryKey = "lease_id";

    function LeaseTypeDuration($l){
       $lease = Lease::where('lease_id',$l->lease_id)->first();
       $tt ='';
       if($lease->type == 1){
            $tt = 'Fixed';
       } else if($lease->type == 2) {
            $tt =  'Fixed/Roll Over';
       } else if($lease->type == 3){
            $tt =  'Month to Month';
       }
       return $tt .' '.date('M/d/Y',strtotime($lease->date_start)).'-'.date('M/d/Y',strtotime($lease->date_end));
    }

    function LeaseDaysLeft($l){
        $lease = Lease::where('lease_id',$l->lease_id)->first();
        $start_date = strtotime($lease->date_start);
        $end_date = strtotime($lease->date_end);
        $datediff = $start_date - $end_date;
        return floor($datediff / (60 * 60 * 24));
    }
}
