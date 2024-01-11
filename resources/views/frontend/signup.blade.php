@extends('frontend.layouts.frontLayout')

@section('content')
      <!-- header -->
      <div class="login-section">
         <div class="container">
            <div class="row">
               <div class="col-lg-offset-1 col-lg-10">
                  <div class="row">
                     <div class="col-md-6 col-sm-6">
                        <div class="login-box">
                           <h1>Sign Up</h1>
                           <h4 class="sub-heading">Already have an account? <a href="{{route('login')}}"> Sign in</a></h4>

                             @include('frontend.includes.validation')

                             @include('frontend.includes.flashMessage')

                            <form action="{{route('registration')}}" method="post" id="signupForm">
                               @if(isset($pp) && !empty($pp))
                   
                            <input type="hidden" name="profile_purpose" value="{{ $pp }}">
                               @endif
                           
                              @csrf

                              <div class="form-group">
                                 <label>First Name</label>
                                 <div class="with-icon icon-left">
                                    <input class="form-control custom-input" name="first_name" id="first_name" type="text" placeholder="Enter your First Name" value="{{old('first_name')}}"/>
                                    <i class="input-icon"><img src="{{asset('frontend/images/Profile.png')}}" alt=""></i>
                                
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label>Last Name</label>
                                 <div class="with-icon icon-left">
                                    <input class="form-control custom-input" name="last_name" id="last_name" type="text" placeholder="Enter your Last Name" value="{{old('last_name')}}" />
                                    <i class="input-icon"><img src="{{asset('frontend/images/Profile.png')}}" alt=""></i>
                                  
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label>Email</label>
                                 <div class="with-icon icon-left">
                                    <input class="form-control custom-input" name="email" type="email" id="email" placeholder="Enter your Email" value="{{old('email')}}"/>
                                    <i class="input-icon"><img src="{{asset('frontend/images/Icon-email.png')}}" alt=""></i>
                                  
                                    
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label>Username</label>
                                 <div class="with-icon icon-left">
                                    <input class="form-control custom-input" id="username" name="username" type="text" placeholder="Enter your Username" value="{{old('username')}}" autocomplete="off" />
                                    <i class="input-icon"><img src="{{asset('frontend/images/Profile.png')}}" alt=""></i>
                                    
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label>Password: (Note:Password must be uppercase lowercase and two special character[!,@,#,$,%])</label>
                                 <div class="with-icon icon-left">
                                    <input class="form-control custom-input" name="password" id="password" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Create a Password" value="{{old('password')}}"  autocomplete="off" />
                                    <i class="input-icon"><img src="{{asset('frontend/images/Lock.png')}}" alt=""></i>
                                    <div class="pswrd-hideShow">
                                       <input type="checkbox" onclick="myFunction()" id="ShowPswrd">
                                       <label for="ShowPswrd"></label>
                                    </div>
                                 </div>
                              </div>
                              <div class="checkbox custom-checkbox">
                                 <input type="checkbox" id="tandc" name="tandc" value="1">
                                 
                                 <label for="tandc">By accepting our Terms and Conditions you are going to sign up</label>
                              </div>
                              <div class="clearfix"></div>
                              <div class="login-btns">
                                
                                 <button class="btn btn-signup" type="submit" data-toggle="modal" data-target="#account-verify">Sign Up</button>

                              </div>
                              {{-- <h5 class="login-text">Or Sign Up with Google and Facebook</h5> --}}
                              <div class="social-btns">
                                 {{-- <p>
                                    <a href="" class="btn btn-google"><span class="fa-brands fa-google"></span> Continue with Google</a>
                                 </p>
                                 <p><a href="" class="btn btn-facebook"><span class="fa-brands fa-facebook-f"></span> Continue with Facebook</a></p>
                                 <p><a href="" class="btn btn-linkedin"><span class="fa-brands fa-linkedin-in"></span> Continue with Linkedin</a></p>
                                 <p><a href="" class="btn btn-tiktok"><span class="fa-brands fa-tiktok"></span> Continue with TikTok</a></p> --}}
                                 <p class="login-details">
                                    By logging in you agree to our <a href="">Terms of Service</a> and <a href=""> Privacy Policy </a>
                                 </p>
                              </div>
                              <!-- social-btns -->
                            </form>
                        </div>
                        <!-- login-box-->
                     </div>
                     <!-- col -->
                     <div class="col-md-6 col-sm-6">
                        <div class="login-banner">
                           <img src="{{asset('frontend/images/signup-img.png')}}" alt="">
                        </div>
                     </div>
                  </div>
                  <!-- inner-row -->
               </div>
               <!-- col -->
            </div>
            <!-- main-row -->
         </div>
      </div>
      <!-- login-section -->
      <!-- footer -->
    
@endsection