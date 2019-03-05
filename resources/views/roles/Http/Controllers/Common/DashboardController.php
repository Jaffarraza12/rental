<?php

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //

    public  function __construct()
    {
            if(Auth::guest()){
               return redirect()->guest('/login');

            }
    }

    public function index(){
        $heading = "Dashboard";
        $breadcrumb = array(
            'Home'=> URL('/')
        );
        return view('common.dashboard',[
            'heading'=>$heading,
            'breadcrumb'=>$breadcrumb
        ]);
    }
}
