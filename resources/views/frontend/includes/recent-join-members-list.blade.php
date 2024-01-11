@if(isset($recent_user_business_detail) && !empty($recent_user_business_detail))
             
@foreach($recent_user_business_detail as $key => $val_user)

<?php //echo '<pre>';print_r($recent_user_business_detail); exit(); ?>


<div class="col-sm-2 col-md-2">
   <div class="thumbnail">
      <div class="thumb-img">
         <a href="{{route('profile',$val_user->username)}}">
            @if(isset($val_user->provider_id) && $val_user->provider_id!='' && $val_user->social_login!='' && $val_user->profile_image!='')
               <img src="{{ $val_user->profile_image }}" alt="..." onerror="this.onerror=null;this.src='{{default_image()}}';" class="profile-image"/>
               
            @else
            <img src="{{ (isset($val_user->profile_image)) ? default_image($val_user->profile_image) : default_image()}}" alt="..." class="profile-image"/>
            @endif
         </a>
         <div class="add-cart">
            <ul>
               <li><a href="javascript:void:;" class="like_profile_btn" data-profileid="{{$val_user->id}}">
                  @if($val_user->like_status>0)
                  <span class="fas fa-heart"></span>
                  @else
                  <span class="far fa-heart"></span>
                  @endif
               </a></li>
               <!-- <li><a href="javascript:void:;"><span class="fas fa-bag-shopping"></span></a></li> -->
            </ul>
         </div>
      </div>
      <!-- thumb-img -->
      <div class="caption">

         <div class="caption-details">
            <h3><a class="link-profile" href="{{route('profile',$val_user->username)}}">{{ (isset($val_user->full_name) && $val_user->full_name!='') ? ucwords($val_user->full_name) :  '' }}</a></h3>
   
            @if(isset($position_result) && !empty($position_result))
            @foreach($position_result as $pval)
            @if(isset($val_user->user_meta->member_role) && !empty($val_user->user_meta->member_role ))
            @if($val_user->user_meta->member_role==$pval->id)
            <p class="member-role">
             {{$pval->name}}
            </p>
            @endif
            @endif
            @endforeach
            @endif
   
            @if(isset($val_user->user_meta->address) && !empty($val_user->user_meta->address))
            <h5 class="main-locate" >
            <img src="{{asset('frontend/images/icon-location.png')}}" class="icon-location" alt="" style="margin-right: 5px;">
            {{ (isset($val_user->user_meta->address) && $val_user->user_meta->address!='') ? $val_user->user_meta->address :  '' }}
            </h5>
            @endif
         </div>
         
         @if((isset($val_user->member_friendslist->uids) && $val_user->member_friendslist->uids!='' && in_array($val_user->id,explode(',',$val_user->member_friendslist->uids))) || (isset($val_user->member_friendslist->mids) && $val_user->member_friendslist->mids!='' && in_array($val_user->id,explode(',',$val_user->member_friendslist->mids))))
            <div class="sendRequest-btn" name="unsave{{$val_user->user_meta->user_id}}">
                  <a href="javascript:void();" data-tomember="{{$val_user->user_meta->user_id}}"  class="btn btn-main_locate" role="button"><i class="fa-solid fa-user-group"></i>Friend</a>
            </div>
         @else
            @if($val_user->member_request_status==0 && $val_user->member_req_pending>0 && $val_user->member_req_pending_data->status==1)
               <div class="sendRequest-btn" style="{{($val_user->member_request_status>0 && $val_user->member_req_pending==0) ? 'display:none' : 'display:block' }}" name="unsave{{$val_user->user_meta->user_id}}">
                  <a href="javascript:void();" data-tomember="{{$val_user->user_meta->user_id}}"  class="btn btn-main_locate" role="button"><i class="fa-solid fa-user-group"></i>Accepted</a>
               </div>
            @elseif($val_user->member_request_status==0 && $val_user->member_req_pending>0 && $val_user->member_req_pending_data->status==0)
               <div class="sendRequest-btn" style="{{($val_user->member_request_status>0 && $val_user->member_req_pending==0) ? 'display:none' : 'display:block' }}" name="unsave{{$val_user->user_meta->user_id}}">
                  {{-- <a href="{{route('update-request-status', ['id'=>$val_user->member_req_pending_data->id,'status'=>1])}}" class="btn btn-notify2" data-reqid="{{$val_user->member_req_pending_data->status}}"><i class="fa fa-user-plus"></i> Accept Request</a> --}}
                  
                     <a href="{{route('update-request-status', ['id'=>$val_user->member_req_pending_data->id,'status'=>1])}}" data-reqid="{{$val_user->member_req_pending_data->status}}"  class="btn btn-main_locate" role="button"><i class="fa-solid fa-user-group"></i>Accept Request</a>
                  </div>
            @else
               <div class="sendRequest-btn" style="{{($val_user->member_request_status>0 && $val_user->member_req_pending==0) ? 'display:none' : 'display:block' }}" name="unsave{{$val_user->user_meta->user_id}}">
                  <a href="javascript:void();" data-tomember="{{$val_user->user_meta->user_id}}"  class="btn btn-main_locate sent-req" role="button"><i class="fa-solid fa-user-group"></i>Send Request</a>
               </div>
               
               <div class="sendRequest-btn" style="{{($val_user->member_request_status>0 && $val_user->member_req_pending==0) ? 'display:block' : 'display:none' }}" name="saved{{$val_user->user_meta->user_id}}">
                  <a href="javascript:void();" class="btn btn-main_locate pointer-events" id="buttonid" role="button"><i class="fa-solid fa-user-group"></i>Sent</a>
               </div>
            @endif
         @endif
        
      </div>
   </div>
   <!-- thumbnail-->
</div>


@endforeach

@else
   <div class="row ten-columns">
      <div class="col-lg-12">
            <div class="NoUserFound">
         <h2>No User Found</h2>
      </div>
   </div>
   </div>
@endif