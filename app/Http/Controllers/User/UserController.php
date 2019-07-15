<?php

namespace App\Http\Controllers\User;
use App\Http\Model\SubUsers;
use App\Http\Model\UserBuilding;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Model\Building;
use Illuminate\Support\Facades\Response;
use App\Http\Model\CommonAmenities;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    var $active_menu;
    public  function  __construct()
    {
        if (Auth::user()->pid==1)
        {
            redirect('/')->send();
            Session::flash('success_message', ' You are not Autherized !');
        }
        $this->active_menu = 'setting';

    }
    public function index()
    {
        $heading = "Users";
        $breadcrumb = array(
            'Home'=> URL('/'),
            'Users'=> URL('sub_users')
        );
        return view('sub_users.view',[
            'heading' => $heading ,
            'breadcrumb' => $breadcrumb,
            'active_menu' => $this->active_menu,

        ]);

    }
    public function getData(Request $request)
    {
        // $buildingId = $request->session()->get('defaultBuilding');
        $userId = Auth::id();
        return Datatables::of(User  ::select(array('id','name','email','contact','address','created_at'))->orderBy('id','desc'))

            ->addColumn('actions',
                '<div class="btn-group">
                   
                    <button type="button" class="btn dropdown-toggle flag_green" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=" color: #fff">
                       <span >ACTION</span>
                       <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                             <ul class="dropdown-menu">
                                 <li><a class="" href="{{ URL("/sub_users/edit/".$id)}}">Edit</a></li>
                                 <li><a data-url="{{ URL("/sub_users/remove/".$id)}}" class="remove"  data-id="{{$id}}">Delete</a></li>
                             </ul>
                </div>
                     ')
            ->make(true);
    }
    //GET EDIt


    public function getAdd(Request $request)
    {   $heading="Add User";
        $buildings = array();
        $breadcrumb = array(
            'Home'=> URL('/'),
            'Users'=> URL('sub_users'),
            'Add User'=> URL('sub_users/add'),

        );

        return view('/sub_users/add',[
            'Building' => Building::get(),
            'heading' => $heading,
            'breadcrumb' => $breadcrumb,
            'buildings' => $buildings,
            'ActionURL' =>  '/sub_users/store',
        ]);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate =array('email' => 'unique:users,email');
        $name =array();
        $validate ['name'] = 'required|max:109';


        $validator = Validator::make($request->all(),$validate,[],$name);
        if (!$validator->fails()) {

            $user = new User();
            $user->pid =Auth::user()->id;

            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->contact = $request->contact;
            $user->address= $request->address;
           // DB::table('user')->groupBy('id')->count();
            $count=  DB::table('users')->count();
          //  $pakageId = DB::table("config")->select('key')->first()->key;
            $pakageName = DB::table("config")->select('value')->first()->value;
            if($count==$pakageName)
            {
                Session::flash('danger_message', ' Upgrade your Pakage or delete Old Users !');
                return redirect()->back();
            }else{
                $user->save();
            }

            //For getting last User Id and save All CheckBox values into database corresponding to last insert user Id
            $user_id = $user->id;
            Response::json(array('success' => true, 'last_insert_id' => $user_id), 200);
            foreach ($request->building as $building ):
                UserBuilding::insert([
                    "user_id" => $user_id,
                    'building_id' => $building
                ]);
            endforeach;

            Session::flash('success_message', ' User Has Been Added !');
            return redirect()->back();
        } else {
            return redirect()->back()->withInput()
                ->withErrors($validator);
        }
    }

    public function getEdit($id) {

        $heading = "Edit User";
        $building_name =array();
        $breadcrumb = array(
            'Home'=> URL('/'),
            'Users'=> URL('sub_users'),
            'Edit User'=> URL('sub_users/edit/'.$id),

        );
        $i=0;
        foreach (UserBuilding::where('user_id',$id)->get() as $ba){
            $building_name[$i] = $ba->building_id;
            $i++;
        }

        return view('sub_users.edit', [
            'heading' => $heading,
            'building_names' => $building_name,
            'breadcrumb' => $breadcrumb,
            'record' => User::where('id',$id)->first(),
            //'UserBuilding' => UserBuilding::get(),
            'Building' => Building::get(),
            'ActionURL' => URL('sub_users/edit/' . $id),
        ]);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $validate =array();
        $name =array();
        $validate ['name'] = 'required|max:109';

        $validator = Validator::make($request->all(),$validate,[],$name);
        if (!$validator->fails()) {
            /*$work_order = new SubUsers();*/
            // $work_order->user_id = $userId;
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->contact = $request->contact;
            $user->address= $request->address;

            $user->save();
            UserBuilding::where("user_id", $id)->delete();
            //building amenities
            foreach ($request->building as $building ):
                UserBuilding::insert([
                    "user_id" => $id,
                    'building_id' => $building
                ]);
            endforeach;

            Session::flash('success_message', ' User Has Been Modified !');
            return redirect()->back();
        } else {
            return redirect()->back()->withInput()
                ->withErrors($validator);
        };
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userbuilding =UserBuilding::where('user_id',$id);
        $userbuilding->delete();

        $sub_users = User::find($id);
        $sub_users->delete();
    }
}
