<?php



namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\SendsPasswordResetEmails;



class ForgotPasswordController extends Controller

{

    /*

    |--------------------------------------------------------------------------

    | Password Reset Controller

    |--------------------------------------------------------------------------

    |

    | This controller is responsible for handling password reset emails and

    | includes a trait which assists in sending these notifications from

    | your application to your users. Feel free to explore this trait.

    |

    */



    use SendsPasswordResetEmails;



    public function showLinkRequestForm()

    {

        $pageConfigs = ['bodyCustomClass' => 'forgot-bg', 'isCustomizer' => false];



        return view('/auth/passwords/email', [

            'pageConfigs' => $pageConfigs

        ]);

    }

    
    public function forgot_password()
    {

        return view('frontend.forget-password');
    }

 

    public function forgot_password_request(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|email'
    ]);

    if(!$validator->fails() )
    {
        if( $user = User::where('email', $request->input('email') )->first() )
        {
            $token = Str::random(64);

        

            User::where(['email' => $user->email])->update(['remember_token' => $token]);

          
            $link=route('password-reset',['token'=>$token]);

            return redirect()->back()->with('success', 'We have emailed your password reset link <a target="_blank" href="' . $link.'">click</a>');
        }
    }
    
    return redirect()->back()->withErrors("Email address not correct. Please check");
}


public function password_reset_email(Request $request,$token)
{

    return view('frontend.password-reset',compact('token'));
}


public function create_new_password(Request $request)
{
    // echo"<pre>"; print_r($request->all()); die;

    $validateData = Validator::make($request->all(), [
       
        'password' => [
            'required',
            'min:8',
            'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
        ],
        'confirm_password' => 'required|same:password',
    
    ]);
    if ($validateData->fails()) {
        
      
        return redirect()->back()->withErrors($validateData)->withInput();

    }

    
        $users = User::where(['remember_token' => $request->remember_token])->where('remember_token', '!=','');
        
        if($users->count()>0 ){
            // echo $request->remember_token; die;
            $users_token = User::where(['remember_token' => $request->remember_token])->update(['password' =>  Hash::make($request->password), 'remember_token'=> null]);

        
        return redirect()->back()->with('success', 'New password successfully created ');
        }else{
            return redirect()->back()->with('error', 'Invalid Url');
        }

    
}

}

