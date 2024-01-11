@extends('frontend.layouts.frontLayout')

@section('content')
      <div class="member-home">
         <div class="container">
            <div class="home_text">
               <h1>Members</h1>
               <div class="home_inner-flex">
                  <p>
                     <a href="#" data-toggle="modal" data-target="#invite-linkedin" class="btn invite-linkedin"><i class="fa-brands fa-linkedin"></i>Invite via Linkedin</a>  
                  </p>

                <form action="{{route('all-members')}}" id="searchform" name="searchform" class="float-right">
                  <div class="input-group">
                     <input type="text" name="keyword" id='search_btn' value="{{request()->get('keyword','')}}"  autocomplete="off" class="form-control search-role_member" placeholder="Search Members" aria-describedby="basic-addon2">
                     @csrf
                   <button class="input-group-addon" id="basic-addon2" type="submit"><a  class="btn btn-search_banner"><i class="fa-solid fa-magnifying-glass"></i></a></button>
                    
                  </div>
               </form>

               </div>
            </div>
         </div>
         <!--container-->  
      </div>
      <!--member-->
      <div class="container">
         <div class="connected-member">
            <p>Total Connected Members - {{ $connected_members }} Members</p>
            <a href="{{route('all-members')}}" class="btn-reccomended">View All Recommanded Members <i class="fa-solid fa-arrow-right"></i></a>  
         </div>
         <!-- connect-memmber -->
      </div>
      <!-- container -->
      <div class="main_member-text">
         <div class="container">
            <div class="row ten-columns">
           
                @include('frontend.includes.members-list')
               <!--col-->
            
               <!--col-->
          
               <!--col-->
              
               <!--col-->
            
               <!--col-->
            </div>
         </div>
         <!-- container -->
      </div>
   
      <!-- recetly join memeber -->
      <div class="member-home">
         <div class="container">
            <div class="home_text">
               <h1>Recently join Members</h1>
              
            </div>
         </div>
         <!--container-->  
      </div>

       <!-- container -->
       <div class="main_member-text">
         <div class="container">
            <div class="row ten-columns">
           
                @include('frontend.includes.recent-join-members-list')
               <!--col-->
            
               <!--col-->
          
               <!--col-->
              
               <!--col-->
            
               <!--col-->
            </div>
         </div>
         <!-- container -->
      </div>
      <!-- recetly join memeber -->

      <!-- main_member-text -->
      <div class="partner-location">
         <div class="container">
            <h2>Partner Locations Near You</h2>
            <div class="row">
           @if(isset($patner) && $patner!='')
           @foreach($patner as $key=>$val)
               <div class="col-sm-4 col-md-4">
                  <div class="media partner_box">
                     <div class="media-left media-middle">
                        <a href="javascript:void();">
                        <img class="media-object" src="{{url('/').'/assets/uploadimage/'.$val->logo }}" class="responsive-img" alt="..." value="" width="105px" height="105px">
                        </a>
                     </div>
                     <div class="media-body">
                        <h4 class="media-heading">{{ (isset($val->company_name) && $val->company_name!='' ) ? $val->company_name	 :'' }}</h4>
                        <div class="part-icon">
                           <span class=""> <img src="{{asset('frontend/images/icon-location.png')}}" alt="">{{ (isset($val->patner_location) && $val->patner_location!='' ) ? $val->patner_location	 :'' }}</span>
                           @if($val->type=='Gym')
                           <span class=""><img src="{{asset('frontend/images/icon-gym.svg')}}" alt=""> {{ (isset($val->type) && $val->type!='' ) ? $val->type	 :'' }}</span>
                           @elseif($val->type=='Restaurant')
                           <span class=""><img src="{{asset('frontend/images/icon-restaurant.svg')}}" alt=""> {{ (isset($val->type) && $val->type!='' ) ? $val->type	 :'' }}</span>
                           @else
                           <span class=""><img src="{{asset('frontend/images/icon-gym.svg')}}" alt=""> {{ (isset($val->type) && $val->type!='' ) ? $val->type	 :'' }}</span>
                           @endif
                        </div>
                     </div>
                  </div>
               </div>
               @endforeach
               @endif
               <!--col-->
               
               <!--col-->
            </div>
            <!--row-->
         </div>
         <!-- container -->
      </div>
      <!-- mai div -->
      <div class="message">
         <div class="container">
            <div class="view-message">
               <h2>Messages <span class="msg_main-icon"><img src="{{asset('frontend/images/pencilIcon.png')}}" alt="" srcset=""></span></h2>
               <a href="{{route('messages')}}" class="btn-reccomended">View All Messages <i class="fa-solid fa-arrow-right"></i></a>  
            </div>
            <!-- view-message -->
            <!-- <div class="row main_msg">
               <div class="col-sm-8 col-md-8">
                  <div class="media">
                     <div class="media-left">
                        <a href="#">
                        <img class="media-object" src="{{asset('frontend/images/partner1.png')}}" alt="...">
                        </a>
                     </div>
                     <div class="media-body">
                        <h4 class="media-heading">Ronald Richards</h4>
                        <p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia 
                           consequat duis enim velit mollit. Exercitation veniam  consequat sunt nostrud amet.
                        </p>
                     </div>
                  </div>
               </div>
               <div class="col-sm-2 col-md-2 con-upper-mar">
                  <span class="msg-icon"><a href=""><i class="fa-regular fa-comment-dots"></i> </a></span>
                  <span class="msg-icon"><a href=""><i class="fa-regular fa-trash-can"></i></a></span>
               </div>
               <div class="col-sm-2 col-md-2">
                  <div class="five-min">
                     <p>5 min ago</p>
                  </div>
               </div>
            </div> -->
            <!--row-->
         </div>
         <!--container-->  
      </div>
      <!--message-->
@endsection

<script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-firestore.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script type="module">
      // Import the functions you need from the SDKs you need
      import { initializeApp } from "https://www.gstatic.com/firebasejs/9.6.10/firebase-app.js";  
      import { doc, getFirestore,where  } from "https://www.gstatic.com/firebasejs/9.6.10/firebase-firestore.js";  
      var arr = []
      // const firebaseConfig = {
      //    apiKey: "AIzaSyBEX9ZgOQeXQwCfLKvONlpYMGOx5PI6kYs",
      //    authDomain: "spring-verse.firebaseapp.com",
      //    projectId: "spring-verse",
      //    storageBucket: "spring-verse.appspot.com",
      //    messagingSenderId: "5570982132",
      //    appId: "1:5570982132:web:31724bb0df54ddd9886ea1",
      //    measurementId: "G-STK15TTN27"
      // };
      const firebaseConfig = {
         apiKey: "AIzaSyBwySnO0weIj3LpHU1jeREfJWnBikGEnpU",
         authDomain: "spring-verse-a6c0a.firebaseapp.com",
         projectId: "spring-verse-a6c0a",
         storageBucket: "spring-verse-a6c0a.appspot.com",
         messagingSenderId: "469464895197",
         appId: "1:469464895197:web:0db3ee3e458efcd9ca5534",
         measurementId: "G-6NBEJJ71F8"
      };
      const userid = '{{Auth::user()->id}}';

      firebase.initializeApp(firebaseConfig);
      let firestore = firebase.firestore();

      let api_data = [];
      axios.get(`https://devfolio.co.in/spring-verse/api/getmemberdata/${userid}`).then(response =>{
         api_data = response.data.data;
         getChats(api_data)
      }).catch((err)=>{
         console.log(err, 'error');
      })

      function getChats(chatArray){
         let chatRef = firestore.collection('chats');
         const query1 = chatRef.where('user_id', '==', userid);
         const query2 = chatRef.where("member", "==",userid);
         let arr = [];
         Promise.all([query1.get(), query2.get()])
         .then(([querySnapshot1, querySnapshot2]) => {
            const mergedSnapshot = querySnapshot1.docs.concat(querySnapshot2.docs);
            chatArray.forEach((res) => {
               if(res.user_id == userid){
                  mergedSnapshot.forEach((doc) => {
                     if(doc.id == res.chat_room_id){
                        arr.push({id: doc.id, data: doc.data(),profile_image: res.profile_image,full_name: res.full_name})
                     }
                  })
               }
            })
            console.log(chatArray,"chatArray");
            arr.sort((a,b) => {
               const timeA = a.data.current_time;
               const timeB = b.data.current_time;
               if (timeA > timeB) {
                  return -1;
               } else if (timeA < timeB) {
                  return 1;
               } else {
                  return 0;
               }
            })
            let fiveElement = arr.filter((arr, index) => {
               return index < 5
            })
            
            fiveElement.forEach((el) => {
               chatRef.doc(el.id).collection('messages').orderBy('time','desc').limit(1).onSnapshot(async items=>{
                  items.docs.map((item) => {
                     let memberid = item.data().member == userid ? item.data().user_id : item.data().member;
                     let html = '<div class="row main_msg"><div class="col-sm-8 col-md-8"><div class="media"><div class="media-left"><a href="#"><img class="media-object" src='+el.profile_image+' alt="..."></a></div><div class="media-body"><h4 class="media-heading">'+el.full_name+'</h4><p>'+item.data().message+'</p></div></div></div><div class="col-sm-2 col-md-2 con-upper-mar"><span class="msg-icon"><a href="{{route("messages")}}?mmid='+memberid+'"><i class="fa-regular fa-comment-dots"></i> </a></span></div><div class="col-sm-2 col-md-2"><div class="five-min"><p>'+diff_minutes(item.data().time)+'</p></div></div>';
                     $(".message .container").append(html);
                  })
               })
            })
         })
         .catch((error) => {
            console.log('Error getting documents: ', error);
         });
      }

      function diff_minutes(dt1,format='') 
      {
         dt1 = new Date(dt1);
         let dt2 = new Date();
         var diff =(dt2.getTime() - dt1.getTime()) / (1000*60*60*24);
         let lastmsg;
         diff = Math. abs(Math. round(diff));
         console.log(diff)
         if(diff>0 && diff<2){
            lastmsg = 'yesterday';
         }else if(diff>2){
            lastmsg = dt1.toLocaleDateString();
         }else{
            lastmsg = dt1.getHours()+':'+dt1.getMinutes()
         } //(diff>0) ? diff : dt1.getHours()+':'+dt1.getMinutes(); 
         if(format==''){
         return lastmsg;
         }else{
            let diff_new = (dt2.getTime() - dt1.getTime()) /(1000*60)
            return Math. abs(Math. round(diff_new));
         }
      }
</script>

