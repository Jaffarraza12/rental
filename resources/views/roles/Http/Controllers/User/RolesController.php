<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Role;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\Session;

class RolesController extends Controller
{
    //
    public function index(){

        $heading = "Roles Management";
        $breadcrumb = array(
            'Home'=> URL('/'),
            'Roles'=> URL('roles')
        );
        /*return Datatables::of(Role::all())->make(true);*/
        return view('roles.roles',[
            'heading'=>$heading,
            'breadcrumb'=>$breadcrumb
        ]);
    }

    public function getData() {
        return Datatables::of(Role::all())
            ->addColumn('operations',
                '<ul class="no_style">
                         <li>
                           <a href="javascript:;" class="remove" data-id="{{$id}}" data-url="{{ URL("role/remove/".$id)}}">
                         <i class="fa fa-remove" data-btn-cancel-class="btn-danger" data-btn-cancel-icon="icon-close" data-btn-cancel-label="Stoooop!" data-btn-ok-class="btn-success" data-btn-ok-icon="icon-like" data-btn-ok-label="Continue" data-placement="right" data-toggle="confirmation" class="btn red-mint" data-original-title="" title=""></i> </a>
                         </li>
                         <li><a class="pop" data-url="{{ URL("role/edit/".$id)}}">
                         <i class="fa fa-edit"></i> </a>
                         </li>
                         </ul>')
            ->make(true);
    }

    public function getAddRole() {
        $heading = "Add Role";
        return view('roles.add',[
            'heading' => $heading,
            'ActionURL' => URL("role/add")
        ]);
    }

    public function AddRole(Request $request) {
        if ($request->isMethod('post')) {
            $role = new Role();
            $role->name         = $request->input("name");
            $role->display_name = $request->input("display_name"); // optional
            $role->description  = $request->input("description"); // optional
            $role->save();
            Session::flash('success_message', ' Role Has Been Added !');
            return redirect()->back();
        }
    }

    public function getEditRole($id)
    {
        $heading = "Edit Role";
        if (Role::findorfail($id)) {
            $role = Role::where("id",$id)->first();
        }
        return view('roles.edit',[
            'heading' => $heading,
            'role' => $role,
            'id' => $id
        ]);
    }

    public function EditRole($id,Request $request) {

        if ($request->isMethod('post')) {
            $role = Role::findOrFail($id);
            $role->name         = $request->input("name");
            $role->display_name = $request->input("display_name"); // optional
            $role->description  = $request->input("description"); // optional
            $role->save();

            Session::flash('success_message', ' Role Has Been Modefied !');
            return redirect()->back();
        }
    }

    public function Destroy($id,Request $request){

        $role = Role::findOrFail($id);
        $role->delete();


    }

}
