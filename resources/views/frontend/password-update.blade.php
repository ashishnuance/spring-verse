@extends('frontend.layouts.frontLayout')
 @section('content')

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
               <form action="{{route('change-password')}}" method="post" id="passwordForm"> 
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <div class="col-lg-6">
                   @include('frontend.includes.validation')

                   @include('frontend.includes.flashMessage')
                     <h2>Password Update</h2>
                      <div class="input-inside">
                        <div class="form-group form-group-default">
                        <label class="control-label">Old Password</label>
                        <input type="password" name="old_password" id="old_password" class="form-control">
                     </div>

                     <div class="input-inside">
                        <div class="form-group form-group-default">
                        <label class="control-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                     </div>

                     <div class="form-group form-group-default">
                        <label class="control-label">Confirm Password</label>
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control">
                     </div>
                     </div>
                  
                  <div class="p-btn-group">
                     <a href="{{route('myaccount')}}" class="btn btn-personal_continue">Back</a>
                     <button  type="submit" class="btn btn-personal_continue">Update Password</button>
                  </div>
                     
                  </div>
               </div>
               </form>
               <!-- main offst col  -->
            </div>
            <!-- mainrow -->
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
         </div>
         <!-- container -->
      </div>
      <!-- personal detals -->

 @endsection