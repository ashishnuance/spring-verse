
@extends('frontend.layouts.frontLayout')
@section('content')
      <!-- header -->  
      <div class="group-landing">
         <div class="container">
            <div class="container-fluid">
               <div class="group-header">
                  <h1>{{ (isset($grp_detail) && !empty($grp_detail) && $grp_detail->grp_name) ? ucfirst($grp_detail->grp_name) :  '' }}</h1>
                  <div class="group-btn">
                  @if($grp_detail->user_id==auth()->user()->id)
                     <a class="btn btn-right-space addmembers_group" href="JavaScript:void(0);" data-toggle="modal" data-id="{{(isset($grp_detail->id) && $grp_detail->id!='') ? $grp_detail->id : '0'}}" data-target="#addmembers_group"><i class="fa fa-user-plus"></i> Add Members</a>
                     @endif
                     {{-- <a href="" class="btn"><i class="fa fa-calendar"></i> View Meetups Dates</a> --}}
                  </div>
                  <!--- group-btn -->
               </div>
               <!-- group-header -->
               <div class="row">
                  <div class="col-sm-12 col-lg-8 col-md-8">
                     <h4>{{ (isset($grp_detail) && !empty($grp_detail) && $grp_detail->description) ? ucfirst($grp_detail->description) :  '' }}</h4>
                     
                     <?php 
                     $mytag = (isset($grp_detail->tag) && $grp_detail->tag!='') ? explode(',',$grp_detail->tag) : array(); 
                     //echo"<pre>"; print_r($myhobbies); die;

                     ?>

                     <div class="detail-box">
                        <h4><img src="{{asset('frontend/images/icon-hobbies.png')}}" alt=""> Tags</h4>
                        <div class="hobbies-btn">
                        @if(!empty($mytag))
                        @for($h=0;$h< count($mytag);$h++)
                        <a href="javascript:void();" class="btn">{{ (isset($mytag) && !empty($mytag) && $mytag[$h]) ? ucfirst($mytag[$h]) :  '' }}</a>
                        @endfor
                        @endif
                           
                        </div>
                     </div>
                     <!-- detail-box -->
                     <div class="connected-member">
                        <p>Total Connected Members - {{$grp_member_count+1}} Members</p>
                     </div>
                     <!-- connected-member -->
                     <div class="main_member-text search-section">
                        <div class="row">
                           @if(isset($grp_members_grpadmin_arr) && !empty($grp_members_grpadmin_arr))
                           <?php $grp_admin = $grp_members_grpadmin_arr; ?>

                           
                              <div class="col-sm-4 col-md-4">
                                 <div class="thumbnail">
                                    <div class="thumb-img">
                                    <a href="{{ (isset($grp_admin->users_admin->username) && $grp_admin->users_admin->username!='' && $grp_admin->users_admin->id!=auth()->user()->id) ? route('profile',$grp_admin->users_admin->username) :  'javascript:void(0);' }}">
                                       
                                          @if(isset($grp_admin->users_admin->provider_id) && $grp_admin->users_admin->provider_id!='' && $grp_admin->users_admin->social_login!='' && $grp_admin->users_admin->profile_image!='')
                                             <img src="{{ $grp_admin->users_admin->profile_image }}" alt="..." onerror="this.onerror=null;this.src='{{default_image($grp_admin->users_admin->profile_image)}}';"/>
                                             
                                          @else
                                          <img src="{{ (isset($grp_admin->users_admin->profile_image)) ? default_image($grp_admin->users_admin->profile_image) : default_image()}}" alt="...">
                                          @endif
                                       </a>
                                    </div>
                                    
                                    <!-- thumb-img -->
                                    <div class="caption">
                                       <h3>{{ (isset($grp_admin->users_admin->full_name) && $grp_admin->users_admin->full_name!='') ? ucwords($grp_admin->users_admin->full_name)." (admin)" :  '' }}</h3>


                                          @if(isset($position_result) && !empty($position_result))
                                          @foreach($position_result as $pval)
               
                                          @if(isset($grp_admin->user_meta_admin->member_role) && !empty($grp_admin->user_meta_admin->member_role ))
                                          @if($grp_admin->user_meta_admin->member_role==$pval->id)
                                          <p class="member-role">
                                          {{$pval->name}}
                                          </p>
                                          @endif
                                          @endif
                                          @endforeach
                                          @endif
                                    
                                       @if(isset($grp_admin->user_meta_admin->address) && !empty($grp_admin->user_meta_admin->address))
                                       <h5 class="main-locate" >
                                       <img src="{{asset('frontend/images/icon-location.png')}}" class="icon-location" alt="" style="margin-right: 5px;">
                                       {{ (isset($grp_admin->user_meta_admin->address) && $grp_admin->user_meta_admin->address!='') ? $grp_admin->user_meta_admin->address :  '' }}
                                       </h5>
                                       @endif
                                    </div>
                                 </div>
                                 <!-- thumbnail-->
                              </div>
                           
                           @endif

                        @if(isset($group_member_list) && !empty($group_member_list))
             
                        @foreach($group_member_list as $key => $val_user)
                           <div class="col-sm-4 col-md-4">
                              <div class="thumbnail">
                                 <div class="thumb-img">
                                   <a href="{{($val_user->users->id!=auth()->user()->id) ? route('profile',$val_user->users->username) : 'javascript:void(0);'}}">
                                       @if(isset($val_user->users->provider_id) && $val_user->users->provider_id!='' && $val_user->users->social_login!='' && $val_user->users->profile_image!='')
                                          <img src="{{ $val_user->users->profile_image }}" alt="..." onerror="this.onerror=null;this.src='{{default_image($val_user->users->profile_image)}}';"/>
                                          
                                       @else
                                       <img src="{{ (isset($val_user->users->profile_image)) ? default_image($val_user->users->profile_image) : default_image()}}" alt="...">
                                       @endif
                                    </a>
                                    <div class="add-cart">
                                       <ul>
                                       @if($grp_detail->user_id==auth()->user()->id)
                                          <li><a href="{{route('group-member-remove',[base64_encode($val_user->member_id),base64_encode($val_user->group_id)])}}" title="Remove" class="remove-member"><span class="fas fa-times"></span></a></li>
                                          @endif
                                          {{-- <li><a href=""><span class="fas fa-bag-shopping"></span></a></li> --}}
                                       </ul>
                                    </div>
                                 </div>
                                 <!-- thumb-img -->
                                 <div class="caption">
                                    <h3>{{ (isset($val_user->users->full_name) && $val_user->users->full_name!='') ? ucwords($val_user->users->full_name) :  '' }}</h3>

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
                              </div>
                              <!-- thumbnail-->
                           </div>
                        @endforeach
                        @endif
                          
                           <!--col-->
                        </div>
                        <!-- row -->
                       
                        <!-- row -->
                        {{-- <div>  <a href="" class="btn btn-load_search">Load More Member<i class="fa-solid fa-caret-down"></i></a></div> --}}
                     </div>
                     <!-- search-section -->
                 

                  </div>
                  <!-- col -->
                  
                  @if($system_groups_members>0)
                  <div class="col-md-4 col-sm-6">
                     <h1 class="visible-xs profile-heading-mobile">Schedule A Meetup</h1>
                     <div class="calendar-section" id="profile-step1">

                        <div id="myCalendar" inline="true" class="date myCalendar" data-date-format="mm-dd-yyyy"></div>

                        <!-- <div class="datepicker" id="datepicker" inline="true"></div> -->
                        <!-- <div id="my-calendar"></div> -->
                        <div class="meetup-btn">
                           <a href="JavaScript:void(0);" class="btn" id="profile-stepBtn1">Schedule Meetup</a>
                        </div>
                     </div>
                     <!-- calendar-section -->
                     <!-- meeting-location -->
                     <div class="meeting-location" id="profile-step2">
                        <h4><span class="fa fa-angle-left"></span> Meeting Location</h4>
                        <div class="meeting-box">
                           <img src="{{asset('frontend/images/icon-virtual.png')}}" alt="">
                           <h3><a href="JavaScript:void(0);" id="profile-stepBtn2">Virtual <span class="fa fa-angle-right"></span> </a> </h3>
                        </div>
                        <!-- meeting-box -->
                        <div class="meeting-box">
                           <img src="{{asset('frontend/images/icon-virtual.png')}}" alt="">
                           <h3><a href="JavaScript:void(0);">In Person <span class="fa fa-angle-right"></span> </a> </h3>
                        </div>
                        <!-- meeting-box -->
                     </div>
                     <!-- meeting-location -->
                     <!-- slot-section -->
                     <div class="slot-section" id="profile-step3">
                        <h4><span class="fa fa-angle-left"></span> Available Slots</h4>
                        <h5>Friday 6 September, 2022</h5>
                        <ul class="time-slot">
                           <li><a href="">09:30 PM</a></li>
                           <li><a href="" class="active">11:30 PM</a></li>
                           <li><a href="">02:30 PM</a></li>
                           <li><a href="">03:45 PM</a></li>
                           <li><a href="">05:30 PM</a></li>
                        </ul>
                        <h5>Friday 6 September, 2022</h5>
                        <ul class="time-slot">
                           <li><a href="">09:30 PM</a></li>
                           <li><a href="">11:30 PM</a></li>
                           <li><a href="">02:30 PM</a></li>
                           <li><a href="">03:45 PM</a></li>
                           <li><a href="">05:30 PM</a></li>
                        </ul>
                        <div class="confirm-slot">
                           <a href="javascript:void();" class="btn btn-slot" id="profile-stepBtn3">Confirm Slot</a>
                        </div>
                     </div>
                     <!-- slot-section -->
                     <!-- invite-members -->
                     <div class="invite-members" id="profile-step4">
                        <h4><span class="fa fa-angle-left"></span> Invite More Members</h4>
                        <div class="input-group">
                           <input type="text" class="form-control" placeholder="Search Friends" aria-describedby="basic-addon2">
                           <span class="input-group-addon" id="basic-addon2"><a href="" class="btn btn-pop"><i class="fa-solid fa-magnifying-glass"></i></a></span>
                        </div>
                        <!-- input-group -->
                        <h5>Invitation List</h5>
                        <div class="media pop_member">
                           <div class="row">
                              <div class="col-sm-8 col-md-8 col-lg-9">
                                 <div class="media-left">
                                    <a href="#">
                                    <img class="media-object" src="{{asset('frontend/images/popmember.png')}}" alt="...">
                                    </a>
                                 </div>
                                 <div class="media-body">
                                    <h6 class="media-heading">Albert F.</h6>
                                    <p>Fashion Designer</p>
                                 </div>
                              </div>
                              <!--col-->
                              <div class="col-sm-4 col-md-4 col-lg-3">
                                 <div class="checkbox">
                                    <label>
                                    <input type="checkbox"> 
                                    </label>
                                 </div>
                              </div>
                           </div>
                           <!--row-->
                           <div class="row">
                              <div class="col-sm-8 col-md-8 col-lg-9">
                                 <div class="media-left">
                                    <a href="#">
                                    <img class="media-object" src="{{asset('frontend/images/popmember.png')}}" alt="...">
                                    </a>
                                 </div>
                                 <div class="media-body">
                                    <h6 class="media-heading">Albert F.</h6>
                                    <p>Fashion Designer</p>
                                 </div>
                              </div>
                              <!--col-->
                              <div class="col-sm-4 col-md-4 col-lg-3">
                                 <div class="checkbox">
                                    <label>
                                    <input type="checkbox"> 
                                    </label>
                                 </div>
                              </div>
                           </div>
                           <!--row-->
                           <div class="row">
                              <div class="col-sm-8 col-md-8 col-lg-9">
                                 <div class="media-left">
                                    <a href="#">
                                    <img class="media-object" src="{{asset('frontend/images/popmember.png')}}" alt="...">
                                    </a>
                                 </div>
                                 <div class="media-body">
                                    <h6 class="media-heading">Albert F.</h6>
                                    <p>Fashion Designer</p>
                                 </div>
                              </div>
                              <!--col-->
                              <div class="col-sm-4 col-md-4 col-lg-3">
                                 <div class="checkbox">
                                    <label>
                                    <input type="checkbox"> 
                                    </label>
                                 </div>
                              </div>
                           </div>
                           <!--row-->
                           <div class="add-inviteBtn">
                              <a href="JavaScript:void(0);" class="btn btn-invite-pop" id="profile-stepBtn4">Add to Invitation List</a>
                           </div>
                        </div>
                     </div>
                     <!-- invite-members -->
                     <!-- meeting-details-->
                     <div class="meeting-details" id="profile-step5">
                        <h4><span class="fa fa-angle-left"></span> Meetup Details</h4>
                        <div class="row media">
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
                        </div>
                        <!--row-->
                        <div class="row media">
                           <div class="col-sm-9 col-md-9 col-xs-9">
                              <div class="media-left">
                                 <a href="#">
                                 <img class="media-object" src="{{asset('frontend/images/icon-meeting.png')}}" alt="...">
                                 </a>
                              </div>
                              <div class="media-body">
                                 <h6 class="media-heading">Meeting Slot</h6>
                                 <p>11:30 PM - Onwards </p>
                                 <p>Friday 6 September, 2022</p>
                              </div>
                           </div>
                           <!--col-->
                           <div class="col-sm-3 col-md-3 col-xs-3">
                              <div class="meeting-icons">
                                 <a href=""><img src="{{asset('frontend/images/pencilIcon.png')}}" alt=""></a>
                              </div>
                           </div>
                        </div>
                        <!--row-->
                        <div class="row media">
                           <div class="col-sm-9 col-md-9 col-xs-9">
                              <div class="media-left">
                                 <a href="#">
                                 <img class="media-object" src="{{asset('frontend/images/icon-link.png')}}" alt="...">
                                 </a>
                              </div>
                              <div class="media-body">
                                 <h6 class="media-heading">Meeting Link</h6>
                                 <p>https://us06web.zoom.us/j/9218739812?...</p>
                              </div>
                           </div>
                           <!--col-->
                           <div class="col-sm-3 col-md-3 col-xs-3">
                              <div class="meeting-icons">
                                 <a href=""><img src="{{asset('frontend/images/icon-copy.png')}}" alt=""></a>
                              </div>
                           </div>
                        </div>
                        <!--row-->
                        <div class="schedule-meetup">
                           <a href="JavaScript:void(0);" class="btn btn-schedule" id="profile-stepBtn5">Schedule Meetup</a>
                        </div>
                     </div>
                     <!-- meeting-details -->
                  </div>
                  @endif
                  <!-- col4-->
               </div>
               <!-- row -->

               @if($system_groups_members>0)
               <div class="message-section">
                  <div class="message-box">
                     <div class="message-header">
                        <div class="media">
                           <div class="media-left">
                              <a href="#">
                              <img class="media-object" src="{{asset('frontend/images/popmember.png')}}" alt="...">
                              </a>
                           </div>
                           <div class="media-body">
                              <h4 class="media-heading">Yoga</h4>
                              <p>678 Members</p>
                           </div>
                        </div>
                        <!-- media -->
                        <div class="btn-message">
                           <a href="" class="btn">View in  Message</a>
                        </div>
                     </div>
                     <!-- message-header-->
                     <div class="message-middle">
                        <div class="middle-space"></div>
                        <div class="login-or">
                           <hr class="hr-or">
                           <span class="span-or">Today</span>
                        </div>
                        <div class="chat_area" id="style-4">
                           <ul class="list-unstyled">
                              <li class="left clearfix">
                                 <span class="chat-img1 pull-left">
                                 <img src="{{asset('frontend/images/popmember.png')}}" alt="User Avatar" class="img-circle">
                                 </span>
                                 <div class="chat-body1 clearfix">
                                    <div class="chat_time ">11:00 am</div>
                                    <p>Hey Olivia, can you please review the latest design when you can?</p>
                                 </div>
                              </li>
                              <li class="left clearfix admin_chat">
                                 <span class="chat-img1 pull-right">
                                 <img src="{{asset('frontend/images/popmember2.pn')}}g" alt="User Avatar" class="img-circle">
                                 </span>
                                 <div class="chat-body1 clearfix">
                                    <div class="chat_time chat_time_2">09:40PM</div>
                                    <p>Sure thing, I’ll have a look today. They’re looking great! </p>
                                 </div>
                              </li>
                              <li class="left clearfix">
                                 <span class="chat-img1 pull-left">
                                 <img src="{{asset('frontend/images/popmember.png')}}" alt="User Avatar" class="img-circle">
                                 </span>
                                 <div class="chat-body1 clearfix">
                                    <div class="chat_time ">11:00 am</div>
                                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Accusantium cumque animi sit vitae, aliquid reiciendis ut ea quo</p>
                                 </div>
                              </li>
                           </ul>
                        </div>
                        <!--chat_area-->
                        <div class="message_write">
                           <textarea class="form-control" placeholder="Type your message here....."></textarea>
                           <div class="clearfix"></div>
                           <div class="chat_bottom">
                              <a href="#" class="pull-right btn btn-sentbtn">Send Message</a>
                           </div>
                           <div class="clearfix"></div>
                        </div>
                     </div>
                     <!-- message-middle -->
                  </div>
                  <!-- message-box -->
               </div>
               @endif
               <!-- message-section -->
            </div>
            <!-- container-fluid -->
         </div>
         <!-- container -->
      </div>
      <!-- group-landing -->
      <!-- footer -->
      @endsection
   