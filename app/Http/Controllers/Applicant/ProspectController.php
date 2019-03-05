<?php

namespace App\Http\Controllers\Applicant;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Model\Prospect;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use App\Http\Model\Applicant;
use App\Http\Model\ApplicantBuilding;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;

class ProspectController extends Controller
{
    //
    var $active_menu;
    var $building;
    public  function  __construct()
    {
        $this->active_menu = 'applicant';
    }
    function index(){
        $heading = "Applicants";
        $breadcrumb = array(
            'Home'=> URL('/'),
            'Prospect'=> URL('prospect')
        );
        return view('applicant.prospect.view',[
            'heading' => $heading ,
            'breadcrumb' => $breadcrumb,
            'active_menu' => $this->active_menu

        ]);
    }
    function getData(Request $request){

        $dataTable = Datatables::of(Applicant::select(array('applicant_id','name','email','status'))
            ->join('applicant_building','applicant_building.id','=','applicant.applicant_id')
            ->orderBy('applicant.created_at','desc'))
            ->editColumn('status',function($status){
                  if($status->status == 1){
                     return 'Inquiry (Web)';
                } else if($status->status== 2) {
                     return 'Inquiry (Office)';
                } else if($status->status == 3) {
                    return 'Invitation Sent';
                } else if($status->status == 4) {
                    return 'Submit From Web';
                } else if($status->status == 5) {
                    return 'Submit Manual';
                }
            })
            ->addColumn('actions',
                '<div class="btn btn-group">
  <button type="button" class="btn dropdown-toggle flag_green" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #fff">
    <span >ACTION &nbsp;&nbsp;&nbsp;</span>
    <span class="fa fa-caret-down"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu">
    <li><a href="{{ URL("applicants/".$applicant_id."/edit")}}">Edit</a></li>
    <li><a href="{{ URL("building/remove/".$applicant_id)}}" class="remove"  data-id="{{$applicant_id}}">Delete</a></li>
    <li><a href="{{ URL("applicants/".$applicant_id."/notification")}}">Send Applicant Form</a></li>
    <li><a href="{{ URL("applicants/".$applicant_id."/modify")}}">Manual Enter Applicant Detail</a></li>
  </ul>
</div>')
            ->make(true);

        return $dataTable;



    }

    function create(){
        $heading = " Add Applicant ";
        $breadcrumb = array(
            'Home'=> URL('/'),
            'Applicant'=> URL('applicants'),
            'Add Applicant'=> URL('applicants/create')
        );
        return view('applicant.prospect.add',[
            'heading' => $heading,
            'active_menu' => $this->active_menu,
            'breadcrumb' => $breadcrumb,
            'ActionURL' => URL('applicants'),
        ]);
    }
    function store(Request $request){
        $validate =array();
        $name =array();
        $validate ['name'] = 'required|max:109';
        $validate ['email'] = 'required|max:109|unique:applicant,email';
        $validator = Validator::make($request->all(),$validate,[],$name);
        if (!$validator->fails()) {
            $applicant = new Applicant();
            $applicant->name = $request->name;
            $applicant->email = $request->email;
            $applicant->phone = $request->phone;
            $applicant->mobile = $request->mobile;
            $applicant->address = $request->address;
            $applicant->status = 2;
            $applicant->prefer_type = $request->prefer_type;
            $applicant->save();
            $applicant_id = $applicant->applicant_id;
            Response::json(array('success' => true, 'last_insert_id' => $applicant_id), 200);
            $applicantBuilding = new ApplicantBuilding();
            $applicantBuilding->id = $applicant_id;
            $applicantBuilding->building_id = $request->session()->get('defaultBuilding');
            $applicantBuilding->unit_id = $request->unit_id;
            $applicantBuilding->save();
            Session::flash('success_message', ' New Applicant Has been Added !');
            return redirect('applicants');
        } else {
            return redirect()->back()->withInput()->withErrors($validator,'mess');
        }
    }
    function sendNotification($id){
        Session::flash('success_message', 'Applicant Form Has Been Sent Via Email');
        return redirect('applicants');
    }
    function manualForm($id){
        $heading = " Applicants ";
        $breadcrumb = array(
            'Home'=> URL('/'),
            'Applicant'=> URL('applicants'),
            'Applicant Profile'=> URL('applicants/'.$id.'/manualForm')
        );
        return view('applicant.prospect.complete',[
            'heading' => $heading,
            'breadcrumb' => $breadcrumb,
            'applicant' => Applicant::select('applicant.*','applicant_building.unit_id')->LeftJoin('applicant_building','applicant_building.id','=','applicant.applicant_id')->where('applicant_id',$id)->first(),
            'ActionURL' => URL('applicants/update'),
        ]);

    }
    function show(){}
    function edit($id){

        $heading = " Applicants ";
        $breadcrumb = array(
            'Home'=> URL('/'),
            'Applicant'=> URL('applicants'),
            'Edit Applicant'=> URL('applicants/'.$id.'/edit')
        );
        return view('applicant.edit',[
            'heading' => $heading,
            'breadcrumb' => $breadcrumb,
            'active_menu' => $this->active_menu,
            'applicant' => Applicant::select('applicant.*','applicant_building.unit_id')->LeftJoin('applicant_building','applicant_building.id','=','applicant.applicant_id')->where('applicant_id',$id)->first(),
            'ActionURL' => URL('applicants/update'),
        ]);

    }
    function update(Request $request){
        $validate =array();
        $name =array();
        $validate ['name'] = 'required|max:109';
        $validate ['email'] = 'required|max:109';
        $validator = Validator::make($request->all(),$validate,[],$name);
        if (!$validator->fails()) {
            $applicant = Applicant::find($request->applicant_id);
            $applicant->name = $request->name;
            $applicant->email = $request->email;
            $applicant->phone = $request->phone;
            $applicant->mobile = $request->mobile;
            $applicant->address = $request->address;
            $applicant->status = $request->status;
            $applicant->prefer_type = $request->prefer_type;
            $applicant->save();

            Session::flash('success_message', ' Applicant Been Modified !');
            return redirect('applicants');
        } else {
            return redirect()->back()->withInput()->withErrors($validator,'mess');
        }
    }
    function application($id=0){
        $heading = " Create Application ";
        $breadcrumb = array(
            'Home'=> URL('/'),
            'Applicant'=> URL('applicants'),
            'Create Application'=> URL('applicants/new-rental-application')
        );
        return view('applicant.prospect.app',[
            'heading' => $heading,
            'active_menu' => $this->active_menu,
            'breadcrumb' => $breadcrumb,
            'ActionURL' => URL('applicants'),
        ]);
    }
    function destory(){}
}
