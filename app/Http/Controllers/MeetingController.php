<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserMeta;
use App\Models\Profiletype;
use App\Models\PersonMeeting;
use App\Models\Industry;
use App\Models\ProfilegroupModel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Models\ZoomMeetingModel;
use App\Models\MatchmakingprofilestatusModel;


use Illuminate\Support\Facades\Auth;

class MeetingController extends Controller
{
    public function meeting(Request $request,$username=''){
        $user_id = Auth::user()->id;
        $postdata = $request->all();
        // echo "<pre>";print_r($postdata); die;
        $postdata['user_id'] = $request->user()->id;
        $postdata['group_id'] = $request->group_id;

        $postdata['member_id'] = $request->member_id;

        $postdata['date_time'] = date('Y-m-d H:i:s', strtotime($request->date_time));

        $data = PersonMeeting::create($postdata);
        if($request->profile_id!=''){
          MatchmakingprofilestatusModel::updateOrCreate(['profile_id'=>$request->profile_id,'user_id'=>$user_id],['profile_id'=>$request->profile_id,'user_id'=>$user_id,'status'=>1]);
        }
        
        if ($data) {

            return redirect()->back()->with('success','Meeting Schedule Successfully Added');

        } else {

            return redirect()->back()->with('error', 'Meeting Not Created');
        }
      
    }

    public function meetinglist(Request $request)
    {
      $user_id = $request->user()->id;
      
      $zoom_meeting_data = ZoomMeetingModel::whereRaw("find_in_set($user_id,member_ids)")->orWhere('user_id',$user_id)->where('date_time','>',date('Y-m-d'))->orderBy('id','desc');
      // echo $zoom_meeting_data->toSql();
      $this->data['meeting_list_count'] = $zoom_meeting_data->count();
      // echo $zoom_meeting_data->count();
      if($zoom_meeting_data->count()>0){
        
        $this->data['meeting_list_result'] = $zoom_meeting_data->get();
      }

      $multiple_member_id = $zoom_meeting_data->pluck('member_ids');
      
      $single_member_id = explode(',',(isset($multiple_member_id[0]) && $multiple_member_id[0]!='') ? $multiple_member_id[0] : '');
      
      $member_new = User::select('profile_image','username','full_name')->where(['id'=>$single_member_id])->get();
       
      $this->data['member_new_profile'] = $member_new;
            
      return view('frontend.zoom_meeting_list',$this->data);

    }

}