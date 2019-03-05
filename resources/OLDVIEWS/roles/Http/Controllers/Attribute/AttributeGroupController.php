<?php

namespace App\Http\Controllers\Attribute;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\AttributeGroup;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
class AttributeGroupController extends Controller
{
    //
    public function index(){
        $heading = "Attribute Groups";
        $breadcrumb = array(
            'Home'=> URL('/'),
            'Attribute Groups'=> URL('attribute_groups')
        );
        return view('attribute.attributegroup.view',[
            'heading' => $heading ,
            'breadcrumb' => $breadcrumb

        ]);
    }
    public function getData() {
        return Datatables::of(AttributeGroup::all())
            ->addColumn('operations',
                '<ul class="no_style">
                         <li>
                           <a href="javascript:;" class="remove" data-id="{{$attribute_group_id}}" data-url="{{ URL("attribute_groups/remove/".$attribute_group_id)}}">
                         <i class="fa fa-remove" title=""></i> </a>
                         </li>
                         <li><a class="pop" data-url="{{ URL("attribute_groups/edit/".$attribute_group_id)}}">
                         <i class="fa fa-edit"></i> </a>
                         </li>
                         </ul>')
            ->make(true);
    }
    public function getAdd() {

        $heading = "Add Attribute Group";
        return view('attribute.attributegroup.add',[
            'heading' => $heading,
            'ActionURL' => URL('attribute_groups/add'),
        ]);

    }
    public function Add(Request $request) {

            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
            ]);
        if (!$validator->fails()) {
            $attributeGroup = new AttributeGroup();
            $attributeGroup->name         = $request->input("name");
            $attributeGroup->save();
            Session::flash('success_message', ' Group Has Been Added !');
            return redirect()->back();
        } else {
            return redirect()->back()->withInput()
                ->withErrors($validator);;
        }
    }
    public function getEdit($id) {
        $heading = "Edit Group";
        if (AttributeGroup::findorfail($id)) {
            $attributeGroup = AttributeGroup::where("attribute_group_id",$id)->first();
        }
        return view('attribute.attributegroup.edit',[
            'heading' => $heading,
            'record' => $attributeGroup,
            'ActionURL' => URL('attribute_groups/edit/'.$id),
        ]);
    }
    public function Edit($id,Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);
        if (!$validator->fails()) {
           $attributeGroup = AttributeGroup::findorfail($id);
            $attributeGroup->name  = $request->input("name");
            $attributeGroup->save();

            Session::flash('success_message', ' Group Has Been Modefied !');
            return redirect()->back();
        } else {
            return redirect()->back()->withInput()
                ->withErrors($validator);;
        }
    }
    public function Destroy($id,Request $request) {
        $attributeGroup = AttributeGroup::findorfail($id);
        $attributeGroup->delete();
    }
}
