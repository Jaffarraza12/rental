<?php

namespace App\Http\Controllers\Common;

use App\Http\Model\Tenant;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Http\Model\Task;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Input;

class TaskController extends Controller
{
    //

    var $active_menu;
    public function __construct()
    {
        $this->active_menu = 'setting';
    }
    public function index($type=''){
          if($type=="staff" || $type=="tenant" || $type=="owner" || $type=="" ) {
              $heading = $type." Task";

              $breadcrumb = array(
                'Home' => URL('/'),
                'Task' => URL('task')
            );
            return view('common.task.view', [
                'heading' => $heading,
                'breadcrumb' => $breadcrumb,
                'type' => $type,
                'active_menu' => $this->active_menu,
            ]);
        } else {
            abort(404);
        }

    }
    function getData(Request $request){
        $buildingId = $request->session()->get('defaultBuilding');
        $userId = Auth::user()->id;
        $task = Task::select(array('task.id','task.name','users.name as user','task.due','task.status','task.priorty','task.type'))
            ->join("users","users.id","=","task.user_id");
        if(Auth::user()->pid == 0 ){
            $task = $task->where(function ($query){
                $query->where('users.pid',Auth::user()->id)->orwhere('task.user_id',Auth::user()->id);
            });
        } else {
            $task= $task->where('task.user_id',Auth::user()->id);
        }
        if($request->type ){
            $task= $task->where('task.type',$request->type);
        }
        return Datatables::of($task)
            ->editColumn('status','@if($status == 2)
                                Closed.
                            @elseif($status == 1)
                                Pending.
                            @else
                                Opened.
                            @endif')
            ->editColumn('priorty','@if($priorty == 2)
                                High
                            @elseif($priorty == 1)
                                Normal
                            @else
                                Low
                            @endif')
            ->addColumn('actions',
                '<div class="btn-group">
                   <button type="button" class="btn dropdown-toggle flag_green" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #fff">
                    <span >ACTION</span>
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a href="{{ URL($type."-task/".$id."/edit")}}">Edit</a></li>
                    <li><a  class="remove"  data-id="{{$id}}">Delete</a></li>
                  </ul>
                </div>')
            ->make(true);
    }
    function create($type=''){
        if($type=="staff" || $type=="tenant" || $type=="owner" || $type=="" ) {
            $heading = "Create New Task";
            $breadcrumb = array(
                'Home' => URL('/'),
                'Task' => URL('task'),
                'New Task' => ($type == '') ? URL('task/create') : URL($type-'task/create')
            );
            $users = array();
            $users[Auth::user()->id] = Auth::user()->name;
            foreach (User::where('pid', Auth::user()->id)->get() as $us):
                $users[$us->id] = $us->name;
            endforeach;
            $tenants =array();
            foreach(Tenant::get() as $tenant ){
                $tenants[$tenant->id] = $tenant->name;
            }
            return view('common.task.add', [
                'heading' => $heading,
                'active_menu' => $this->active_menu,
                'breadcrumb' => $breadcrumb,
                'type' => $type,
                'tenants' => $tenants,
                'users' => $users,
                'ActionURL' => URL('task'),
            ]);
        } else {
            abort(404);
        }
    }
    function store(Request $request){
        $validate =array();
        $name =array();
        $validate['summary'] = 'required|max:109';
        $validator = Validator::make($request->all(),$validate,[],array());
        if (!$validator->fails()) {
            $task = new task();
            $task->name = $request->summary;
            $task->description= $request->description;
            $task->category= $request->category;
            $task->due= $request->due;
            $task->type= $request->type;
            $task->building_id = $request->building_id;
            $task->user_id= $request->user;
            $task->status= $request->status;
            $task->tenant_id= $request->tenant_id;
            $task->priorty= $request->priorty;
            $task->save();
            $to = ( $request->type == '') ? 'task' : $request->type.'-task';
            Session::flash('success_message', 'Task Has Been Created !');
            return redirect($to);
        } else {
            return redirect()->back()
                ->withInput()->withErrors($validator,'mess');
        }
    }
    function edit($type='',$id){
            $heading = "Edit Task";
            $breadcrumb = array(
                'Home'=> URL('/'),
                'Task'=> URL('task'),
                'Edit Task'=> URL('task/'.$id)
            );
            $users =array();
            $users[Auth::user()->id] = Auth::user()->name;
            foreach (User::where('pid',Auth::user()->id)->get() as $us):
                $users[$us->id] = $us->name;
            endforeach;
            $tenants =array();
            foreach(Tenant::get() as $tenant ){
                $tenants[$tenant->id] = $tenant->name;
            }
            return view('common.task.edit',[
                'heading' => $heading,
                'active_menu' => $this->active_menu,
                'breadcrumb' => $breadcrumb,
                'users' => $users,
                'type' => $type,
                'tenants' => $tenants,
                'record' => Task::where('id',$id)->first(),
                'ActionURL' => URL('task/'.$id),
            ]);
    }
    function update($id,Request $request){
        $validate =array();
        $name =array();
        $validate['summary'] = 'required|max:109';
        $validator = Validator::make($request->all(),$validate,[],array());
        if (!$validator->fails()) {
            $task = task::find($id);
            $task->name = $request->summary;
            $task->description= $request->description;
            $task->category= $request->category;
            $task->due= $request->due;
            $task->type= $request->type;
            $task->building_id = $request->building_id;
            $task->user_id= $request->user;
            $task->status= $request->status;
            $task->tenant_id= $request->tenant_id;
            $task->priorty= $request->priorty;
            $task->save();
            $to = ( $request->type == '') ? 'task' : $request->type.'-task';
            Session::flash('success_message', 'Task Has Been Updated !');
            return redirect($to);
        } else {
            return redirect()->back()
                ->withInput()->withErrors($validator,'mess');
        }
    }
    function destroy(Request $request,$id){
        $task = task::find($id);
        $json = array();
        if($task){
            $task->delete();
            $json['success'] = true;
        } else {
            $json['success'] = false;
        }
        echo json_encode($json);
    }
}
