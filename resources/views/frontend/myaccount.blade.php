@extends('frontend.layouts.frontLayout')
 @section('content')
<!-- header -->
<div class="myaction-section">
  <div class="container">
    <h1 class="account-title">My Account</h1>
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

      
      <form action="{{route('myaccount-update')}}" method="post"> 
        @csrf 
        <div class="col-lg-7 col-sm-8">
          @include('frontend.includes.flashMessage')
          <h3>Your Profile Page</h3>
          <div class="account-smbox">
            <span class="flex-space">
            <span class="flex-d">
              <img src="{{asset('frontend/images/icon-id.png')}}" alt="" > Member ID </span>
            <span class="id-number">{{ (isset($mydetail) && $mydetail->member_id) ? $mydetail->member_id : '' }}</span>
          </span>
            {{-- <input type="number" class="form-control id-number" id="" placeholder="Account Code" name="member_id" value="" readonly required> --}}
          </div>
          <div class="account-smbox">
            <span class="flex-space">
            <span class="flex-d">
              <img src="{{asset('frontend/images/icon-id.png')}}" alt="" > Username </span>
            <span class="id-number">{{ (isset($mydetail->username) && $mydetail->username) ? $mydetail->username : '' }}</span>
          </span>
            {{-- <input type="number" class="form-control id-number" id="" placeholder="Account Code" name="member_id" value="" readonly required> --}}
          </div>
          <!-- account-smbox -->
          <div class="account-bio">
            <span class="flex-space">
            <span class="flex-d">
              <img src="{{asset('frontend/images/icon-user2.png')}}" alt=""> Bio </span>
            <a href="javascript:;" class="editPencil_social" onclick="edit_profile(this,'bio')">
              <i class="fa fa-pencil" aria-hidden="true" style="padding: 5px;color: #7B408F;"></i>
            </a>
          </span>
            <h4 class="bio">{{(isset($mydetail) && $mydetail->bio) ? $mydetail->bio : ''}}</h4>
            <textarea class="form-control icontypeclick" name="bio" id="commentBox" style="display:none;">{{ (isset($mydetail) && $mydetail->bio) ? $mydetail->bio : '' }}</textarea>
          </div>
          <!-- account-bio -->
          <div class="detail-box">
            <span class="flex-space">
              <span class="flex-d">
              <img src="{{asset('frontend/images/icon-hobbies.png')}}" alt="" name="hobbies"> Interests  </span>
              <a href="javascript:;" class="editPencil_social" onclick="edit_profile(this,'hobbies')">
                <i class="fa fa-pencil" aria-hidden="true" style="padding: 5px;color: #7B408F;"></i>
              </a>
            </span>
            <div style="display:none;" class="hobbies">
              <input id="hobbies" class="form-control" name="hobbies" value="{{ (isset($mydetail) && $mydetail->hobbies) ? $mydetail->hobbies : '' }}" data-role="tagsinput" type="text">
            </div>
            <div class="hobbies-btn">
              @if(!empty($myhobbies))
              @for($h=0;$h< count($myhobbies);$h++)
              <a href="javascript:;" class="btn">{{$myhobbies[$h]}}</a>
              @endfor
              @endif 
            </div>
          </div>
          @if(!empty($profile_type_result))
          <h3>Profile Type</h3>
          <div class="custom_radio">
            @foreach($profile_type_result as $pk => $ptype_val)
            <input type="radio" id="featured-{{$pk}}" name="profile_type" value="{{$ptype_val->id}}" {{ (isset($mydetail->profile_type) && $mydetail->profile_type==$ptype_val->id) ? 'checked' : (($pk==0) ? 'checked': '') }}>
            <label for="featured-{{$pk}}">{{$ptype_val->name}}</label>
            @endforeach
            {{-- <input type="radio" id="featured-2">
            <label for="featured-2">Custom Radio Button 2</label>
            <input type="radio" id="featured-3">
            <label for="featured-3">Custom Radio Button 3</label> --}}
          </div>
          @endif
          <br />

          <div id="social-net">
        
          <h3>Social Links</h3>
          <div class="social-box">
              <span>
                <img src="{{asset('frontend/images/icon-fb.png')}}" alt=""> Facebook 
              </span>
              <span class="RightInerrt">
            <h4 class="facebook">{{(isset($mydetail) && $mydetail->facebook) ? $mydetail->facebook : ''}}</h4>
            <input type="url" id="facebook" class="form-control validate icontypeclick SocialInput" name="facebook" style="display:none;" value="{{(isset($mydetail) && $mydetail->facebook) ? $mydetail->facebook : ''}}">
            <span class="SpaceIcons">
              <a href="javascript:;" class="editPencil_social"  type="url" onclick="edit_profile(this,'facebook')">
                <i class="fa fa-pencil" aria-hidden="true" style="padding: 5px;color: #7B408F;"></i>
              </a>
              <a href="{{(isset($mydetail) && $mydetail->facebook) ? $mydetail->facebook : 'javascript:;'}}" target="_blank">
              @if(isset($mydetail) && $mydetail->facebook!='')
                <img src="{{asset('frontend/images/icon-copy2.png')}}" alt="">
              @endif
              </a>
            </span>
            
            </span>
            
          </div>
          <!-- social-box -->
          <div class="social-box">
            <span>
              <img src="{{asset('frontend/images/icon-twitter.png')}}" alt=""> Twitter 

            </span>

            <span class="RightInerrt">
            <h4 class="twitter">{{ (isset($mydetail) && $mydetail->twitter) ? $mydetail->twitter : '' }} </h4>
            <input type="url" id="twitter" class="form-control validate icontypeclick SocialInput" name="twitter" style="display:none;" value="{{(isset($mydetail) && $mydetail->twitter) ? $mydetail->twitter : '' }}">

            <span class="SpaceIcons">
              <a href="javascript:;" class="editPencil_social" type="url" onclick="edit_profile(this,'twitter')">
                <i class="fa fa-pencil" aria-hidden="true" style="padding: 5px;color: #7B408F;"></i>
              </a>
              <a href="{{ (isset($mydetail) && $mydetail->twitter) ? $mydetail->twitter : 'javascript:;' }}" target="_blank">
                @if(isset($mydetail) && $mydetail->twitter!='')
                <img src="{{asset('frontend/images/icon-copy2.png')}}" alt="">
                @endif
            </a>
          </span>
          </span>
            
          </div>
          <!-- social-box -->
          <div class="social-box">
            <span>
              <img src="{{asset('frontend/images/icon-ln.png')}}" alt=""> Linkedin 

            </span>

            <span class="RightInerrt">
            <h4 class="linkedin">{{ (isset($mydetail) && $mydetail->linkedin) ? $mydetail->linkedin : '' }} </h4>
            <input type="url" id="linkedin" class="form-control validate icontypeclick SocialInput" name="linkedin" style="display:none;" value="{{ (isset($mydetail) && $mydetail->linkedin) ? $mydetail->linkedin : '' }}">
            <span class="SpaceIcons">
              <a href="javascript:;" class="editPencil_social" type="url" onclick="edit_profile(this,'linkedin')">
                <i class="fa fa-pencil" aria-hidden="true" style="padding: 5px;color: #7B408F;"></i>
              </a>
              <a href="{{ (isset($mydetail) && $mydetail->linkedin) ? $mydetail->linkedin : 'javascript:;' }}" target="_blank">
                @if(isset($mydetail) && $mydetail->linkedin!='')
                  <img src="{{asset('frontend/images/icon-copy2.png')}}" alt="">
                @endif
            
            </a>
          </span>
        </span>
            
          </div>
          <!-- social-box -->
          <div class="social-box">
            <span>
              <img src="{{asset('frontend/images/icon-snapchat.png')}}" alt=""> Snapchat 

            </span>
            <span class="RightInerrt">
            <h4 class="snapchat">{{ (isset($mydetail) && $mydetail->snapchat) ? $mydetail->snapchat : '' }} </h4>
              <input type="url" id="snapchat" class="form-control validate icontypeclick SocialInput" name="snapchat" style="display:none;" value="{{ (isset($mydetail) && $mydetail->snapchat) ? $mydetail->snapchat : '' }}">

              <span class="SpaceIcons">
              <a href="javascript:;" class="editPencil_social"  type="url" onclick="edit_profile(this,'snapchat')">
                <i class="fa fa-pencil" aria-hidden="true" style="padding: 5px;color: #7B408F;"></i>
              </a>

              <a href="{{ (isset($mydetail) && $mydetail->snapchat) ? $mydetail->snapchat : 'javascript:;' }}" target="_blank">
                @if(isset($mydetail) && $mydetail->snapchat!='')
                  <img src="{{asset('frontend/images/icon-copy2.png')}}" alt="">
                @endif
            
              </a>
              </span>
           </span>
           
          </div>

            <!-- social-box -->
            <div class="social-box">
            <span>
              <img src="{{asset('frontend/images/icon-instagram.png')}}" alt=""> Instagram 

            </span>
            <span class="RightInerrt">
            <h4 class="instagram">{{ (isset($mydetail) && $mydetail->instagram) ? $mydetail->instagram : '' }} </h4>
              <input type="url" id="instagram" class="form-control validate icontypeclick SocialInput" name="instagram" style="display:none;" value="{{ (isset($mydetail) && $mydetail->instagram) ? $mydetail->instagram : '' }}">

              <span class="SpaceIcons">
              <a href="javascript:;" class="editPencil_social"  type="url" onclick="edit_profile(this,'instagram')">
                <i class="fa fa-pencil" aria-hidden="true" style="padding: 5px;color: #7B408F;"></i>
              </a>

              <a href="{{ (isset($mydetail) && $mydetail->instagram) ? $mydetail->instagram : 'javascript:;' }}" target="_blank">
                @if(isset($mydetail) && $mydetail->instagram!='')
                  <img src="{{asset('frontend/images/icon-copy2.png')}}" alt="">
                @endif
            
              </a>
              </span>
           </span>
           
          </div>
            
          </div>
          <!-- social-box -->
          <div class="account-btns">
            <button class="btn btn-save" type="submit">Save Changes</button>
            {{-- <a href="" class="btn btn-save">Save Changes</a> --}}
            {{-- <a href="" class="btn btn-cancel">Cancel</a> --}}
          </div>
        </div>
      </form>
      <!-- col -->
      
      <div class="col-lg-3 col-sm-12">
        <div class="change-photo profileimage">
        <label for="changeProfile" class="cursorpointer">
          @if(isset(auth()->user()->provider_id) && auth()->user()->provider_id!='' && auth()->user()->social_login!='' && auth()->user()->profile_image!='')
                  
          <img src="{{ auth()->user()->profile_image }}" class="user-img" onerror="this.onerror=null;this.src='{{profile_image()}}';" />

          @elseif(profile_image()!='')
          <img src="{{ profile_image() }}" class="user-img" />
          @else
          My Account
          @endif
        </label>
          
          <div class="uplodPhoto-box">
            <input type="file" name="image" class="image" id="changeProfile" accept="image/*">
            <label for="changeProfile">Change Profile Photo</label>
          </p>
        </div>
        <!-- change-photo -->
      </div>
    </div>
    <!-- row -->
  </div>
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
</div>
<!-- myaction-section -->
<!--footer--> 
@endsection