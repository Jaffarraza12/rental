<?php

namespace App\Http\Controllers\Transaction;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Tenant;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Model\Payment;
use App\Http\Model\Lease;

class RentRollController extends Controller
{
    //
    var $active_menu;
    public function __construct()
    {
        $this->active_menu = 'rental';
    }
    function index(){
        $heading = "Rent Roll";
        $breadcrumb = array(
            'Home'=> URL('/'),
            'Rent Roll'=> URL('rentroll')
        );
        return view('transaction.rentroll',[
            'heading' => $heading ,
            'breadcrumb' => $breadcrumb,
            'active_menu' => $this->active_menu,

        ]);
    }
    function create(Request $request){

        $buildingId = $request->session()->get('defaultBuilding');
        $userId = Auth::id();
        $dataTable = Datatables::of(Tenant::select(array('tenant.id','tenant.name','tenant.email','tenant.phone','tenant.user_id','building.name AS BUILDING', 'unit.name AS UNIT','payment.payment_id','lease.lease_id','lease.status','lease.date_start','lease.date_end','lease.amount','payment.due_date'))
            ->leftjoin("lease","tenant.id","=","lease.tenant_id")
            ->leftjoin("building","lease.building_id","=","building.building_id")
            ->leftjoin("unit","lease.unit_id","=","unit.unit_id")
            ->leftjoin("payment",function($j){
                $j->on("lease.lease_id","=","payment.lease_id");
                $j->on("payment.payment_type",'=',DB::raw("'lease'"));
                $j->on("payment.payment",'=',DB::raw("0"));
            })
            /*->where('tenant.user_id',$userId)*/
            ->where('building.building_id',$buildingId)
            ->orderBy('due_date','asc')
            ->groupBy('tenant.id')
            ->havingRaw('MIN(payment.due_date)'))
            ->editColumn('tenant.name','<a href="{{ URL("tenant/edit/".$id)}}">{{$UNIT}}</a> {{$name}}')
            ->editColumn('status',function($status){
                if($status){
                    return 'Active';
                } else {
                    return 'Past';
                }
            })
            ->editColumn('type',function($lease_id) {
                $lease = new Lease;
                return $lease->LeaseTypeDuration($lease_id);
            })
            ->editColumn('payment_id', function($lease_id){
                $lease= new Lease;
                return $lease->LeaseDaysLeft($lease_id) .' days';
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
            ->make(true);

        return $dataTable;



    }
    function store(){}
    function show(){}
    function edit(){}
    function update(){}
    function destory(){}
}
