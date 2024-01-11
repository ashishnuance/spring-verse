<nav class="navbar navbar-default custom-nav">

  <div class="container wow fadeInDown">

     <!-- Brand and toggle get grouped for better mobile display -->

     <div class="navbar-header">

       @if (Request::segment(1) !== 'login' && Request::segment(1) !== 'signup')
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"

           data-target="#bs-example-navbar-collapse-1" aria-expanded="false">

        <span class="sr-only">Toggle navigation</span>

        <span class="icon-bar top-bar"></span>

        <span class="icon-bar middle-bar"></span>

        <span class="icon-bar bottom-bar"></span>

        </button>

        @endif

        <a href="{{route('home')}}" class="navbar-brand">

           <img src="{{asset('frontend/images/SV-03.png')}}" class="logo" style="position: relative; left: -20px;"/>
           <p class="logo-tagline"> A Global Creative Community</p>

           {{-- Spring<span>Verse</span> --}}

        </a>

     </div>

     <!-- Collect the nav links, forms, and other content for toggling -->

     @if (Request::segment(1) !== 'login' && Request::segment(1) !== 'signup')
     <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
       @if(Auth::check())

        <ul class="nav navbar-nav navbar-right">

           <li><a href="{{route('home')}}">Home</a></li>

           <li><a href="{{route('all-members')}}">Explore</a></li>

           <li class="logged-in-message"><a href="{{route('messages')}}">Messages @if(Auth::check())<span class="message-count">0 @endif</a></li>

           <li><a href="{{route('notifications')}}">Notifications @if(Auth::check())<span class="noti-count">{{unread_notification()}}@endif</span></a></li>

           <li><a href="{{asset('frontend/PDF/SPRING-NYC-STUDIOS-OVERVIEW-OCT 2022-compressed.pdf')}}" target="_blank">Events</a></li>


           <li><a href="JavaScript:void(0);">Talent</a></li>
           <li><a href="{{route('match-making-profile')}}">Match Profile</a></li>

            <li>
              
               <a href="{{route('myaccount')}}" class="img-dropdown profileimage">
                  @if(isset(auth()->user()->provider_id) && auth()->user()->provider_id!='' && auth()->user()->social_login!='' && auth()->user()->profile_image!='')
                  
                  
                  <img src="{{ auth()->user()->profile_image }}" class="user-img"  onerror="this.onerror=null;this.src='{{profile_image()}}';" />

                  @elseif(profile_image()!='')
                  <img src="{{ profile_image() }}" class="user-img" />
                  @else
                  My Account
                  @endif
               </a>
            </li>
         {{-- @if(Auth::check())
           <li><a href="{{route('logout')}}">Logout</a></li>
         @endif --}}

        </ul>

      @else

        <ul class="nav navbar-nav navbar-right">

           <li><a href="JavaScript:void(0);">Home</a></li>

           <li><a href="JavaScript:void(0);">Explore</a></li>

           <li class="logged-in-message"><a href="JavaScript:void(0);">Messages</a></li>

           <li><a href="JavaScript:void(0);">Notifications @if(Auth::check())<span class="noti-count">{{unread_notification()}}@endif</span></a></li>

           <li><a href="{{asset('frontend/PDF/SPRING-NYC-STUDIOS-OVERVIEW-OCT 2022-compressed.pdf')}}" target="_blank">Events</a></li>


           <li><a href="JavaScript:void(0);">Talent</a></li>

            <li>
              
               <a href="{{route('myaccount')}}" class="img-dropdown profileimage">
                  @if(isset(auth()->user()->provider_id) && auth()->user()->provider_id!='' && auth()->user()->social_login!='' && auth()->user()->profile_image!='')
                  
                  
                  <img src="{{ auth()->user()->profile_image }}" class="user-img"  onerror="this.onerror=null;this.src='{{profile_image()}}';" />

                  @elseif(profile_image()!='')
                  <img src="{{ profile_image() }}" class="user-img" />
                  @else
                  My Account
                  @endif
               </a>
            </li>
         {{-- @if(Auth::check())
           <li><a href="{{route('logout')}}">Logout</a></li>
         @endif --}}

        </ul>

      @endif
      
   </div>
   @endif

     <!-- /.navbar-collapse -->

  </div>

  <!-- /.container-fluid -->

</nav>