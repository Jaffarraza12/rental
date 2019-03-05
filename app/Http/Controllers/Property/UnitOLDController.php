<?php

namespace App\Http\Controllers\Property;

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



class UnitController extends Controller
{

    public function index($building_id){
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
            'heading' => $heading ,
            'sub_heading' => 'Total '.$building->units .' Units',
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
        return Datatables::of(Building ::select(array('building.building_id','building.name','building.units','building.created_at','building.updated_at')))
            ->addColumn('operations',
                '<ul class="no_style">
                         <li>
                           <a href="javascript:;" class="remove" data-id="{{$building_id}}" data-url="{{ URL("building/remove/".$building_id)}}">
                         <i class="fa fa-remove" title=""></i> </a>
                         </li>
                         <li><a class="pop" data-url="{{ URL("building/edit/".$building_id)}}">
                         <i class="fa fa-edit"></i> </a>
                         </li>
                         <li><a class="pop"title="Units Detail" href="{{ URL("unit/".$building_id)}}">
                         <i class="fa fa-square-o"></i> </a>
                         </li>
                         </ul>')
            ->make(true);
    }

    public function save($id,Request $request){
        $validate =array();
        $name =array();
        $validate ['name'] = 'required|max:109';

        $validator = Validator::make($request->all(),$validate,[],$name);
        $json =  array();

        if (!$validator->fails()) {
            $unit = Unit::find($request->id);
            $unit->name = $request->name;
            $unit->type = $request->type;
            $unit->floor = $request->floor;
            $unit->available = $request->available;
            $unit->furnished = $request->furnished;
            $unit->save();
            $unit_id = $request->id;
            UnitAmenities::where('unit_id',$unit_id)->delete();
            foreach ($request->amenities as $amenity):
                UnitAmenities::insert([
                    'private_amenity_id' => $amenity,
                    'unit_id' => $unit_id
                ]);
            endforeach;
            $json['success'] = " Unit Has Been Successfully Modefied !";
        } else {
            $json['error'] = $validator->errors()->all();
        }


        echo json_encode($json);

    }

    public function getAdd($building_id){

    }


    public function getUnits($building_id){
      $units = array();
        foreach (Unit::where('building_id',$building_id)->get() as $unit):
            $units[$unit->unit_id] = $unit->name;
        endforeach;
        echo json_encode($units);

    }

}
