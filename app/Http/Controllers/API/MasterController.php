<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\MemberMessageModel;
use App\Models\User;
use stdClass;

class MasterController extends Controller 
{
    public $successStatus = 200;
    public $errorStatus = 401;

    function getmemberdata($mmid=0){
        if($mmid>0){
            $chatroomid = MemberMessageModel::select('chat_room_id','member_id','user_id')->where(function($q1) use ($mmid){
                return $q1->where('member_id',$mmid)->orWhere('user_id',$mmid);  
            })->get();
            $member_result = [];
            foreach($chatroomid as $key => $val){
                $member_result[$key] = $val;
                if($val->user_id==$mmid){
                    $userdata = User::select(['id as member_id','full_name','profile_image','social_login','provider_id'])->where('id',$val->member_id)->first();

                    $member_result[$key]['profile_image'] = ($userdata->provider_id!='' && $userdata->social_login!='') ? $userdata->profile_image : default_image($userdata->profile_image);
                    $member_result[$key]['full_name'] = $full_name = $userdata->full_name;
                    $member_result[$key]['member_id'] = $userdata->member_id;
                    

                }else{
                    $userdata = User::select(['id as member_id','full_name','profile_image','social_login','provider_id'])->where('id',$val->user_id)->first();
                    
                    
                    $member_result[$key]['profile_image'] = ($userdata->provider_id!='' && $userdata->social_login!='') ? $userdata->profile_image : default_image($userdata->profile_image);
                    $member_result[$key]['full_name'] = $userdata->full_name;
                    $member_result[$key]['member_id'] = $userdata->member_id;
                }
            }
            return response()->json(['success' =>$this->successStatus,'message'=>'member id','data'=>$member_result], $this->successStatus); 
        }else{
            return response()->json(['error' =>$this->errorStatus,'message'=>'screen file not proper'], $this->errorStatus); 
        }
    }

    function getsinglememberdata($mmid=0){
        if($mmid>0){ 
            $userdata = User::select(['id as member_id','full_name','profile_image','social_login','provider_id'])->where('id',$mmid)->first();

            $member_result['profile_image'] = ($userdata->provider_id!='' && $userdata->social_login!='') ? $userdata->profile_image : default_image($userdata->profile_image);
            $member_result['full_name'] = $full_name = $userdata->full_name;
            $member_result['member_id'] = $userdata->member_id;
            return response()->json(['success' =>$this->successStatus,'message'=>'member id','data'=>$member_result], $this->successStatus); 
        }else{
            return response()->json(['error' =>$this->errorStatus,'message'=>'screen file not proper'], $this->errorStatus); 
        }
    }

}