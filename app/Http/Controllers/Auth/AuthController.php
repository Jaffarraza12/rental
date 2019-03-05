<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected $redirectAfterLogout = '/login';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $this->redirectTo = '/login';
        return User::create([
            'name' => $data['name'],
            'username   ' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function checkUser($email, Request $request)
    {
        $token = csrf_token();
        $response = User::select()->where("email",$email)->first();
        if(!empty($response))
        {
            return response()->json(['response' => 'found']);
        }
        else
        {
            return response()->json(['response' => 'not found', 'token' => $token]);
        }
    }

    public function createUser(Request $request)
    {
        $email = $request->user_email;
        $name = $request->fname.' '.$request->lname;
        $password = $request->password;
        $package = $request->package;

        $user = User::create([
            'name' => $name,
            'package' => $package,
            'email' => $email,
            'password' => bcrypt($password),
        ]);

        $userId = $user->id;

        $packageQuery = DB::table('package_detail')
            ->select('*')
            ->where('package_id', '=', $package)
            ->first();

        foreach ( $packageQuery as $key=>$value)
        {
            if($key != 'package_id' && $key != 'id')
            DB::table('config')->insert([
                ['package_id' => $package, 'user_id' => $userId, 'key' => $key, 'value' => $value]
            ]);
        }

        return redirect('/login');
    }
    public function store(Request $request)
    {
        $validate =array();
        $name =array();
        $validate ['name'] = 'required|max:109';

        $validator = Validator::make($request->all(),$validate,[],$name);
        if (!$validator->fails()) {
            $user = new User();
            $user->pid =Auth::user()->pid;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->contact = $request->contact;
            $user->address= $request->address;

            $user->save();
            Session::flash('success_message', ' Work Order Has Been Added !');
            return redirect()->back();
        } else {
            return redirect()->back()->withInput()
                ->withErrors($validator);
        }
    }
}

