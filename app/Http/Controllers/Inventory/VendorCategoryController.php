<?php

namespace App\Http\Controllers\Inventory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Vendor;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Model\VendorCategory;
use Illuminate\Support\Facades\Response;

class VendorCategoryController extends Controller
{
    //
    var $active_menu;
    public function __construct(){
        $this->active_menu = 'vendor';
    }
    public function index(){
        $heading = "Vendor Category";
        $breadcrumb = array(
            'Home'=> URL('/'),
            'Vendors'=> URL('vendors-category')
        );
        return view('inventory.vendor-category.view',[
            'heading' => $heading ,
            'breadcrumb' => $breadcrumb,
            'active_menu' => $this->active_menu

        ]);
    }
    public function getData(Request $request){
        return Datatables::of(VendorCategory::select(array('vendor-category.id','vendor-category.name','vc.name AS PName','vc.id AS vid','vendor-category.detail'))
            ->rightJoin('vendor-category AS vc', 'vendor-category.id', '=', 'vc.pid'))
            ->editColumn('name','{{$PName." - ".$name}} ')
            ->addColumn('operations',
                '<div class="btn-group">  
                  <button type="button" class="btn dropdown-toggle flag_green" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #fff">
                    <span >ACTION</span>
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a href="{{ URL("/vendors-category/".$vid."/edit")}}">Edit</a></li>
                    <li><a data-id="{{$vid}}" class="remove" ">Delete</a></li>
                  </ul>
                </div>')
            ->removeColumn('PName')
            ->make(true);
    }
    public function create(){
        $heading = " Add Category ";
        $breadcrumb = array(
            'Home'=> URL('/'),
            'Categories'=> URL('vendors-category'),
            'Add Category'=> URL('vendors-category/create')
        );
        $categories =  array();
        $categories[0] = 'Parent Category';
        foreach(VendorCategory::where('pid',0)->get() as $vendor){
            $categories[$vendor->id] = $vendor->name;
        }
        return view('inventory.vendor-category.add',[
            'heading' => $heading,
            'active_menu' => $this->active_menu,
            'breadcrumb' => $breadcrumb,
            'categories' => $categories,
            'ActionURL' => URL('vendors-category'),
        ]);

    }
    public function store(Request $request){
        $validate =array();
        $name =array();
        $validate['name'] = 'required|max:109';
        $validate['pid'] = 'required|int';
        $validator = Validator::make($request->all(),$validate,[],array());
        if(!$validator->fails()){
            $vendorCategory = new VendorCategory();
            $vendorCategory->name = $request->name;
            $vendorCategory->pid = $request->pid;
            $vendorCategory->detail = $request->detail;
            $vendorCategory->save();
            Session::flash('success_message', 'Vendor Category Has Been Added !');
            return redirect('vendors-category');
        } else {
            return redirect()->back()
                ->withInput()->withErrors($validator,'mess');

        }

    }
    public function edit($id){
        $heading = " Edit Category ";
        $breadcrumb = array(
            'Home'=> URL('/'),
            'Categories'=> URL('vendors-category'),
            'Edit Category'=> URL('vendors-category'.$id.'/edit')
        );
        $categories =  array();
        $categories[0] = 'Parent Category';
        foreach(VendorCategory::where('pid',0)->get() as $vendor){
            $categories[$vendor->id] = $vendor->name;
        }
        return view('inventory.vendor-category.edit',[
            'heading' => $heading,
            'active_menu' => $this->active_menu,
            'breadcrumb' => $breadcrumb,
            'categories' => $categories,
            'record' => VendorCategory::where('id',$id)->first(),
            'ActionURL' => URL('vendors-category/'.$id),
        ]);
    }
    public function update(Request $request,$id){
        $validate =array();
        $name =array();
        $validate['name'] = 'required|max:109';
        $validate['pid'] = 'required|int';
        $validator = Validator::make($request->all(),$validate,[],array());
        if(!$validator->fails()){
            $vendorCategory = VendorCategory::find($id);
            $vendorCategory->name = $request->name;
            $vendorCategory->pid = $request->pid;
            $vendorCategory->detail = $request->detail;
            $vendorCategory->save();
            Session::flash('success_message', 'Vendor Category Has Been Modefied !');
            return redirect('vendors-category');
        } else {
            return redirect()->back()
                ->withInput()->withErrors($validator,'mess');

        }
    }

    public function destroy(Request $request,$id){
        $json = array();
        $vendorCategory = VendorCategory::find($id);
        if($vendorCategory ){
            $vendorCategory->delete();
            $json['success'] = true;
        } else {
            $json['success'] = false;
        }
            echo json_encode($json);


    }
}
