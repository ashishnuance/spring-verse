<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserMeta;
use App\Models\Profiletype;
use App\Models\Position;
use App\Models\GroupModel;
use App\Models\Industry;
use App\Models\ProfilegroupModel;
use App\Models\RequestMember;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;


use Illuminate\Support\Facades\Auth;

class MyAccountController extends Controller
{
    public function myaccount(Request $request)
    {
        // echo (Auth::check() && Auth::user()->profile_image!='') ? asset($this->profile_image_path.'/'.Auth::user()->profile_image) : asset($this->default_profile_image_path);
        //Auth::user()->profile_image;
        $mydetail = $request->user()->getusermeta();
        $mydetail->member_id = $request->user()->member_id;
        $mydetail->username = $request->user()->username;
        $mydetail->profile_image = $request->user()->profile_image;
        $myhobbies = (isset($mydetail->hobbies) && $mydetail->hobbies!='') ? explode(',',$mydetail->hobbies) : array();
        
        $unique_id=  floor(time()-999999999);
        $formatted_number = preg_replace("/^(\d{3})(\d{3})(\d{3})$/", "$1-$2-$3", $unique_id);
        $profile_type_result = [];
        $profiletype = Profiletype::select(['id','name'])->where(['status'=>1]);
        if($profiletype->count()>0){
            $profile_type_result = $profiletype->get();
        }
        $this->data['mydetail']=$mydetail;
        // echo"<pre>"; print_r($this->data['mydetail']); die;
        $this->data['myhobbies']=$myhobbies;
        $this->data['formatted_number']=$formatted_number;
        $this->data['profile_type_result']=$profile_type_result;

        return view('frontend.myaccount',$this->data);
    }
    function myaccount_update(request $request)
    {
        
        // $where['id'] = $request->user()->id;

        // $postdata = $request->input();

        $where['user_id'] = Auth()->user()->id;
        $postdata = $request->all();

        unset($postdata['_token']);
        unset($postdata['submit']);
        unset($postdata['id']);
       
        $resp = UserMeta::where($where)->update($postdata);
        
        return redirect()->back()->with('success','Profile Updated Successfully!');
    }

 
    
    public function uploadCropImage(Request $request)
    {
  
        $image = $request->image;
        $dirpath = 'uploads/profile/';
        list($type, $image) = explode(';', $image);
        list(, $image)      = explode(',', $image);
        $image = base64_decode($image);
        $image_name= time().'.png';
        
        $path = public_path($dirpath.$image_name);
      
        if(file_put_contents($path, $image)){
            // if(File::exists($imagePath)){
            //     unlink($imagePath);
            // }
            User::where(['id'=>$request->user()->id])->update(['profile_image'=>$image_name]);

           
            return response()->json(['status'=>true,'image_url'=>url('/public/').'/'.$dirpath.$image_name]);

        }else{
            return response()->json(['status'=>false]);
        }
    }

    public function membership(){
        return view('frontend.membership');
    }

    
    /**
     * show personal detail page
     */
    public function personal_details($id=''){

      

        $user_id = Auth::user()->id;
        $user_detail = [];
        $personaldetail = UserMeta::where(['trash'=>0,'status'=>1,'user_id'=>$user_id]);
        if($personaldetail->count()>0){
            $user_detail = $personaldetail->first(); 
        }
        
        
        $usermeta_detail = [];
        $personalmeta_detail = User::where(['id'=>$user_id]);
        if($personalmeta_detail->count()>0){
            $usermeta_detail = $personalmeta_detail->first(); 
        }
        // echo"<pre>"; print_r($usermeta_detail); die;        
        $this->data['user_detail']=$user_detail;
        $this->data['usermeta_detail']=$usermeta_detail;
        $this->data['id']=$id;


        return view('frontend.personal-detail',$this->data);

    }

    public function professional_details($id=''){

        
        $position = Position::select(['id','name'])->where(['status'=>1]);
        if($position->count()>0){
            $position_result = $position->get();
        }
           
        $industry = Industry::select(['id','name'])->where(['status'=>1]);
        if($industry->count()>0){
            $industry_result = $industry->get();
        }

        $user_id = Auth::user()->id;
        $user_detail = [];
        $personaldetail = UserMeta::where(['trash'=>0,'status'=>1,'user_id'=>$user_id]);
        if($personaldetail->count()>0){
            $user_detail = $personaldetail->first(); 
        }
        
        
        $usermeta_detail = [];
        $personalmeta_detail = User::where(['id'=>$user_id]);
        if($personalmeta_detail->count()>0){
            $usermeta_detail = $personalmeta_detail->first(); 
        }
        // echo"<pre>"; print_r($usermeta_detail); die;        
        $this->data['user_detail']=$user_detail;
        $this->data['usermeta_detail']=$usermeta_detail;
        $this->data['id']=$id;
        $this->data['position_result']=$position_result;
        $this->data['industry_result']=$industry_result;

        return view('frontend.professional-detail',$this->data);

      


    }

    function personal_details_update(request $request)
    {
        $usermeta_where['user_id'] = Auth()->user()->id;
        $where['id'] = Auth()->user()->id;
        $postdata = $request->all();
       
        
        // echo"<pre>"; print_r($user); die;        
        $usermeta = array('home_location'=>$postdata["home_location"],'website'=>$postdata["website"],'address'=>$postdata["address"],'country'=>$postdata["country"],'city'=>$postdata["city"],'state'=>$postdata["state"],'postal_code'=>$postdata["postal_code"]);
      
        UserMeta::updateOrCreate($usermeta_where, $usermeta);
     
        $redirect_url = (isset($request->redirecturl) && $request->redirecturl!='') ? $request->redirecturl : 'myaccount';
        return redirect()->route($redirect_url)->with('success','Details Updated Successfully!');
    }

    function professional_details_update(request $request)
    {
        $usermeta_where['user_id'] = Auth()->user()->id;
        $where['id'] = Auth()->user()->id;
        $postdata = $request->all();
       
        
        $user =array('full_name'=>$postdata["full_name"],'email'=>$postdata["email"],'phone'=>$postdata["phone"],'mobile'=>$postdata["mobile"],'gender'=>$postdata["gender"],'dob'=> date('d-m-Y',strtotime( $postdata["dob"] )));
        
        // echo"<pre>"; print_r($user); die;        
        $usermeta = array('member_role'=>$postdata["member_role"], 'industry'=>$postdata["industry"]);
      
        UserMeta::updateOrCreate($usermeta_where, $usermeta);
        User::updateOrCreate($where, $user);

     
        $redirect_url = (isset($request->redirecturl) && $request->redirecturl!='') ? $request->redirecturl : 'myaccount';
        return redirect()->route($redirect_url)->with('success','Details Updated Successfully!');
    }

    public function password_update()
    {
        
        return view('frontend.password-update');
    }

    public function change_password(Request $request)
    {

        $validateData = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => [
                'required',
                'min:8',
                'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
            ],
            'confirm_password' => 'required|same:password',
        
        ]);
        if ($validateData->fails()) {
            // print_r($validateData->errors()); die;
            // return redirect()->back()->with('error', 'Current Password and Password does not match')->withInput();
            return redirect()->back()->withErrors($validateData)->withInput();

        }

        $user_data = User::select(['password'])->where('id',Auth::user()->id)->first();
        
        // echo"<pre>";print_r($user_data); die; 
        
        if (!Hash::check($request->old_password, $user_data->password)) {
            return redirect()->back()->with('error','The old password does not match our records.');
        }
        
            $users = User::find(Auth::user()->id);
            $users->password =  Hash::make($request->password);
            
            $users->save();
            
            return redirect()->route('myaccount')->with('success', 'password updated successfully');
        
    }

    function friend_list(Request $request){

        $user_id = Auth::user()->id;
        $user_list =[];
        $search_key = ($request->q && $request->q!='') ? 'and `full_name` like "%'.$request->q.'%"' : '';

       
        $user_list_resp = DB::select('select `id`, `full_name` from `sv_users` where `id` != "'.$user_id.'" and exists (select * from `sv_member_request` where (`sv_users`.`id` = `sv_member_request`.`to_member` or `sv_users`.`id` = `sv_member_request`.`user_id`) and (`status` = 1) and (`user_id` = '.$user_id.' or `to_member` = '.$user_id.')) '.$search_key.' and exists (select * from `sv_users_roles` where `sv_users`.`id` = `sv_users_roles`.`user_id` and `role_id` = 2) order by `full_name` asc limit 10');
        /*$user_list_resp = User::with('get_user_role','friends')->whereHas('friends',function($query) use ($user_id){
            return $query->where(['status'=>1])->where(function($q) use($user_id){
                return $q->where('user_id',$user_id)->orWhere('to_member',$user_id);
            });
        })->select(['id','full_name'])->where('full_name','like','%'.$request->q.'%')->whereHas('get_user_role', function($query) {
            $query->where('role_id', 2);})->orderBy('full_name','asc')->limit(10);
        echo $user_list_resp->toSql(); exit();*/ 
        if($user_list_resp!=''){
            $user_list =  $user_list_resp;
        }

        // if($user_list_resp->count()>0){
        //     $user_list =  $user_list_resp->get();
        // }
        
        return response()->json(['items'=>$user_list]);
    
    }

    function recommend_friend_list(Request $request){

        $user_id = Auth::user()->id;
        $user_list =[];
        $search_key = ($request->q && $request->q!='') ? 'and `full_name` like "%'.$request->q.'%"' : '';
        $user_list_resp = DB::select('select `id`, `full_name` from `sv_users` where `username` != "'.$request->username.'" and exists (select * from `sv_member_request` where (`sv_users`.`id` = `sv_member_request`.`to_member` or `sv_users`.`id` = `sv_member_request`.`user_id`) and (`status` = 1) and (`user_id` = '.$user_id.' or `to_member` = '.$user_id.')) '.$search_key.' and exists (select * from `sv_users_roles` where `sv_users`.`id` = `sv_users_roles`.`user_id` and `role_id` = 2) order by `full_name` asc limit 10');
        /*User::with('get_user_role','friends')->where('username','!=',$request->username)->whereHas('friends',function($query) use ($user_id){
            return $query->where(['status'=>1])->where(function($q) use($user_id){
                return $q->where('user_id',$user_id)->orWhere('to_member',$user_id);
            });
        })->select(['id','full_name'])->where('full_name','like','%'.$request->q.'%')->whereHas('get_user_role', function($query) {
            $query->where('role_id', 2);})->orderBy('full_name','asc')->limit(10);*/
            
        
        //echo $user_list_resp->toSql();exit();
        if($user_list_resp!=''){
            $user_list =  $user_list_resp;
        }
        
        return response()->json(['items'=>$user_list]);
    
    }

    function create_group(Request $request){
        
        $user_id = $request->user()->id;

        $resp = 0;
        for($f=0;$f<count($request->users);$f++){
            // echo ProfilegroupModel::where(['group_id'=>$request->group_id,'member_id'=>$request->users[$f]])->toSql();
            if(ProfilegroupModel::where(['group_id'=>$request->group_id,'member_id'=>$request->users[$f]])->count()==0){
                $resp = ProfilegroupModel::create(['group_id'=>$request->group_id,'member_id'=>$request->users[$f],'user_id'=>$request->user()->id]);
            };
        }
        $fire_store_id = GroupModel :: select('firestore_grp_id')->where(['id'=>$request->group_id])->first();

        $grp_members_id = ProfilegroupModel:: select('user_id','member_id')->where(['group_id'=>$request->group_id, 'user_id'=>$user_id]);
        $grp_mm_id = [];
        if($grp_members_id->count()>0){

        foreach($grp_members_id->get() as $g_val){
            $grp_mm_id[] =  $g_val->member_id;
        }
        $grp_mm_id[] = $grp_members_id->first()->user_id;
        }
        //  echo"<pre>"; print_r($request->users); die;

        if($resp){
            return response()->json(['data'=>$request->users,'group_id'=>$fire_store_id,'members'=>$grp_mm_id, 'user_id'=>$user_id,'message'=>'Member added successfully','status'=>200,'status_msg'=>'success'],200);
            // return redirect()->back()->with('success','Member added successfully');
        }elseif(isset($request->users) && count($request->users)>0){
            return response()->json(['data'=>$request->users,'group_id'=>$fire_store_id,'members'=>$grp_members_id,'message'=>'Member already exist in group','status'=>200],200);
            // return redirect()->back()->with('error','Member already exist in group');
        }
        return response()->json(['data'=>$request->users,'group_id'=>$fire_store_id,'members'=>$grp_members_id,'message'=>'success','status'=>200],200);
        // return response()->json(['items'=>$user_list]);
        // return redirect()->back();
    }

    function group_list(Request $request){
        $user_id = $request->user()->id;
        
        $result = ProfilegroupModel::select(DB::raw('group_concat(user_id) as uid'),DB::raw('group_concat(member_id) as mid'),'group_name')->where('user_id',$user_id)->orWhere('member_id',$user_id)->groupBy('group_name');
        if($result->count()>0){
            
            $group_list = $result->get();
            foreach($group_list as $gval){
                // echo $gval->mid;
                $gval->group_members_name = User::select(DB::raw('group_concat(full_name) as full_name'))->whereIn('id',explode(',',$gval->mid))->first()->full_name;
                $gval->user_name = User::select('full_name')->whereIn('id',explode(',',$gval->uid))->first()->full_name;
                
            }
            $this->data['group_list'] =$group_list;
        }
        
        return view('frontend.grouplist',$this->data);
    }


    function friends_list(Request $request){
        $user_id = $request->user()->id;
        $friends_result = [];
        $total_user_count = 0;
        $friends_response = RequestMember::where(function($query) use($user_id) {
            $query->where('to_member',$user_id)->orWhere('user_id',$user_id);
        })->where('status',1);
        // echo $friends_response->toSql();exit();
        if($friends_response->count()>0){

            $total_user_count = $friends_response->count();
            $friends_result = $friends_response->get();
            foreach($friends_result as $f_val){
                if($f_val->user_id==$user_id){
                    $f_val->users = User::select(['full_name','member_id','email','username','profile_image','provider_id','social_login'])->where('id',$f_val->to_member)->first();
                }elseif($f_val->to_member==$user_id){
                    $f_val->users = User::select(['full_name','member_id','email','username','profile_image','provider_id','social_login'])->where('id',$f_val->user_id)->first();
                }
            }
        }
        // echo '<pre>';print_r($friends_result); exit();
        return view('frontend.friends-list',compact('friends_result','total_user_count'));
    }
}