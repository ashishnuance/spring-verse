<div class="row ">
    <div class="col-sm-6 col-lg-8">
       <div class="media">
          <div class="media-left">
       
             <a href="{{ (isset($noti_val->listdata->groupusers->username)) ? route('profile',$noti_val->listdata->groupusers->username) : 'javascript:void();'}}" target="_blank">
             <img class="media-object" src="{{ default_image($noti_val->listdata->groupusers->profile_image)}}" alt="..." onerror="this.onerror=null;this.src='{{default_image($noti_val->listdata->groupusers->profile_image)}}';">
             </a>
          </div>
          <div class="media-body">
           
             <h4><a href="{{ (isset($noti_val->listdata->groupusers->username)) ? route('profile',$noti_val->listdata->groupusers->username) : 'javascript:void();'}}"> {{ (isset($noti_val->listdata->groupusers->full_name) && $noti_val->listdata->groupusers->full_name!='') ? ucwords($noti_val->listdata->groupusers->full_name) :  '' }}</a><span class="date-time">
             {{differenceInHours(($noti_val->listdata->updated_at!='') ? $noti_val->listdata->updated_at : $noti_val->listdata->updated_at)}} ago</span></h4>

             <p>This Member added you this group <a href="{{ (isset($noti_val->listdata->group_detail->grp_name)) ? route('group-detail',$noti_val->listdata->group_detail->slug) : 'javascript:void();'}}" target="_blank">{{(isset($noti_val->listdata->group_detail->grp_name) && $noti_val->listdata->group_detail->grp_name!='') ? ucfirst($noti_val->listdata->group_detail->grp_name) : ''}}</a></p>
          </div>
       </div>
       <!-- media -->
    </div>
    
    <div class="col-sm-6 col-lg-6">
       
       <!-- notification-btns -->
    </div>
 </div>