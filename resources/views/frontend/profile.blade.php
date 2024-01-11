@extends('frontend.layouts.frontLayout')
@section('content')


      <div class="profile-banner">
         <div class="container">
            <div class="media">
               <div class="media-left">
               <a href="JavaScript:void(0);">
                  @if(isset($user_detail->provider_id) && $user_detail->provider_id!='' && $user_detail->social_login!='' && $user_detail->profile_image!='')
                     <img src="{{ $user_detail->profile_image }}" alt="..." onerror="this.onerror=null;this.src='{{default_image($user_detail->profile_image)}}';"/>
                  @else
                  <img class="media-object" src="{{ (isset($user_detail->profile_image)) ? default_image($user_detail->profile_image) : default_image()}}" alt="...">
                  <!-- <img class="media-object" src="{{ empty($user_detail->profile_image) ? url('/public/').'/frontend/images'.env('FRONT_DEFAUlT_PATH') : url('/public/').'/uploads/profile/'.$user_detail->profile_image }}" alt="..."> -->
                  @endif
                  </a>
               </div>
               <div class="media-body">
                  <h4 class="media-heading">{{ (isset($user_detail) && !empty($user_detail) && $user_detail->full_name) ? ucfirst($user_detail->full_name) :  '' }}</h4>

                  {{-- <p>{{ (isset($user_detail->user_meta) && !empty($user_detail->user_meta) && $user_detail->user_meta->member_role) ? $user_detail->user_meta->member_role :  '' }}</p> --}}

                  @if(isset($position_result) && $position_result!='')

                  @foreach($position_result as $pval)
                  <p class="member-role">
                  @if(isset($user_detail->user_meta->member_role) && !empty($user_detail->user_meta->member_role ))
                  @if($user_detail->user_meta->member_role==$pval->id)
                  {{$pval->name}}
                  @endif
                  @endif
                  </p>
                  @endforeach
                  @endif

                  <div class="BtnAcceptAndReject">
                     {{-- <a href="javascript:void();" class="btn btn-notify2"><i class="fa fa-user-plus"></i> Accept</a>
                     <a href="javascript:void();" class="btn btn-notify2"><i class="fa fa-user-plus"></i> Reject</a> --}}
                     
                     <div class="col-md-4 flex-d">
                     
                     @if(isset($notification_list) && $notification_list->to_member==auth()->user()->id)

                        @if(isset($notification_list) && !empty($notification_list) && $notification_list->status ==0)
                        
                        

                           <a href="{{route('update-request-status', ['id'=>$notification_list->id,'status'=>2])}}" class="btn btn-notify2rej" data-reqid="{{$notification_list->status}}"><i class="fa fa-user-times"></i>  Reject Request</a>

                           <a href="{{route('update-request-status', ['id'=>$notification_list->id,'status'=>1])}}" class="btn btn-notify2" data-reqid="{{$notification_list->status}}"><i class="fa fa-user-plus"></i> Accept Request</a>
                        
                        
                        @else
                           @if(isset($notification_list) && $notification_list->status==2)
                              <a href="javascript:void();" class="btn btn-notify2rej pointer-events" data-reqid="{{$notification_list->status}}"><i class="fa fa-user-times"></i>  Rejected</a>
                           @elseif(isset($notification_list) && $notification_list->status==1)
                              <a href="javascript:void();" class="btn btn-notify2" data-reqid="{{$notification_list->status}}"><i class="fa fa-user-plus"></i>  Accepted</a>
                           @endif
                        @endif
                     @else
                     
                     <div class="sendRequest-btn" style="{{ (isset($user_detail) &&($user_detail->member_request_status!='') && ($user_detail->member_request_status>0)) ? 'display:none' : 'display:block' }}" name="unsave{{(isset($user_detail->user_meta->user_id)) ? $user_detail->user_meta->user_id : ''}}">
                        <a href="javascript:void();" data-tomember="{{(isset($user_detail)) ? $user_detail->user_meta->user_id : ''}}"  class="btn btn-notify2rej  sent-req" role="button"><i class="fa-solid fa-user-group"></i> Send Request</a>
                     </div>
                     
                        @if(isset($user_detail->member_friendslist) && ($user_detail->member_friendslist->uids!='' && in_array($user_detail->id,explode(',',$user_detail->member_friendslist->uids)) || $user_detail->member_friendslist->mids!='' && in_array($user_detail->id,explode(',',$user_detail->member_friendslist->mids))))
                              <div class="sendRequest-btn" name="unsave{{$user_detail->user_meta->user_id}}">
                                    <a href="javascript:void();" data-tomember="{{$user_detail->user_meta->user_id}}"  class="btn btn-main_locate" role="button"><i class="fa-solid fa-user-group"></i>Friend</a>
                              </div>
                        @else
                        <div class="sendRequest-btn" style="{{(isset($user_detail) &&$user_detail->member_request_status>0) ? 'display:block' : 'display:none' }}" name="saved{{(isset($user_detail)) ? $user_detail->user_meta->user_id : ''}}">
                           <a href="javascript:void();" class="btn btn-notify2 sent-req pointer-events" id="buttonid" role="button"><i class="fa-solid fa-user-group"></i> Sent</a>
                        </div>
                        @endif
                     @endif
                    

                     

                  </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- container -->
      </div>
      <!-- profile-banner -->
      <div class="profile-section">
         <div class="container">
            <div class="row profile-heading">
               <div class="col-md-8 col-sm-6">
                  <h1>About Me</h1>
               </div>
               @if($check_user_friend>0 || $matchprofile_flag>0)
               <div class="col-md-4 col-sm-6">
                  <h1 class="hidden-xs">Schedule A Meetup</h1>
                  
               </div>
               @endif
              
            </div>
          
            <!-- row -->
            <div class="row profile-details">
               <div class="col-md-8 col-sm-6">
                  <p class="profile-desc">
                     {{ (isset($user_detail->user_meta) && !empty($user_detail->user_meta) && $user_detail->user_meta->bio) ? $user_detail->user_meta->bio :  '' }}
                  </p>
                     <?php 
                     $myhobbies = (isset($user_detail->user_meta->hobbies) && $user_detail->user_meta->hobbies!='') ? explode(',',$user_detail->user_meta->hobbies) : array(); 
                     //echo"<pre>"; print_r($myhobbies); die;

                     ?>
                  <div class="detail-box">

                     <h4><img src="{{asset('frontend/images/icon-hobbies.png')}}" alt=""> Hobbies</h4>
                     <div class="hobbies-btn">
                        @if(!empty($myhobbies))
                        @for($h=0;$h< count($myhobbies);$h++)
                        <a href="javascript:void();" class="btn">{{ (isset($myhobbies) && !empty($myhobbies) && $myhobbies[$h]) ? ucfirst($myhobbies[$h]) :  '' }}</a>
                        @endfor
                        @endif
                     </div>

                  </div>
                  <!-- detail-box -->
                  <div class="row">
                     <div class="col-md-6 col-sm-12">
                        <div class="profile-messagebox">
                           <a href="{{route('messages')}}?mmid={{$user_detail->id}}"><img src="{{asset('frontend/images/icon-message.png')}}" alt=""> Message <span class="fa fa-angle-right"></span></a>
                        </div>
                        <!-- profile-messagebox-->
                     </div>
                     <div class="col-md-6 col-sm-12">
                        <div class="profile-messagebox">
                        <a href="JavaScript:void(0);" data-toggle="modal" class="frommemberid" data-target="#Recommend" data-frommemberid="{{(isset($user_detail)) ? $user_detail->id :''}}"><img src="{{asset('frontend/images/icon-recommend.png')}}" alt=""> Recommend <span class="fa fa-angle-right"></span></a>
                        </div>
                        <!-- profile-messagebox-->
                     </div>
                  </div>
                  <!-- row -->
               </div>
               
               <div class="col-md-4 col-sm-6">
                  @if($check_user_friend>0 || $matchprofile_flag>0)
                  <h1 class="visible-xs profile-heading-mobile">Schedule A Meetup</h1>
                  <div class="calendar-section" id="profile-step1">
                   
                     <div class="InlineCalender">
                        <div id="myCalendar" inline="true" class="date myCalendar" name="date_time" data-date-format="mm-dd-yyyy"></div>
                        <input type="hidden" name="person_meetingdate_date" value="{{date('d-m-Y')}}"/>

                        <div class="ScheduleTime">
                           <p>Schedule Time</p>
                           <div class="group">
                           <input type="time"  class="btn timehere" id="time" name="person_meetingdate_time" value="{{date('H:i A')}}"/>
                           </div>
                           
                        </div>
                        
                     </div>
                  

                     <!-- <div class="datepicker" id="datepicker" inline="true"></div> -->
                     <!-- <div id="my-calendar"></div> -->
                     <div class="meetup-btn">
                      {{-- <div class="col-md-4 col-sm-6">
                     <input type="time"  class="btn" id="time" name="person_meetingdate_time" />
                     </div> --}}
                        <a href="JavaScript:void(0);" class="btn" id="profile-stepBtn1">Schedule Meetup</a>
                     </div>

                  </div>
                  @endif

                  
                  <!-- calendar-section -->
                  <!-- meeting-location -->
                  <div class="meeting-location" id="profile-step2">
                     <h4><span class="fa fa-angle-left schedule-back cursorpointer"></span> Meeting Location</h4>
                     <div class="meeting-box">
                        <img src="{{asset('frontend/images/icon-virtual.png')}}" alt="">
                        <h3><a href="JavaScript:void(0);" id="profile-stepBtn2">Virtual <span class="fa fa-angle-right"></span> </a> </h3>
                     </div>
                     <!-- meeting-box -->
                   
                
                     <div class="meeting-box">
                        <img src="{{asset('frontend/images/icon-virtual.png')}}" alt="">
                        <h3><a href="JavaScript:void(0);" data-toggle="modal" data-profilename="{{(isset($user_detail)) ? $user_detail->full_name :''}}" data-meetingid="{{(isset($user_detail)) ? $user_detail->id :''}}" class="meetingid" data-target="#person-meet">In Person <span class="fa fa-angle-right"></span> </a> </h3>
                     </div>
                    
                     <!-- meeting-box -->
                  </div>
                  <!-- meeting-location -->
                  <!-- slot-section -->
                  <div class="slot-section" id="profile-step3">
                     <h4><span class="fa fa-angle-left meeting-back cursorpointer"></span> Meeting Detail</h4>
                     <h5 class="zoom_meeting_date">Friday 6 September, 2022</h5>
                     <ul class="time-slot zoom_meeting_time">
                        {{-- <li><a href="">09:30 PM</a></li> --}}
                        <li><a href="javascript:void(0);" class="active">11:30 PM</a></li>
                        {{-- <li><a href="">02:30 PM</a></li>
                        <li><a href="">03:45 PM</a></li>
                        <li><a href="">05:30 PM</a></li> --}}
                     </ul>
                     <input type="hidden" name="meeting_start_time"/>
                     <div class="form-group">
                     <input type="text" name="topic" placeholder="Meeting Topic" class="form-control"/>
                     </div>
                     <div class="form-group">
                     <input type="text" name="agenda" placeholder="Meeting Agenda" class="form-control"/>
                     </div>
                     <div class="form-group">
                        <label>Duration</label>
                        <select class="form-control" name="duration">
                           <option value="15" select="select">15 Min</option>
                           <option value="30">30 Min</option>
                           <option value="45">45 Min</option>
                           <option value="60">1 Hr</option>
                        </select>
                     </div>
                     <input type="hidden" name="meeting_starttime" required/>
                     <div class="confirm-slot">
                        
                        <a href="javascript:void(0);" class="btn btn-slot" id="profile-stepBtn3">Confirm Slot</a>
                     </div>
                  </div>
                  <!-- slot-section -->
                  <!-- invite-members -->
                  <div class="invite-members" id="profile-step4">
                     <h4><span class="fa fa-angle-left profile-step4 cursorpointer"></span> Invite More Members</h4>
                     {{-- <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search Friends" aria-describedby="basic-addon2">
                        <span class="input-group-addon" id="basic-addon2"><a href="" class="btn btn-pop"><i class="fa-solid fa-magnifying-glass"></i></a></span>
                     </div> --}}
                     <!-- input-group -->
                     <h5>Invitation List <span class="heading-skip-btn">
                        
                     <a href="JavaScript:void(0);" id="profile-stepBtn4">Skip</a></span></h5>
                     <div class="media pop_member">
                        <div class="list-scroll">
                        <input type="checkbox" style="display:none" value="{{(isset($user_detail->id) && $user_detail->id!='') ? $user_detail->id  :''}}" checked="checked" class="member_invitation" name="member_invitation[]">
                        @if(isset($user_detail->user_friendlist_detail) && $user_detail->user_friendlist_detail!='')
                        @foreach($user_detail->user_friendlist_detail as $member_val)
                        <div class="row">
                           <div class="col-sm-8 col-md-8 col-lg-8">
                              <div class="InnerListInva">
                              <div class="media-left">
                                 <a href="javascript:void(0);">
                                    @if(isset($member_val->social_login) && $member_val->social_login!='' && $member_val->profile_image!='')
                                       <img class="media-object" src="{{ $member_val->profile_image }}" alt="..." onerror="this.onerror=null;this.src='{{default_image()}}';"/>
                                    @else
                                    <img class="media-object" src="{{ (isset($member_val->profile_image)) ? default_image($member_val->profile_image) : default_image()}}" alt="..." onerror="this.onerror=null;this.src='{{default_image()}}';">
                                    
                                    @endif
                                 {{-- <img class="media-object" src="{{asset('frontend/images/popmember.png')}}" alt="..."> --}}
                                 </a>
                              </div>
                              <div class="media-body TextAlign">
                                 <p>{{(isset($member_val->full_name) && $member_val->full_name!='') ? ucwords($member_val->full_name) : ''}}</p>
                                 {{-- <p>Fashion Designer</p> --}}
                              </div>
                           </div>
                           </div>
                           
                           <!--col-->
                           <div class="col-sm-4 col-md-4 col-lg-4">
                              <div class="checkbox">
                                 <label>
                                 <input type="checkbox" value="{{$member_val->id}}" class="member_invitation" name="member_invitation[]"> 
                                 </label>
                              </div>
                           </div>
                        </div>
                        @endforeach
                        @endif
                        </div>
                        <!--row-->
                        
                        <div class="add-inviteBtn">
                           <a href="JavaScript:void(0);" class="btn btn-invite-pop" id="profile-stepBtn5" >Add to Invitation List</a>

                        </div>
                     </div>
                  </div>
                  <!-- invite-members -->
                  <!-- meeting-details-->
                  <div class="meeting-details" id="profile-step5">
                     <h4><span class="fa fa-angle-left cursorpointer profile-step5"></span> Meetup Details</h4>
                     {{-- <div class="row media">
                        <div class="col-sm-9 col-md-9 col-xs-9">
                           <div class="media-left">
                              <a href="#">
                              <img class="media-object" src="{{asset('frontend/images/icon-user.png')}}" alt="...">
                              </a>
                           </div>
                           <div class="media-body">
                              <h6 class="media-heading">Participant List</h6>
                              <p>Savannah N., Albert F., Floyd M.</p>
                           </div>
                        </div>
                        <!--col-->
                        <div class="col-sm-3 col-md-3 col-xs-3">
                           <div class="meeting-icons">
                              <a href=""><img src="{{asset('frontend/images/pencilIcon.png')}}" alt=""></a>
                           </div>
                        </div>
                     </div> --}}
                     <!--row-->
                     <div class="row media">
                        <div class="col-sm-9 col-md-9 col-xs-9">
                           <div class="media-left">
                              <a href="javascript:void(0);">
                              <img class="media-object" src="{{asset('frontend/images/icon-meeting.png')}}" alt="...">
                              </a>
                           </div>
                           <div class="media-body">
                              <h6 class="media-heading">Meeting Slot</h6>
                              <p class="meeting_tt">11:30 PM - Onwards </p>
                              <p class="meeting_dt">Friday 6 September, 2022</p>
                           </div>
                        </div>
                        <!--col-->
                        <div class="col-sm-3 col-md-3 col-xs-3">
                           <div class="meeting-icons">
                              {{-- <a href=""><img src="{{asset('frontend/images/pencilIcon.png')}}" alt=""></a> --}}
                           </div>
                        </div>
                     </div>
                     <!--row-->
                     <div class="row media">
                        <div class="col-sm-9 col-md-9 col-xs-9">
                           <div class="media-left">
                              <a href="javascript:void(0);">
                              <img class="media-object" src="{{asset('frontend/images/icon-link.png')}}" alt="...">
                              </a>
                           </div>
                           <div class="media-body">
                              <h6 class="media-heading">Join Meeting Link</h6>
                              <p class="meetingjoinlink">https://us06web.zoom.us/j/9218739812?...</p>
                           </div>
                        </div>
                        <!--col-->
                        <div class="col-sm-3 col-md-3 col-xs-3">
                           
                           <div class="meeting-icons">
                               <span class="tooltiptext" id="myTooltip"></span>
                              <a href="javascript:void(0);"  onclick="copyToClipboard('.meetingjoinlink')" ><img src="{{asset('frontend/images/icon-copy.png')}}" alt="" onmouseout="outFunc()"></a>
                           

                           </div>
                        </div>
                     </div>
                     <!--row-->
                     <div class="schedule-meetup">
                        <a href="JavaScript:void(0);" class="btn btn-schedule" id="profile-stepBtn5" target="_blank">Schedule Meetup</a>
                     </div>
                  </div>
                  <!-- meeting-details -->
               </div>
            </div>
            <!-- row -->
         </div>
      </div>
      <!-- profile-section -->
@endsection

      