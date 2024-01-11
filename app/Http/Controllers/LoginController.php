<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    
    // public function __construct()
    // {
        
    //         if (session('success')) {
    //             Alert::success(session('success'));
    //         } 
    //         if (session('error')) {
    //             Alert::error(session('error'));
    //         }
        
    // }

    public function login()
    {
        
        if(Auth::check() && Auth::user()->user_role()->role_id==2){
            return redirect()->route('home');
        }elseif(Auth::check() && Auth::user()->user_role()->role_id==1){
            return redirect()->route('admin');
        }
        return view('frontend.login',$this->data);
    }

    /**
     * member login process
    **/
    public function memberLogin(Request $request) {
        // print_r($request->all());
        $validate = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        if ( $validate->fails() ) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

      
        $user_data = User::where('username',$request->username);
        $term_condition=[];
        if($user_data->count()>0){
            
            // match password
            if (Hash::check($request->password, $user_data->first()->password)) {
               if(Auth::attempt(['username' => $request->username, 'password' => $request->password, 'active_status' => 1])){

               }else{
                return redirect()->back()->with('error', 'You are not active please contact to Admin');    

               }

                if(isset(Auth::user()->getusermeta()->term_condition) && Auth::user()->getusermeta()->term_condition==1){
                    return redirect()->route('home');  
                }
                return redirect()->route('terms-condition');
            } else {
                return redirect()->back()->with('error', 'Username and Password not correct');    
            }
        }else{
            return redirect()->back()->with('error', 'Username and Password not correct');
            // return redirect()->back()->withError('');
        }

        exit();
    }
}
