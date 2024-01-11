@extends('frontend.layouts.frontLayout')
@section('content')
      <!-- header -->   
      <!-- create-group -->
      <div class="create-group">
         <div class="container">
            <div class="container-fluid">
               <h1>{{isset($group_response) && $group_response!='' ? 'Update' : 'Create'}} Group</h1>
               <div class="row">
                  <div class="col-sm-8 col-lg-10">
                     <h3>Group Details</h3>
                     @include('frontend.includes.validation')

                     @include('frontend.includes.flashMessage')

                    <form action="{{route('group-store')}}" method="post" enctype="multipart/form-data" id="group_create_form" onsubmit="return false">
                        <input type="hidden" name="user_id" value="">
                    
                   
                      @csrf

                     <div class="create-box">
                        <label for="">Group Name<span class="red-text">*</span></label>
                        <input type="text" placeholder="" class="form-control" name="grp_name" id="" value="{{old('grp_name')}}" oninput="this.value=this.value.replace(/[^A-Za-z0-9 ]/g,'');" maxlength="60" required>
                     </div>
                     <!-- create-box -->
                     <div class="create-box">
                        <label for="">What is the purpose of your group?<span class="red-text">*</span></label>
                        <input type="text" placeholder="" required class="form-control" name="description" id="" value="{{old('description')}}">
                     </div>
                     <!-- create-box -->
                     <div class="create-box">
                        <label for="">Group Tags<span class="red-text">*</span></label>
                        
                        <input placeholder="Add tags to group" id="group_tags" class="form-control" name="tag" value="" data-role="tagsinput" type="text" value="{{old('tag')}}">
                        {{-- <div class="hobbies-btn">
                           <a href="" class="btn">Swimming</a>
                           
                        </div> --}}
                     </div>
                     <div class="create-box">
                        <p>Group Image<span class="red-text"> (NOTE:Max image size 200x200)</span></p>
                        <div class="UploadImage">
                        <label for="fileUpload">Upload Image</label>
                        <input type="file" placeholder="" class="form-control img-Upload" name="grp_profile" id="fileUpload" accept="image/*" data-max-width="201" data-max-height="201" value="{{old('grp_profile')}}" >
                     </div>

                     </div>
                     <!-- create-box -->
                     <p class="create-groupbtn">
                        
                        <button class="btn"  type="submit" class="grp_created" data-target="#grp_created">Create Group</button>
                     </p>
                    </form>
                  </div>

                  
                  
                  @if(isset($group_response) && $group_response!='')
                  <div class="col-sm-4 col-lg-2">
                     <div class="change-photo">
                        <img src="{{ (isset($group_response->grp_profile) && $group_response->grp_profile!='') ? asset('uploads/group/'.$group_response->grp_profile) : default_image()}}" alt="" name="grp_profile">
                        <p>
                           <a href="">Change Group Icon Photo</a>
                        </p>
                     </div>
                     <!-- change-photo -->
                  </div>
                  @endif
               </div>
               <!-- row -->
            </div>
            <!-- container-fluid -->
         </div>
         <!-- container -->
      </div>
      <!-- create-group -->
      <!-- footer -->
      @endsection
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
      <script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-app.js"></script>
      <script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-firestore.js"></script>
      <script type="module">
         import { initializeApp } from "https://www.gstatic.com/firebasejs/9.6.10/firebase-app.js";  
         import { doc, getFirestore } from "https://www.gstatic.com/firebasejs/9.6.10/firebase-firestore.js";

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

         $(document).ready(function(){
            $('#group_create_form').submit(function(){
               let formdata = $(this).serializeArray();
               let form_url = $(this).attr('action');
               var FormDataimage = new FormData();
               FormDataimage.append('grp_profile', $('input[name=grp_profile]')[0].files[0]); 
               FormDataimage.append('grp_name', $('input[name=grp_name]').val()); 
               FormDataimage.append('description', $('input[name=description]').val()); 
               FormDataimage.append('tag', $('input[name=tag]').val()); 
               FormDataimage.append('_token', '{{csrf_token()}}'); 
               console.log('FormDataimage',FormDataimage,formdata);
               // alert('asd');  
               $.ajax({
                  type: "POST",
                  dataType: "json",
                  url: form_url,
                  data: FormDataimage,
                  processData: false,
                  contentType: false,
                  cache: false,
                  success:function(resp){
                     console.log(resp)
                     $('#grp_created').modal('hide');
                     if(resp.status == 200 && resp.status_msg=='success'){
                        let datetime = currentdatetime();
                        alert(resp.data.user_id);
                        let obj = {
                           'current_time': datetime,
                           'group_id': resp.data.firestore_grp_id,
                           'group_name': resp.data.grp_name,
                           'members': [resp.data.user_id],
                           'grp_profile': resp.data.grp_profile
                        }
                        let obj2 = {
                           'is_welcome_message': true,
                           'message': resp.user_name.full_name+' Created Group '+resp.data.grp_name,
                           'time': datetime,
                           'user_id': resp.data.user_id,
                           'user_name': resp.user_name.full_name,
                           'user_profile': resp.user_name.profile_image
                        }
                        let obj3 = {
                           'unreadmsgcount': 0
                        }
                        console.log(obj,obj2);
                        firestore.collection('group-chat').doc(resp.data.firestore_grp_id).set(obj);
                        firestore.collection('group-chat').doc(resp.data.firestore_grp_id).collection('messages').doc().set(obj2);
                        firestore.collection('group-chat').doc(resp.data.firestore_grp_id).collection('unreadmsgcount').doc(`${resp.data.user_id}`).set(obj3);
                        Swal.fire({
                        title: '<span style="color:green">Success</span>',
                        text: resp.message,
                        imageUrl: '{{asset('frontend/images/spring-verse-logo.png')}}',
                        imageAlt: 'spring-verse',
                        // icon: 'success',
                        showConfirmButton: false,
                        timer: 2000,
         
                        });
                     }else{
                     console.log('asdasdasd');
                     Swal.fire({
                        title: '<span style="color:red">Error</span>',
                        text: resp.message,
                        imageUrl: '{{asset('frontend/images/spring-verse-logo.png')}}',
                        imageAlt: 'spring-verse',
                        //   icon: 'error',
                        showConfirmButton: false,
                        timer: 2000,
                        
                     });
                     }
                  },error: function (error) {
                     Swal.fire({
                        title: '<span style="color:red">Error</span>',
                        text: resp.message,
                        imageUrl: '{{asset('frontend/images/spring-verse-logo.png')}}',
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
         
         
         function currentdatetime(){
            const d = new Date();
            var options = {
                  year: "numeric",
                  month: "2-digit",
                  day: "numeric"
               };
            let datetime = d.toLocaleDateString("as-IN",options)+' '+d.toLocaleTimeString();
            return datetime;
         }
      </script>