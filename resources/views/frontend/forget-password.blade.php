@extends('frontend.layouts.frontLayout')
 @section('content')

<div class="login-section">
	<div class="container">
		<div class="row">
      
			<div class="col-md-6 col-sm-6 col-md-offset-3">
           @include('frontend.includes.validation')
           @include('frontend.includes.flashMessage')

            <div class="login-box">
               <h1>Forgot Password</h1>
                <form action="{{route('forgot-password-form')}}" method="post" > 
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  {{-- <div class="form-group">
                     <label>Username</label>
                     <div class="with-icon icon-left">
                        <input class="form-control custom-input" type="text" placeholder="@annamartina">
                        <i class="input-icon"><img src="{{asset('frontend/images/Profile.png')}}" alt=""></i>
                     </div>
                  </div> --}}
                  <div class="form-group">
                     <label>Email</label>
                     <div class="with-icon icon-left">
                        <input class="form-control custom-input" id="email" type="email" placeholder="annamartina@gmail.com" name="email">
                        <i class="input-icon"><img src="{{asset('frontend/images/Icon-email.png')}}" alt=""></i>
                     </div>
                  </div>
                  
                  <div class="login-btns">
                     <button class="btn btn-signup"  type="submit" data-toggle="modal" data-target="account-verify">Forgot Password</button>
               
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