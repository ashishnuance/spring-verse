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
use App\Models\GroupModel;
use App\Models\MemberMessageModel;
use DB;

use Illuminate\Support\Facades\Validator;

class MessagesController extends Controller
{
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $loginuserid = $user_id = $request->user()->id;
        $member_message_data = '';
        $allfriends_list = $this->allfriends($request);
        // echo '<pre>';print_r($allfriends_list); 
        // exit();
        $active_chat_member =0;
        if($request->query('mmid') && $request->query('mmid')!=''){
            $active_chat_member = $mmid = $request->query('mmid');
            $member_message_data_result =  MemberMessageModel::select('chat_room_id')->where(function($q1) use ($user_id){
                return $q1->where('member_id',$user_id)->orWhere('user_id',$user_id); 
                    
            })->where(function($q1) use ($mmid){
                return $q1->where('member_id',$mmid)->orWhere('user_id',$mmid); 
                    
            })->whereNotNull('chat_room_id');
            // echo $member_message_data_result->toSql(); exit();
            // echo $member_message_data_result->count();
            if($member_message_data_result->count()>0){
                $member_message_data = $member_message_data_result->first()->chat_room_id;
            }
        }else{
            // print_r($allfriends_list['all_records']); exit();
            if(isset($allfriends_list['all_records'][0]) && $allfriends_list['all_records'][0]->member_data->mmid!=''){
                $active_chat_member = $mmid = $allfriends_list['all_records'][0]->member_data->mmid;
                $member_message_data_result =  MemberMessageModel::select('chat_room_id')->where(function($q1) use ($user_id){
                    return $q1->where('member_id',$user_id)->orWhere('user_id',$user_id); 
                        
                })->where(function($q1) use ($mmid){
                    return $q1->where('member_id',$mmid)->orWhere('user_id',$mmid); 
                        
                })->whereNotNull('chat_room_id');
                // echo $member_message_data_result->toSql(); exit();
                // echo $member_message_data_result->count(); exit();
                if($member_message_data_result->count()>0){
                    $member_message_data = $member_message_data_result->first()->chat_room_id;
                }
            }else{
                return redirect()->route('all-members')->with('error','No connected member');
            }
        }
        
        $member_data=[];
        $member_data_sql = User::where('id',$mmid);
        if($member_data_sql->count()>0){
            $member_data = $member_data_sql->first();
        }
        
        foreach($allfriends_list['all_records'] as $frnd_val){
            $user_id = $loginuserid;
            $mmid = $frnd_val->mmid;
            $chatroomid = MemberMessageModel::select('chat_room_id')->where(function($q1) use ($user_id){
                return $q1->where('member_id',$user_id)->orWhere('user_id',$user_id); 
                    
            })->where(function($q1) use ($mmid){
                return $q1->where('member_id',$mmid)->orWhere('user_id',$mmid); 
                    
            })->whereNotNull('chat_room_id');
            if($chatroomid->count()>0){
                $frnd_val->chatroomid = $chatroomid->first()->chat_room_id;
            }
        }
        
        
        $receiver_profile_image = getuser_profileimage($request->user()->id);
        
        // echo '<pre>';
        // print_r($allfriends_list['all_records']);
        // exit();
        // echo $member_message_data;exit();
        return view('frontend.messages.index',compact('allfriends_list','loginuserid','member_message_data','member_data','receiver_profile_image','active_chat_member'));
    }

    function save_chatid(Request $request){
        $msg= '';
        // try {
            $user_id = $request->user()->id;
            $mmid = $request->member_id;
            $member_message_data =  MemberMessageModel::select('chat_room_id')->where(function($q1) use ($user_id){
                return $q1->where('member_id',$user_id)->orWhere('user_id',$user_id); 
                    
            })->where(function($q1) use ($mmid){
                return $q1->where('member_id',$mmid)->orWhere('user_id',$mmid); 
                    
            })->whereNotNull('chat_room_id');
            // $member_message_data =  MemberMessageModel::select('chat_room_id')->where(function($q1) use ($user_id){
            //     return $q1->where('member_id',$user_id)->orWhere('user_id',$user_id);   
            // })->whereNotNull('chat_room_id');
            // echo $member_message_data->toSql(); exit();
            $msg = $request->chat_room_id;
            if($member_message_data->count()>0){
                $chat_room_id = $member_message_data->first()->chat_room_id;
                $msg = $chat_room_id;
            }else{
                MemberMessageModel::create(['user_id'=>$user_id,'member_id'=>$request->member_id,'chat_room_id'=>$request->chat_room_id]);
                $msg = $request->chat_room_id;
            }
            return response()->json(['data'=>$msg,'status'=>true]);
        // } catch (\Throwable $th) {
        //     //throw $th;
        // }
        return response()->json(['status'=>false]);
        // return redirect()->route('messages');
    }


    /*************************************/

    public function newchat(Request $request)
    {
        $loginuserid = $user_id = $request->user()->id;
        $member_message_data = '';
        $allfriends_list = $this->allfriends($request);
        // echo '<pre>';print_r($allfriends_list); 
        // exit();
        $active_chat_member =0;
        if($request->query('mmid') && $request->query('mmid')!=''){
            $active_chat_member = $mmid = $request->query('mmid');
            $member_message_data_result =  MemberMessageModel::select('chat_room_id')->where(function($q1) use ($user_id){
                return $q1->where('member_id',$user_id)->orWhere('user_id',$user_id); 
                    
            })->where(function($q1) use ($mmid){
                return $q1->where('member_id',$mmid)->orWhere('user_id',$mmid); 
                    
            })->whereNotNull('chat_room_id');
            // echo $member_message_data_result->toSql(); exit();
            // echo $member_message_data_result->count();
            if($member_message_data_result->count()>0){
                $member_message_data = $member_message_data_result->first()->chat_room_id;
            }
        }else{
            // print_r($allfriends_list); exit();
            if(isset($allfriends_list['all_records'][0]) && $allfriends_list['all_records'][0]->member_data->mmid!=''){
                $active_chat_member = $mmid = $allfriends_list['all_records'][0]->member_data->mmid;
                $member_message_data_result =  MemberMessageModel::select('chat_room_id')->where(function($q1) use ($user_id){
                    return $q1->where('member_id',$user_id)->orWhere('user_id',$user_id); 
                        
                })->where(function($q1) use ($mmid){
                    return $q1->where('member_id',$mmid)->orWhere('user_id',$mmid); 
                        
                })->whereNotNull('chat_room_id');
                // echo $member_message_data_result->toSql(); exit();
                // echo $member_message_data_result->count(); exit();
                if($member_message_data_result->count()>0){
                    $member_message_data = $member_message_data_result->first()->chat_room_id;
                }
            }else{
                return redirect()->route('all-members')->with('error','No connected member');
            }
        }
        
        $member_data=[];
        $member_data_sql = User::where('id',$mmid);
        if($member_data_sql->count()>0){
            $member_data = $member_data_sql->first();
        }
        
        foreach($allfriends_list['all_records'] as $frnd_val){
            $user_id = $loginuserid;
            $mmid = $frnd_val->mmid;
            $chatroomid = MemberMessageModel::select('chat_room_id')->where(function($q1) use ($user_id){
                return $q1->where('member_id',$user_id)->orWhere('user_id',$user_id); 
                    
            })->where(function($q1) use ($mmid){
                return $q1->where('member_id',$mmid)->orWhere('user_id',$mmid); 
                    
            })->whereNotNull('chat_room_id');
            if($chatroomid->count()>0){
                $frnd_val->chatroomid = $chatroomid->first()->chat_room_id;
            }
        }
        
        $receiver_profile_image = getuser_profileimage($request->user()->id);
        
        return view('frontend.messages.firestore',compact('allfriends_list','loginuserid','member_message_data','member_data','receiver_profile_image','active_chat_member'));
    }

    /*************************************/

    public function groupchat(Request $request)
    {
        $loginuserid = $user_id = $request->user()->id;
        $member_message_data = '';
        $group_member_list = [];
        $allfriends_list = $this->allfriends($request);
       
        $grp_list = $this->getGroupMemberList($request);

        $grp_chat = $this->group_chat_list($request);

        $to_member_id = [];
        if(isset($_GET['mmid']) && $_GET['mmid']!='' && $_GET['mmid']>0){
            $to_member_id = $_GET['mmid'];
         }

        $grp_chat_room_id = GroupModel :: select('firestore_grp_id')->where(['grp_name'=>$to_member_id])->first();

//    echo '<pre>';print_r($grp_chat_room_id); 
//         exit();
        $active_chat_member =0;
        if($request->query('mmid') && $request->query('mmid')!=''){
            $active_chat_member = $mmid = $request->query('mmid');
            $member_message_data_result =  MemberMessageModel::select('chat_room_id')->where(function($q1) use ($user_id){
                return $q1->where('member_id',$user_id)->orWhere('user_id',$user_id); 
                    
            })->where(function($q1) use ($mmid){
                return $q1->where('member_id',$mmid)->orWhere('user_id',$mmid); 
                    
            })->whereNotNull('chat_room_id');
            // echo $member_message_data_result->toSql(); exit();
            // echo $member_message_data_result->count();
            if($member_message_data_result->count()>0){
                $member_message_data = $member_message_data_result->first()->chat_room_id;
            }
        }else{
            // print_r($allfriends_list['all_records']); exit();
            if(isset($allfriends_list['all_records'][0]) && $allfriends_list['all_records'][0]->member_data->mmid!=''){
                $active_chat_member = $mmid = $allfriends_list['all_records'][0]->member_data->mmid;
                $member_message_data_result =  MemberMessageModel::select('chat_room_id')->where(function($q1) use ($user_id){
                    return $q1->where('member_id',$user_id)->orWhere('user_id',$user_id); 
                        
                })->where(function($q1) use ($mmid){
                    return $q1->where('member_id',$mmid)->orWhere('user_id',$mmid); 
                        
                })->whereNotNull('chat_room_id');
                // echo $member_message_data_result->toSql(); exit();
                // echo $member_message_data_result->count(); exit();
                if($member_message_data_result->count()>0){
                    $member_message_data = $member_message_data_result->first()->chat_room_id;
                }
            }else{
                return redirect()->route('all-members')->with('error','No connected member');
            }
        }
        
        $member_data=[];
        $member_data_sql = User::where('id',$mmid);
        if($member_data_sql->count()>0){
            $member_data = $member_data_sql->first();
        }
       
        foreach($allfriends_list['all_records'] as $frnd_val){
            $user_id = $loginuserid;
            $mmid = $frnd_val->mmid;
            $chatroomid = MemberMessageModel::select('chat_room_id')->where(function($q1) use ($user_id){
                return $q1->where('member_id',$user_id)->orWhere('user_id',$user_id); 
                    
            })->where(function($q1) use ($mmid){
                return $q1->where('member_id',$mmid)->orWhere('user_id',$mmid); 
                    
            })->whereNotNull('chat_room_id');
            if($chatroomid->count()>0){
                $frnd_val->chatroomid = $chatroomid->first()->chat_room_id;
            }
        }
        
        $receiver_profile_image = getuser_profileimage($request->user()->id);
        
        return view('frontend.messages.groupchat',compact('allfriends_list','grp_list','loginuserid','member_message_data','member_data','receiver_profile_image','active_chat_member', 'grp_chat','grp_chat_room_id'));
    }


    function memberdetail(Request $request){
        // print_r($request->all()); exit();
        // if($mmid!=''){
        $result = User::select(['profile_image','provider_id','social_login','full_name'])->where(['id' => $request->member_id]);
        if ($result->count() > 0) {
            $userdata= $result->first();
            $profile_image = ($userdata->provider_id!='' && $userdata->social_login!='') ? $userdata->profile_image : default_image($userdata->profile_image);
            $full_name = $userdata->full_name;
        
        return response()->json(['data'=>['profileimage'=>$profile_image,'fullname'=>$full_name],'status'=>true]);
        } else {
        return false;
        }
        // $profileimage = getuser_profileimage($request->member_id);
        // $profileimage = getuser_profileimage($request->member_id);   
        // }else{
        //     return false;
        // }
        
    }
}