<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\UserMeta;
use App\Models\Position;
use App\Models\RequestMember;
use App\Models\RecommendedModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\VisitorsModel;
use DB;

class ProfileController extends Controller
{

    public function profile(Request $request,$username='',$matchprofile_flag='')
    {
        $user_id = Auth::user()->id;
        $check_user_friend = 0;
        $user_detail = [];
        if ($username != '') {
            $personal_detail = User::with('user_meta')->where(['username'=>$username]);
            
            if($personal_detail->count()>0){
                $user_detail = $personal_detail->first(); 
                $profile_id = $user_detail->id;
                $date = date('Y-m-d'); 
                $visit_data = VisitorsModel::where(['member_id'=>$user_detail->id])->where(['user_id'=>$user_id])->where(['date'=>$date])->get();

                if($visit_data->count() ==0)
                {
                VisitorsModel::create(['member_id'=>$user_detail->id,'user_id'=>$user_id,'date'=>$date]);
                }


                $check_user_friend = RequestMember::where(['status'=>1])->where(function($qw) use ($user_id){
                    return $qw->where('user_id',$user_id)->orWhere('to_member',$user_id);
                })->where(function($qw1) use ($profile_id){
                    return $qw1->where('user_id',$profile_id)->orWhere('to_member',$profile_id);
                })->count();
                
                $user_detail->member_request_status = RequestMember::where(['user_id'=>$user_id,'to_member'=>$user_detail->id])->count();
                
                
                $member_friendslist = RequestMember::select(DB::raw('group_concat(user_id) as uids'),DB::raw('group_concat(to_member) as mids'))->where(['status'=>1])->where(
                function($wh) use ($user_id){
                    return $wh->where('to_member',$user_id)->orWhere('user_id',$user_id);
                });
                
                $user_detail->member_friendslist_count = $member_friendslist->count();
                if($member_friendslist->count()>0){
                    $user_detail->member_friendslist = $member_friendslist->first(); 
                    
                    $memberids_arr = array_unique(array_merge(explode(',',$user_detail->member_friendslist->uids),explode(',',$user_detail->member_friendslist->mids)));
                    
                    $user_friendlist_detail = User::select(['id','full_name','profile_image','social_login'])->whereIn('id',$memberids_arr)->where('username','!=',$username)->where('id','!=',$user_id);
                    $user_detail->user_friendlist_detail = $user_friendlist_detail->get(); 
                    
                }

            }
        }
  
        $position = Position::select(['id','name'])->where(['status'=>1]);
        if($position->count()>0){
            $position_result = $position->get();
         
        }

      
        $notification_list = Requestmember::with('users_meta','user')->where(['to_member'=>$request->user()->id, 'user_id'=>$user_detail->id ])->first();
      
        return view('frontend.profile',compact('user_detail','position_result','notification_list','username','check_user_friend','matchprofile_flag'));
      
    }

    
}