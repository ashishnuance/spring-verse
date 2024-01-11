@if(isset($user_business_detail) && !empty($user_business_detail))
             
@foreach($user_business_detail as $key => $val_user)

<?php //echo '<pre>';print_r($val_user->user_meta->member_role); exit(); ?>


<div class="col-sm-3 col-md-3">
   <div class="thumbnail">
      <div class="thumb-img">
         <a href="{{route('profile',$val_user->username)}}">
            @if(isset($val_user->provider_id) && $val_user->provider_id!='' && $val_user->social_login!='' && $val_user->profile_image!='')
               <img src="{{ $val_user->profile_image }}" alt="..." onerror="this.onerror=null;this.src='{{default_image($val_user->profile_image)}}';"/>
            @else
            <img src="{{ (isset($val_user->profile_image)) ? default_image($val_user->profile_image) : default_image()}}" alt="...">
            @endif
         </a>
         <div class="add-cart">
            <ul>
               <li><a href="javascript:void:;" class="like_profile_btn" data-url="likeprofilepage" data-profileid="{{$val_user->id}}">
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
            <h3>{{ (isset($val_user->full_name) && $val_user->full_name!='') ? ucwords($val_user->full_name) :  '' }}</h3>
   
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
      
      
     
         <div class="sendRequest-btn" style="{{($val_user->member_request_status>0) ? 'display:none' : 'display:block' }}" name="unsave{{$val_user->user_meta->user_id}}">
            <a href="javascript:void();" data-tomember="{{$val_user->user_meta->user_id}}"  class="btn btn-main_locate sent-req" role="button"><i class="fa-solid fa-user-group"></i>Send Request</a>
         </div>
         
          <div class="sendRequest-btn" style="{{($val_user->member_request_status>0) ? 'display:block' : 'display:none' }}" name="saved{{$val_user->user_meta->user_id}}">
            <a href="javascript:void();" class="btn btn-main_locate sent-req pointer-events" id="buttonid" role="button"><i class="fa-solid fa-user-group"></i>Sent</a>
         </div>
        
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