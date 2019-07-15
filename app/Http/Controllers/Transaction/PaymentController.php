<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Model\PaymentCredit;
use App\Http\Model\PaymentDone;
use App\Http\Model\PaymentReceived;
use App\Http\Model\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Payment;
use App\Http\Model\Lease;
use Illuminate\Support\Facades\Session;
use App\Http\Model\Building;
use App\Http\Model\Tenant;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Expr\Print_;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    var $active_menu;
    public function __construct()
    {
        $this->active_menu = 'payment';
    }
    public function index(Request $request){
        $userId = Auth::id();
        $heading = "Payment Records";
        $breadcrumb = array(
            'Home'=> URL('/'),
            'Payments'=> URL('payment')

        );

        $buildingId = $request->session()->get('defaultBuilding');
        $units=array();
        $building = DB::table('building')->select('name')->where('building_id',$buildingId)->first();
        foreach(Unit::where('building_id',$buildingId)->get() as $unit){
            $units[$unit->unit_id] = $unit->name;
        }
        $tenant	= array();
        foreach(tenant::where('user_id',$userId)->get() as $tenan){
            $tenant[$tenan->id] = $tenan->name;
        }
        return view('transaction.payment.list_view',[
            'heading' => $heading,
            'breadcrumb' => $breadcrumb,
            'active_menu' => $this->active_menu,
            'building' => $building,
            'units' => $units,
            'tenant' => $tenant,
            'ActiveMenu' => "payment",
            'ActionURL' => URL('/payment')
        ]);

    }

    public function getData(Request $request) {

        $buildingId = $request->session()->get('defaultBuilding');
        $userId = Auth::id();
        $payment =  Datatables::of(Payment::select("payment.payment_id","payment.payment","payment.lease_id","payment.amount","payment.due_date","payment.user_id","building.name","unit.name as Unitname","lease_expense.description" )
            ->leftJoin("building","building.building_id","=","payment.building_id")
            ->leftJoin("unit","unit.unit_id","=","payment.unit_id")
            ->leftJoin("lease","lease.lease_id","=","payment.lease_id")
            ->leftJoin("lease_expense","lease_expense.lease_exp_id","=","payment.lease_exp_id")
            ->where('payment.building_id',$buildingId)
            ->OrderBy("payment.due_date")
        )->editColumn('payment',
            '@if($payment == 2)
					Payment Recieved
				@else
				    Not Recieved	
				@endif')
            ->editColumn('description',
                '@if($description == "")
					{{"Rent Payment"}}
				@else 
				 {{$description}}
				@endif')
            ->addColumn('actions',
                '<div class="btn-group">
 
  <button type="button" class="btn dropdown-toggle flag_green" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #fff">
    <span >ACTION</span>
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu">
    <li><a title="Complete Payment" class="pop" data-url="{{ URL("/payment/".$lease_id)}}">Edit</a></li>
  </ul>
</div>
<a title="Complete Payment" class="pop" data-url="{{ URL("/payment/".$lease_id)}}" style="display:none;">
                         <i class="fa fa-money"></i> </a>')
            ->filter(function($query){
                if (Input::get('payment.building_id')) {
                    $query->where('building.building_id', '=', Input::get('building_id'));
                }
                if (Input::get('unit_id')) {
                    $query->where('payment.unit_id', '=', Input::get('unit_id'));
                }
                if (Input::get('tenant_id')) {
                    $query->where('lease.tenant_id', '=', Input::get('tenant_id'));
                }
                if (Input::get('payment_type')) {
                    if(Input::get('payment_type') == '012'){
                        $query->where('payment.payment_type', '=', 'lease');
                    } else {
                        $query->where('lease_expense.description', '=', Input::get('payment_type'));
                    }
                }
                if (Input::get('to')) {

                    if(Input::get('to') && Input::get('from')){
                        $query->whereBetween('lease.date_start',array(Input::get('from'),Input::get('to')));
                    } else if(Input::get('to')) {
                        $query->where('lease.date_start', '=<', Input::get('payment_type'));
                    }
                }
            })

            ->make(true);

        return $payment;

    }

     public  function  getAdd($request){
        $payments = Payment::select("payment.payment_id","payment.lease_id","payment.amount","payment.due_date","building.name","unit.name as Unitname","lease_expense.description" )
            ->leftJoin("building","building.building_id","=","payment.building_id")
            ->leftJoin("unit","unit.unit_id","=","payment.unit_id")
            ->leftJoin("lease","lease.lease_id","=","payment.lease_id")
            ->leftJoin("lease_expense","lease_expense.lease_exp_id","=","payment.lease_exp_id")
            ->where("payment.lease_id",61)->OrderBy("payment.due_date")->get();
        $payment = array();
        foreach($payments as $pay){
            if($pay->description){
                $payment[$pay->payment_id] = 'Payment for '.$pay->description .' of '.$pay->name ." ".$pay->Unitname. " for the month of ".date('M,Y',strtotime($pay->due_date));
            } else {
                $payment[$pay->payment_id] = 'Payment for RENT of '.$pay->name ." ".$pay->Unitname. " for the month of ".date('M,Y',strtotime($pay->due_date));
            }

        }
        return view('transaction.payment.add',[
            'heading' => 'Add Payment',
            'payments' => $payment,
            'lease_id' => $request,
            'ActionURL' => URL('/paymentmade')
        ]);
    }


    public function paymentMade(Request $request){

        $pay = new Payment();
        $pay->mode = $request->payment_mode;
        $pay->amount = $request->pay_amount;
        $pay->date = $request->date;
        $pay->owner_fname = $request->owner_fname;
        $pay->owner_lname = $request->owner_lname;
        $pay->account_type = $request->account_type;
        $pay->routing_no = $request->routing_no;
        $pay->account_no = $request->account_no;

        if( $request->cheque_no ) {
            $pay->cheque_no = $request->cheque_no;
        } else {
            $pay->cheque_no = '';
        }



        /*PaymentDone::insert([
            'payment_id' => $pay->payment_id,
            'mode' => $pay->mode,
            'amount' => $pay->amount,
            'date' => $pay->date,
            'owner_fname' => $pay->owner_fname,
            'owner_lname' => $pay->owner_lname,
            'account_type' => $pay->account_type,
            'routing_no' => $pay->routing_no,
            'account_no' => $pay->account_no,
            'cheque_no' => $pay->cheque_no
        ]);

        Session::flash('success_message', ' New Payment Has been Added !');*/

        $payments = Payment::select("payment.payment_id","payment.lease_id","payment.amount","payment.due_date","building.name","unit.name as Unitname","lease_expense.description" )
            ->leftJoin("building","building.building_id","=","payment.building_id")
            ->leftJoin("unit","unit.unit_id","=","payment.unit_id")
            ->leftJoin("lease","lease.lease_id","=","payment.lease_id")
            ->leftJoin("lease_expense","lease_expense.lease_exp_id","=","payment.lease_exp_id")
            ->where("payment.lease_id",$request->lease_id)->OrderBy("payment.due_date")->get();
        $payment = array();
        foreach($payments as $pay){
            if($pay->description){
                $payment[$pay->payment_id] = 'Payment for '.$pay->description .' of '.$pay->name ." ".$pay->Unitname. " for the month of ".date('M,Y',strtotime($pay->due_date));
            } else {
                $payment[$pay->payment_id] = 'Payment for RENT of '.$pay->name ." ".$pay->Unitname. " for the month of ".date('M,Y',strtotime($pay->due_date));
            }

         /*   echo "<pre>";
            print_r($pay['payment_id']);
            echo "</pre>";*/


        }



        return view('transaction.payment.add',[
            'heading' => 'Add Payment',
            'payments' => $payment,
            'lease_id' => $request->lease_id,
            'ActionURL' => URL('/paymentmade')
        ]);
    }


    public function getLeasePayment($lease_id){

        $heading = "Outstanding Payment";
        $heading1 = "upcoming Payment";
        $dt = date("y-m-d");
        $dtx =Carbon::now()->addDay(10);
        $dts =Carbon::now()->subDay(360);


       $payments = Payment::select("payment.payment_id","payment.lease_id","payment.amount","payment.due_date","building.name","unit.name as Unitname","lease_expense.description" )
            ->leftJoin("building","building.building_id","=","payment.building_id")
            ->leftJoin("unit","unit.unit_id","=","payment.unit_id")
            ->leftJoin("lease","lease.lease_id","=","payment.lease_id")
            ->leftJoin("lease_expense","lease_expense.lease_exp_id","=","payment.lease_exp_id")
            ->where("payment.lease_id",$lease_id)
            ->where("payment.payment",0)->OrderBy("payment.due_date")
            ->whereBetween("payment.due_date",array($dts,$dt))
           ->paginate(5);


        $paymenta = Payment::select("payment.payment_id","payment.lease_id","payment.amount","payment.due_date","building.name","unit.name as Unitname","lease_expense.description" )
            ->leftJoin("building","building.building_id","=","payment.building_id")
            ->leftJoin("unit","unit.unit_id","=","payment.unit_id")
            ->leftJoin("lease","lease.lease_id","=","payment.lease_id")
            ->leftJoin("lease_expense","lease_expense.lease_exp_id","=","payment.lease_exp_id")
            ->where("payment.lease_id",$lease_id)
            ->whereNotBetween("payment.due_date",array($dts,$dt))
             ->paginate(5);
        $tenantID=Lease::select('lease.tenant_id')
            ->leftjoin("payment","lease.lease_id" ,"=","payment.lease_id")
            ->where("payment.lease_id",$lease_id)->first();

        $DebitSum  = DB::table('payment_debit') ->where('tenant_id',$tenantID->tenant_id) ->sum('amount');
        $CreditSum = DB::table('payment_credit')->where('tenant_id',$tenantID->tenant_id) ->sum('amount');
        $total=$DebitSum-$CreditSum;
        return view('transaction.payment.view',[
            'heading' => $heading,
            'heading1' => $heading1,
            'payments' => $payments,
            'paymenta' => $paymenta,
            'tenantID'=>$tenantID,
            'total'=>$total,
            'ActionURL' => URL('/payment/paymentDone')
        ]);
    }



    public function paymentDone(Request $request)
    {
        $tenantID = Lease::select('lease.tenant_id', 'lease.lease_id','description')
            ->leftjoin("payment", "lease.lease_id", "=", "payment.lease_id")
            ->leftjoin("lease_expense", "lease.lease_id", "=", "lease_expense.lease_id")
            ->where("lease.tenant_id", $request->tenant_id)->first();
        $DebitSum = DB::table('payment_debit')->where('tenant_id', $tenantID->tenant_id)->sum('amount');
        $CreditSum = DB::table('payment_credit')->where('tenant_id', $tenantID->tenant_id)->sum('amount');
        $total = $DebitSum - $CreditSum;


        $name = array();
        $validate ['payment'] = 'required|max:109';

        $validator = Validator::make($request->all(), $validate, [], $name);


        if (!$validator->fails()) {
            $PaymentMade = new PaymentCredit();
            $PaymentMade->user_id = Auth::user()->id;
            $PaymentMade->tenant_id = $request->tenant_id;
            $PaymentMade->amount = $request->payment;
            $PaymentMade->lease_id = $request->lease_id;
            $PaymentMade->credit = "credit";
            $PaymentMade->comment = $request->description;
            if ($request->payment > $total) {
                Session::flash('danger_message', ' Insufficent Balance!');
                return redirect()->back();
            } else {
                $PaymentMade->save();

                $data = $request->input('payments');

                $pay = Payment::find($data);
                $pay->payment = 2;
                $pay->recieve_at = time();
                $pay->save();
                Session::flash('success_message', ' Payment Has Been Made!');
                return redirect()->back();
            }
        }

        else {
            return redirect()->back()->withInput()
                ->withErrors($validator);
        }
    }


/*  public function LeasePayment(Request $request,$lease_id){
        if(count($request->payment) > 0) {
            foreach ($request->payment as $payment):
                $payment = Payment::find($payment);
                $payment->payment = 2;
                $payment->recieve_at = date('Y-m-d');
                $payment->save();
            endforeach;
            Session::flash('success_message', ' Payment Has been completed successfully!');
            return redirect()->back();
        }
        Session::flash('failed_message', ' Select payment first !');
        return redirect()->back();
    }*/


    public  function  SendNotification($lease_id){
        $date =date('Y').'-'.date('m');
        $lease = Lease::select('building.name as BUILDING', 'unit.name as UNIT','lease_id','tenant.email' )
            ->join('tenant','tenant.id','=','lease.tenant_id')
            ->join('unit','unit.unit_id','=','lease.unit_id')
            ->join('building','lease.building_id','=','building.building_id')
            ->where('lease_id',$lease_id)
            ->first();
        $payments = Payment::where("lease_id",$lease_id)
            ->whereBetween('due_date', array(
                $date.'-01',
                $date.'-31'
            ))->get();

        Mail::send('emails.reminder', ['user' => $lease->email,'lease' => $lease,'payments' => $payments], function ($m) {
            $m->from('noreply@colligur.com', 'Colligur');
            $m->to('jaffaraza@gmail.com', 'raza')->subject('Payment Reminder Notification!');
        });

        Session::flash('success_message', ' Notification Sent!..');
        return view('transaction.payment.notify',[
            'heading' => 'Payment Notification.'
        ]);
    }


    public function getPaymentHistory($id)
    {   $heading = "Payment History";
        $tenantID=Lease::select('lease.tenant_id','lease.lease_id')
            ->leftjoin("payment","lease.lease_id" ,"=","payment.lease_id")
            ->where("lease.tenant_id",$id)->first();
        $DebitSum = DB::table('payment_debit')->where('tenant_id', $tenantID->tenant_id)->sum('amount');
        $CreditSum = DB::table('payment_credit')->where('tenant_id', $tenantID->tenant_id)->sum('amount');
        $totals = $DebitSum - $CreditSum;

     /*   $payDebit = PaymentReceived::select('tenant_id','amount','debit','date','comment')->where('tenant_id',$tenantID->tenant_id);*/
        $final  = PaymentCredit::select('tenant_id','amount','credit','created_at','comment')->where('tenant_id',$tenantID->tenant_id)->get();
        /*$final= $payDebit->union($payCredit)->get();*/
       /* $DebitSum  = DB::table('payment_debit')->where('tenant_id',$tenantID->tenant_id) ->sum('amount');*/
        $total = DB::table('payment_credit')->where('tenant_id',$tenantID->tenant_id) ->sum('amount');
       /* $total=$DebitSum-$CreditSum;*/
        return view('transaction.payment.payment-history',[
            'heading' => $heading,
            "final"=> $final,
            'total'=>$total,
            'totals'=>$totals,
            'ActionURL' => URL('/paymentmade')
        ]);


    }






}
