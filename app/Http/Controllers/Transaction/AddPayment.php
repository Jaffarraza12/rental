<?php

namespace App\Http\Controllers\Transaction;
use App\Http\Controllers\Controller;

use App\http\Model\PaymentCredit;
use App\Http\Model\PaymentReceived;
use App\Http\Model\Tenant;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Http\Model\Payment;
use App\Http\Model\Lease;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
class AddPayment extends Controller
{
    public function getAdd(Request $request)
    {   $heading="ADD PAYMENT";
       $id= $request->route('id');
     return view('/transaction/payment/add',[
            'heading' => $heading,
            'id'=>$id,
            'ActionURL' =>  '/transaction/store',
        ]);

    }
    public function store(Request $request)
    {

        $name =array();
        $validate ['amount'] = 'required|max:109';


        $validator = Validator::make($request->all(),$validate,[],$name);
        if (!$validator->fails()) {

            $AddPaymennt = new PaymentReceived();
            $AddPaymennt->user_id = Auth::user()->id;
            $AddPaymennt->tenant_id = $request->tenant_id;
            $AddPaymennt->debit ="debit";
            $AddPaymennt->tenant_id = $request->tenant_id;
            $AddPaymennt->amount = $request->amount;
            $AddPaymennt->mode = $request->payment_mode;
            $AddPaymennt->date = $request->date;
            $AddPaymennt->account_no = $request->account_no;
            $AddPaymennt->cheque_no = $request->cheque_no;
            $AddPaymennt->comment = $request->comment;
            $AddPaymennt->save();
            Session::flash('success_message', ' Payment Has Been Added !');
            return redirect()->back();
        }
         else {
            return redirect()->back()->withInput()
                ->withErrors($validator);
        }
    }
    public function getLeasePayment($lease_id){
        $heading = "Payment List";
      //$amount = DB::table('payment_Debit')->where('tenant_id', '=', 5) ->sum('amount');
      /* $tenantID=Lease::select('lease.tenant_id')
            ->leftjoin("payment","lease.lease_id" ,"=","payment.lease_id")
            ->where("payment.lease_id",$lease_id)*/;


        $payments = Payment::select("payment.payment_id","payment.lease_id","payment.amount","payment.due_date","building.name","unit.name as Unitname","lease_expense.description" )
            ->leftJoin("building","building.building_id","=","payment.building_id")
            ->leftJoin("unit","unit.unit_id","=","payment.unit_id")
            ->leftJoin("lease","lease.lease_id","=","payment.lease_id")
            ->leftJoin("lease_expense","lease_expense.lease_exp_id","=","payment.lease_exp_id")
            ->where("payment.lease_id",$lease_id);

           /* ->where("payment.payment",0)->OrderBy("payment.due_date")->paginate(5);*/

        return view('transaction.payment.view',[
            'heading' => $heading,
            'payments' => $payments,
           // 'tenantID'=>$tenantID,
            //'tenantID'=>$tenantID,
            'ActionURL' => URL('/payment/add')
        ]);
    }
    public function add(Request $request,$lease_id)
    {



    }


}
