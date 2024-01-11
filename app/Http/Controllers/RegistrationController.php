<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserMeta;
use DB;
//use App\Models\Auth\User\UserRole;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class RegistrationController extends Controller
{
    public $env_role = 2;
    public function signup($pp=1)
    {
        $this->data['pp']=$pp;
        if(Auth::check() && Auth::user()->user_role()->role_id==2){
            return redirect()->route('home');
        }elseif(Auth::check() && Auth::user()->user_role()->role_id==1){
            return redirect()->route('admin');
        }
        return view('frontend.signup', $this->data);
    }

    public function create_user(Request $request) {
        
        $validate = Validator::make($request->all(), [
            'tandc' => 'required',
            'email'=> 'required|email|unique:users',
            'username' => 'required|unique:users,username',
            'password' => [
                'required',
                'min:8',
                'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
            ]
        ]);

        if ( $validate->fails() ) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        
        $userdata['full_name'] = $request->first_name.' '.$request->last_name;
        $userdata['email'] = $request->email;
        $userdata['username'] = $request->username;
        $userdata['tandc'] = $request->tandc;
        $unique_id = floor(time()-999999999);
        $userdata['member_id'] = preg_replace("/^(\d{3})(\d{3})(\d{3})$/", "$1-$2-$3", $unique_id);
        $userdata['password'] = Hash::make($request['password']);
        $userdata['profile_purpose'] = $request->profile_purpose;

        
        $red = User::create($userdata);

        if ($red) {
            $usermeta['user_id'] = $red->id; 
            $usermeta['first_name'] = $request->first_name; 
            $usermeta['last_name'] = $request->last_name; 
            UserMeta::create($usermeta);
            $user_role = DB::table('users_roles')->insert(['user_id'=>$red->id,'role_id'=>$this->env_role]);
            Auth::attempt(['username' => $request->username, 'password' => $request->password]);
            return redirect()->route('terms-condition');
             
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function email_check(Request $request)
    {
        $user = User::where('email', $request->get('email'))->count();
        if($user>0){
            echo 'false';
        }else{
            echo 'true';
        }
    }

    /**
    * check username unique
    **/
    public function usernamecheck(Request $request)
    {
        $user = User::where('username', $request->get('username'))->count();
        if($user>0){
            echo 'false';
        }else{
            echo 'true';
        }
    }
}