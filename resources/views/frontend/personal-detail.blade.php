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
                      
                  <form action="{{route('personal-detail-update')}}" method="post"> 
                     <input type="hidden" name="_token" value="{{csrf_token()}}">
                     <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                     @include('frontend.includes.flashMessage')

                        <h2>Personal Details</h2>
                        <h3>Your Home Location</h3>
                        <h5>Choose your home location</h5>
                        <div class="input-inside">
                           <div class="form-group form-group-default">
                              <label class="control-label">Home Location</label>
                              <input type="text"  name="home_location" id="project"  value="{{ (isset($user_detail) && !empty($user_detail) && $user_detail->home_location) ? $user_detail->home_location :  old('home_location') }}" class="form-control" required="">
                           </div>
                        </div>
                     
                        <div class="contact_details">
                           <h5>Your Contact Details</h5>
                           <div class="form-group form-group-default">
                              <label class="control-label">Address</label>
                              <input type="text" name="address" id="project"  value="{{ (isset($user_detail) && !empty($user_detail) && $user_detail->address) ? $user_detail->address :  old('address') }}" class="form-control" required="">
                           </div>
                           <div class="form-group form-group-default">
                              <label class="control-label">Country</label>
                              <input type="text"  name="country" id="project"  value="{{ (isset($user_detail) && !empty($user_detail) && $user_detail->country) ? $user_detail->country :  old('country') }}" class="form-control" required="">
                           </div>
                           <div class="row">
                              <div class="col-sm-4 col-md-4">
                                 <div class="form-group form-group-default">
                                    <label class="control-label">Town / City</label>
                                    <input type="text"  name="city" id="project"  value="{{ (isset($user_detail) && !empty($user_detail) && $user_detail->city) ? $user_detail->city :  old('city') }}" class="form-control" required="">
                                 </div>
                              </div>
                              <div class="col-sm-4 col-md-4">
                                 <div class="form-group form-group-default">
                                    <label class="control-label">State / Province</label>
                                    <input type="text" name="state" id="project"  value="{{ (isset($user_detail) && !empty($user_detail) && $user_detail->state) ? $user_detail->state :  old('state') }}" class="form-control" required="">
                                 </div>
                              </div>
                              <div class="col-sm-4 col-md-4">
                                 <form action="" class="needs-validation">
                                 <div class="form-group form-group-default">
                                    <label class="control-label">Zip / Postcode</label>
                                    <input type="text"  name="postal_code" id="project"  value="{{ (isset($user_detail) && !empty($user_detail) && $user_detail->postal_code) ? $user_detail->postal_code :  old('postal_code') }}" class="form-control" required="">
                                 </div>
                              </div>
                           </div>
                           <div class="form-group form-group-default">
                              <label class="control-label">Company Website</label>
                              <input type="text"  name="website" id="project"  value="{{ (isset($user_detail) && !empty($user_detail) && $user_detail->website) ? $user_detail->website :  old('website') }}" class="form-control" required="">
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
     