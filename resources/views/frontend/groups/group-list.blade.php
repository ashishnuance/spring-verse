@extends('frontend.layouts.frontLayout')
@section('content')

<!-- header -->
<!--  group-section -->
<div class="group-section myaction-section">
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
         
            <div class="col-md-9">
                  <div class="group-heading">
                     <h1>Groups</h1>
                     <div>
                        <a href="{{route('group-add')}}" class="btn btn-creategroup">Create Group</a>
                     </div>
                  </div>
                  <ul class="group-list">
                     <li class="active"><a href="#MyGroup" data-toggle="tab">My Groups</a></li>
                     <li><a data-toggle="tab" href="#ExploreGroups">Explore Groups</a></li>
                  </ul>

                  @if(isset($grp_member_count) && $grp_member_count!='')
                  <div class="tab-content">
                     <div id="MyGroup" class="tab-pane fade in active">
                        @foreach($grp_member_count as $grplist_val)


                        <div class="group-box">
                              <div class="row">
                                 <div class="col-sm-8 col-lg-9">
                                    <div class="media">
                                          <div class="media-left">
                                             <a
                                                href="{{ (isset($grplist_val['slug'])) ? route('group-detail',$grplist_val['slug']) : 'javascript:void();'}}">

                                                <img class="media-object"
                                                      src="{{ ($grplist_val['grp_profile']!='') ? asset('uploads/group/'.$grplist_val['grp_profile']) : default_image()}}"
                                                      alt="..."
                                                      onerror="this.onerror=null;this.src='{{default_image()}}';"
                                                      alt="...">
                                             </a>
                                          </div>
                                          <div class="media-body">
                                             <h4><a
                                                      href="{{ (isset($grplist_val['slug'])) ? route('group-detail',$grplist_val['slug']) : 'javascript:void();'}}">{{ (isset($grplist_val['grp_name']) && $grplist_val['grp_name']!='') ? ucwords($grplist_val['grp_name']) :  '' }}</a>
                                             </h4>

                                             <p>{{ ($grplist_val['member_count']>=1) ? ($grplist_val['member_count']+1).' Members' : (($grplist_val['member_count']==0) ? ($grplist_val['member_count']+1).' Member' : 'No Members')}}
                                             </p>

                                          </div>
                                    </div>
                                 </div>

                                 <div class="col-sm-4 col-lg-3">
                                    @if(auth()->user()->id==$grplist_val['user_id'])
                                    <div class="dropdown">
                                          <button class="btn dropdown-toggle" type="button" id="dropdownMenu1"
                                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                             <span class="glyphicon glyphicon-option-vertical"></span>
                                          </button>
                                          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                             {{-- <li><a href="#">Action</a></li>
                              <li><a href="#">Another action</a></li> --}}

                                             {{-- <li><a href="{{route('group-edit',base64_encode($grplist_val['id))}}">Edit</a>
                                             </li> --}}
                                             <li><a href="#" data-toggle="modal" data-id="{{$grplist_val['id']}}"
                                                      class="addmembers_group" data-target="#addmembers_group">Add
                                                      Member</a></li>
                                             <li class="show-alert-delete-box"><a
                                                      href="{{route('group-delete',$grplist_val['id'])}}">Delete Group</a>
                                             </li>
                                          </ul>
                                    </div>
                                    @endif
                                 </div>
                              </div>
                              <!-- row -->
                        </div>



                        @endforeach

                        @if(empty($grp_member_count))
                        <div class="row">
                              <div class="col-lg-12">
                                 <div class="NoUserFound">
                                    <h2>No Result Found</h2>
                                 </div>
                              </div>
                        </div>
                        @endif
                     </div>
                     <div id="ExploreGroups" class="tab-pane fade">

                        <div class="connected-member space-bottom flex-mobile">
                              <h3>Creative</h3>
                              {{-- <a href="" class="btn-reccomended">See all in Creativity <i class="fa-solid fa-arrow-right"></i></a>   --}}
                        </div>

                        <div class="partner-location">
                              <div class="">
                                 <div class="row">
                                    @if(isset($allgroup_list) && $allgroup_list!='')
                                    @foreach ($allgroup_list as $allgroup_val)

                                    <div class="col-sm-4 col-md-4">
                                          <div class="media partner_box">
                                             <div class="media-left media-middle">
                                                <a
                                                      href="{{ (isset($allgroup_val['slug'])) ? route('group-detail',$allgroup_val['slug']) : 'javascript:void();'}}">
                                                      <img class="media-object"
                                                         src="{{ ($allgroup_val['grp_profile']!='') ? asset('uploads/group/'.$allgroup_val['grp_profile']) : default_image()}}"
                                                         alt="..."
                                                         onerror="this.onerror=null;this.src='{{default_image()}}';"
                                                         alt="..." width="100">
                                                </a>
                                             </div>
                                             <div class="media-body">
                                                <h4><a
                                                         href="{{ (isset($allgroup_val['slug'])) ? route('group-detail',$allgroup_val['slug']) : 'javascript:void();'}}">{{ (isset($allgroup_val['grp_name']) && $allgroup_val['grp_name']!='') ? ucwords($allgroup_val['grp_name']) :  '' }}</a>
                                                </h4>
                                                {{-- <h4 class="media-heading">Equinox</h4> --}}
                                                <div class="part-icon">
                                                      {{-- <span class=""> <img src="images/icon-location.png" alt=""> Newyork, USA</span> --}}
                                                      <span
                                                         class="">{{ (isset($allgroup_val['description ']) && $allgroup_val['description ']!='') ? ucwords($allgroup_val['description ']) :  '' }}</span>
                                                </div>
                                             </div>
                                          </div>
                                    </div>
                                    @endforeach
                                    @endif
                                 </div>
                                 <!--row-->

                                 <!--row-->
                                 <!-- row4 -->
                                 <!--row-->
                              </div>
                              <!-- container -->
                        </div>

                        {{-- <div class="loading-btn mt0"> <a href="" class="btn btn-loadmore">Load More <i class="fa-solid fa-caret-down"></i></a></div> --}}

                        @if(empty($grp_member_count))
                        <div class="row">
                              <div class="col-lg-12">
                                 <div class="NoUserFound">
                                    <h2>No Result Found</h2>
                                 </div>
                              </div>
                        </div>
                        @endif
                     </div>
                  </div>
                  @endif


                  <!-- group-box -->

            </div>
        </div>
        

        <!-- container-fluid -->
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
    <!-- container -->
</div>
<!--  group-section -->
<!-- footer -->
@endsection

<script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-firestore.js"></script>

<script type="module">
import {
    initializeApp
} from "https://www.gstatic.com/firebasejs/9.6.10/firebase-app.js";
import {
    doc,
    getFirestore
} from "https://www.gstatic.com/firebasejs/9.6.10/firebase-firestore.js";

const firebaseConfig = {
    apiKey: "AIzaSyBEX9ZgOQeXQwCfLKvONlpYMGOx5PI6kYs",
    authDomain: "spring-verse.firebaseapp.com",
    projectId: "spring-verse",
    storageBucket: "spring-verse.appspot.com",
    messagingSenderId: "5570982132",
    appId: "1:5570982132:web:31724bb0df54ddd9886ea1",
    measurementId: "G-STK15TTN27"
};

firebase.initializeApp(firebaseConfig);
let firestore = firebase.firestore();

const userid = '{{Auth::user()->id}}';
var get_memberid = '{{(isset($_GET["mmid"]) && $_GET["mmid"]!='
') ? $_GET["mmid"] : 0 }}';

$(document).ready(function() {
    $('#add_grp_member').submit(function() {
        let formdata = $(this).serializeArray();
        let form_url = $(this).attr('action');
        $.ajax({
            type: "POST",
            dataType: "json",
            url: form_url,
            data: formdata,
            success: function(resp) {
                console.log(resp, 'resp');

                $('#addmembers_group').modal('hide');
                if (resp.status == 200 && resp.status_msg == 'success') {
                    let collection_ref = firestore.collection('group-chat').doc(resp
                        .group_id.firestore_grp_id);
                    resp.data.map((result) => {
                        console.log(result);
                        let obj = {
                            'unreadmsgcount': 0
                        }
                        collection_ref.collection('unreadmsgcount').doc(`${result}`)
                            .set(obj);
                        collection_ref.update({
                            members: resp.members
                        }).then(() => {
                            console.log("Member added successfully..!!");
                        }).catch((err) => {
                            console.log(err, 'error doc')
                        })
                    })

                    Swal.fire({
                        title: '<span style="color:green">Success</span>',
                        text: resp.message,
                        imageUrl: '{{asset('
                        frontend / images / spring - verse - logo.png ')}}',
                        imageAlt: 'spring-verse',
                        // icon: 'success',
                        showConfirmButton: false,
                        timer: 2000,

                    });
                } else {
                    console.log('asdasdasd');
                    Swal.fire({
                        title: '<span style="color:red">Error</span>',
                        text: resp.message,
                        imageUrl: '{{asset('
                        frontend / images / spring - verse - logo.png ')}}',
                        imageAlt: 'spring-verse',
                        //   icon: 'error',
                        showConfirmButton: false,
                        timer: 2000,

                    });
                }
            },
            error: function(error) {
                Swal.fire({
                    title: '<span style="color:green">Error</span>',
                    text: resp.message,
                    imageUrl: '{{asset('
                    frontend / images / spring - verse - logo.png ')}}',
                    imageAlt: 'spring-verse',
                    // icon: 'success',
                    showConfirmButton: false,
                    timer: 2000,

                });
            }
        });
        return false;
    })
})
</script>