
<div class="notification-box ">
<div class="row ">
   <div class="col-sm-6 col-lg-6">
      <div class="media">
         <div class="media-left">
      
            <a href="{{ (isset($noti_val->listdata->user->username)) ? route('profile',$noti_val->listdata->user->username) : 'javascript:void();'}}">
            <img class="media-object" src="{{ (isset($noti_val->listdata->user->profile_image) && $noti_val->listdata->user->profile_image!='') ? default_image($noti_val->listdata->user->profile_image) : ''}}" alt="..." onerror="this.onerror=null;this.src='{{default_image()}}';">
            </a>
         </div>
         <div class="media-body">
            
            <h4><a href="{{ (isset($noti_val->listdata->user->username)) ? route('profile',$noti_val->listdata->user->username) : 'javascript:void();'}}"> 
            {{ (isset($noti_val->listdata->user->full_name) && $noti_val->listdata->user->full_name!='') ? ucwords($noti_val->listdata->user->full_name) :  '' }}</a><span class="date-time">
            {{differenceInHours(($noti_val->listdata->updated_at!='') ? $noti_val->listdata->updated_at : $noti_val->listdata->updated_at)}} ago</span></h4>

            
            
            @if($noti_val->listdata->status ==2 )
               <p>Request Rejected</p>

            @elseif($noti_val->listdata->status ==1 )
               <p>Request Accepted</p>
            @else

            <p>{{ (isset($noti_val->listdata->user->full_name) && $noti_val->listdata->user->full_name!='') ? $noti_val->listdata->user->full_name : 'user'}} has sent you request</p>
            @endif
            

         </div>
      </div>
      <!-- media -->
   </div>
   
   <div class="col-sm-6 col-lg-6">
      <div class="notification-btns">


         @if($noti_val->listdata->status ==0)

         <a href="{{route('update-request-status', ['id'=>$noti_val->listdata->id,'status'=>2])}}" class="btn btn-notify2 acceptrequest" data-reqid="{{$noti_val->listdata->status}}"> <i class="fa fa-user-plus"></i> Reject Request</a>

         <a href="{{route('update-request-status', ['id'=>$noti_val->listdata->id,'status'=>1])}}" class="btn btn-notify1 acceptrequest" data-reqid="{{$noti_val->listdata->status}}"> <i class="fa fa-user-plus"></i> Accept Request</a>
         
         
         @else
            @if($noti_val->listdata->status==2)
               <a href="javascript:void();" class="btn btn-notify1 rejectrequest pointer-events" data-reqid="{{$noti_val->listdata->status}}"> <i class="fa fa-user-times"></i> Rejected</a>
            @elseif($noti_val->listdata->status==1)
               <a href="javascript:void();" class="btn btn-notify2 acceptrequest pointer-events" data-reqid="{{$noti_val->listdata->status}}"> <i class="fa fa-user-plus"></i> Accepted</a>
            @endif
         @endif

         {{-- @if($noti_val->listdata->status ==0)

         <a href="{{route('update-request-status', ['id'=>$noti_val->listdata->id,'status'=>1])}}" class="btn btn-notify2 acceptrequest" data-reqid="{{$noti_val->listdata->status}}"> <i class="fa fa-user-plus"></i> Accepted</a>

         @else
         <a href="javascript:;" class="btn btn-notify2 acceptrequest" data-reqid="{{$noti_val->listdata->status}}"> <i class="fa fa-user-plus"></i> Accept Request</a>

         @endif --}}


      
      </div>
      <!-- notification-btns -->
   </div>
</div>
</div>

