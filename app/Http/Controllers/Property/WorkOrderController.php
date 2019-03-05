<?php

namespace App\Http\Controllers\Property;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Http\Model\Building;
use App\Http\Model\Expense;
use App\Http\Model\Vendor;
use App\Http\Model\Unit;
use App\User;
use App\Http\Model\WorkOrder;
use App\Http\Model\Tenant;
use Illuminate\Support\Facades\Mail;
use App\Http\Model\Lease;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Jimmyjs;
use PdfReport;
use Illuminate\Support\Facades\Auth;

class WorkOrderController extends Controller
{
    var $active_menu;
    public function __construct()
    {
        $this->active_menu = 'work_order';
    }
    public function index(){
        $heading = "Work Orders";
        $breadcrumb = array(
            'Home'=> URL('/'),
            'Work Orders'=> URL('work_order')
        );
        return view('property.work_order.view',[
            'heading' => $heading ,
            'breadcrumb' => $breadcrumb,
            'active_menu' => $this->active_menu,

        ]);

    }
    public function getData(Request $request) {
        $buildingId = $request->session()->get('defaultBuilding');
        $userId = Auth::user()->id;
        $workO = WorkOrder ::select(array('work_order.work_order_id','work_order.name','work_order.user_id','users.name as building','unit.name as unit_name','work_order.status','work_order.priority','work_order.created_at'))
            ->join("building","work_order.building_id","=","building.building_id")
            ->join("users","users.id","=","work_order.user_id")
            ->leftJoin("unit","work_order.unit_id","=","unit.unit_id")
            ->where('work_order.building_id',$buildingId);
        if(Auth::user()->pid == 0 ){
            $workO = $workO->where(function ($query){
                $query->where('users.pid',Auth::user()->id)->orwhere('work_order.user_id',Auth::user()->id);
            });
        } else {
            $workO = $workO->where('work_order.user_id',Auth::user()->id);
        }
        return Datatables::of($workO)
            ->editColumn('status','@if($status == 2)
                                Closed.
                            @elseif($status == 1)
                                Pending.
                            @else
                                Opened.
                            @endif')
            ->addColumn('actions',
                '<div class="btn-group">
  
  <button type="button" class="btn dropdown-toggle flag_green" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #fff">
    <span >ACTION</span>
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu">
    <li><a href="{{ URL("work_order/view/".$work_order_id)}}">View</a></li>
    <li><a href="{{ URL("work_order/edit/".$work_order_id)}}">Edit</a></li>
    <li><a href="{{ URL("work_order/remove/".$work_order_id)}}" class="remove"  data-id="{{$work_order_id}}">Delete</a></li>
  </ul>
</div>
<ul class="no_style" style="display: none;">
                         <li>
                           <a href="javascript:;" class="remove" data-id="{{$work_order_id}}" data-url="{{ URL("work_order/remove/".$work_order_id)}}">
                         <i class="fa fa-remove" title=""></i> </a>
                         </li>
                         <li><a  href="{{ URL("work_order/view/".$work_order_id)}}">
                         <i class="fa fa-edit"></i> </a>
                         </li>
                         </ul>')
            ->make(true);
    }
    public function getExpenseData() {
        return Datatables::of(Expense ::select(array('expense_id','entry_date','')))
            ->addColumn('operations',
                '<ul class="no_style">
                         <li>
                           <a href="javascript:;" class="remove" data-id="{{$work_order_id}}" data-url="{{ URL("work_order/remove/".$work_order_id)}}">
                         <i class="fa fa-remove" title=""></i> </a>
                         </li>
                         <li><a  href="{{ URL("work_order/view/".$work_order_id)}}">
                         <i class="fa fa-edit"></i> </a>
                         </li>
                         </ul>')
            ->make(true);
    }
    public function getAdd(Request $request) {
        $heading = "New Work Order";
        $breadcrumb = array(
            'Home'=> URL('/'),
            'Work Orders'=> URL('work_order'),
            'New Work Order'=> URL('work_order/add')
        );
        $buildings = array();
        $building_id = $request->session()->get('defaultBuilding');
        /*foreach (Building::get() as $building):
            $buildings[$building->building_id] = $building->name;
        endforeach;*/
        $units = Unit::join('lease','lease.unit_id','=','unit.unit_id')->where('unit.building_id',$building_id)->get();
        $unit =array();
        foreach ($units as $u):
            $unit[$u->unit_id] = $u->name;
        endforeach;
        $vendors =array();
        foreach (Vendor::get() as $v):
            $vendors[$v->id] = $v->name;
        endforeach;
        $users =array();
        $users[Auth::user()->id] = Auth::user()->name;
        foreach (User::where('pid',Auth::user()->id)->get() as $us):
            $users[$us->id] = $us->name;
        endforeach;
        return view('property.work_order.add',[
            'heading' => $heading,
            'buildings' => $buildings,
            'building_id' => $building_id,
            'active_menu' => $this->active_menu,
            'vendors' => $vendors,
            'units' => $unit,
            'users' => $users,
            'breadcrumb' => $breadcrumb,
            'ActionURL' => URL('work_order/add'),
        ]);
    }
    public function Add(Request $request) {

        $userId = Auth::id();

        $validate =array();
        $name =array();
        $validate['summary'] = 'required|max:109';
        $validate['unit'] = 'required';
        $validate['resident'] = 'required';
        $validator = Validator::make($request->all(),$validate,[],array());
        if (!$validator->fails()) {
            $work_order = new WorkOrder();
            $work_order->name = $request->summary;
            $work_order->vendor_id = $request->vendor;
            $work_order->entry = $request->entry;
            $work_order->user_id = $request->user;
            $work_order->resident = $request->resident;
            $work_order->contact = $request->contact;
            $work_order->address = $request->address;
            $work_order->building_id = $request->building;
            $work_order->unit_id = $request->unit;
            $work_order->type = $request->type;
            $work_order->date_open = $request->date_open;
            $work_order->due_date = $request->due_date;
            $work_order->status = $request->status;
            $work_order->priority = $request->priority;
            $work_order->save();
            Session::flash('success_message', 'New Work Order  Has Been Created !');
            return redirect('work_order');
        } else {
            return redirect()->back()
                ->withErrors($validator,'mess');
        }
    }
    public function getView($id) {

        $heading = "Edit Work Order";
        $work_order =WorkOrder::where('work_order_id',$id)->first();


        $breadcrumb = array(
            'Home'=> URL('/'),
            'Work Orders'=> URL('work_order'),
            $work_order->name => URL('work_edit/edit/'.$id)
        );

        return view('property.work_order.detail_view',[
            'heading' => $heading,
            'building' => Building::where('building_id',$work_order->building_id)->first(),
            'unit' => Unit::where('unit_id',$work_order->unit_id)->first(),
            'expenses' => Expense::where('work_order_id',$id)->first(),
            'breadcrumb' => $breadcrumb,
            'sub_heading' => 'Work Order '.$work_order->name,
            'work_order' => $work_order,
            'id' => $id,
            'ActionURL' => URL('work_order/add'),
        ]);
    }
    public function getEdit($id,Request $request) {
        $heading = "Edit Work Order";
        $work_order = WorkOrder::where('work_order_id',$id)->first();
        $units =array();
        if(isset($work_order->building_id)){
            foreach (Unit::where('building_id',$work_order->building_id)->get() as $unit):
                $units[$unit->unit_id] = $unit->name;
            endforeach;
        }
        $breadcrumb = array(
            'Home'=> URL('/'),
            'Work Orders'=> URL('work_order'),
            'Edit Work Order'=> URL('work_order/edit/'.$id)
        );
        $buildings = array();
        $building_id = $request->session()->get('defaultBuilding');
        /*foreach (Building::get() as $building):
            $buildings[$building->building_id] = $building->name;
        endforeach;*/
        $units = Unit::join('lease','lease.unit_id','=','unit.unit_id')->where('unit.building_id',$building_id)->get();
        $unit =array();
        foreach ($units as $u):
            $unit[$u->unit_id] = $u->name;
        endforeach;
        $vendors =array();
        foreach (Vendor::get() as $v):
            $vendors[$v->id] = $v->name;
        endforeach;
        $users =array();
        $users[Auth::user()->id] = Auth::user()->name;
        foreach (User::where('pid',Auth::user()->id)->get() as $us):
            $users[$us->id] = $us->name;
        endforeach;
        return view('property.work_order.edit',[
            'heading' => $heading,
            'buildings' => $buildings,
            'breadcrumb' => $breadcrumb,
            'record' =>  $work_order,
            'active_menu' => $this->active_menu,
            'vendors' => $vendors,
            'users' => $users,
            'building_id' => $building_id,
            'units' =>  $unit,
            'id' => $id,
            'ActionURL' => URL('work_order/edit/'.$id),
        ]);
    }
    public function Edit($id,Request $request) {
        $validate =array();
        $name =array();
        $validate ['summary'] = 'required|max:109';

        $validator = Validator::make($request->all(),$validate,[],$name);
        if (!$validator->fails()) {
            $work_order =  WorkOrder::find($id);
            $work_order->name = $request->summary;
            $work_order->vendor_id = $request->vendor;
            $work_order->entry = $request->entry;
            $work_order->user_id = $request->user;
            //$work_order->building_id = $request->building;
            $work_order->unit_id = $request->unit;
            $work_order->resident = $request->resident;
            $work_order->contact = $request->contact;
            $work_order->address = $request->address;
            $work_order->type = $request->type;
           // $work_order->date_open = $request->date_open;
            if( $work_order->status != $request->status  ){
                $tenant = Tenant::select('tenant.*')->join('lease','lease.tenant_id','=','tenant.id')->where('lease.unit_id',$work_order->unit_id)->first();
                $user = User::where('id',$work_order->user_id)->first();
                Mail::send('emails.work_order.status', ['user' => $tenant->email,'WO' => $work_order,'unit' => Unit::where('unit_id',$work_order->unit_id)->first(),'user' => $user ], function ($m) {
                    $m->from('noreply@colligur.com', 'Colligur');
                    $m->to('jaffaraza@gmail.com', 'raza')->subject('Status has been changed of Work Order!');
                });
            }
            $work_order->due_date = $request->due_date;
            $work_order->status = $request->status;
            $work_order->priority = $request->priority;
            $work_order->save();
            Session::flash('success_message', ' Work Order Has Been Modefied !');
            return redirect('work_order');
        } else {
            return redirect()->back()->withInput()
                ->withErrors($validator);
        }
    }
    public function Destroy($id,Request $request) {

        $work_order = WorkOrder::find($id);
        $work_order->delete();
    }
    //FOR API
    public function ApiAdd(Request $request) {
        $validate =array();
        $name =array();
        $validate ['name'] = 'required|max:109';
        $validator = Validator::make($request->all(),$validate,[],$name);
        if (!$validator->fails()) {
            $work_order = new WorkOrder();
            $work_order->name = $request->name;
            $work_order->resident = $request->resident;
            $work_order->contact = $request->contact;
            $work_order->address = $request->address;
            $work_order->tenant_id = $request->tenant_id;
            $work_order->building_id = $request->building;
            $work_order->unit_id = $request->unit;
            $work_order->type = $request->type;
            $work_order->date_open = $request->date_open;
            $work_order->due_date = $request->due_date;
            $work_order->status = $request->status;
            $work_order->priority = $request->priority;
            $work_order->save();
            $work_order_id = $work_order->work_order_id;
            Response::json(array('success' => true, 'last_insert_id' => $work_order_id), 200);
            $newWork = WorkOrder::where('work_order_id',$work_order_id)->first();
            echo json_encode($newWork);
        } else {
            return redirect()->back()->withInput()
                ->withErrors($validator);
        }
    }//FOR API

    public function getPdf()
    {

        // Retrieve any filters
        $fromDate = '2016-08-31 12:01:23';
        $toDate = '2016-09-07 18:01:14';

        // Report title
        $title = 'Registered User Report';

        // For displaying filters description on header
        $meta = [
            'Registered on' => $fromDate . ' To ' . $toDate
        ];

        // Do some querying..
        $queryBuilder = building::select(['name', 'created_at', 'units'])
            ->whereBetween('created_at', [$fromDate, $toDate]);

        // Set Column to be displayed
        $columns = [
            'Name' => 'name',
            'Created At', // if no column_name specified, this will automatically seach for snake_case of column name (will be registered_at) column from query result
            'Units' => 'units',
        ];

        /*
            Generate Report with flexibility to manipulate column class even manipulate column value (using Carbon, etc).

            - of()         : Init the title, meta (filters description to show), query, column (to be shown)
            - editColumn() : To Change column class or manipulate its data for displaying to report
            - editColumns(): Mass edit column
            - showTotal()  : Used to sum all value on specified column on the last table (except using groupBy method). 'point' is a type for displaying total with a thousand separator
            - groupBy()    : Show total of value on specific group. Used with showTotal() enabled.
            - limit()      : Limit record to be showed
            - make()       : Will producing DomPDF / SnappyPdf instance so you could do any other DomPDF / snappyPdf method such as stream() or download()
        */
        return PdfReport::of($title, $meta, $queryBuilder, $columns)
            ->editColumn('Created At', [
                'displayAs' => function($result) {
                    return $result->created_at->format('d M Y');
                }
            ])
            ->editColumn('Units', [
                'displayAs' => function($result) {
                    return thousandSeparator($result->units);
                }
            ])
            ->showTotal([
                'Total Balance' => 'point'
            ])
            ->limit(20)
            ->stream(); // or download('filename here..') to download pdf
        //->download('abc.pdf');

    }

}
