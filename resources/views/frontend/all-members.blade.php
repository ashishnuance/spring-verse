
@extends('frontend.layouts.frontLayout')
@section('content')
      <!-- header -->
      <!-- main banner -->
      <div class="Search_banner">
         <div class="container">
            <div class="inner_serch-text">
               <h1>{{$total_user_count}} Members  in your connection list</h1>
               <form id="searchform" name="searchform" class="float-right">
                  <div class="input-group">
                     <input type="text" name="keyword" id='search_btn' value="{{request()->get('keyword','')}}"  class="form-control search-role_member" placeholder="Search Members" aria-describedby="basic-addon2">
                     <button class="input-group-addon" id="basic-addon2" type="submit"><a  class="btn btn-search_banner"><i class="fa-solid fa-magnifying-glass"></i></a></button>
                  </div>
               </form>
            </div>
            <!--div-->
            <div class="search_down">
               <div class="dropdown">
                  <button class="btn btn-default dropdown-toggle down_active dropbtn" type="button" id="dropdownMenu1" data-toggle="dropdown"  aria-haspopup="true" aria-expanded="true" onclick="myFunction_dropdown()">
                  Industry
                  <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu industry-list" id="myDropdown" aria-labelledby="dropdownMenu1">
                        <input type="text" placeholder="Search.." class="form-control" id="myInput" onkeyup="filterFunction()">
                        @if(isset($industry_result) && !empty($industry_result))
                        @foreach ($industry_result as $val_role)
                        <li data-text="{{str_replace(' ','-',strtolower($val_role->name))}}" data-id="{{$val_role->id}}"><a href="javascript:void();">{{$val_role->name}}</a></li>
                        @endforeach
                        @endif
                  </ul>
               </div>
               <!--1st-->
               <div class="dropdown">
                  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                  Position
                  <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu position-list" aria-labelledby="dropdownMenu1">

                      @if(isset($position_result) && !empty($position_result))
                     @foreach ($position_result as $val_role)
                     <li data-text="{{str_replace(' ','-',strtolower($val_role->name))}}" data-id="{{$val_role->id}}"><a href="javascript:void();">{{$val_role->name}}</a></li>
                     @endforeach
                     @endif
                   
                     {{-- <li role="separator" class="divider"></li>
                     <li><a href="#">Separated link</a></li> --}}
                  </ul>
               </div>
               <!--2nd-->
               <div class="dropdown">
                  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                  Location
                  <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="padding: 5px;">
                     <li>
                        <form class="float-right" onsubmit="return profilelocationsearch(this)">
                           <input type="text" name="location" placeholder="Location" class="form-control">
                        </form>
                     </li>
                  </ul>
               </div>
               <!--3rd-->
               <div class="dropdown">
                  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                  Interest
                  <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu hobbies-list" aria-labelledby="dropdownMenu1" style="padding: 5px;">
                     {{-- <li>
                        <form class="float-right" onsubmit="return profileinterestsearch(this)">
                           <input type="text" name="interest" placeholder="Interest" class="form-control">
                        </form>
                     </li>--}}
                     @if(isset($my_hobbies) && !empty($my_hobbies))
                     @foreach ($my_hobbies as $key=> $val_hobby)
                   
                     <li data-text="{{$val_hobby}}" data-id="{{$key}}"><a href="javascript:void();"> {{ucfirst($val_hobby)}}</a></li>
                     @endforeach
                     @endif

                  </ul>
               </div>
               <!--3rd-->
            </div>
            <!--search down-->
         </div>
         <!--container--> 
      </div>
      <!--banner-->
      <!-- search results  -->
      <div class="main_member-text search-section">
         <div class="container">
            <div class="innner_heading-search">
               <h2>Business</h2>
            </div>
            <div class="row ten-columns business-thumbprofile">
              @include('frontend.includes.members-list')
               
               
            </div>
            
         
            
            <!-- row -->
            @if(isset($business_total_count) && $business_total_count > 5 )

            <div>  <a href="javascript:void();" class="btn btn-load_search loading_image loadmore-businessprofile" data-limit="5">Load More Member<i class="fa-solid fa-caret-down"></i></a></div>
            @else

            @endif
            <div class="innner_heading-search">
               <h2>Personal</h2>
            </div>
            <div class="row ten-columns personal-thumbprofile">

              @include('frontend.includes.personal-member-list')
           
           
               <!--col-->
               
            </div>
           
            <!-- row -->
            <!-- end -->
            @if(isset($pesonal_total_count) && $pesonal_total_count > 5 )
            <div>  <a href="javascript:void();" class="btn btn-load_search loading_image loadmore-personalprofile" data-limit="5">Load More Member<i class="fa-solid fa-caret-down"></i></a></div>
            
            @endif
         </div>
         <!-- container -->
      </div>
      <!-- main_member-text -->
      <!-- search results -->
      <!-- footer -->
@endsection
