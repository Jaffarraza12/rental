<?php

namespace App\Http\Controllers\applicant;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Applicant;
use App\Http\Model\ApplicantEmployer;
use App\Http\Model\ApplicantDocument;
use App\Http\Model\Building;
use App\Http\Model\ApplicantOccupant;
use App\Http\Model\ApplicantVehicle;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApplicantController extends Controller
{
    public function __construct()
    {

    }

    //
    public function index(){
        $heading = "Applicants";
        $breadcrumb = array(
            'Home'=> URL('/'),
            'Applicant'=> URL('applicant')
        );
        return view('applicant.applicant.view',[
            'heading' => $heading ,
            'breadcrumb' => $breadcrumb,
            'ActiveMenu' => 'applicant'


        ]);

    }
    public function getData(Request $request) {

        $buildingId = $request->session()->get('defaultBuilding');
        $userId = Auth::id();
        return Datatables::of(Applicant ::select(array('applicant_id','user_id','name','email','phone','address','prefer_type','prefer_building')))
            ->where('prefer_building',$buildingId)
            ->where('user_id',$userId)
            ->editColumn('name','<a href="{{ URL("applicant/view/".$applicant_id)}}">{{$name}}</a>')
            ->addColumn('actions',
                '<div class="btn-group">
  <button type="button" class="btn" style="background: #eb8209; color: #fff">Action</button>
  <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background: #eb8209; color: #fff">
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu">
    <li><a href="{{ URL("applicant/edit/".$applicant_id)}}">Edit</a></li>
    <li><a href="{{ URL("applicant/remove/".$applicant_id)}}" class="remove"  data-id="{{$applicant_id}}">Delete</a></li>
  </ul>
</div>

<select id="actionBox" class="actionBox" style="display: none;">
                            <option>Action</option>
                            <option value="{{ URL("applicant/edit/".$applicant_id)}}">Edit</option>
                            <option class="remove"  data-id="{{$applicant_id}}" value="{{ URL("applicant/remove/".$applicant_id)}}">Delete</option>
                        </select>    
                        <ul class="no_style" style="display:none;">                        
                         <li>
                           <a href="javascript:;" class="remove" data-id="{{$applicant_id}}" data-url="{{ URL("applicant/remove/".$applicant_id)}}">
                         <i class="fa fa-remove" title=""></i> </a>
                         </li>
                         <li><a class="pop" data-url="{{ URL("a/edit/".$applicant_id)}}">
                         <i class="fa fa-edit"></i> </a>
                         </li>
                         </ul>')
            ->make(true);
    }
    public function getAdd(Request $request) {
        $heading = "Add Applicant";
        $breadcrumb = array(
            'Home'=> URL('/'),
            'Applicants'=> URL('applicant'),
            'Add'=> URL('applicant/add')
        );

        $buildingId = $request->session()->get('defaultBuilding');

        $buildings=DB::table('building')->select('name')->where('building_id', $buildingId)->first();
        /*foreach(Building::get() as $build){
            $buildings[$build->building_id] = $build->name;
        }*/
       /* foreach(Building::where('building_id',$buildingId)->get() as $build){
            $buildings[$build->building_id] = $build->name;
        }*/

        return view('applicant.applicant.add',[
            'heading' => $heading,
            'breadcrumb' => $breadcrumb,
            'buildings' => $buildings,
            'ActiveMenu' => 'applicant',
            'ActionURL' => URL('applicant/add')
        ]);


    }
    public function Add(Request $request) {

        $validate =array();
        $name =array();
        $validate ['name'] = 'required|max:109';
        $validate ['email'] = 'required|email|max:109';
        $validator = Validator::make($request->all(),$validate,[],$name);

        $userId = Auth::id();

        if (!$validator->fails()) {

            $applicant = new Applicant();
            $applicant->user_id = $userId;
            $applicant->name = $request->name;
            $applicant->email = $request->email;
            $applicant->phone = $request->phone;
            $applicant->ssn = $request->ssn;
            $applicant->address = $request->address;
            $applicant->driving_license = $request->driving_license;
            $applicant->smoke = $request->smoke;
            $applicant->profile = $request->profile;
            $applicant->lease_perfer = $request->lease_perfer;
            $applicant->prefer_type = $request->prefer_type;
            $applicant->prefer_area = $request->prefer_area;
            $applicant->prefer_building = $request->prefer_building;
            $applicant->notes = $request->notes;
            $applicant->save();
            $applicant_id = $applicant->applicant_id;
            Response::json(array('success' => true, 'last_insert_id' => $applicant_id), 200);
            //Applicant Occupant
            $i=0;
            foreach($request->occupant_name as $occupant_name):
                ApplicantOccupant::insert([
                    'applicant_id' => $applicant_id,
                    'name' => $occupant_name,
                    'relation' => $request->relation[$i],
                    //  'comment' => $request->comments[$i]
                ]);
                $i++;
            endforeach;
            //Applicant vehicle
            $i=0;
            foreach($request->make as $make):
                ApplicantVehicle::insert([
                    'applicant_id' => $applicant_id,
                    'make' => $make,
                    'model' => $request->model[$i],
                    'tag' => $request->tag[$i]
                ]);
                $i++;
            endforeach;


            //Applicant Income
            $i=0;
            foreach($request->employer as $employer):
                ApplicantEmployer::insert([
                    'applicant_id' => $applicant_id,
                    'employer' => $employer,
                    'role' => $request->role[$i],
                    'telephone' => $request->employer_phone[$i],
                    'duration' => $request->duration[$i],
                    'income' => $request->income[$i],
                ]);
                $i++;
            endforeach;
         /*   $i=0;
            foreach($request->file as $file):
                if($request->hasFile('file')[0]->isValid()){
                    $path = $request->file->path();
                    $extension = $request->file->extension();
                    $request->file->storeAs('images', 'filename.jpg');



                }
                $i++;
           endforeach;*/
            if($request->ajax()){
                $json = array();
                $json['applicant_id'] = $applicant_id;
                $json['applicant_name'] = $request->name;
                $json['lease_perfer'] = $request->lease_perfer;
                $json['prefer_type'] = $request->prefer_type;
                $json['email'] = $request->email;
                $json['phone'] = $request->phone;
                $json['profile'] = $request->profile;
                $json['prefer_type'] = $request->prefer_type;
                $json['success'] =' New Applicant Has been Added !';
                echo json_encode($json);

            } else {
                Session::flash('success_message', ' New Applicant Has been Added !');
                return redirect('applicant');
            }

        } else {
            if($request->ajax()) {
                $errors = $validator->errors();
                $json['error'] = $errors;
                echo json_encode($json);


            } else {
                return redirect()->back()->withErrors($validator);
            }




        }


    }
    public function getEdit($id) {}
    public function Edit($id,Request $request) {}
    public function Destroy($id,Request $request) {
        $applicant = Applicant::where('applicant_id',$id);
        $applicant->delete();
    }

    public function Detail($id){
        $app = Applicant::where('applicant_id',$id)->first();

        echo json_encode($app);
    }
}
