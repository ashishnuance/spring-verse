<!DOCTYPE html>
<html>

<head>
    <title>{{ isset($pageTitle) ? $pageTitle : 'Spring Verse' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/style.css')}}" />
    <!-- <link rel="stylesheet" type="text/css" href="css/font-awesome.css" /> -->
    <link rel="stylesheet" href="{{asset('frontend/css/font-awesome_v6.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/animate.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/hover.css')}}" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
    .error {
        color: #f00 !important;
    }

    .NoUserFound {
        background: #fff;
        padding: 10px;
        border: 1px dashed;
    }

    .NoUserFound h2 {
        margin-top: 10px;
    }
    </style>
    <style>
    .tooltip {
        position: relative;
        display: inline-block;
    }

    .tooltip .tooltiptext {
        visibility: hidden;
        width: 140px;
        background-color: #555;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 5px;
        position: absolute;
        z-index: 1;
        bottom: 150%;
        left: 50%;
        margin-left: -75px;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .tooltip .tooltiptext::after {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: #555 transparent transparent transparent;
    }

    .tooltip:hover .tooltiptext {
        visibility: visible;
        opacity: 1;
    }
    </style>
</head>

<body>

    <div class="LoaderhideAndShow" style="display: none;">
        <div class="Loader">
            <div class="spinner-square">
                <div class="square-1 square"></div>
                <div class="square-2 square"></div>
                <div class="square-3 square"></div>
            </div>
        </div>
    </div>
    <!-- header -->
    @include('frontend.includes.headerNavigation')
    <!-- header -->
    @yield('content')
    <!-- footer -->
    @include('frontend.includes.footerNavigation')
    <!-- footer -->
    <!-- Modal -->



    <div class="modal fade bs-example-modal-lg signup-modal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-regular fa-xmark"></i>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">How would you like to use the SpringVerse Platform?</h4>
                </div>
                <div class="modal-body signuppage">
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <input type="radio" id="featured-1" class="radiogroup" name="profile_purpose" value="1"
                                checked>
                            <label for="featured-1">
                                <div class="signup_box signup_box1 activeBox">
                                    <img src="{{asset('frontend/images/bg-icon1.png')}}" class="sigupBox_img" alt="">
                                    <img src="{{asset('frontend/images/icon-1.png')}}" alt="">
                                    <h4>Business <span class="block"></span> Use Only </h4>
                                </div>
                            </label>
                        </div>
                        <!-- col -->
                        <div class="col-md-4 col-sm-4">
                            <input type="radio" id="featured-2" class="radiogroup" name="profile_purpose" value="2"
                                {{ (isset($userdata->profile_purpose) && !empty($userdata) && $userdata->profile_purpose == "2") ? 'checked' : '' }}>
                            <label for="featured-2">
                                <div class="signup_box signup_box2">
                                    <img src="{{asset('frontend/images/bg-icon2.png')}}" class="sigupBox_img" alt="">
                                    <img src="{{asset('frontend/images/icon-2.png')}}" alt="">
                                    <h4>Personal <span class="block"></span> Use Only </h4>
                                </div>
                            </label>
                        </div>
                        <!-- col -->
                        <div class="col-md-4 col-sm-4">
                            <input type="radio" id="featured-3" class="radiogroup" name="profile_purpose" value="3"
                                {{ (isset($userdata->profile_purpose) && !empty($userdata) && $userdata->profile_purpose == "3") ? 'checked' : '' }}>
                            <label for="featured-3">
                                <div class="signup_box signup_box3">
                                    <img src="{{asset('frontend/images/bg-icon3.png')}}" class="sigupBox_img" alt="">
                                    <img src="{{asset('frontend/images/icon-3.png')}}" alt="">
                                    <h4>Business + <span class="block"></span> Personal Use Only </h4>
                                </div>
                            </label>
                        </div>
                        <!-- col -->
                    </div>
                    <!-- row -->

                    <p class="text-center">


                        <a href="{{route('signup')}}" id="signup_tag" class="btn btn-continue">Continue</a>

                    </p>
                </div>
                <!-- modal-body -->
            </div>
        </div>
    </div>

    <div id="Recommend" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Recommend</h4>
                </div>
                <div class="modal-body">
                    <form action="{{route('send-recommended-request')}}" method="post">
                        <input type="hidden" name="_token" value="{{csrf_token()}}" />
                        <input type="hidden" name="from_member_id" value="" id="from_member_id" />
                        <div class="form-group">
                            <select class="select2" name="users[]" aria-placeholder="Select Members"
                                style="width: 100%;" multiple required></select>
                        </div>
                        <div class="form-group">
                            <div class="btn-group"
                                style="display: flex; justify-content: center; align-items: center; gap: 30px;">
                                <button type="submit" class="btn btn-main_locate">Submit</button>
                                <button type="button" class="btn btn-main_locate" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> -->
            </div>

        </div>
    </div>
    <!---Meetimg in person-->
    <div id="person-meet" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">In Person</h4>
                </div>
                <div class="modal-body">
                    <form action="{{route('meeting')}}" method="post" id="person-meeting-form">
                        <input type="hidden" name="_token" value="{{csrf_token()}}" />
                        <input type="hidden" name="member_id" value="" id="from_meeting_id" />
                        <input type="hidden" name="user_id" value="" id="" />
                        <input type="hidden" name="profile_id"
                            value="{{(isset($matchprofile_flag) && $matchprofile_flag>0 && $matchprofile_flag!='') ? $matchprofile_flag : ''}}" />
                        <input type="hidden" name="date_time" value="" id="person_meetingdate_date" />




                        <div class="form-group">
                            <h3 class="profile-name"></h3>
                            <h5 class="meeting-datetime"></h5>
                        </div>
                        <div class="form-group">
                            <div class="btn-group"
                                style="display: flex; justify-content: center; align-items: center; gap: 30px;">
                                <button type="submit" class="btn btn-main_locate">Submit</button>
                                <button type="button" class="btn btn-main_locate" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> -->
            </div>

        </div>
    </div>

    <!-- create group -->
    <div id="addmembers_group" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Members</h4>
                </div>
                <div class="modal-body">
                    <form action="{{route('create-group')}}" method="post" id="add_grp_member">
                        <input type="hidden" name="_token" value="{{csrf_token()}}" />
                        <input type="hidden" name="group_id" value="" />



                        {{-- <div class="form-group">
               <input type="text" required name="group_name" class="form-control" placeholder="Group Name" />
             </div> --}}
                        <div class="form-group">
                            <select class="select3" name="users[]" aria-placeholder="Select Members"
                                style="width: 100%;" multiple required></select>
                        </div>
                        <div class="form-group">
                            <div class="btn-group"
                                style="display: flex; justify-content: center; align-items: center; gap: 30px;">
                                <button type="submit" class="btn btn-main_locate">Submit</button>
                                <button type="button" class="btn btn-main_locate" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div> -->
            </div>
        </div>
    </div>
    <!-- create group end -->

    <div id="LogoutModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <div class="InnerContentLogout">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <div class="text-center textStyle">
                            <h3>Are you leaving? </h2>
                                <p>Are you sure you want to logout</p>
                        </div>

                        <div class="Btns">
                            <a href="javascript:void();" class="btn btn-default" data-dismiss="modal"
                                aria-label="Close">Cancel</a>
                            <a href="{{route('logout')}}" class="btn btn-primary btn-theme">Logout</a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- Sign up Modal -->
    <script type="text/javascript" src="{{asset('frontend/js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/js/index.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/js/wow.js')}}"></script>
    <script src="{{asset('frontend/js/calendar.js')}}"></script>


    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    <!-- jQuery -->

    <!-- tags hobbies -->
    <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.4.2/bootstrap-tagsinput.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.4.2/bootstrap-tagsinput.css" />
    <!-- tags hobbies end -->
    <!--- validation library-->
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <!-- image crop -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
    <!-- image crop end -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.full.min.js"></script> --}}
    {{-- 
   <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script> --}}

    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <!-- sweet alert  -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>
    {{-- <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css" rel="stylesheet"/> --}}

    @include('frontend.includes.script')
    <script>
    function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
    </script>
</body>

</html>