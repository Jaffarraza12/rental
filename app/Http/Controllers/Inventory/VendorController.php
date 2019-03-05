<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Model\Account;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Vendor;
use App\Http\Model\VendorCategory;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Jimmyjs;
use PdfReport;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    //
    var $active_menu;
    public function __construct(){
        $this->active_menu = 'vendor';
    }
    public function index(){
        $heading = "Vendors";
        $breadcrumb = array(
            'Home'=> URL('/'),
            'Vendors'=> URL('vendors')
        );
        return view('inventory.vendor.view',[
            'heading' => $heading ,
            'breadcrumb' => $breadcrumb,
            'active_menu' => $this->active_menu

        ]);
    }
    public function getData(Request $request){
        return Datatables::of(Vendor::select(array('id','name','contact_email','phone_mobile')))
            ->addColumn('operations',
                '<div class="btn-group">  
                  <button type="button" class="btn dropdown-toggle flag_green" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #fff">
                    <span >ACTION</span>
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a href="{{ URL("/vendors/".$id."/edit")}}">Edit</a></li>
                    <li><a class="remove" data-id="{{$id}}" >Delete</a></li>
                  </ul>
                </div>')
            ->make(true);
    }
    public function create(){
        $heading = " Add Vendor ";
        $breadcrumb = array(
            'Home'=> URL('/'),
            'Vendors'=> URL('vendors'),
            'Add vendor'=> URL('vendors/create')
        );
        $categories =  array();
        foreach(VendorCategory::get() as $vendor){
            $categories[$vendor->id] = $vendor->name;
        }
        $expense_account =array();
        foreach(Account::where('pid',9)->get() as $account){
            $expense_account[$account->id] = $account->name;
        }
        return view('inventory.vendor.add',[
            'heading' => $heading,
            'active_menu' => $this->active_menu,
            'breadcrumb' => $breadcrumb,
            'categories' => $categories,
            'expense_account_type' => $expense_account,
            'ActionURL' => URL('vendors'),
        ]);
    }
    public function store(Request $request){
        $validate =array();
        $name =array();
        $validate['name'] = 'required|max:109';
        $validate['company_name'] = 'required';
        $validate['contact_email'] = 'required';
        $validator = Validator::make($request->all(),$validate,[],array());
        if(!$validator->fails()){
            $vendor = new Vendor();
            $vendor->name = $request->name;
            $vendor->company_name = $request->company_name;
            $vendor->category_vendor_id = $request->category_vendor_id;
            $vendor->expense_account = $request->expense_account;
            $vendor->account_number = $request->account_number;
            $vendor->contact_email = $request->contact_email;
            $vendor->contact_alernative_email = $request->contact_alernative_email;
            $vendor->phone_mobile = $request->phone_mobile;
            $vendor->phone_office = $request->phone_office;
            $vendor->phone_home  = $request->phone_home;
            $vendor->province  = $request->province;
            $vendor->postal_code  = $request->postal_code;
            $vendor->country  = $request->country;
            $vendor->website  = $request->website;
            $vendor->comment = $request->comment;
            $vendor->expiration_date  = $request->expiration_date;
            $vendor->provider  = $request->provider;
            $vendor->policy_number  = $request->policy_number;
            $vendor->expiration_date  = $request->expiration_date;
            $vendor->save();
            Session::flash('success_message', 'New Vendor Has Been Added !');
            return redirect('vendors');
        } else {
            return redirect()->back()
                ->withErrors($validator,'mess');

        }

    }
    public function edit($id){
        $heading = " Edit Vendor ";
        $breadcrumb = array(
            'Home'=> URL('/'),
            'Vendors'=> URL('vendors'),
            'Edit vendor'=> URL('vendor/'.$id.'/edit')
        );
        $categories =  array();
        foreach(VendorCategory::get() as $vendor){
            $categories[$vendor->id] = $vendor->name;
        }
        $expense_account =array();
        foreach(Account::where('pid',9)->get() as $account){
            $expense_account[$account->id] = $account->name;
        }
        return view('inventory.vendor.edit',[
            'heading' => $heading,
            'active_menu' => $this->active_menu,
            'record' => Vendor::where('id',$id)->first(),
            'breadcrumb' => $breadcrumb,
            'expense_account_type' => $expense_account,
            'categories' => $categories,
            'ActionURL' => URL('vendors/'.$id),
        ]);
    }
    public function update(Request $request,$id){
        $validate =array();
        $name =array();
        $validate['name'] = 'required|max:109';
        $validate['company_name'] = 'required';
        $validate['contact_email'] = 'required';
        $validator = Validator::make($request->all(),$validate,[],array());
        if(!$validator->fails()){
            $vendor =  Vendor::find($id);
            $vendor->name = $request->name;
            $vendor->company_name = $request->company_name;
            $vendor->category_vendor_id = $request->category_vendor_id;
            $vendor->expense_account = $request->expense_account;
            $vendor->account_number = $request->account_number;
            $vendor->contact_email = $request->contact_email;
            $vendor->contact_alernative_email = $request->contact_alernative_email;
            $vendor->phone_mobile = $request->phone_mobile;
            $vendor->phone_office = $request->phone_office;
            $vendor->phone_home  = $request->phone_home;
            $vendor->province  = $request->province;
            $vendor->postal_code  = $request->postal_code;
            $vendor->city  = $request->city;
            $vendor->country  = $request->country;
            $vendor->website  = $request->website;
            $vendor->comment = $request->comment;
            $vendor->expiration_date  = $request->expiration_date;
            $vendor->provider  = $request->provider;
            $vendor->policy_number  = $request->policy_number;
            $vendor->expiration_date  = $request->expiration_date;
            $vendor->save();
            Session::flash('success_message', 'Vendor Has Been Modified !');
            return redirect('vendors');
        } else {
            return redirect()->back()
                ->withErrors($validator,'mess');

        }
    }
    public function destroy(Request $request,$id){
        $json = array();
        $vendor= Vendor::find($id);
        if($vendor ){
            $vendor->delete();
            $json['success'] = true;
        } else {
            $json['success'] = false;
        }
        echo json_encode($json);


    }
}
