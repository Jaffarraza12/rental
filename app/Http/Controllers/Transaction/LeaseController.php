<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Model\Unit;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use App\Http\Model\Tenant;
use App\Http\Model\Applicant;
use App\Http\Model\Building;
use App\Http\Model\Lease;
use App\Http\Model\Payment;
use App\Http\Model\LeaseExpense;
use Illuminate\Support\Facades\Auth;

class LeaseController extends Controller
{
    //
    public function __construct(Request $request)
    {

    }

    public function index(){}
    public function getData(){}
    public function getLease(Request $request) {
        $userId = Auth::id();
        $breadcrumb = array(
            'Home'=> URL('/'),
            'Lease'=> URL('lease'),
        );
        $heading = "Lease Agreement ";
        $buildings =array();
        $tenants =array();
        $applicantsDataSet= array() ;
        $buildingId = $request->session()->get('defaultBuilding');
        /*foreach(Building::get() as $building):
            $buildings[$building->building_id] = $building->name;
        endforeach;*/
        foreach(Building::where('building_id',$buildingId)->get() as $build){
            $buildings[$build->building_id] = $build->name;
        }
        foreach (Tenant::get() as $tenant):
            $tenants[$tenant->id] = $tenant->first_name .' '.$tenant->last_name;
        endforeach;
        foreach (Applicant::where('user_id',$userId)->get() as $applicant):
            $applicantsDataSet[]= [
                'label' => $applicant->name,
                'value' => $applicant->applicant_id,
            ];
        endforeach;

        return view('transaction.lease.lease',[
            'heading' => $heading,
            'buildings' => $buildings,
            'building_id' => $buildingId,
            'breadcrumb' => $breadcrumb,
            'tenants' => $tenants,
            'applicantsDataSet' => json_encode($applicantsDataSet),
            'tenant' => Tenant::first(),
            'ActionURL' => URL('lease')
        ]);



    }
    public function Lease(Request $request) {
        $validate =array();
        $name =array();

        $validate ['unit_id'] = 'required|int|max:109';
        $validate ['applicant_id'] = 'required|int|max:109';
        $validate ['rent_type'] = 'required';
        $validate ['lease_prefer'] = 'required';
        $validate ['rate'] = 'required|int';
        $validate ['start'] = 'required';
        $validate ['end'] = 'required';
        //$request->starting_date = strtotime(strtotime($request->starting_date). "+ 0 months");
       // $request->end_date = strtotime(strtotime($request->starting_date) . "+".$request->rent_duration." months");

        $request->starting_date = strtotime($request->start);
        $request->end_date = strtotime($request->end);
 

        $payment = new Payment;
        $validator = Validator::make($request->all(),$validate,[],$name);

        if (!$validator->fails()) {
            $lease = new Lease();
            $tenant = new Tenant;
            $lease->building_id = $request->building_id;
            $lease->unit_id = $request->unit_id;
            $lease->applicant_id = $request->applicant_id ;
            $lease->tenant_id = $tenant->ApplicantToTenant($request->applicant_id);
            /*if($request->lease_prefer == 'Monthly' ){
                $lease->date_start = date('Y-m-d',strtotimooe($request->starting_date));
                $lease->date_end = date('Y-m-d',strtotime($request->ending_date));
            } else {*/
            $lease->date_start = date('Y-m-d',$request->starting_date);
            $lease->date_end = date('Y-m-d',$request->end_date);

            //}
            $lease->notice_period = $request->notice_period;
            $lease->lease_prefer = $request->lease_prefer;
            $lease->amount = $request->rate;
            $lease->comment = $request->comment;
            $lease->save();
            $lease_id = $lease->lease_id;
            $unit = Unit::findorfail($request->unit_id);
            $unit->available = 0;
            $unit->save();
            $applicant = Applicant::where('applicant_id',$request->applicant_id)->first();
            $applicant->tenant= 100;
            $applicant->save();

            Response::json(array('success' => true, 'last_insert_id' => $lease_id), 200);
            $i=0;
            $payment->PaymentAdjustment($request,$lease_id);
            Session::flash('success_message', ' Lease has been create.!');
            return redirect()->back();
        } else {


            return back()->withErrors($validator,'mess');
        }


    }
}
