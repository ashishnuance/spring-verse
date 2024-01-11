@extends('frontend.layouts.frontLayout')
@section('content')
<!-- header -->
<!-- main banner -->
<div class="Search_banner">
    <div class="container">
        <div class="inner_serch-text">
            <h1>{{$total_user_count}} Members in your connection list</h1>
            <form id="searchform" name="searchform" class="float-right">
                <div class="input-group">
                    <input type="text" name="keyword" id='search_btn' value="{{request()->get('keyword','')}}"
                        class="form-control search-role_member" placeholder="Search Members"
                        aria-describedby="basic-addon2">
                    <button class="input-group-addon" id="basic-addon2" type="submit"><a
                            class="btn btn-search_banner"><i class="fa-solid fa-magnifying-glass"></i></a></button>
                </div>
            </form>
        </div>
        <!--div-->

        <!--search down-->
    </div>
    <!--container-->
</div>
<!--banner-->
<!-- search results  -->
<div class="main_member-text search-section myaction-section">
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

            <div class="col-lg-10">
                <div class="row ten-columns likeprofile-thumbprofile">
                    @include('frontend.includes.fav-profile')
                </div>
            </div>
        </div>

        <!-- row -->
        @if(isset($business_total_count) && $business_total_count > 5 )

        <div> <a href="javascript:void();" class="btn btn-load_search loading_image loadmore-likeprofile"
                data-limit="5">Load More Member<i class="fa-solid fa-caret-down"></i></a></div>
        @else

        @endif

        <!-- container -->
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
<!-- main_member-text -->
<!-- search results -->
<!-- footer -->
@endsection