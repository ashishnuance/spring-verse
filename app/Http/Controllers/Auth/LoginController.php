<?php



namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\UserMeta;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;



class LoginController extends Controller

{

    /*

    |--------------------------------------------------------------------------

    | Login Controller

    |--------------------------------------------------------------------------

    |

    | This controller handles authenticating users for the application and

    | redirecting them to your home screen. The controller uses a trait

    | to conveniently provide its functionality to your applications.

    |

    */



    use AuthenticatesUsers;



    /**

     * Where to redirect users after login.

     *

     * @var string

     */

    protected $redirectTo = RouteServiceProvider::HOME;



    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function __construct()

    {

        $this->middleware('guest')->except('logout');

    }



    // Login

    public function showLoginForm()

    {

        $pageConfigs = ['bodyCustomClass' => 'login-bg', 'isCustomizer' => false];



        return view('/auth/login', [

            'pageConfigs' => $pageConfigs

        ]);

    }



    //Google Login

    public function redirectToGoogle(){

    return Socialite::driver('google')->stateless()->redirect();

    }

    

    //Google callback  

    public function handleGoogleCallback(){

    

    $user = Socialite::driver('google')->stateless()->user();

    

      $this->_registerorLoginUser($user,'google');

      return redirect()->route('home');

    }

    

    //Facebook Login

    public function redirectToFacebook(){

    return Socialite::driver('facebook')->stateless()->redirect();

    }

    

    //facebook callback  

    public function handleFacebookCallback(Request $request){
      
      try {
        if(isset($request->error_code) && $request->error_code!='' && $request->error_code>0){
            return redirect()->route('login')->with('error','There is some issue please try again');
        }        
        $user = Socialite::driver('facebook')->stateless()->user();

        $this->_registerorLoginUser($user,'facebook');
        return redirect()->route('home');
      } catch(\Exeption $e){
        return redirect()->route('login')->with('error','There is some issue please try again');
      }

    

    }

    //LinkedIn Login
    public function redirectToLinkedIn(){
      return Socialite::driver('linkedin')->redirect();
    }
  
    //linkedin callback  
    public function handleLinkedInCallback(Request $request){
      try{
        $user = Socialite::driver('linkedin')->user();
        
        $this->_registerorLoginUser($user,'linkedin');
        return redirect()->route('home');
      }catch (\Exception $e){
        return redirect()->route('login')->with('error','There is some issue please try again');
      }
    }


    protected function _registerOrLoginUser($data,$login_type='facebook')
    {
      try {
        $user = User::where('email', '=', $data->email)->first();
        if (!$user) {
            $username = explode('@',$data->email);
            $unique_id = floor(time()-999999999);            
            $user = new User();
            $user->full_name = $data->name;
            $user->email = $data->email;
            $user->provider_id = $data->id;
            $user->tandc = 1;
            $user->username = $username[0];
            $user->social_login = $login_type;
            $user->profile_image = $data->avatar;
            $user->member_id = preg_replace("/^(\d{3})(\d{3})(\d{3})$/", "$1-$2-$3", $unique_id);
            $user->save();

            $usermeta['user_id'] = $user->id; 
            $usermeta['first_name'] = $data->name; 
            $usermeta['last_name'] = ''; 
            UserMeta::create($usermeta);
            
            $user_role = DB::table('users_roles')->insert(['user_id'=>$user->id,'role_id'=>env('MEMBER_ROLE')]);
            
        }

        Auth::login($user);
      }catch (\Exception $e) {
        return false;
      }
    }


}

