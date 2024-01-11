<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\MemberShip;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\UserMeta;
use App\Models\User;
use App\Models\Position;
use App\Models\Industry;
use App\Models\RequestMember;
use App\Models\PaymentsModel;
use App\Models\LikeprofileModel;
use App\Models\RecommendedModel;

use Illuminate\Support\Facades\Validator;

class LikeProfileController extends Controller
{
    public function like_profile(Request $request)
    {

        $user_id = Auth::user()->id;
        $user_detail = $personal_user =[];

        //  SELECT sv_users.id,sv_users.full_name,sv_users.email,sv_users.profile_image,sv_like_profile.member_id,sv_user_meta.bio,sv_like_profile.user_id
        // FROM `sv_users` join sv_user_meta on sv_users.id=sv_user_meta.user_id
        // join sv_like_profile on sv_users.id=sv_like_profile.member_id where sv_like_profile.user_id=2
        // LIMIT 50

        $businessdetail_total = User::with('get_user_role', 'user_meta','likes')->whereHas('get_user_role', function($query) {
        $query->where('role_id', 2);})->whereHas('likes', function($query) use($user_id) {
            $query->where(['user_id'=>$user_id]);
        })->where(['active_status'=>1])
        ->when($request->has("keyword"), function ($q) use ($request) {
            return $q->where("full_name", "like", "%" . $request->get("keyword") . "%");
        });
     
        $this->data['business_total_count'] = $businessdetail_total->count();
        $businessdetail = $businessdetail_total->limit(5)->orderBy('id', 'DESC')->get(); 


        if($businessdetail->count()>0){
            foreach($businessdetail as $valu){
                $valu->member_request_status = RequestMember::where(['user_id'=>$user_id,'to_member'=>$valu->id])->count();
                $valu->like_status = LikeprofileModel::where(['user_id'=>$user_id,'member_id'=>$valu->id])->count();
            }
            $this->data['user_business_detail'] = $businessdetail; 
        }


      
        
        $this->data['total_user_count'] =  $this->data['business_total_count'];
          
    return view('frontend.like-profile', $this->data);

    }


    function loadmore_likeprofile(Request $request){

        $user_id = Auth::user()->id;
        $user_detail = $personal_user =[];

        $businessdetail_total = User::with('get_user_role', 'user_meta','likes')->whereHas('get_user_role', function($query) {
        $query->where('role_id', 2);})->whereHas('likes', function($query) use($user_id) {
            $query->where(['user_id'=>$user_id]);
        })->where(['active_status'=>1]);

        // $businessdetail_total = User::with('get_user_role', 'user_meta')->whereHas('get_user_role', function($query) {
        // $query->where('role_id', 2);})->where('id', '!=',$user_id)->where(['active_status'=>1])->whereIn('profile_purpose',[1])
      
        $this->data['business_total_count'] = $businessdetail_total->count();
        
        if($request->ajax()){
            
            $user_business_detail = $businessdetail_total->offset($request['limit'])->limit(5)->orderBy('id', 'DESC'); 
            $this->data['user_personal_nextcount'] = ($request['limit']+count($user_business_detail->get()));
            $this->data['user_business_detail'] = $user_business_detail->get();
            foreach($this->data['user_business_detail'] as $valu){
                $valu->member_request_status = RequestMember::where(['user_id'=>$user_id,'to_member'=>$valu->id])->count();
                $valu->like_status = LikeprofileModel::where(['user_id'=>$user_id,'member_id'=>$valu->id])->count();
            }
        }
        $loadmore_btn = true;
        if($this->data['user_personal_nextcount'] >= $this->data['business_total_count']){
        $loadmore_btn = false;
        }
        // print_r($this->data); exit();
        $return = view('frontend.includes.fav-profile',$this->data)->render();
        return response()->json(['data'=>$return,'limit_value'=>$this->data['user_personal_nextcount'],'loadmore_btn'=>$loadmore_btn,'tt'=>[$this->data['user_personal_nextcount'],$this->data['business_total_count']]]);
     

    }
}