<?php

namespace App\Http\Controllers\Property;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Building;
use App\Http\Model\BuildingContact;
use App\Http\Model\CommonAmenities;
use App\Http\Model\BuildingAmenities;
use App\Http\Model\Unit;
use App\Http\Model\UnitAttribute;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;



class BuildingController extends Controller
{
    //
    var $active_menu ;
    public  function  __construct()
    {
       if (Auth::user()->pid==1)
       {
           redirect('/')->send();
           Session::flash('success_message', ' You are not Autherized !');
       }
       $this->active_menu = 'building';

    }

    public function index(){
        $heading = "Buildings";
        $breadcrumb = array(
            'Home'=> URL('/'),
            'Building'=> URL('building')
        );
        return view('property.building.view',[
            'heading' => $heading ,
            'breadcrumb' => $breadcrumb,
            'active_menu' => $this->active_menu

        ]);
    }
    public function getData() {
        return Datatables::of(Building ::select(array('building.building_id','building.name','building.units','building.street_address')))
            ->addColumn('operations',
                '<div class="btn btn-group">
                  <button type="button" class="btn dropdown-toggle flag_green" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=" color: #fff">
                    <span >ACTION &nbsp;&nbsp;&nbsp;</span>
                    <span class="fa fa-caret-down"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu">
                   <li><a href="javascript:;" class="remove" data-id="{{$building_id}}" data-url="{{ URL("building/remove/".$building_id)}}"> <i class="fa fa-remove" title=""></i> REMOVE </a> </li>
                   <li><a href="{{ URL("building/edit/".$building_id)}}"><i class="fa fa-edit"></i>  EDIT</a></li>
                    <li><a class="pop"title="Units Detail" href="{{ URL("unit/".$building_id)}}"><i class="fa fa-square-o"></i> DELETE </a></li> </ul>
                </div>')
            ->make(true);
    }
    public function getAdd() {
        $heading = "Add Building";
        $breadcrumb = array(
            'Home'=> URL('/'),
            'Building'=> URL('building'),
            'Add Building' => URL('building/add')
        );

        return view('property.building.add',[
            'heading' => $heading,
            'active_menu' => $this->active_menu,
            'CommonAmenities' => CommonAmenities::get(),
            'breadcrumb' => $breadcrumb,
            'ActionURL' => URL('building/add'),
        ]);
    }
    public function Add(Request $request) {
        $validate =array();
        $name =array();
        $validate ['name'] = 'required|max:109';
        $validate ['building_type'] = 'required';
        $validate ['units'] = 'required|integer';
        $validator = Validator::make($request->all(),$validate,[],$name);
       if (!$validator->fails()) {
           $building = new Building();
           $building->user_id =Auth::user()->id;
           $building->name = $request->name;
           $building->building_type = $request->building_type;
           $building->buidling_type_unit = $request->buidling_type_unit;
           $building->units = $request->units;
           $building->num_floors = $request->num_floors;
           $building->description= $request->description;
           $building->year_of_construction= $request->year_of_construction;
           $building->history= $request->history;
           $building->mission= $request->mission;
           $building->zip_code= $request->zip_code;
           $building->street_address= $request->street_address;
           $more_common_amenities = array();
           if($request->more_amenities != "") {
               $moreAmenity = explode(",", $request->more_amenities);
               if(is_array($moreAmenity)) {
                   foreach ($moreAmenity as $ca):
                       $more_common_amenities[$ca] = 1;
                   endforeach;
               }
           }
           if($more_common_amenities) {
               $building->common_amenities = json_encode($more_common_amenities);
           }
           $building->save();
           $building_id = $building->building_id;
           Response::json(array('success' => true, 'last_insert_id' => $building_id), 200);
           foreach ($request->amenities as $amenity ):
                BuildingAmenities::insert([
                    "building_id" => $building_id,
                    'common_amenity_id' => $amenity
                ]);
           endforeach;
           $i =0;
           foreach ($request->contact_person as $contact ):
                       BuildingContact::insert([
                          "building_id" => $building_id,
                          "contact_person" => $contact,
                          "designation" => $request->designation[$i],
                          "phone" => $request->phone[$i],
                          "phone_2" => $request->phone_2[$i],
                       ]);
               $i++;
           endforeach;;
           //unit
           Session::flash('success_message', ' Building Has Been Added !');
           return redirect('building');
       } else {
           return redirect()->back()->withInput()
               ->withErrors($validator,'mess');
       }

    }
    public function getEdit($id) {
        $heading = "Edit Building";
        $breadcrumb = array(
            'Home'=> URL('/'),
            'Building'=> URL('building'),
            'Edit Building' =>  URL('building/edit/'.$id)
        );
        if (Building::findorfail($id)) {


            $building_amenity =array();
            $i=0;
                foreach (BuildingAmenities::where('building_id',$id)->get() as $ba){
                    $building_amenity[$i] = $ba->common_amenity_id;
                    $i++;
                }

            return view('property.building.edit', [
                'heading' => $heading,
                'breadcrumb' => $breadcrumb,
                'active_menu' => $this->active_menu,
                'building_amenities' => $building_amenity,
                'record' => building::where('building_id',$id)->first(),
                'CommonAmenities' => CommonAmenities::get(),
                'BuildingContact' => BuildingContact::where('building_id',$id)->get(),
                'ActionURL' => URL('building/edit/' . $id),
            ]);
        }
    }
    public function Edit($id,Request $request) {

        if (Building::findorfail($id)) {
            $name =array();
            $validate ['name'] = 'required|max:109';
            $validator = Validator::make($request->all(),$validate,[],$name);

            if (!$validator->fails()) {
                $building = Building::find($id);
                $building->name = $request->name;
                $building->building_type = $request->building_type;
                $building->buidling_type_unit = $request->buidling_type_unit;
                $building->units = $request->units;
                $building->num_floors = $request->num_floors;
                $building->description= $request->description;
                $building->year_of_construction= $request->year_of_construction;
                $building->history= $request->history;
                $building->mission= $request->mission;

                $building->operation_hours= $request->operation_hours;
                $building->zip_code= $request->zip_code;
                $building->street_address= $request->street_address;
                $more_common_amenities = array();
                if($request->more_amenities) {
                    $moreAmenity = explode(",", $request->more_amenities);
                    if(is_array($moreAmenity)) {
                        foreach ($moreAmenity as $ca):
                            $more_common_amenities[$ca] = 1;
                        endforeach;
                    }
                }
                if(is_array($request->old_amenities)) {
                    foreach ($request->old_amenities as $ca):
                        $more_common_amenities[$ca] = 1;
                    endforeach;
                }

                if($more_common_amenities) {
                    $building->common_amenities = json_encode($more_common_amenities);
                }
                $building->save();

                BuildingAmenities::where("building_id", $id)->delete();
                //building amenities
                foreach ($request->amenities as $amenity ):
                    BuildingAmenities::insert([
                        "building_id" => $id,
                        'common_amenity_id' => $amenity
                    ]);
                endforeach;
                $i=0;
                if(count($request->input("building_contact_id"))) {
                   foreach ($request->building_contact_id as $building_contact_id):
                        BuildingContact::where('building_contact_id', $building_contact_id)->update(
                            [
                                "contact_person" => $request->contact_person_old[$i],
                                "designation" => $request->designation_old[$i],
                                "phone" => $request->phone_old[$i],
                                "website" => $request->website_old[$i],
                                "phone_2" => $request->phone_2_old[$i],
                            ]);
                        $i++;
                    endforeach;
                }
                if(count($request->input("contact_person"))) {
                    $i =0;
                    foreach ($request->contact_person as $contact ):
                        BuildingContact::insert([
                            "building_id" => $id,
                            "contact_person" => $contact,
                            "designation" => $request->designation[$i],
                            "phone" => $request->phone[$i],
                            "phone_2" => $request->phone_2[$i],
                            "website" => $request->website[$i]
                        ]);
                        $i++;
                    endforeach;;
                }
                Session::flash('success_message', ' Building Has Been Modefied !');
                return redirect('building');
            } else {

                return redirect()->back()->withInput()
                    ->withErrors($validator,'mess');
            }
        }

    }
    public function getBuilding($id) {
        Building::find($id);
        $building = Building::where('building_id',$id)->first();
        $buildingContact = BuildingContact::where('building_id',$id)->first();
        $json = array();
        $json['building_id'] = $building->building_id;
        $json['name'] = $building->name;
        $json['manager'] = $buildingContact->contact_person .' ( '.$buildingContact->designation.' ) ';
        $json['phone'] = $buildingContact->phone;
        $json['num_floors'] = $building->num_floors;
        $json['units'] = $building->units;
        $json['city'] = $building->city;
        $json['state'] = $building->state;
        $json['address'] = $building->street_address;

        echo json_encode($json);

    }
    public function Destroy($id,Request $request) {
        $units = Unit::where('building_id',$id);
        $units->delete();

        $buildingAmenities =BuildingAmenities::where('building_id',$id);
        $buildingAmenities->delete();

        $building = Building::find($id);
        $building->delete();

    }
    public function DestroyContact($id,Request $request) {
        $building_contact = BuildingContact::where('building_contact_id',$id);
        $building_contact->delete();
    }

    public function SwitchBuilding($id,Request $request) {

        //Auth::id();

        $building_switch = Building::where('building_id',$id)->first();
        $request->session()->put('defaultBuilding', $building_switch->building_id);
        session(['key' => 'jaffar']);

        //return response()->json(['response' => 'OK']);
    }

}
