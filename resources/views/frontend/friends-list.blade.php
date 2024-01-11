
@extends('frontend.layouts.frontLayout')
@section('content')
      <!-- header -->
      <!-- main banner -->
      <div class="Search_banner myaction-section">
         <div class="container">
                <div class="col-lg-2 col-sm-4">
                  <div class="accountbox">
                     <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
                     @include('frontend.myaccount.sidebarmenu')
                     <!-- /.navbar-collapse -->
                  </div>
                  <!-- accountbox -->
               </div>
                <div class="col-md-10">
                    <div class="inner_serch-text">
                    <h1>{{$total_user_count}} Members in your network list</h1>
                    {{-- <form id="searchform" name="searchform" class="float-right">
                        <div class="input-group">
                            <input type="text" name="keyword" id='search_btn' value="{{request()->get('keyword','')}}"  class="form-control search-role_member" placeholder="Search Members" aria-describedby="basic-addon2">
                            <button class="input-group-addon" id="basic-addon2" type="submit"><a  class="btn btn-search_banner"><i class="fa-solid fa-magnifying-glass"></i></a></button>
                        </div>
                    </form> --}}
                    </div>
                    <div class="row ten-columns likeprofile-thumbprofile">
                @if(isset($friends_result) && !empty($friends_result))
             
                @foreach($friends_result as $key => $val_user)

                <?php //echo '<pre>';print_r($val_user->user_meta->member_role); exit(); ?>


                <div class="col-sm-3 col-md-3">
                <div class="thumbnail">
                    <div class="thumb-img">
                        <a href="{{route('profile',$val_user->users->username)}}">
                            @if(isset($val_user->users->provider_id) && $val_user->users->provider_id!='' && $val_user->users->social_login!='' && $val_user->users->profile_image!='')
                            <img src="{{ $val_user->users->profile_image }}" alt="..." onerror="this.onerror=null;this.src='{{default_image($val_user->users->profile_image)}}';"/>
                            @else
                            <img src="{{ (isset($val_user->users->profile_image)) ? default_image($val_user->users->profile_image) : default_image()}}" alt="...">
                            @endif
                        </a>
                    </div>
                    <!-- thumb-img -->
                    <div class="caption">

                        <div class="caption-details">
                            <h3 style="height:32px;">{{ (isset($val_user->users->full_name) && $val_user->users->full_name!='') ? ucwords($val_user->users->full_name) :  '' }}</h3>
                
                            @if(isset($position_result) && !empty($position_result))
                            @foreach($position_result as $pval)
                            @if(isset($val_user->users_meta_requestuser->member_role) && !empty($val_user->users_meta_requestuser->member_role ))
                            @if($val_user->users_meta_requestuser->member_role==$pval->id)
                            <p class="member-role">
                            {{$pval->name}}
                            </p>
                            @endif
                            @endif
                            @endforeach
                            @endif
                            
                            <h5 class="main-locate" >
                            @if(isset($val_user->users_meta_requestuser->address) && !empty($val_user->users_meta_requestuser->address))
                            <img src="{{asset('frontend/images/icon-location.png')}}" class="icon-location" alt="" style="margin-right: 5px;">
                            {{ (isset($val_user->users_meta_requestuser->address) && $val_user->users_meta_requestuser->address!='') ? $val_user->users_meta_requestuser->address :  '' }}
                            @endif
                        </h5>
                            <div class="sendRequest-btn">
                                <a href="javascript:void();" style="cursor: default;" class="btn btn-main_locate" role="button"><i class="fa-solid fa-user-group"></i>Friend</a>
                             </div>
                        </div>
                    
                    </div>
                </div>
                <!-- thumbnail-->
                </div>


                @endforeach

                @else
                <div class="row ten-columns">
                    <div class="col-lg-12">
                            <div class="NoUserFound">
                        <h2>No User Found</h2>
                    </div>
                </div>
                </div>
                @endif
               
            </div>
            
       
            <!--div-->
          
            <!--search down-->
         </div>
         <!--container--> 
      </div>
      <!--banner-->
      <!-- search results  -->
      
      <div class="main_member-text search-section">
         <div class="container">
           
            
         
            
            <!-- row -->
            {{-- @if(isset($friends_result) )

            <div>  <a href="javascript:void();" class="btn btn-load_search loading_image loadmore-likeprofile" data-limit="5">Load More Member<i class="fa-solid fa-caret-down"></i></a></div>
            @else

            @endif --}}
            
         <!-- container -->
      </div>
      </div>
      <!-- main_member-text -->
      <!-- search results -->
      <!-- footer -->
@endsection
