<?php
namespace App\Http\Controllers\Property;

use Composer\EventDispatcher\ScriptExecutionException;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Building;
use App\Http\Model\Unit;
use App\Http\Model\UnitAmenities;
use App\Http\Model\PrivateAmenities;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;


class UnitController extends Controller
{
    var $active_menu ;
    var $building ;

    public  function  __construct()
    {
        $this->active_menu = 'building';
        $this->building = Session::get('defaultBuilding');

    }
    public function index(){
        $building_id = (int) $this->building;
        $building = Building::where('building_id',$building_id)->first();
        $units = Unit::where('building_id',$building_id)->get();
        $heading = $building->name;
        //unit amenities
        $unit_amenities =array();
        foreach($units as $unit):
            $i=0;
            foreach(UnitAmenities::where('unit_id',$unit->unit_id)->get() as $ua):
                    $unit_amenities[$unit->unit_id][$i] = $ua->private_amenity_id;
                    $i++;
            endforeach;
        endforeach;

        $breadcrumb = array(
            'Home'=> URL('/'),
            'Building'=> URL('building'),
            'Unit'=> URL('unit/'.$building_id),
        );
        return view('property.unit.view',[
            'building_selected' => $this->building,
            'heading' => $heading ,
            'sub_heading' => 'Total '.$building->units .' Units',
            'active_menu' => $this->active_menu,
            'unit_amenities' => $unit_amenities,
            'private_amenities' => PrivateAmenities::get(),
            'building' => $building,
            'units' => $units,
            'id' => $building_id,
            'ActiveMenu' => 'building',
            'breadcrumb' => $breadcrumb

        ]);
    }

    public function getData($id) {
        return Datatables::of(Unit::select(array('unit_id','name','type','available','furnished','floor'))->where('building_id',$id))
            ->editColumn('furnished','@if($furnished)
                                     Yes
                                    @else
                                     No
                                    @endif ')
            ->editColumn('available','@if($available)
                                     Vacant
                                    @else
                                     BOOKED
                                    @endif ')
            ->addColumn('operations',
                '<div class="btn btn-group">
                  <button type="button" class="btn dropdown-toggle flag_green" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=" color: #fff">
                    <span >ACTION &nbsp;&nbsp;&nbsp;</span>
                    <span class="fa fa-caret-down"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                    <ul class="dropdown-menu">
                         <li>
                           <a href="javascript:;" class="remove" data-id="{{$unit_id}}" data-url="{{ URL("unit/remove/".$unit_id)}}">
                         <i class="fa fa-remove" title=""></i> Remove </a>
                         </li>
                         <li><a class="" href="{{ URL("unit/edit/".$unit_id)}}">
                         <i class="fa fa-edit"></i> Edit</a>
                         </li>
                         <li><a title="Make Duplicate" class="make_duplicate"  data-id="{{$unit_id}}">
                         <i class="icon-link"></i> Make Duplicate </a>
                         </li>
                         </ul>')
            ->make(true);
    }

    public function getAdd(){
        $building_id = $this->building;
        $building = Building::where('building_id',$building_id)->first();
        $heading = "Add Unit for ". $building->name;

        $breadcrumb = array(
            'Home'=> URL('/'),
            'Building'=> URL('building'),
            'Building Unit'=> URL('unit'),
            'Add Unit '=> URL('unit/add'),
        );
        return view('property.unit.add',[
            'heading' => $heading,
            'building_selected' => $this->building,
            'active_menu' => $this->active_menu,
            'private_amenities' => PrivateAmenities::get(),
            'breadcrumb' => $breadcrumb,
            'ActionURL' => URL('unit/add/'.$building_id),
        ]);


    }

    public function Add($id,Request $request){
        $validate =array();
        $name =array();
        $validate ['name'] = 'required|max:109';

        $validator = Validator::make($request->all(),$validate,[],$name);
        $json =  array();

        if (!$validator->fails()) {
            $unit = new Unit;
            $unit->name = $request->name;
            $unit->building_id = $id;
            $unit->type = $request->type;
            $unit->floor = $request->floor;
            $unit->available = $request->available;
            $unit->multi_tenant = $request->multi_tenant;
            $unit->furnished = $request->furnished;
            $count=  DB::table('unit')->count();
            $pakageName = DB::table("config")->where('key',"units")->select('value')->first()->value;
            if($count==$pakageName)
            {
                Session::flash('danger_message', ' Upgrade your Pakage !');
                return redirect()->back();
            }else{
                $unit->save();
            }
           // $unit->save();
            $unit_id = $unit->unit_id;
            Response::json(array('success' => true, 'last_insert_id' => $unit_id), 200);
            UnitAmenities::where('unit_id',$unit_id)->delete();
            foreach ($request->amenities as $amenity):
                UnitAmenities::insert([
                    'private_amenity_id' => $amenity,
                    'unit_id' => $unit_id
                ]);
            endforeach;
            Session::flash('success_message', ' Unit Has Been Added !');
            return redirect('unit/'.$id);
        } else {
            return redirect()->back()->withInput()
                ->withErrors($validator,'mess');
        }

    }
    public function Duplicate($id,Request $request){

            $unit = Unit:: findorfail($id);
            $newUnit = new Unit();
            $newUnit->name = $unit->name;
            $newUnit->building_id = $unit->building_id;
            $newUnit->type = $unit->type;
            $newUnit->floor = $unit->floor;
            $newUnit->available = $unit->available;
            $newUnit->multi_tenant = $unit->multi_tenant;
            $newUnit->furnished = $unit->furnished;
            $newUnit->save();
            $unit_id = $newUnit->unit_id;
            Response::json(array('success' => true, 'last_insert_id' => $unit_id), 200);
            foreach (UnitAmenities::where('unit_id',$id)->get() as $amenity):
                UnitAmenities::insert([
                    'private_amenity_id' => $amenity->private_amenity_id,
                    'unit_id' => $unit_id
                ]);
            endforeach;

            $json['success'] = " Duplicate Unit Has Been Added.";
            $json['unit_total'] = Unit::where('building_id',$unit->building_id)->count();
            echo json_encode($json);

    }
    public function getEdit($unit_id){
        $unit = Unit::where('unit_id',$unit_id)->first();
        $breadcrumb = array(
            'Home'=> URL('/'),
            'Building'=> URL('building'),
            'Building Unit'=> URL('unit/'.$unit->building_id),
            'Edit Unit '=> URL('unit/edit/'.$unit->building_id),
        );
        $unit = Unit::where('unit_id',$unit_id)->first();
        $heading = "Edit Unit";
        $unit_amenities =array();
        $i=0;
        foreach(UnitAmenities::where('unit_id',$unit_id)->get() as $ua):
            $unit_amenities[$i] = $ua->private_amenity_id;
            ++$i;
        endforeach;
        return view('property.unit.edit',[
            'heading' => $heading,
            'active_menu' => $this->active_menu,
            'unit' => $unit,
            'breadcrumb' => $breadcrumb,
            'private_amenities' => PrivateAmenities::get(),
            'unit_amenities' => $unit_amenities,
            'ActionURL' => URL('unit/edit/'.$unit_id),
        ]);


    }

    public function Edit($id,Request $request){
        $validate =array();
        $name =array();
        $validate ['name'] = 'required|max:109';
        $validator = Validator::make($request->all(),$validate,[],$name);
        if (!$validator->fails()) {
            $unit = Unit::findorfail($id);
            $unit->name = $request->name;
            $unit->type = $request->type;
            $unit->floor = $request->floor;
            $unit->available = $request->available;
            $unit->multi_tenant = $request->multi_tenant;
            $unit->furnished = $request->furnished;
            $unit->save();
            $unit_id = $id;
            UnitAmenities::where('unit_id',$unit_id)->delete();
            foreach ($request->amenities as $amenity):
                UnitAmenities::insert([
                    'private_amenity_id' => $amenity,
                    'unit_id' => $unit_id
                ]);
            endforeach;
            Session::flash('success_message', ' Unit Has Been Modefied !');
            return redirect()->back();
        } else {
            return redirect()->back()->withInput()
                ->withErrors($validator,'mess');
        }


        echo json_encode($json);

    }

    public function getUnits($building_id,Request $request){
        $units = array();
        $BuildingUnits = Unit::where('building_id',$building_id);
        if(!$request->free) {
            $BuildingUnits->where(function ($q) {
             $q->where('available', 1)
               ->orwhere('multi_tenant', 1);
             });
        }
        if(!$request->term != ""){
            $BuildingUnits->where("name","like",'%'.$request->term.'%');
        }

        foreach ($BuildingUnits->get() as $unit):
            $units[] = [
                'label' => $unit->name,
                'value' => $unit->unit_id
            ];
        endforeach;

        /*foreach ($BuildingUnits->get() as $unit):
            $units[] = $unit->name;
        endforeach;*/
        echo json_encode($units);

    }

    public function getTotalUnits($building_id){
        $json['total_unit'] = Unit::where('building_id',$building_id)->count();
        echo json_encode($json);

    }


    public  function Destroy($id){
        UnitAmenities::where('unit_id',$id)->delete();
        Unit::where('unit_id',$id)->delete();
    }

}
