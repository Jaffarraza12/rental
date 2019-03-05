<?php

namespace App\Http\Controllers\Inventory;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Inventory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use DB;
use Yajra\Datatables\Datatables;

class InventoryControllers extends Controller
{
    public function index()
    {
        /* echo Auth::user()->pid;
         exit();*/
        $heading = "Inventory";
        $breadcrumb = array(
            'Home'=> URL('/'),
            'Inventory'=> URL('inventory')
        );
        return view('inventory.view',[
            'heading' => $heading ,
            'breadcrumb' => $breadcrumb,
            'ActiveMenu' => 'inventory'

        ]);

    }
    public function getData(Request $request)
    {
        // $buildingId = $request->session()->get('defaultBuilding');
        // $userId = Auth::id();

        return Datatables::of(Inventory ::select(array('id','productName','productDescription','unitCost','quantity','vendor','contactNumber','purchasingDate')))
            //->join("building","work_order.building_id","=","building.building_id")
            // ->leftJoin("unit","work_order.unit_id","=","unit.unit_id")
            //->where('work_order.user_id')
            //->where('work_order.building_id',$buildingId)

            ->addColumn('actions',
                '<div class="btn-group">
                 <button type="button" class="btn" style="background: #eb8209; color: #fff">Action</button>
                 <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background: #eb8209; color: #fff">
                 <span class="caret"></span>
                 <span class="sr-only">Toggle Dropdown</span>
                 </button>
               <ul class="dropdown-menu">
                  <li><a class="pop" data-url ="{{ URL("/inventory/edit/".$id)}}">Edit</a></li>
                  <li><a data-url="{{ URL("/inventory/remove/".$id)}}" class="remove"  data-id="{{$id}}">Delete</a></li>
               </ul>
                 </div>
                    <ul class="no_style" style="display: none;">
                         <li>
                           <a href="javascript:;" class="remove" " data-url="{{ URL("/inventory/remove/".$id)}}">
                         <i class="fa fa-remove" title=""></i> </a>
                         </li>
                         <li><a  href="{{ URL("/inventory/edit/".$id)}}">
                         <i class="fa fa-edit"></i> </a>
                         </li>
                         </ul>')
                     ->make(true);
    }

    //Add produc
    public function create()
    {
        //
    }
    public function getAdd(Request $request)
    {   $heading="Inventory";


        return view('/inventory/add',[
            'heading' => $heading,
            'ActionURL' =>  '/inventory/store',
        ]);

    }
    //Store datat into Database
    public function store(Request $request)
    {
        $name =array();
        $validate ['productName'] = 'required|max:109';



        $validator = Validator::make($request->all(),$validate,[],$name);
        if (!$validator->fails()) {

            $inventory = new Inventory();
            $inventory->productName= $request->productName;
            $inventory->productDescription = $request->productDescription;
            $inventory->unitCost = $request->unitCost;
            $inventory->quantity = $request->quantity;
            $inventory->vendor= $request->vendor;
            $inventory->contactNumber= $request->contactNumber;
            $inventory->purchasingDate= $request->purchasingDate;
            $inventory->save();


            Session::flash('success_message', ' Inventory Has Been Added !');
            return redirect()->back();
        } else {
            return redirect()->back()->withInput()
                ->withErrors($validator);
        }
    }
    public function getEdit($id) {
        $heading = "Edit Product";
        $pro = Inventory::where('id',$id)->first();

        return view('inventory/edit',[
            'heading' => $heading,
            'ActionURL' => URL('/inventory/edit/'.$id),
            'record' =>  $pro,
        ]);
    }

    public function edit($id,Request $request)
    {
        $name =array();
        $validate ['productName'] = 'required|max:109';



        $validator = Validator::make($request->all(),$validate,[],$name);
        if (!$validator->fails()) {

            $inventory =  Inventory::find($id);
            $inventory->productName= $request->productName;
            $inventory->productDescription = $request->productDescription;
            $inventory->unitCost = $request->unitCost;
            $inventory->quantity = $request->quantity;
            $inventory->vendor= $request->vendor;
            $inventory->contactNumber= $request->contactNumber;
            $inventory->purchasingDate= $request->purchasingDate;
            $inventory->save();


            Session::flash('success_message', ' Inventory Has Been Modified !');
            return redirect()->back();
        } else {
            return redirect()->back()->withInput()
                ->withErrors($validator);
        }
    }

    public function destroy($id)
    {   $inventory= Inventory::find($id);
        $inventory->delete();
    }



}
