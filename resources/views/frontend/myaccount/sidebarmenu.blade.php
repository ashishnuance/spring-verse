<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
      <li>
        <a href="#" data-toggle="collapse" data-target="#submenu-1"> Your Account <i class="fa fa-fw fa-angle-down pull-right"></i>
        </a>
        <ul id="submenu-1" class="collapse in">
          <li class="YourPhoto">
            <div class="uplodPhoto-box">
            <input type="file" name="image" class="image" id="changeProfile" accept="image/*" />
            <label for="changeProfile">Your Photo</label>
        </div>
            <!-- <a href="javascript:;">Your Photo</a> -->
          </li>
          <li>
            <a href="{{route('personal-detail')}}">Personal Details</a>
          </li>
          <li>
            {{-- <a href="{{route('payment_details',[1])}}">Billing Details</a> --}}
          </li>
          <li>
            <a href="{{route('professional-detail')}}">Professional Details</a>
          </li>
          <li>
            <a href="#social-net" >Social Networks</a>
          </li>
          <li>
            <a href="{{route('password-update')}}">Password</a>
          </li>
          <li>
            <a href="{{route('notifications')}}">Notifications</a>
          </li>
          <li>
            <a href="{{route('requestlist')}}">Request List</a>
          </li>
          <li>
            <a href="{{route('meetinglist')}}">Meeting List</a>
          </li>
          <li>
            <a href="{{route('likeprofile')}}">Favorites</a>
          </li>
      
          {{-- <li>
            <a href="JavaScript:void(0);" data-toggle="modal" class="create_group" data-target="#create_group">Create Group</a>
          </li> --}}
          <li>
            <a href="{{route('group-list')}}">Groups</a>
          </li>
        </ul>
      </li>
      <!-- <li><a href="#" data-toggle="collapse" data-target="#submenu-2"> Plans and Benefits <i class="fa fa-fw fa-angle-down pull-right"></i></a><ul id="submenu-2" class="collapse"><li><a href="javascript:;">Social Networks</a></li><li><a href="javascript:;">Passwords</a></li><li><a href="javascript:;">Notifications</a></li></ul></li> -->
      <li>
        <a href="{{route('membership-plan')}}">Plans and Benefits</a>
      </li>
      <li>
        <a href="{{route('billing')}}">Billing</a>
      </li>
      <li>
        <a href="javascript:void(0)">Your Bookings</a>
      </li>
      <li>
        <a href="{{route('full-calendar')}}">Your Events</a>
      </li>
      {{--<li>
        <a href="javascript:void(0)">Deliveris</a>
      </li>--}}
      <li>
        <a href="{{route('visitors')}}">Visitors</a>
      </li>
      <li>
        <!-- <a href="{{route('logout')}}" id="LogoutModal">Logout</a> -->
        <a href="javascript:;" data-toggle="modal" data-target="#LogoutModal">Logout</a>
      </li>
    </ul>
  </div>