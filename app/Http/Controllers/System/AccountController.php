<?php

namespace App\Http\Controllers\System;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Vendor;
use App\Http\Model\Account;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Model\VendorCategory;
use Illuminate\Support\Facades\Response;

class AccountController extends Controller
{
    var $active_menu;
    public function __construct(){
        $this->active_menu = 'setting';
    }
    public function index(){
        $heading = "Chart Of Account";
        $breadcrumb = array(
            'Home'=> URL('/'),
            'Account'=> URL('account')
        );
        return view('system.account.view',[
            'heading' => $heading ,
            'breadcrumb' => $breadcrumb,
            'active_menu' => $this->active_menu

        ]);
    }
    public function getData(Request $request){
        return Datatables::of(Account::select(array('id','name','pid as type','sub' ))->where('pid','!=',0))
            ->editColumn('type',function($a){
                $account = Account::where('id',$a->type)->first();
                return $account->name;

            })
            ->addColumn('operations',
                '<div class="btn-group">  
                  <button type="button" class="btn dropdown-toggle flag_green" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #fff">
                    <span >ACTION</span>
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a href="{{ URL("/account/".$id."/edit")}}">Edit</a></li>
                    <li><a data-id="{{$id}}" class="remove" ">Delete</a></li>
                  </ul>
                </div>')
            ->make(true);
    }
    public function create(){
        $heading = " Add Account";
        $breadcrumb = array(
            'Home'=> URL('/'),
            'Account'=> URL('account'),
            'Add Account'=> URL('account/create')
        );
        $types  =  array();
        foreach(Account::where('pid',0)->get() as $account){
            $types[$account->id] = $account->name;
        }
        return view('system.account.add',[
            'heading' => $heading,
            'active_menu' => $this->active_menu,
            'breadcrumb' => $breadcrumb,
            'types' => $types,
            'ActionURL' => URL('account'),
        ]);

    }
    public function store(Request $request){
        $validate =array();
        $name =array();
        $validate['name'] = 'required|max:109';
        $validate['pid'] = 'required|int';
        $validator = Validator::make($request->all(),$validate,[],array());
        if(!$validator->fails()){
            $account = new Account();
            $account->name = $request->name;
            $account->pid = $request->pid;
            $account->sub= $request->sub;
            $account->comment = $request->comment;
            $account->save();
            Session::flash('success_message', 'Account Has Been Added !');
            return redirect('account');
        } else {
            return redirect()->back()
                ->withInput()->withErrors($validator,'mess');

        }

    }
    public function edit($id){
        $heading = " Edit Account";
        $breadcrumb = array(
            'Home'=> URL('/'),
            'Account'=> URL('account'),
            'Edit Account'=> URL('account/'.$id.'/edit')
        );
        $types  =  array();
        foreach(Account::where('pid',0)->get() as $account){
            $types[$account->id] = $account->name;
        }
        return view('system.account.edit',[
            'heading' => $heading,
            'active_menu' => $this->active_menu,
            'breadcrumb' => $breadcrumb,
            'record' => Account::where('id',$id)->first(),
            'types' => $types,
            'ActionURL' => URL('account/'.$id  ),
        ]);
    }
    public function update(Request $request,$id){
        $validate =array();
        $name =array();
        $validate['name'] = 'required|max:109';
        $validate['pid'] = 'required|int';
        $validator = Validator::make($request->all(),$validate,[],array());
        if(!$validator->fails()){
            $account = Account::find($id);
            $account->name = $request->name;
            $account->pid = $request->pid;
            $account->sub= $request->sub;
            $account->comment = $request->comment;
            $account->save();
            Session::flash('success_message', 'Account Has Been Modefied !');
            return redirect('account');
        } else {
            return redirect()->back()
                ->withInput()->withErrors($validator,'mess');

        }
    }

    public function destroy(Request $request,$id){
        $json = array();
        $account = Account::find($id);
        if($account){
            $account->delete();
            $json['success'] = true;
        } else {
            $json['success'] = false;
        }
        echo json_encode($json);


    }
}
