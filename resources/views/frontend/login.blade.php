{{-- layout extend --}}

@extends('frontend.layouts.frontLayout')



@section('content')

      <!-- header -->

      <div class="login-section">

         <div class="container">

            <div class="row">

               <div class="col-lg-offset-1 col-lg-10">

                  <div class="row">

                     <div class="col-md-6 col-sm-6">

                        <div class="login-banner">

                           <img src="{{asset('frontend/images/SV-v1-500×750px.gif')}}" alt="">

                        </div>

                     </div>

                     <div class="col-md-6 col-sm-6 col-lg-offset-1 col-lg-5">

                        <div class="login-box">

                           <h1>LOGIN</h1>

                           <!-- <h4 class="sub-heading">How do I get started SpringVerse</h4> -->

                           @include('frontend.includes.validation')

                           @include('frontend.includes.flashMessage')

                           <form action="{{route('member-login')}}" method="post">

                              @csrf

                              <div class="form-group">

                                 <label>Username</label>

                                 <div class="with-icon icon-left">

                                    <input class="form-control custom-input" type="text" name="username" placeholder="Username" />

                                    <i class="input-icon"><img src="{{asset('frontend/images/Profile.png')}}" alt=""></i>

                                 </div>

                              </div>

                              <div class="form-group">

                                 <label>Password:</label>

                                 <div class="with-icon icon-left">
                                    <input class="form-control custom-input" name="password" type="password" id="password" placeholder="Password" />
                                    <i class="input-icon"><img src="{{asset('frontend/images/Lock.png')}}" alt=""></i>
                                    <div class="pswrd-hideShow">
                                       <input type="checkbox" onclick="myFunction()" id="ShowPswrd">
                                       <label for="ShowPswrd"></label>
                                    </div>
                                 </div>
                              </div>

                              <div class="checkbox custom-checkbox">

                                 <input type="checkbox" id="remember" name="remember_me" value="Apple">

                                 <label for="remember">Remember me?</label>

                                 <span class="pull-right"><a href="{{route('forgot-password')}}" class="forgot-pass">Forgot Password?</a></span>

                              </div>

                              <div class="clearfix"></div>

                              <div class="login-btns">

                                 <button class="btn btn-signin" type="submit">Sign In</button>

                              </div>

                              <div class="">
                                 <a class="btn btn-signup" href="" data-toggle="modal" data-target=".bs-example-modal-lg">Sign Up</a>
                              </div>

                              <h5 class="login-text">Or Login with Google and Facebook</h5>

                              <div class="social-btns">

                                  <p>
                                    <a href="{{route('login.linkedin')}}" class="btn btn-linkedin"><span class="fa-brands fa-linkedin-in"></span>

                                    Continue with Linkedin</a>

                                 </p>

                                 <p>
                                    {{-- <a href="{{route('login.google')}}" class="btn btn-danger btn-block">Login with Google</a> --}}
                                    <a href="{{route('login.google')}}" class="btn btn-google"><span class="fa-brands fa-google"></span> Continue

                                    with Google</a>

                                 </p>

                                 <p>
                                    {{-- <a href="{{route('login.facebook')}}" class="btn btn-primary btn-block">Login with Facebook</a> --}}
                                    <a href="{{route('login.facebook')}}" class="btn btn-facebook"><span class="fa-brands fa-facebook-f"></span>

                                    Continue with Facebook</a>

                                 </p>

                              

                                 <p><a href="" class="btn btn-tiktok"><span class="fa-brands fa-tiktok"></span> Continue

                                    with TikTok</a>

                                 </p>

                                 <p class="login-details">

                                    By logging in you agree to our <a href="">Terms of Service</a> and <a href=""> Privacy

                                    Policy </a>

                                 </p>

                              </div>

                              <!-- social-btns -->

                           </form>

                        <!-- login-box-->

                     </div>

                     <!-- col -->

                  </div>

                  <!-- inner-row -->

               </div>

               <!-- col -->

            </div>

            <!-- main-row -->

         </div>

      </div>

      <!-- login-section -->
   </div>

@endsection