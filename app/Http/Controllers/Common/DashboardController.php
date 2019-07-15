<?php

namespace App\Http\Controllers\Common;

use App\Http\Model\Building;
use App\Http\Model\Payment;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Unit;
use App\Http\Model\WorkOrder;
use App\Http\Model\Applicant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    //

    public  function __construct()
    {

    }

    public function index(){

        $heading = "Dashboard";

        $breadcrumb = array(
            'Home'=> URL('/')
        );


       $fromDate = strtotime(date('Y-m').'-01');
       $endDate = strtotime(date('Y-m').'-30');
       $applicants = Applicant::where('tenant',100)->OrderBy('applicant_id','DESC')->take(3)->get();
       $building = Building::select()->get();

        $defaultBuilding =  0;
        if(Session::get('defaultBuilding')){
            $defaultBuilding = Session::get('defaultBuilding');
        } else {
            $defaultBuilding = 0;
        }
       return view('common.dashboard',[
            'heading'=>$heading,
            'breadcrumb'=>$breadcrumb,
            'applicants' => $applicants,
            'WorkOrder' => WorkOrder::where('status','!=',2)->get(),
            'CompleteWorkOrder' => WorkOrder::where('status',2)->get(),
            'TotalUnit'=>Unit::where(function($q){
                    $q->where('available',1)
                        ->orwhere('multi_tenant',1);
                })->count(),

            'TotalPayment'=> Payment::select(DB::raw('SUM(amount) as sales'))->where('building_id',$defaultBuilding )->whereBetween('recieve_at',array($fromDate,$endDate))->first(),
            'TotalWorkOrder'=> WorkOrder::where('status','!=',2)->where('building_id',$defaultBuilding )->count(),
            'TotalApplicant'=> Applicant::where('tenant',0)->count(),
            'ActiveMenu'=> 'dashboard',
       ]);
    }


    public function showBuilding(){

        $buildings = Building::select()->get();
        $heading = 'SELECT YOUR BUILDING FIRST';

        return view('common.showBuilding', compact('buildings','heading'));

    }

    public function Logout(){
        Auth::logout();
        return redirect(URL(''));


    }
}
