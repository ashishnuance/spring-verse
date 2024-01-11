@extends('frontend.layouts.frontLayout')
 @section('content')
      <!-- header -->
      <div class="personal_detail myaction-section">
         <div class="container">
            <div class="row">
               <div class="col-lg-2 col-sm-4">
                  <div class="accountbox">
                     <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
                     @include('frontend.myaccount.sidebarmenu')
                     <!-- /.navbar-collapse -->
                  </div>
                  <!-- accountbox -->
                </div>
                  <!-- col -->
               <div class="col-lg-6">
                      
            <form action="{{route('professional-detail-update')}}" method="post"> 
               <input type="hidden" name="_token" value="{{csrf_token()}}">
               <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                @include('frontend.includes.flashMessage')

                  <h2>Professional Details</h2>
                 
                  
                  <div class="personal_inner" id="PersonalDetails">
                     <h5>Your Personal Details</h5>
                     <div class="input-inside">
                        <div class="form-group form-group-default">
                           <label class="control-label">Full Name</label>
                           <input type="text"  name="full_name" id="project"  value="{{ (isset($usermeta_detail) && !empty($usermeta_detail) && $usermeta_detail->full_name) ? $usermeta_detail->full_name :  old('full_name') }}" class="form-control" required="">
                        </div>
                        <div class="form-group form-group-default">
                           <label class="control-label">Email</label>
                           <input type="email" name="email" id="project"  value="{{ (isset($usermeta_detail) && !empty($usermeta_detail)  && $usermeta_detail->email) ? $usermeta_detail->email :  old('email') }}" class="form-control" required="" readonly>
                        </div>
                     </div>
                  </div>
                  <div class="row detail-info">
                     <div class="col-md-4 col-sm-4">
                        <div class="form-group form-group-default">
                           <label class="control-label">Phone</label>
                           <input type="text" maxlength="14"  name="phone" id="project"  value="{{ (isset($usermeta_detail) && !empty($usermeta_detail)  && $usermeta_detail->phone) ? $usermeta_detail->phone :  old('phone') }}" class="form-control" required="" oninput="this.value=this.value.replace(/[^0-9]/g,'');" >
                        </div>
                     </div>
                     <!--1st-->
                     <div class="col-md-4 col-sm-4">
                        <div class="form-group form-group-default">
                           <label class="control-label">Mobile</label>
                           <input type="text" maxlength="14"  name="mobile" id="project"  value="{{ (isset($usermeta_detail) && !empty($usermeta_detail) && $usermeta_detail->mobile) ? $usermeta_detail->mobile :  old('mobile') }}" class="form-control" required="" oninput="this.value=this.value.replace(/[^0-9]/g,'');" >
                        </div>
                     </div>
                     <!--2nd-->
                     <div class="col-md-4 col-sm-4">
                        <div class="form-group form-group-default">
                           <label class="control-label">Gender</label>
                         
                           <select name="gender" id="typeId" class="form-control" required="">
                              <option value="1" selected {{ (isset($usermeta_detail->gender) && !empty($usermeta_detail) && $usermeta_detail->gender == "1") ? 'selected' : '' }}>Male</option>
                              <option value="0" {{ (isset($usermeta_detail->gender) && !empty($usermeta_detail) && $usermeta_detail->gender == "0") ? 'selected' : '' }}>Female</option>
                           </select>
                        </div>
                     </div>
                     <!--3rd-->
                  </div>
                  <!--inner row-->
                  {{-- <div class="birth_info">
                   <div class="form-group inlineform">
                   <label class="control-label">Date</label>
                  <input type="date"  value=""  inline="true" class="form-control autoinput datepicker" placeholder='Scheduled at'>
                  </div>
                  </div> --}}
                  
                  <div class="birth_info">
                     {{-- <div class="form-group form-group-default">
                        <label class="control-label">Email</label>
                        <input type="email" name="Email" id="project"  value="{{ (isset($user_detail) && $user_detail->bio) ? $user_detail->bio :  old('name') }}" class="form-control" required="">
                     </div> --}}
                     <div class="form-group form-group-default inlineform myCalendar">
                        <label class="control-label">Date of Birth</label>
                        @php
                        $today_date=date("Y-m-d");
                        $date_max = strtotime($today_date.' -18 year');
                        @endphp
                        <div class="col-sm-12 col-lg-6">
                           <div class="ig-input-group ">
                              {{-- <label class="field-label">Date of birth</label> --}}
                              <input type="text"  name="dob"  class="form-control name_attr textbox-n" placeholder="Select Birthdate" error_msg="Date of birth" onfocus="(this.type='date')" max='{{ date("Y-m-d",$date_max) }}' required value="{{ (isset($usermeta_detail) && !empty($usermeta_detail) && $usermeta_detail->dob) ? $usermeta_detail->dob :  old('dob') }}">
                              {{-- <button type="button" tabindex="-1" class="d-none clear-icon"><i class="icon-close"></i></button> --}}
                           </div>
                        </div>

                        {{-- <input type="text" placeholder="Select Birthdate" name="dob" id="datepicker" onfocus="(this.type='date')" max='{{ date("Y-m-d",$date_max) }}' value="{{ (isset($usermeta_detail) && !empty($usermeta_detail) && $usermeta_detail->dob) ? $usermeta_detail->dob :  old('dob') }}" class="form-control autoinput date myCalendar" autocomplete="off" required=""> --}}
                     </div>

                       {{-- <div class="form-group form-group-default">
                        <label class="control-label">Role</label>
                        <input type="text"  placeholder="" name="member_role" id="" value="{{ (isset($user_detail) && !empty($user_detail) && $user_detail->member_role) ? $user_detail->member_role :  old('member_role') }}" class="form-control" required="">
                       </div> --}}

                        <div class="form-group form-group-default">
                           <label class="control-label">Position</label>
                         
                           <select name="member_role" id="typeId" class="form-control" required="">
                               @if(isset($position_result) && !empty($position_result))
                               @foreach ($position_result as $val_role)
                                  <option value="{{$val_role->id}}" {{ (isset($user_detail->member_role) && $user_detail->member_role == $val_role->id ) ? 'selected' : '' }}>{{$val_role->name}}</option>
                              @endforeach
                              @endif
                           </select>
                        </div>

                          <div class="form-group form-group-default">
                           <label class="control-label">Industry</label>
                     
                           <select name="industry" id="typeId" class="form-control" required="">
                               @if(isset($industry_result) && !empty($industry_result))
                               @foreach ($industry_result as $val_type)
                               <option value="{{$val_type->id}}" {{ (isset($user_detail->id) && $user_detail->industry == $val_type->id ) ? 'selected' : '' }}>{{$val_type->name}}</option>
                              @endforeach
                              @endif
                           </select>
                        </div>
                     
                  </div>
                
                  {{-- <p> <a href="payment_details.html" class="btn btn-personal_continue">Continue</a></p> --}}
                  <div class="p-btn-group">
                  <a href="{{route('myaccount')}}" class="btn btn-personal_continue">Back</a href="">
                  <button class="btn btn-personal_continue" type="submit">Save Changes</button>
              
                  @if(isset($id) && !empty($id))
                  <input type="hidden" value="membership-plan" name="redirecturl"/>
                  <a href="{{route('membership-plan',[1])}}" class="btn btn-personal_continue skip-btn" >Skip</a>
                  @else

                  @endif
                  </div>

               </div>
               <!-- main offst col  -->
            </div>
            </form> 
            <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
               <div class="modal-dialog modal-md" role="document">
                  <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="modalLabel">Profile Image</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     <div class="img-container">
                        <div class="row">
                        
                        <div class="col-lg-11">
                           <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                        </div>
                        </div>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                     <button type="button" class="btn btn-primary btn-theme" id="crop">Crop and Save</button>
                  </div>
                  </div>
               </div>
            </div>  
            <!-- mainrow -->
         </div>
         <!-- container -->
      </div>
      <!-- personal detals -->
      <!-- footer -->
@endsection
     