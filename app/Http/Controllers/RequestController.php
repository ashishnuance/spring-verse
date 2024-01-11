<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RequestMember;
use App\Models\RecommendedModel;
use App\Models\UserMeta;
use App\Models\ProfilegroupModel;
use App\Models\LikeprofileModel;
use App\Models\PersonMeeting;
use App\Models\ZoomMeetingNotificationModel;
use App\Models\ZoomMeetingModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;

use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{

    public function sent_request(Request $request)
    {
    
        $user_id =  Auth()->user()->id;
        $postdata = $request->all();
        $postdata['user_id'] = $user_id;

        $request_check = RequestMember::where(['to_member'=>$request->to_member,'user_id'=>$user_id]);
        if($request_check->count()>0){
            return response()->json(['success'=>false], 200 );
        }else{

            $red = RequestMember::create($postdata);
            if ($red) {
                return response()->json(['success'=>true] , 200);

            }else{
                return response()->json(['success'=>false], 200 );
            }
        }

    }

    public function to_request(){

       // echo"<pre>"; print_r($request->all()); die;
        $sent_req = RequestMember::where([''=>$request->user_id]);

        if($sent_req->count() > 0 ){
            $to_member = $sent_req->first()->to_member;
            if($to_member != $request->input('to_member')){
                $request->validate(
                    [
                        'to_member' => 'unique:member_request'
                    ],
                    [
                        'to_member.unique'=>"The Sent Request already Exist"
                        ]
                    );
                    
                }
            } 

        return view('frontend.homepage', $this->data);
    }

    public function notifications(Request $request)
    {  
        $perpagelimit = 10;
        // echo $req_id,$status; exit();
        $user_id = $request->user()->id;

        $notification_list = DB::select('SELECT id,user_id,member_id,read_status,"group" as type,created_at,IF(updated_at IS NULL, created_at, updated_at) as updated_at FROM `sv_members_group` where member_id = '.$user_id.'
        UNION (SELECT id,user_id,to_member as member_id,read_status,"request" as type,created_at,IF(updated_at IS NULL, created_at, updated_at) as updated_at FROM `sv_member_request` where to_member = '.$user_id.')
        UNION (SELECT id,user_id,member_id as member_id,read_status,"meeting" as type,created_at,IF(updated_at IS NULL, created_at, updated_at) as updated_at FROM `sv_person_meeting` where member_id = '.$user_id.')
        UNION (SELECT id,user_id,member_id as member_id,read_status,"meeting_sent" as type,created_at,IF(updated_at IS NULL, created_at, updated_at) as updated_at FROM `sv_person_meeting` where user_id = '.$user_id.')
        UNION (SELECT id,user_id,member_id as member_id,read_status,"zoom_meeting" as type,created_at,IF(updated_at IS NULL, created_at, updated_at) as updated_at FROM `sv_zoom_meting_notification` where member_id = '.$user_id.')
        UNION (SELECT id,user_id,member_ids as member_id,read_status,"zoom_meeting_request" as type,created_at,IF(updated_at IS NULL, created_at, updated_at) as updated_at FROM `sv_zoom_meeting` where user_id = '.$user_id.')
        UNION (SELECT id,user_id,to_member_id as member_id,read_status,"recommend" as type,created_at,IF(updated_at IS NULL, created_at, updated_at) as updated_at FROM `sv_recommended_users` where to_member_id = '.$user_id.') order by created_at desc limit '.$perpagelimit);

        foreach($notification_list as $noti_val){
            if($noti_val->type=='group'){
                $groupmember_notification_list = ProfilegroupModel::with('groupuser_meta','groupusers','group_detail')->where('id',$noti_val->id);
                if($groupmember_notification_list->count()>0){
                    $noti_val->listdata = $groupmember_notification_list->first();
                }
            }elseif($noti_val->type=='request'){
                $request_notification_list = Requestmember::with('users_meta','user')->where('id',$noti_val->id);
                if($request_notification_list->count()>0){
                    $noti_val->listdata = $request_notification_list->first();
                }
            }elseif($noti_val->type=='recommend'){
                $recommended_notification_list = RecommendedModel::with('user','user_requestuser')->where('id',$noti_val->id);
                if($recommended_notification_list->count()>0){
                    $noti_val->listdata = $recommended_notification_list->first();
                }
            }elseif($noti_val->type=='meeting'){
                $personmeeting_notification_list = PersonMeeting::with('user_request_touser','user')->where('id',$noti_val->id);
                // echo '<pre>';print_r($personmeeting_notification_list->first()); exit();
                if($personmeeting_notification_list->count()>0){
                    $noti_val->listdata = $personmeeting_notification_list->first();
                }
            }elseif($noti_val->type=='meeting_sent'){
                $personmeeting_notification_list = PersonMeeting::with('user_request_touser','user')->where('id',$noti_val->id);
                // echo '<pre>';print_r($personmeeting_notification_list->first()); exit();
                if($personmeeting_notification_list->count()>0){
                    $noti_val->listdata = $personmeeting_notification_list->first();
                }
            }elseif($noti_val->type=='zoom_meeting'){
                $zoommeeting_notification_list = ZoomMeetingNotificationModel::with('user')->where('id',$noti_val->id);
                
                if($zoommeeting_notification_list->count()>0){
                    $noti_val->listdata = $zoommeeting_notification_list->first();
                }
            }elseif($noti_val->type=='zoom_meeting_request'){
                $zoommeeting_req_notification_list = ZoomMeetingModel::with('user')->select(['user_id','member_ids','start_link','date_time'])->where('id',$noti_val->id);
                
                if($zoommeeting_req_notification_list->count()>0){
                    $noti_val->listdata = $zoommeeting_req_notification_list->first();
                }
            }
            
            
        }
        $this->data['notificationlist_result'] = $notification_list;
        $this->data['notificationlist_result_count'] = count($notification_list);
        Requestmember::where(['to_member'=>$user_id,'read_status'=>0])->update(['read_status'=>1]);
        RecommendedModel::where(['to_member_id'=>$user_id,'read_status'=>0])->update(['read_status'=>1]);
        ProfilegroupModel::where(['member_id'=>$user_id,'read_status'=>0])->update(['read_status'=>1]);
        PersonMeeting::where(['member_id'=>$user_id,'read_status'=>0])->update(['read_status'=>1]);
        PersonMeeting::where(['user_id'=>$user_id,'read_status'=>0])->update(['read_status'=>1]);
        ZoomMeetingNotificationModel::where(['member_id'=>$user_id,'read_status'=>0])->update(['read_status'=>1]);
        ZoomMeetingModel::where(['user_id'=>$user_id,'read_status'=>0])->update(['read_status'=>1]);
        
        
        
        // echo '<pre>';print_r($this->data['notificationlist_result']); exit();
        /*
        
        
        $notification_list = Requestmember::with('users_meta','user')->where('to_member',$request->user()->id);
        $this->data['notificationlist_total_count'] = $notification_list->count();
        
        if($notification_list->count()>0){
            $this->data['notification_list'] = $notification_list->orderBy('created_at', 'DESC')->limit(10)->get();
        }

        $groupmember_notification_list = ProfilegroupModel::with('groupuser_meta','groupusers','group_detail')->where('member_id',$user_id);
        $this->data['groupmember_notification_list_count'] = $groupmember_notification_list->count();
        
        if($groupmember_notification_list->count()>0){
            $this->data['groupmember_notification_list'] = $groupmember_notification_list->orderBy('created_at', 'DESC')->limit(10)->get();
        }
        
        
        $recommended_list = RecommendedModel::with('user','user_requestuser')->where(['to_member_id'=>$user_id]);
        $this->data['recommended_list_count'] = $recommended_list->count();
        if($recommended_list->count()>0){
            $this->data['recommended_list'] = $recommended_list->orderBy('created_at', 'DESC')->get();
        }*/
        
        if($request->ajax()){
            //echo"<pre>"; print_r($request->all()); die();
            $total_notification_list = DB::select('SELECT id,user_id,member_id,read_status,"group" as type,created_at,IF(updated_at IS NULL, created_at, updated_at) as updated_at FROM `sv_members_group` where member_id = '.$user_id.'
            UNION (SELECT id,user_id,to_member as member_id,read_status,"request" as type,created_at,IF(updated_at IS NULL, created_at, updated_at) as updated_at FROM `sv_member_request` where to_member = '.$user_id.')
            UNION (SELECT id,user_id,member_id as member_id,read_status,"meeting" as type,created_at,IF(updated_at IS NULL, created_at, updated_at) as updated_at FROM `sv_person_meeting` where member_id = '.$user_id.')
            UNION (SELECT id,user_id,member_id as member_id,read_status,"meeting_sent" as type,created_at,IF(updated_at IS NULL, created_at, updated_at) as updated_at FROM `sv_person_meeting` where member_id = '.$user_id.')
            UNION (SELECT id,user_id,member_id as member_id,read_status,"zoom_meeting" as type,created_at,IF(updated_at IS NULL, created_at, updated_at) as updated_at FROM `sv_zoom_meting_notification` where member_id = '.$user_id.')
            UNION (SELECT id,user_id,member_ids as member_id,read_status,"zoom_meeting_request" as type,created_at,IF(updated_at IS NULL, created_at, updated_at) as updated_at FROM `sv_zoom_meeting` where user_id = '.$user_id.')
            UNION (SELECT id,user_id,to_member_id as member_id,read_status,"recommend" as type,created_at,IF(updated_at IS NULL, created_at, updated_at) as updated_at FROM `sv_recommended_users` where to_member_id = '.$user_id.') order by created_at desc');
            
            $notification_list = DB::select('SELECT id,user_id,member_id,read_status,"group" as type,created_at,IF(updated_at IS NULL, created_at, updated_at) as updated_at FROM `sv_members_group` where member_id = '.$user_id.'
            UNION (SELECT id,user_id,to_member as member_id,read_status,"request" as type,created_at,IF(updated_at IS NULL, created_at, updated_at) as updated_at FROM `sv_member_request` where to_member = '.$user_id.')
            UNION (SELECT id,user_id,member_id as member_id,read_status,"meeting" as type,created_at,IF(updated_at IS NULL, created_at, updated_at) as updated_at FROM `sv_person_meeting` where member_id = '.$user_id.')
            UNION (SELECT id,user_id,member_id as member_id,read_status,"meeting_sent" as type,created_at,IF(updated_at IS NULL, created_at, updated_at) as updated_at FROM `sv_person_meeting` where member_id = '.$user_id.')
            UNION (SELECT id,user_id,member_id as member_id,read_status,"zoom_meeting" as type,created_at,IF(updated_at IS NULL, created_at, updated_at) as updated_at FROM `sv_zoom_meting_notification` where member_id = '.$user_id.')
            UNION (SELECT id,user_id,member_ids as member_id,read_status,"zoom_meeting_request" as type,created_at,IF(updated_at IS NULL, created_at, updated_at) as updated_at FROM `sv_zoom_meeting` where user_id = '.$user_id.')
            UNION (SELECT id,user_id,to_member_id as member_id,read_status,"recommend" as type,created_at,IF(updated_at IS NULL, created_at, updated_at) as updated_at FROM `sv_recommended_users` where to_member_id = '.$user_id.') order by created_at desc limit '.$request['limit'].','.$perpagelimit);
            foreach($notification_list as $noti_val){
                if($noti_val->type=='group'){
                    $groupmember_notification_list = ProfilegroupModel::with('groupuser_meta','groupusers','group_detail')->where('id',$noti_val->id);
                    if($groupmember_notification_list->count()>0){
                        $noti_val->listdata = $groupmember_notification_list->first();
                    }
                }elseif($noti_val->type=='request'){
                    $request_notification_list = Requestmember::with('users_meta','user')->where('id',$noti_val->id);
                    if($request_notification_list->count()>0){
                        $noti_val->listdata = $request_notification_list->first();
                    }
                }elseif($noti_val->type=='recommend'){
                    $recommended_notification_list = RecommendedModel::with('user','user_requestuser')->where('id',$noti_val->id);
                    if($recommended_notification_list->count()>0){
                        $noti_val->listdata = $recommended_notification_list->first();
                    }
                }elseif($noti_val->type=='meeting'){
                    $personmeeting_notification_list = PersonMeeting::with('user_request_touser','user')->where('id',$noti_val->id);
                    
                    if($personmeeting_notification_list->count()>0){
                        $noti_val->listdata = $personmeeting_notification_list->first();
                    }
                }elseif($noti_val->type=='meeting_sent'){
                    $personmeeting_notification_list = PersonMeeting::with('user_request_touser','user')->where('id',$noti_val->id);
                    
                    if($personmeeting_notification_list->count()>0){
                        $noti_val->listdata = $personmeeting_notification_list->first();
                    }
                }elseif($noti_val->type=='zoom_meeting'){
                    $zoommeeting_notification_list = ZoomMeetingNotificationModel::with('user')->where('id',$noti_val->id);
                    
                    if($zoommeeting_notification_list->count()>0){
                        $noti_val->listdata = $zoommeeting_notification_list->first();
                    }
                }elseif($noti_val->type=='zoom_meeting_request'){
                    $zoommeeting_req_notification_list = ZoomMeetingModel::with('user')->select(['user_id','member_ids','start_link','date_time'])->where('id',$noti_val->id);
                    
                    if($zoommeeting_req_notification_list->count()>0){
                        
                        $noti_val->listdata = $zoommeeting_req_notification_list->first();
                    }
                }
                
            }
            $this->data['notificationlist_result'] = $notification_list;
            $this->data['notificationlist_result_count'] = count($notification_list);
            
            if(isset($notification_list) && $notification_list!=''){
                $return = view('frontend.includes.all-notification-section',$this->data)->render();
                $loadmore_btn = true;
                // count($total_notification_list) $request['limit']+count($notification_list)
                if(count($total_notification_list) <= $request['limit']+count($notification_list)){
                $loadmore_btn = false;
                }
                
            }
            /*
            $notification_list_result = $notification_list->orderBy('created_at', 'DESC')->offset($request['limit'])->limit(10);
            $this->data['user_notification_nextcount'] = ($request['limit']+count($notification_list_result->get()));
            $this->data['notificationlist_result'] = $notification_list_result->get();

            $return = view('frontend.includes.notification-list-section',$this->data)->render();
            $loadmore_btn = true;
            if($this->data['user_notification_nextcount'] >= $this->data['notificationlist_total_count']){
            $loadmore_btn = false;
            }*/
            return response()->json(['data'=>$return,'limit_value'=>($request['limit']+count($notification_list)),'loadmore_btn'=>$loadmore_btn,'tt'=>[$this->data['notificationlist_result_count'],10]]);
        }
        // echo '<pre>';print_r($this->data['notificationlist_total_count']); exit();
        
        return view('frontend.notifications',$this->data);
    }


    public function requestlist(Request $request)
    {  
       

        $request_list_resp = Requestmember::with('users_meta_requestuser','user_requestuser')->where('user_id',$request->user()->id);
        $this->data['requestlist_total_count'] = $request_list_resp->count();
        
        if($request_list_resp->count()>0){
            
            $this->data['requestlist_result'] = $request_list_resp->orderBy('created_at', 'DESC')->limit(10)->get();
        }
        if($request->ajax()){
            $requestlist_result = $request_list_resp->orderBy('created_at', 'DESC')->offset($request['limit'])->limit(10);
            // print_r($request->all()); exit();
            $this->data['user_request_nextcount'] = ($request['limit']+count($requestlist_result->get()));
            $this->data['requestlist_result'] = $requestlist_result->get();
            $return = view('frontend.includes.request-list-section',$this->data)->render();
            $loadmore_btn = true;
            if($this->data['user_request_nextcount'] >= $this->data['requestlist_total_count']){
            $loadmore_btn = false;
            }
            
            return response()->json(['data'=>$return,'limit_value'=>$this->data['user_request_nextcount'],'loadmore_btn'=>$loadmore_btn,'tt'=>[$this->data['user_request_nextcount'],$this->data['requestlist_total_count']]]);
        }
        // echo '<pre>';print_r($this->data['requestlist_result']); exit();
        return view('frontend.requestlist',$this->data);
    }

    public function update_request_status($req_id=0, $status=0){
        // echo $req_id,$status; exit();
        if ($req_id != 0 && $status!= '') {
            $update = Requestmember::where(['id' => $req_id])->update(['status' => $status]);
            if ($update) {
                
                if($status==1){
                    return redirect()->back()->with(['success' => 'Request accepted']);
                }else{
                    return redirect()->back()->with(['error' => 'Request Rejected']);
                }
            } else {
                return redirect()->back()->with(['error' => "Something Went Wrong"]);
            }
        }
    }

    
    public function send_recommended_request(Request $request){
        $postdata = [];
        for($r=0;$r<count($request->users);$r++){
            $checkrequest = RecommendedModel::where(['to_member_id'=>$request->users[$r],'from_member_id'=>$request->from_member_id,'user_id'=>$request->user()->id]);
            if($checkrequest->count()==0){
                $postdata[]=
                    ['to_member_id'=>$request->users[$r],
                    'from_member_id'=>$request->from_member_id,
                    'user_id'=>$request->user()->id
                    
                ];
                // print_r($postdata); exit();
                // RecommendedModel::create($postdata);
            }
        }
        if(!empty($postdata)){
            
            RecommendedModel::insert($postdata);
            // return redirect()->back();
            return redirect()->back()->with('success','Recommended successfully');
        }else{
            return redirect()->back()->with('error','Request already sent');
        }
    }


    function like_profile(Request $request){
        
        $user_id = $request->user()->id;
        $icon_html= '<span class="far fa-heart"></span>';
        $check_like_response = LikeprofileModel::where(['user_id'=>$user_id,'member_id'=>$request->profile_id]);
        if($check_like_response->count()>0){
            $check_like_response->delete();
            $icon_html= '<span class="far fa-heart"></span>';
        }else{
            LikeprofileModel::create(['user_id'=>$user_id,'member_id'=>$request->profile_id]);
            $icon_html= '<span class="fas fa-heart"></span>';
        }
        return response()->json(['success'=>true,'data'=>$icon_html], 200 );
    }
}