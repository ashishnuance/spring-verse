<?php

use Carbon\Carbon;
use App\Models\RequestMember;
use App\Models\RecommendedModel;
use App\Models\SocialLink;
use App\Models\PaymentsModel;
use App\Models\MemberShip;
use App\Models\MatchmakingModel;
use App\Models\User;
use App\Models\ProfilegroupModel;
use App\Models\PersonMeeting;
use App\Models\ZoomMeetingNotificationModel;
use App\Models\ZoomMeetingModel;


if (!function_exists('print_die')) {

  function print_die($userlist){

      return json_decode($userlist);

  }

}

if (!function_exists('profile_image')) {
  function profile_image(){
    return (Auth::check() && Auth::user()->profile_image!='') ? asset('/uploads/profile/'.Auth::user()->profile_image) : asset('frontend/images/placeholder-image.jpg');
    //return json_decode($userlist);
  }
}

if (!function_exists('default_image')) {
  function default_image($img=''){
    return empty($img) ? asset('/frontend/images/placeholder-image.jpg') : asset('/uploads/profile/'.$img);
    // return ($img!='') ?  : '/member1.png';
    //return json_decode($userlist);
  }
}

if (!function_exists('differenceInHours')) {
  function differenceInHours($startdate){
    $enddate=date('Y-m-d H:i:s');
    $datetime1 = new DateTime($startdate);
    $datetime2 = new DateTime($enddate);
    $interval = $datetime1->diff($datetime2);
    if($interval->format('%h')>24){
      return $interval->format('%d').' Day(s)';
    }else{
      return ($interval->format('%h')>0) ? $interval->format('%h').' Hours' : $interval->format('%i')." Minutes";
    }
    // $starttimestamp = strtotime($startdate);
    // $endtimestamp = strtotime($enddate);
    // $difference = abs($endtimestamp - $starttimestamp)/3600;
    // $mintunes = abs($endtimestamp - $starttimestamp)/60;
    // return $mintunes;//round($difference);
  }
}


/**
 * get unread notification count
 */
if (!function_exists('unread_notification')) {
  function unread_notification(){
    if(Auth::check()){
      Auth::user()->id;
      return (Requestmember::where('to_member',Auth::user()->id)->where('read_status',0)->count()+RecommendedModel::where('to_member_id',Auth::user()->id)->where('read_status',0)->count()+PersonMeeting::where('member_id',Auth::user()->id)->where('read_status',0)->count()+PersonMeeting::where('user_id',Auth::user()->id)->where('read_status',0)->count()+ProfilegroupModel::where('member_id',Auth::user()->id)->where('read_status',0)->count()+ZoomMeetingNotificationModel::where('member_id',Auth::user()->id)->where('read_status',0)->count()+ZoomMeetingModel::where('user_id',Auth::user()->id)->where('read_status',0)->count());
      
    }else{
      return '0';
    }
  }
}

if ( !function_exists('mysql_escape'))
{
    function mysql_escape($inp)
    { 
        if(is_array($inp)) return array_map(__METHOD__, $inp);

        if(!empty($inp) && is_string($inp)) { 
            return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp); 
        } 

        return $inp; 
    }
}

if (!function_exists('site_social_urls')) {
  function site_social_urls(){
    
    
    return $result = SocialLink::first();
    
  }
}


if(!function_exists('plan_name')) {

  function plan_name($id)
  {
      $result = App\Models\MemberShip::select(['title'])->where(['id' => $id]);
      if ($result->count() > 0) {
          $itemparent = $result->first()->title;
          return $itemparent;
      } else {
          return $id;
      }
  }
}

if(!function_exists('matchmaking_id')) {

  function matchmaking_id($id)
  {
      $matchmak = App\Models\MatchmakingModel::select(['id'])->where(['id' => $id]);

      if ($matchmak->count() > 0) {
        $matchmak_id = $matchmak->first()->id;
      }
      return $matchmak_id;
     
  }

}

if(!function_exists('membership_plan_period')) {

  function membership_plan_period($key='')
  {
    $pay_option = ['Annually'=>'Annually fee', 'Monthly'=>'Springverse fee'];
    if($key!=''){
      return (isset($pay_option[$key]) && $pay_option[$key]!='') ? $pay_option[$key] : '';
    }
    return $pay_option;
  }
}



if(!function_exists('user_name')) {

  function user_name($id)
  {
      $result = App\Models\User::select(['username'])->where(['id' => $id]);
      if ($result->count() > 0) {
          $itemparent = $result->first()->username;
          return $itemparent;
      } else {
          return $id;
      }
  }
}

if(!function_exists('user_fullname')) {

  function user_fullname($id)
  {
      $result = App\Models\User::select(['full_name'])->where(['id' => $id]);
      if ($result->count() > 0) {
          $itemparent = $result->first()->full_name;
          return $itemparent;
      } else {
          return $id;
      }
  }
}


if(!function_exists('getuser_profileimage')) {

  function getuser_profileimage($userid)
  {
      $result = App\Models\User::select(['profile_image','provider_id','social_login'])->where(['id' => $userid]);
      if ($result->count() > 0) {
        $userdata= $result->first();
        $profile_image = ($userdata->provider_id!='' && $userdata->social_login!='') ? $userdata->profile_image : default_image($userdata->profile_image);
        return $profile_image;
      } else {
        return false;
      }
  }
}