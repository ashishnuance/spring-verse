@if(isset($requestlist_result) && $requestlist_result!='')
@foreach($requestlist_result as $request_value)
<div class="notification-box">
<div class="row">
   <div class="col-sm-6 col-lg-6">
      <div class="media">
         
         <div class="media-left">
            <a href="{{(isset($request_value->user_requestuser->username)) ? route('profile',$request_value->user_requestuser->username) : 'javascript:void();'}}">
            <img class="media-object" src="{{ (isset($request_value->user_requestuser->profile_image) && $request_value->user_requestuser->profile_image!='') ? default_image($request_value->user_requestuser->profile_image) : default_image()}}" alt="..." onerror="this.onerror=null;this.src='{{default_image()}}';">
            </a>
         </div>
         <div class="media-body">
            <h4> <a href="{{(isset($request_value->user_requestuser->username)) ? route('profile',$request_value->user_requestuser->username) : 'javascript:void();'}}"> {{ (isset($request_value->user_requestuser->full_name) && $request_value->user_requestuser->full_name!='') ? ucwords($request_value->user_requestuser->full_name) :  '' }}</a><span class="date-time">
            {{differenceInHours($request_value->created_at)}} ago</span></h4>


         @if($request_value->status ==2 )
            <p>Request Rejected</p>

         @elseif($request_value->status ==1 )
            <p>Request Accepted</p>
            @else

            <p>You have sent request to {{ (isset($request_value->user_requestuser->full_name) && $request_value->user_requestuser->full_name!='') ? $request_value->user_requestuser->full_name : ''}} </p>
         @endif
         
         </div>
      </div>
      <!-- media -->
   </div>
   <div class="col-sm-6 col-lg-6">

      <div class="notification-btns">
         Request Status 
         @if($request_value->status ==1 )
         <b>Accepted</b>
         @elseif($request_value->status ==2)
         <b>Rejected</b>

         @else

         
         <b>Pending</b>

         @endif
      </div>
      <!-- notification-btns -->
   </div>
</div>
</div>
@endforeach
@endif