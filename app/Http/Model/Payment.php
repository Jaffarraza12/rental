<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Response;
use datetime;
use Illuminate\Support\Facades\DB;

class Payment extends Model
{
    //
    protected $table = 'payment';
    public $timestamps = true;
    protected $primaryKey = "payment_id";


    function PaymentAdjustment($request,$lease_id){
        //payment adjustment
        switch ($request->lease_prefer){
            case('Monthly'):
                $month = 0;
                while(strtotime(strtotime($request->starting_date) . "+".$month." months") < $request->end_date){
                    Payment::insert([
                        'amount' => $request->rate,
                        'lease_id' => $lease_id,
                        'building_id' => $request->building_id,
                        'unit_id' => $request->unit_id,
                        'due_date' => date('Y-m-d',strtotime(strtotime($request->starting_date) . "+".$month." months")),
                        'payment_type' => "lease",
                        'status' => 0,
                        'created_at' => time(),
                        'updated_at' => time()
                    ]);
                    $month +=1;
                }
                break;
            case('Bi-Monthly'):
                $month = 0;
                while(strtotime(strtotime($request->starting_date) . "+".$month." months") < $request->end_date){
                    Payment::insert([
                        'amount' => $request->rate,
                        'lease_id' => $lease_id,
                        'building_id' => $request->building_id,
                        'unit_id' => $request->unit_id,
                        'due_date' => date('Y-m-d',strtotime(strtotime($request->starting_date). "+".$month." months")),
                        'payment_type' => "lease",
                        'status' => 0,
                        'created_at' => time(),
                        'updated_at' => time()
                    ]);
                    //echo date('Y-m-d',strtotime($request->from . "+".$month." months")).'<br/>';
                    $month +=2;
                }
                break;
            case('Quarterly'):
                $month = 0;
                while(strtotime(strtotime($request->starting_date) . "+".$month." months") < $request->end_date ){
                    Payment::insert([
                        'amount' => $request->rate,
                        'lease_id' => $lease_id,
                        'building_id' => $request->building_id,
                        'unit_id' => $request->unit_id,
                        'due_date' => date('Y-m-d',strtotime(strtotime($request->starting_date). "+".$month." months")),
                        'payment_type' => "lease",
                        'status' => 0,
                        'created_at' => time(),
                        'updated_at' => time()
                    ]);
                    //echo date('Y-m-d',strtotime($request->from . "+".$month." months")).'<br/>';
                    $month +=4;
                }
                break;
            case('Every-6-month'):
                $month = 0;
                while(strtotime(strtotime($request->starting_date) . "+".$month." months") < $request->end_date){
                    Payment::insert([
                        'amount' => $request->rate,
                        'lease_id' => $lease_id,
                        'building_id' => $request->building_id,
                        'unit_id' => $request->unit_id,
                        'due_date' => date('Y-m-d',strtotime(strtotime($request->starting_date). "+".$month." months")),
                        'payment_type' => "lease",
                        'status' => 0,
                        'created_at' => time(),
                        'updated_at' => time()
                    ]);
                    //echo date('Y-m-d',strtotime($request->from . "+".$month." months")).'<br/>';
                    $month +=6;
                }
                break;
            case('Yearly'):
                $month = 0;
                while(strtotime(strtotime($request->starting_date) . "+".$month." months") < $request->end_date){
                    Payment::insert([
                        'amount' => $request->rate,
                        'lease_id' => $lease_id,
                        'building_id' => $request->building_id,
                        'unit_id' => $request->unit_id,
                        'due_date' => date('Y-m-d',strtotime(strtotime($request->starting_date). "+".$month." months")),
                        'payment_type' => "lease",
                        'status' => 0,
                        'created_at' => time(),
                        'updated_at' => time()
                    ]);
                    $month +=12;
                }
                break;
        }
        //Other Expenses
        $j=0;
        foreach ($request->expense as $exp):
            if(!empty($exp)) {
                $lease_exp = new LeaseExpense();
                $lease_exp->lease_id = $lease_id;
                $lease_exp->description = $exp;
                $lease_exp->amount = $request->amount[$j];
                $lease_exp->frequency = $request->frequency[$j];
                $lease_exp->variable = $request->variable[$j];
                $lease_exp->save();
                $lease_exp_id = $lease_exp->lease_exp_id;
                Response::json(array('success' => true, 'last_insert_id' => $lease_exp_id), 200);
                switch ($request->frequency[$j]) {
                    case("once_start"):
                        Payment::insert([
                            'amount' => $request->amount[$j],
                            'lease_id' => $lease_id,
                            'lease_exp_id' => $lease_exp_id,
                            'building_id' => $request->building_id,
                            'unit_id' => $request->unit_id,
                            'due_date' => date('Y-m-d', $request->starting_date),
                            'payment_type' => "lease_other",
                            'status' => 0,
                            'created_at' => time(),
                            'updated_at' => time()
                        ]);
                        break;
                    case("once_end"):
                        Payment::insert([
                            'amount' => $request->amount[$j],
                            'lease_id' => $lease_id,
                            'lease_exp_id' => $lease_exp_id,
                            'building_id' => $request->building_id,
                            'unit_id' => $request->unit_id,
                            'due_date' => date('Y-m-d', $request->end_date),
                            'payment_type' => "lease_other",
                            'status' => 0,
                            'created_at' => time(),
                            'updated_at' => time()
                        ]);
                        break;
                    case("monthly"):
                        $mon = 0;
                        while (strtotime(strtotime($request->starting_date) . "+" . $mon . " months") < $request->end_date) {
                            Payment::insert([
                                'amount' => $request->amount[$j],
                                'lease_id' => $lease_id,
                                'lease_exp_id' => $lease_exp_id,
                                'building_id' => $request->building_id,
                                'unit_id' => $request->unit_id,
                                'due_date' => date('Y-m-d', strtotime(strtotime($request->starting_date) . "+" . $mon . " months")),
                                'payment_type' => "lease_other",
                                'status' => 0,
                                'created_at' => time(),
                                'updated_at' => time()
                            ]);
                            $mon += 1;
                        }
                        break;
                    case("yearly"):
                        $mo = 0;
                        while (strtotime(strtotime($request->starting_date) . "+" . $mo . " months") < $request->end_date) {
                            Payment::insert([
                                'amount' => $request->amount[$j],
                                'lease_id' => $lease_id,
                                'lease_exp_id' => $lease_exp_id,
                                'building_id' => $request->building_id,
                                'unit_id' => $request->unit_id,
                                'due_date' => date('Y-m-d', strtotime(strtotime($request->starting_date) . "+" . $mo . " months")),
                                'payment_type' => "lease_other",
                                'status' => 0,
                                'created_at' => time(),
                                'updated_at' => time()
                            ]);
                            $mo += 12;
                        }
                        break;
                }
                $j++;
            }
        endforeach;

    }

    public  function Noofday($payment){
        $date1 = new DateTime(date('Y-m-d'));
        $date2 = new DateTime($payment['due_date']);
        //$date2 = new DateTime('2017-02-01');

        $interval = $date1->diff($date2);
        if($date2 > $date1){
            return $payment['due_date'].' ('.$interval->format('due in %a days ').')';
        } else {
            return $payment['due_date'].' ('.  $interval->format('%a days delayed').')';
        }
    }



    function RemainingAmount($lease,$per){

        switch ($per) {
            case('mon'):
                $result = DB::select( DB::raw("SELECT SUM(amount) as AMT FROM `payment` WHERE  lease_id='$lease->lease_id' AND due_date BETWEEN NOW() - INTERVAL 30 DAY AND NOW()  ") );
                 return $result[0]->AMT;
             break;
            case('bi'):
                $result = DB::select( DB::raw("SELECT SUM(amount) as AMT FROM `payment` WHERE  lease_id='$lease->lease_id' AND due_date BETWEEN NOW() - INTERVAL 60 DAY AND NOW() - INTERVAL 30 DAY  ") );
                return $result[0]->AMT;
            break;
            case('th'):
                $result = DB::select( DB::raw("SELECT SUM(amount) as AMT FROM `payment` WHERE  lease_id='$lease->lease_id' AND due_date BETWEEN NOW() - INTERVAL 90 DAY AND NOW() - INTERVAL 60 DAY  ") );
                return $result[0]->AMT;
            break;
            case('fr'):
                $result = DB::select( DB::raw("SELECT SUM(amount) as AMT FROM `payment` WHERE  lease_id='$lease->lease_id' AND due_date < NOW() - INTERVAL 90 DAY ") );
                return $result[0]->AMT;
            break;
            case('ti'):
                $result = DB::select( DB::raw("SELECT SUM(amount) as AMT FROM `payment` WHERE  lease_id='$lease->lease_id' AND due_date < NOW() ") );
                return $result[0]->AMT;
            break;
        }
    }


}
