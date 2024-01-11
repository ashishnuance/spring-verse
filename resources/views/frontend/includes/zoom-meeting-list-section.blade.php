<div class="row ">
    <div class="col-sm-7 col-lg-9">
       <div class="media">
          <div class="media-left">
            
            @if($noti_val->type=='zoom_meeting_request')
               
               <img class="media-object" src="{{ default_image()}}" alt="..." onerror="this.onerror=null;this.src='{{default_image()}}';" width="100px">
               </a>
            @else
                <a href="{{ (isset($noti_val->listdata->user->username)) ? route('profile',$noti_val->listdata->user->username) : 'javascript:void();'}}" target="_blank">
                <img class="media-object" src="{{ (isset($noti_val->listdata->user->profile_image) && $noti_val->listdata->user->profile_image!='') ? default_image($noti_val->listdata->user->profile_image) : ''}}" alt="..." onerror="this.onerror=null;this.src='{{default_image()}}';" width="100px">
                </a>
            @endif
            
          </div>
          <div class="media-body">
            @if($noti_val->type=='zoom_meeting_request')
                <h4><a href="javascript:void()"> {{ (isset($noti_val->listdata->user->full_name) && $noti_val->listdata->user->full_name!='') ? ucwords($noti_val->listdata->user->full_name) :  '' }}</a><span class="date-time">
                {{differenceInHours(($noti_val->listdata->created_at!='') ? $noti_val->listdata->created_at : $noti_val->listdata->updated_at)}} ago</span></h4>

                <p>Date: {{date('D j M,Y',strtotime($noti_val->listdata->date_time))}} at  {{date('H:i A',strtotime($noti_val->listdata->date_time))}}</p>
                <p>Your meeting URL <a href="{{ (isset($noti_val->listdata->start_link)) ? $noti_val->listdata->start_link : 'javascript:void();'}}" target="_blank">{{$noti_val->listdata->start_link}}</a></p>
            @else
                <h4><a href="{{ (isset($noti_val->listdata->user->username)) ? route('profile',$noti_val->listdata->user->username) : 'javascript:void();'}}"> {{ (isset($noti_val->listdata->user->full_name) && $noti_val->listdata->user->full_name!='') ? ucwords($noti_val->listdata->user->full_name) :  '' }}</a><span class="date-time">
               {{differenceInHours(($noti_val->listdata->created_at!='') ? $noti_val->listdata->created_at : $noti_val->listdata->updated_at)}} ago</span></h4>

                <p>This Member send you meeting request <a href="{{ (isset($noti_val->listdata->join_url)) ? $noti_val->listdata->join_url : 'javascript:void();'}}" target="_blank">{{$noti_val->listdata->join_url}}</a></p>
            @endif
            
          </div>
       </div>
       <!-- media -->
    </div>
    
    <div class="col-sm-5 col-lg-5">
       
       <!-- notification-btns -->
    </div>
 </div>