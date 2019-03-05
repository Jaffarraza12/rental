<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Model\Building;
use App\Http\Model\TenantVehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Tenant;
use App\Http\Model\Applicant;
use App\Http\Model\TenantEmployer;
use App\Http\Model\Lease;
use App\Http\Model\Payment;
use App\Http\Model\LeaseExpense;
use App\Http\Model\TenantPet;
use App\Http\Model\TenantOccupant;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class TenantController extends Controller
{
    //
    var $active_menu;
    public function __construct()
    {
        $this->active_menu = 'rental';
    }

    public function index(){
        $heading = "Tenants";
        $breadcrumb = array(
            'Home'=> URL('/'),
            'Tenants'=> URL('tenants')
        );
        return view('applicant.tenant.view',[
            'heading' => $heading ,
            'active_menu' => $this->active_menu,
            'breadcrumb' => $breadcrumb,



        ]);

    }
    public function getData(Request $request) {

        $buildingId = $request->session()->get('defaultBuilding');
        $userId = Auth::id();
        $dataTable = Datatables::of(Tenant::select(array('tenant.id','tenant.name','tenant.email','tenant.phone','tenant.user_id', 'unit.name AS UNIT','payment.payment_id','lease.lease_id','payment.due_date'))
            ->leftjoin("lease","tenant.id","=","lease.tenant_id")
            ->leftjoin("building","lease.building_id","=","building.building_id")
            ->leftjoin("unit","lease.unit_id","=","unit.unit_id")
            ->leftjoin("payment",function($j){
                $j->on("lease.lease_id","=","payment.lease_id");
                $j->on("payment.payment_type",'=',DB::raw("'lease'"));
                $j->on("payment.payment",'=',DB::raw("0"));
            })
            ->where('tenant.user_id',$userId)
            ->where('building.building_id',$buildingId)
            ->orderBy('due_date','asc')
            ->groupBy('tenant.id')
            ->havingRaw('MIN(payment.due_date)'))
            ->editColumn('tenant.name','<a href="{{ URL("tenant/edit/".$id)}}">{{$name}}</a>')
            ->editColumn('payment_id', function($payment_id){
                $payment= new Payment;
                return $payment->Noofday($payment_id);
            })
            ->addColumn('actions',
                '<div class="btn-group">
  
  <button type="button" class="btn dropdown-toggle flag_green" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=" color: #fff">
    <span >ACTION</span>
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu">
    <li><a href="{{ URL("tenant/edit/".$id)}}">Edit</a></li>
    <li><a href="{{ URL("building/remove/".$id)}}" class="remove"  data-id="{{$id}}">Delete</a></li>
    <li><a class="pop" data-url ="{{ URL("/payment/".$lease_id)}}">Claim Dues</a></li>
    <li><a href="{{ URL("notification/".$lease_id)}}">Send Notification</a></li>
    <li><a class="pop" data-url ="{{ URL("work_order/add")}}">Work Order</a></li>
    <li><a class="pop" data-url ="{{ URL("/payment/add/".$id)}}">Add Payment</a></li>
    <li><a class="pop" data-url ="{{ URL("payment/view/".$id)}}">Payment History</a></li>
  </ul>
</div>')
            ->removeColumn('due_date')
            ->removeColumn('lease_id')
            ->make(true);

        return $dataTable;

    }
    public function getAdd(Request $request) {
        $heading = "Add Tenant";
        $buildings=array();
        $buildingId = $request->session()->get('defaultBuilding');
        /*foreach(Building::get() as $building):
            $buildings[$building->building_id] = $building->name;
        endforeach;*/
        foreach(Building::where('building_id',$buildingId)->get() as $build){
            $buildings[$build->building_id] = $build->name;
        }

        $breadcrumb = array(
            'Home'=> URL('/'),
            'Tenants'=> URL('tenants'),
            'Add'=> URL('tenant/add')
        );

        return view('applicant.tenant.add',[
            'heading' => $heading,
            'buildings' => $buildings,
            'active_menu' => $this->active_menu,
            'breadcrumb' => $breadcrumb,
            'ActionURL' => URL('tenant/add'),
            'ActiveMenu' => 'tenant'
        ]);


    }
    public function Add(Request $request) {

        $userId = Auth::id();

        $validate =array();
        $name =array();
        $validate ['name'] = 'required|max:109';
        $validate ['email'] = 'required|email|max:109';
        $validator = Validator::make($request->all(),$validate,[],$name);


        if (!$validator->fails()) {
            $lease = new Lease();
            $tenant = new Tenant();
            $payment = new Payment();
            $tenant->user_id = $userId;
            $tenant->name = $request->name;
            $tenant->email = $request->email;
            $tenant->phone = $request->phone;
            $tenant->ssn = $request->ssn;
            $tenant->payment_type= $request->payment_type;
            $tenant->address = $request->address;
            $tenant->driving_license = $request->driving_license;
            $tenant->smoke = $request->smoke;
            $tenant->profile = $request->profile;
            $tenant->lease_perfer = $request->lease_perfer;
            $tenant->notes = $request->notes;
            $tenant->save();
            $tenant_id = $tenant->id;
            Response::json(array('success' => true, 'last_insert_id' => $tenant_id), 200);

            $lease->building_id = $request->building_id;
            $lease->unit_id = $request->unit_id;
            $lease->tenant_id =  $tenant_id;
            if($request->lease_prefer == 'Monthly' ){
                $lease->date_start = date('Y-m-d',strtotime($request->starting_date));
                $lease->date_end = date('Y-m-d',strtotime($request->starting_date));
            } else {
                $lease->date_start = date('Y-m-d',strtotime($request->from));
                $lease->date_end = date('Y-m-d',strtotime($request->to));

            }
            $lease->notice_period = $request->notice_period;
            $lease->lease_prefer = $request->lease_prefer;
            $lease->amount = $request->rate;
            $lease->comment = $request->comment;
            $lease->save();
            $lease_id = $lease->lease_id;
            $unit = Unit::where('unit_id',$request->unit_id);
            $unit->available = 0;
            $unit->save();
            Response::json(array('success' => true, 'last_insert_id' => $lease_id), 200);
            $i=0;
            $payment->PaymentAdjustment($request,$lease_id);

            $lease_id = $lease->lease_id;
            //Tenant Occupant
            $i=0;
            foreach($request->occupant_name as $occupant_name):
                TenantOccupant::insert([
                    'tenant_id' => $tenant_id,
                    'name' => $occupant_name,
                    'relation' => $request->relation[$i],
                    //  'comment' => $request->comments[$i]
                ]);
                $i++;
            endforeach;
            //Tenant Pets
            $i=0;
            foreach($request->pet_type as $pet_type):
                TenantPet::insert([
                    'tenant_id' => $tenant_id,
                    'pet_type' => $pet_type,
                    // 'pet_comment' => $request->pet_comment[$i]
                ]);
                $i++;
            endforeach;

            //Tenant vehicle
            $i=0;
            foreach($request->make as $make):
                TenantVehicle::insert([
                    'tenant_id' => $tenant_id,
                    'make' => $make,
                    'model' => $request->model[$i],
                    'tag' => $request->tag[$i]
                ]);
                $i++;
            endforeach;


            //Tenant Income
            $i=0;
            foreach($request->employer as $employer):
                TenantEmployer::insert([
                    'tenant_id' => $tenant_id,
                    'employer' => $employer,
                    'role' => $request->role[$i],
                    'telephone' => $request->employer_phone[$i],
                    'duration' => $request->duration[$i],
                    'income' => $request->income[$i],
                ]);
                $i++;
            endforeach;

            $more_common_amenities = array();
            if($request->more_amenities != "") {
                $moreAmenity = explode(",", $request->more_amenities);
                if (is_array($moreAmenity)) {
                    foreach ($moreAmenity as $ca):
                        $more_common_amenities[$ca] = 1;
                    endforeach;
                }
            }


            Session::flash('success_message', ' Tenant Has been Added !');
            return redirect('tenants');
        } else {

            return redirect()->back()->withErrors($validator);
        }


    }
    public function getEdit($id) {
        $heading = "Edit Tenant";
        $buildings=array();
        foreach(Building::get() as $building):
            $buildings[$building->building_id] = $building->name;
        endforeach;
        $tenant = Tenant::where('id',$id)->first();
        $lease = Lease::select('lease.*','unit.name as UNIT','building.name as UNIT')
            ->join('building','building.building_id','=','lease.building_id')
            ->join('unit','unit.unit_id','=','lease.unit_id')
            ->where('tenant_id',$id)->first();

        $breadcrumb = array(
            'Home'=> URL('/'),
            'Tenants'=> URL('tenants'),
            'Edit'=> URL('tenant/edit/'.$id)
        );

        return view('applicant.tenant.edit',[
            'heading' => $heading,
            'buildings' => $buildings,
            'active_menu' => $this->active_menu,
            'tenant' => $tenant,
            'lease' => $lease,
            'breadcrumb' => $breadcrumb,
            'ActionURL' => URL('tenant/edit/'.$id),
            'ActiveMenu' => 'tenant'
        ]);
    }
    public function Edit($id,Request $request) {
        $validate =array();
        $name =array();
        $validate ['name'] = 'required|max:109';
        $validate ['email'] = 'required|email|max:109';
        $validator = Validator::make($request->all(),$validate,[],$name);


        if (!$validator->fails()) {
            $lease = new Lease();
            $tenant = Tenant::find($id);
            $payment = new Payment();
            $tenant->name = $request->name;
            $tenant->email = $request->email;
            $tenant->phone = $request->phone;
            $tenant->ssn = $request->ssn;
            $tenant->payment_type= $request->payment_type;
            $tenant->address = $request->address;
            $tenant->driving_license = $request->driving_license;
            $tenant->smoke = $request->smoke;
            $tenant->profile = $request->profile;
            $tenant->lease_perfer = $request->lease_perfer;
            $tenant->notes = $request->notes;
            $tenant->save();
            $tenant_id = $tenant->id;
            Response::json(array('success' => true, 'last_insert_id' => $tenant_id), 200);

            $lease->building_id = $request->building_id;
            $lease->unit_id = $request->unit_id;
            $lease->tenant_id =  $tenant_id;
            if($request->lease_prefer == 'Monthly' ){
                $lease->date_start = date('Y-m-d',strtotime($request->starting_date));
                $lease->date_end = date('Y-m-d',strtotime($request->starting_date));
            } else {
                $lease->date_start = date('Y-m-d',strtotime($request->from));
                $lease->date_end = date('Y-m-d',strtotime($request->to));

            }
            $lease->notice_period = $request->notice_period;
            $lease->lease_prefer = $request->lease_prefer;
            $lease->amount = $request->rate;
            $lease->comment = $request->comment;
            $lease->save();
            $lease_id = $lease->lease_id;
            Response::json(array('success' => true, 'last_insert_id' => $lease_id), 200);
            $i=0;
            $payment->PaymentAdjustment($request,$lease_id);

            $lease_id = $lease->lease_id;
            //Tenant Occupant
            $i=0;
            foreach($request->occupant_name as $occupant_name):
                TenantOccupant::insert([
                    'tenant_id' => $tenant_id,
                    'name' => $occupant_name,
                    'relation' => $request->relation[$i],
                    //  'comment' => $request->comments[$i]
                ]);
                $i++;
            endforeach;
            //Tenant Pets
            $i=0;
            foreach($request->pet_type as $pet_type):
                TenantPet::insert([
                    'tenant_id' => $tenant_id,
                    'pet_type' => $pet_type,
                    // 'pet_comment' => $request->pet_comment[$i]
                ]);
                $i++;
            endforeach;

            //Tenant vehicle
            $i=0;
            foreach($request->make as $make):
                TenantVehicle::insert([
                    'tenant_id' => $tenant_id,
                    'make' => $make,
                    'model' => $request->model[$i],
                    'tag' => $request->tag[$i]
                ]);
                $i++;
            endforeach;


            //Tenant Income
            $i=0;
            foreach($request->employer as $employer):
                TenantEmployer::insert([
                    'tenant_id' => $tenant_id,
                    'employer' => $employer,
                    'role' => $request->role[$i],
                    'telephone' => $request->employer_phone[$i],
                    'duration' => $request->duration[$i],
                    'income' => $request->income[$i],
                ]);
                $i++;
            endforeach;

            $more_common_amenities = array();
            if($request->more_amenities != "") {
                $moreAmenity = explode(",", $request->more_amenities);
                if (is_array($moreAmenity)) {
                    foreach ($moreAmenity as $ca):
                        $more_common_amenities[$ca] = 1;
                    endforeach;
                }
            }

            Session::flash('success_message', ' Tenant Has been Modefied !');
            return redirect('tenants');
        } else {

            return redirect()->back()->withErrors($validator);
        }

    }
    //For External Api
    public  function getAuth(Request $request)
    {
        $tenant = Tenant::select('tenant.id', 'tenant.email', 'tenant.phone')
            ->where("email", $request->email)
            ->where('phone', $request->phone)
            ->first();
        echo json_encode($tenant);
    }
    public function Destroy($id,Request $request) {}



}
