@extends('frontend.layouts.frontLayout')
 @section('content')

<div class="login-section">
	<div class="container">
		<div class="row">
      
			<div class="col-md-6 col-sm-6 col-md-offset-3">
           @include('frontend.includes.validation')
           @include('frontend.includes.flashMessage')

            <div class="login-box">
               <h1>Create new Password</h1>
                <form action="{{route('create-password')}}" method="post" id="passwordForm"> 
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="remember_token" value="{{$token}}">

                    <div class="form-group">

                        <label>Password</label>

                        <div class="with-icon icon-left">

                        <input class="form-control custom-input" name="password" type="password" placeholder="Enter Password" />

                        <i class="input-icon"><img src="{{asset('frontend/images/Lock.png')}}" alt=""></i>

                        </div>

                    </div>

                   <div class="form-group">

                        <label>Confirm Password</label>

                        <div class="with-icon icon-left">

                        <input class="form-control custom-input" name="confirm_password" type="password" placeholder="Confirm Password" />

                        <i class="input-icon"><img src="{{asset('frontend/images/Lock.png')}}" alt=""></i>

                        </div>

                    </div>

                  
                  <div class="login-btns">
                     <button class="btn btn-signup"  type="submit" data-toggle="modal" data-target="account-verify">Reset Password</button>
               
                  </div>
                  <!-- social-btns -->
               </form>
            </div>
            <!-- login-box-->
         </div>
		</div>
	</div>
</div>
  @endsection