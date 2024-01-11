<div class="row ">
    <div class="col-sm-7 col-lg-7">
       <div class="media">
          <div class="media-left">
            @if($noti_val->type=='meeting_sent')
               <a href="{{ (isset($noti_val->listdata->user_request_touser->username)) ? route('profile',$noti_val->listdata->user_request_touser->username) : 'javascript:void();'}}" target="_blank">
                  <img class="media-object" src="{{ (isset($noti_val->listdata->user_request_touser->profile_image) && $noti_val->listdata->user->profile_image!='') ? default_image($noti_val->listdata->user_request_touser->profile_image) : ''}}" alt="..." onerror="this.onerror=null;this.src='{{default_image()}}';" width="100px">
               </a>
            @else
               <a href="{{ (isset($noti_val->listdata->user->username)) ? route('profile',$noti_val->listdata->user->username) : 'javascript:void();'}}" target="_blank">
               <img class="media-object" src="{{ (isset($noti_val->listdata->user->profile_image) && $noti_val->listdata->user->profile_image!='') ? default_image($noti_val->listdata->user->profile_image) : ''}}" alt="..." onerror="this.onerror=null;this.src='{{default_image()}}';" width="100px">
               </a>
            @endif
          </div>
          <div class="media-body">
            @if($noti_val->type=='meeting_sent')
               <h4><a href="{{ (isset($noti_val->listdata->user_request_touser->username)) ? route('profile',$noti_val->listdata->user_request_touser->username) : 'javascript:void();'}}"> {{ (isset($noti_val->listdata->user_request_touser->full_name) && $noti_val->listdata->user->full_name!='') ? ucwords($noti_val->listdata->user_request_touser->full_name) :  '' }}</a><span class="date-time">
             {{differenceInHours(($noti_val->listdata->created_at!='') ? $noti_val->listdata->created_at : $noti_val->listdata->updated_at)}} ago</span></h4>
            @else
               <h4><a href="{{ (isset($noti_val->listdata->user->username)) ? route('profile',$noti_val->listdata->user->username) : 'javascript:void();'}}"> {{ (isset($noti_val->listdata->user->full_name) && $noti_val->listdata->user->full_name!='') ? ucwords($noti_val->listdata->user->full_name) :  '' }}</a><span class="date-time">
               {{differenceInHours(($noti_val->listdata->updated_at!='') ? $noti_val->listdata->updated_at : $noti_val->listdata->updated_at)}} ago</span></h4>
            @endif
   
            @if($noti_val->type=='meeting')
          

               <p>{{isset($noti_val->listdata->user->full_name) ?$noti_val->listdata->user->full_name : ''}}  sent you request for person meeting on Date {{date('d-m-Y',strtotime($noti_val->listdata->date_time))}} at {{date('H:i A',strtotime($noti_val->listdata->date_time))}}</p>
            @elseif($noti_val->type=='meeting_sent')
            
               <p>You sent <b>{{isset($noti_val->listdata->user_request_touser->full_name) ?$noti_val->listdata->user_request_touser->full_name : ''}}</b> invitation for in person meeting on Date {{date('d-m-Y',strtotime($noti_val->listdata->date_time))}} at {{date('H:i A',strtotime($noti_val->listdata->date_time))}}</p>
            @else
             <p>This Member recommended you this Profile <a href="{{ (isset($noti_val->listdata->user_requestuser->username)) ? route('profile',$noti_val->listdata->user_requestuser->username) : 'javascript:void();'}}" target="_blank">{{(isset($noti_val->listdata->user_requestuser->full_name) && $noti_val->listdata->user_requestuser->full_name!='') ? $noti_val->listdata->user_requestuser->full_name : ''}}</a></p>
            @endif
          </div>
       </div>
       <!-- media -->
    </div>
    
    <div class="col-sm-5 col-lg-5">
       
       <!-- notification-btns -->
    </div>
 </div>