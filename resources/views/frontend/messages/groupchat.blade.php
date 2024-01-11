@extends('frontend.layouts.frontLayout')
@section('content')
      <!-- header -->
      <div class="messages-section">
         <div class="container">
            <div class="home_text">
               <h1>Group Messages</h1>
             
               <div class="home_inner-flex">
                  <div class="input-group">
                     {{-- <input type="search" class="form-control" placeholder="Search Members" aria-describedby="basic-addon2">
                     <a class="input-group-addon" href="javascript:void(0);" type="button" id="basic-addon2"><i class="fa-solid fa-magnifying-glass"></i></a>  --}}
                  </div>
               </div>
            </div>
            <!-- home-text -->
            <div class="account-box">
               <div class="messages-header">
                  <div class="inbox-header">
                     <h1>Inbox</h1>
                     <a href="javascript:void(0);" class="btn btn-newmsg">25 New Messages</a>
                  </div>
                  <ul class="messages-list">
                     {{-- <li><a href="javascript:void(0);">Unread Messages</a></li>
                     <li><a href="javascript:void(0);" class="btn btn-new-msg">New Messages</a></li> --}}
                     {{-- <li><a href="javascript:void(0);">Archived Messages</a></li> --}}
                  </ul>
               </div>
               <!-- row -->
               <br />
               <!-- chat -->
               <div class="chat_container wow fadeInDown">
                  <div class="col-sm-4 col-md-3 chat_sidebar">
                     <div class="row">
                        <div class="member_list" id="style-4">
                           <ul class="list-unstyled all-frnd-records group_chat_list">
                              {{-- @include('frontend.messages.groupmember-list') --}}
                              @if(isset($allfriends_list['total_friends_count']) && $allfriends_list['total_friends_count']>5)
                              {{-- <button onclick="load_more_friends()">Load More</button> --}}
                              @endif
                           </ul>
                        </div>
                     </div>
                  </div>
                  @if(isset($allfriends_list['all_records']) && !empty($allfriends_list['all_records']))
                  @php
                 // echo $allfriends_list['all_records'][0]->to_member;
                  $to_member_id = $allfriends_list['all_records'][0]->mmid;//($loginuserid==$allfriends_list['all_records'][0]->to_member) ? $allfriends_list['all_records'][0]->user_id : ((isset($_GET['mmid']) && $_GET['mmid']>0) ? $_GET['mmid'] : $allfriends_list['all_records'][0]->to_member);
                  $newchatroomid = 'roomid@'.Auth::user()->id.'@'.$to_member_id;
                  @endphp  
                  <input name="grp_id" type="hidden" value="{{(isset($grp_chat_room_id->firestore_grp_id)) ? $grp_chat_room_id->firestore_grp_id : ''}}"/>
                  @endif
                  <!--chat_sidebar-->
                  <div class="col-sm-8 col-md-9 message_section" >
                     <div class="row">
                        
                        <div class="new_message_head">
                           <div class="">
                              <!-- <button><i class="fa fa-plus-square-o" aria-hidden="true"></i> New Message</button> -->
                              <div class="media">
                                 <div class="media-left">
                                    <a href="javascript:void(0);">
                                   
                                       @if(isset( $grp_chat['grp_chat_list']['users_admin']['provider_id']) && $grp_chat['grp_chat_list']['users_admin']['provider_id']!='' && $grp_chat['grp_chat_list']['users_admin']['social_login']!='' && $grp_chat['grp_chat_list']['grp_profile']!='')
                                       @php 

                                       $sender_profile_image =  $grp_chat['grp_chat_list']['grp_profile'];

                                       @endphp
                                          <img src="{{ $sender_profile_image }}" alt="..." onerror="this.onerror=null;this.src='{{default_image()}}';" class="media-object"/>
                                       @else
                                       @php 
                                       // print_r($grp_chat);
                                       $sender_profile_image = (isset($grp_chat['grp_chat_list']) && !empty($grp_chat['grp_chat_list']) && $grp_chat['grp_chat_list']['grp_profile']!='') ? default_image($grp_chat['grp_chat_list']['grp_profile']) : default_image();//;

                                       @endphp
                                      
                                       <img src="{{ (isset( $grp_chat['grp_chat_list']['grp_profile'])) ? default_image( $grp_chat['grp_chat_list']['grp_profile']) : default_image()}}" alt="..." class="media-object"/>
                                       @endif
                                    {{-- <img class="media-object" src="{{default_image()}}" alt="..."> --}}
                                    </a>
                                 </div>
                                 <div class="media-body">
                                    <h4 class="media-heading">{{(isset($grp_chat['grp_chat_list']['grp_name']) && $grp_chat['grp_chat_list']['grp_name']!='') ? $grp_chat['grp_chat_list']['grp_name'] : ''}}</h4>
                                 </div>
                              </div>
                           </div>
                           <div class="">
                              <div class="message-header-btn">
                                 {{-- <a href="javascript:void(0);" class="btn btn-call"><span class="fa fa-phone"></span> Call</a> --}}
                                 <a href="{{route('profile',(isset($grp_chat['grp_chat_list']['users_admin']['username']) && $grp_chat['grp_chat_list']['users_admin']['username']!='') ? $grp_chat['grp_chat_list']['users_admin']['username'] : '' )}}" target="_blank" class="btn btn-view">View Profile</a>
                              </div>
                           </div>
                           <div class="clearfix"></div>
                        </div>
                        <!--new_message_head-->
                        <div class="chat_area chat-height" id="style-4">
                           <ul class="list-unstyled" id="allChatMessages">
                              
                           </ul>
                        </div>
                        <!--chat_area-->
                        <div class="message_write  message-footer-btn">
                           <textarea class="form-control" placeholder="Type your message here....." id="textMessage"></textarea>
                           <div class="clearfix"></div>
                           <div class="chat_bottom">
                              <a href="javascript:void(0);" class="pull-right btn btn-sentbtn" id="sendMessage">Send Message</a>
                              <div class="clearfix"></div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!--message_section-->
               </div>
            </div>
            <!-- account-box -->
         </div>
         <!-- container -->
      </div>
      <!-- messages-section -->
      @endsection
      
      
      @php
      if(isset($member_message_data) && $member_message_data!=''){
         $newchatroomid = $member_message_data;
      }else{
         if(isset($_GET['gmid']) && $_GET['gmid']!='' && $_GET['gmid']>0){
            $to_member_id = $_GET['gmid'];
            $newchatroomid = 'roomid@'.Auth::user()->id.'@'.$_GET['gmid'];
         }
      }
      if(isset($_GET['gmid']) && $_GET['gmid']!='' && $_GET['gmid']>0){
         $to_member_id = $_GET['gmid'];
      }
      @endphp
      
      <script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-app.js"></script>
      <script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-firestore.js"></script>
     
      <script type="module">
      // Import the functions you need from the SDKs you need
      import { initializeApp } from "https://www.gstatic.com/firebasejs/9.6.10/firebase-app.js";  
      import { doc, getFirestore } from "https://www.gstatic.com/firebasejs/9.6.10/firebase-firestore.js";  
         
      // firebase databse config
      //   const firebaseConfig = {
      //     apiKey: "AIzaSyAkf_ZZLu9TieEoENjeN1uoqZwR-EN0WjI",
      //     authDomain: "springverse-chat.firebaseapp.com",
      //     databaseURL: "https://springverse-chat-default-rtdb.firebaseio.com",
      //     projectId: "springverse-chat",
      //     storageBucket: "springverse-chat.appspot.com",
      //     messagingSenderId: "347968820501",
      //     appId: "1:347968820501:web:2bf21b5366ae20f0c0851c",
      //     measurementId: "G-Y5SZJHGSG2"
      //   };

      const firebaseConfig = {
         apiKey: "AIzaSyBEX9ZgOQeXQwCfLKvONlpYMGOx5PI6kYs",
         authDomain: "spring-verse.firebaseapp.com",
         projectId: "spring-verse",
         storageBucket: "spring-verse.appspot.com",
         messagingSenderId: "5570982132",
         appId: "1:5570982132:web:31724bb0df54ddd9886ea1",
         measurementId: "G-STK15TTN27"
      };

      let group_id = '{{(isset($grp_chat_room_id->firestore_grp_id)) ? $grp_chat_room_id->firestore_grp_id : ''}}';
      const userid = '{{Auth::user()->id}}';
      let user_name = '{{Auth::user()->full_name}}';
      let profile_img = '{{(isset(Auth::user()->profile_image) && Auth::user()->profile_image!='') ? url("public/uploads/profile/")."/".Auth::user()->profile_image : ''}}';
      var get_memberid = '{{(isset($_GET["mmid"]) && $_GET["mmid"]!='') ? $_GET["mmid"] : 0 }}';
      firebase.initializeApp(firebaseConfig);
      let firestore = firebase.firestore();
      let chat_ref = firestore.collection('group-chat');
      chat_ref.orderBy('current_time','desc').onSnapshot(async(snap)=>{
         var arr = []
         let msgs = snap.docs.map((item) => item.id)
         snap.docs.map((group_id)=>{
            let group_data = group_id.data();
            console.log(group_data,'group_data');
            group_data.members.map((member_id)=>{
               if(member_id == userid){
                  arr.push({id:group_id.id,data:group_data,msg:'',count:0});
               }
            })
         })
         console.log(arr,"arr before");
         arr.sort(function (a, b) {
            console.log(a,a.id,msgs,msgs.indexOf(a.id),b.id,msgs.indexOf(b.id))
            return msgs.indexOf(a.id) - msgs.indexOf(b.id);
         })
         
         console.log(arr, 'arr')
         arr.map((group_data)=>{
            console.log(group_data,'group_data');
            let data = group_data.data;
            data.members.map((member_id)=>{
               if(member_id == userid){
                  let collection_ref = firestore.collection('group-chat').doc(data.group_id);
                  collection_ref.collection('unreadmsgcount').doc(userid).onSnapshot(async message=>{
                     collection_ref.collection('messages').orderBy('time','desc').limit(1).onSnapshot(async items=>{
                        items.docs.map((response)=>{
                           console.log(message.data().unreadmsgcount,'unreadmsgcount before');
                           let default_img = "'{{default_image()}}';"
                           // +(message.data().unreadmsgcount > 0 ?  : '')+'
                           let li_tag = '<li id="'+data.group_id+'" class="left clearfix chat_member" data-chatroomid='+data.group_id+'>'
                           let innerHTML = '<a href="{{route("messages_group")}}?mmid='+data.group_name+'"><span class="chat-img"><img src='+(data.grp_profile != undefined && data.grp_profile)+' alt="..." class="img-circle" onerror="this.onerror=null;this.src='+default_img+'" /></span><div class="chat-body clearfix"><div class="header_sec"><h5 class="primary-font">'+data.group_name+'</h5><span class="unread-count">'+message.data().unreadmsgcount+'</span></div><div class="msg-dec"><p class="lastmesg">'+response.data().message+'</p><span class="chat-time lastmsgtime">'+diff_minutes(response.data().time)+'</span></div></div></a>';
                           if($('[data-chatroomid="'+data?.group_id+'"]').length === 0) {
                              $('.group_chat_list').append(li_tag+innerHTML+'</li>')
                           }else{
                              console.log(message.data().unreadmsgcount,'unreadmsgcount after');
                              const context = document.getElementById(data.group_id)
                              context.querySelectorAll('.lastmesg')[0].innerHTML = response.data().message
                              context.querySelectorAll('.lastmsgtime')[0].innerHTML = diff_minutes(response.data().time)
                              context.querySelectorAll('.unread-count')[0].innerHTML = message.data().unreadmsgcount;
                           }
                           if(get_memberid == 0){
                              generate_chat_data(arr[0].data.group_id);
                              $("input[name='grp_id']").val(arr[0].data.group_id);
                              $('.new_message_head .media-heading').text(arr[0].data.group_name);
                              if(arr[0].data.grp_profile != ""){
                                 $('.media-object').attr("src",arr[0].data.grp_profile);
                              }
                           }else if(data.group_name == get_memberid){
                              generate_chat_data(data.group_id);
                           }
                        })
                     })
                  })
               }
            })
         })
      })



      async function generate_chat_data(room_id){
         let collection_ref = chat_ref.doc(room_id).collection('messages');
         collection_ref.orderBy('time','asc').onSnapshot((snapshot)=>{
            chat_ref.doc(room_id).collection('unreadmsgcount').doc(userid).update({
               unreadmsgcount: 0
            }).then(() => {
               console.log("Document successfully updated!");
            }).catch((err)=>{
               console.log(err,'error doc')
            })
            $('#allChatMessages').html('');
            let message ='';
            snapshot.docs.map(doc => {
               let messages = doc.data()
               if(messages.is_welcome_message){
                  message+=`<p>${messages.message}</p>`
               }else{
                  if(messages.user_id==userid){
                     message+=`<li class="left clearfix admin_chat">
                        <span class="chat-img1 pull-right">
                        <img src="{{$receiver_profile_image}}" class="img-circle" onerror="this.onerror=null;this.src='{{default_image()}}';">
                        </span>
                        <div class="chat-body1 clearfix">
                           <div class="chat_time chat_time_2">${messages.time}</div>
                           <p>${messages.message}</p>
                        </div>
                     </li>`;
                  }else{
                     message += `<li class="left clearfix ">
                        <span class="chat-img1 pull-left">
                        <img id="headerImage" src="${messages.user_profile}" class="img-circle" onerror="this.onerror=null;this.src='{{default_image()}}';">
                        </span>
                        <div class="chat-body1 clearfix">
                              <div class="chat_time">${messages.time}</div>
                              <div class="sender_name">${messages.user_name}</div>
                              <p>${messages.message}</p>
                        </div>
                     </li>`;
                  }
               }
            });
            $('#allChatMessages').append(message);
            scrollToBottom();
         })
      }

      $(document).ready(function(){
         $('#textMessage').keyup(function(e){ 
            if(e.which==13 && $(this).val().length>1){
               $("#sendMessage").trigger('click');
            }
         })

         // savechat('{{$newchatroomid}}');
         // save message in firebase
         $("#sendMessage").click(function(){
            let datetime = currentdatetime();
            var text = $('#textMessage').val();
            if (text?.trim().length>0) 
            {
               let blank_grp_id = $("input[name='grp_id']").val();
               const obj = {'user_id':userid,'user_name':user_name,'user_profile':profile_img,'is_welcome_message':false,'message':text,'time':datetime};
               firestore.collection('group-chat').doc(blank_grp_id ? blank_grp_id : group_id).update({
                  current_time: datetime
               }).then(() => {
                  console.log("time updated successfully..!");
               }).catch((err)=>{
                  console.log(err,'error doc')
               })
               firestore.collection('group-chat').doc(blank_grp_id ? blank_grp_id : group_id).get().then((snapshot)=>{
                  snapshot.data().members.map(async (result) => {
                     if(parseInt(userid) !== result){
                        await firestore.collection('group-chat').doc(blank_grp_id ? blank_grp_id : group_id).collection('unreadmsgcount').doc(`${result}`).get().then(async (snapshot)=>{
                           await firestore.collection('group-chat').doc(blank_grp_id ? blank_grp_id : group_id).collection('unreadmsgcount').doc(`${result}`).update({
                              unreadmsgcount: snapshot.data().unreadmsgcount + 1
                           }).then(() => {
                              console.log("count updated successfully..!");
                           }).catch((err)=>{
                              console.log(err,'error doc')
                           })
                        })
                     }
                  })
               })
               firestore.collection('group-chat').doc(blank_grp_id ? blank_grp_id : group_id).collection('messages').doc().set(obj);
               $('#textMessage').val('');
            }
         });
      })
        
         

function diff_minutes(dt1,format='') 
{
   dt1 = new Date(dt1);
   let dt2 = new Date();
   var diff =(dt2.getTime() - dt1.getTime()) / (1000*60*60*24);
   let lastmsg;
   diff = Math. abs(Math. round(diff));
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

function scrollToBottom() {
   let section_height =  $(document).height()-$('#allChatMessages').height();
   // console.log('ssss',$('.chat-height').height(),$('#allChatMessages').height());
   // $(".chat-height").animate({ scrollTop: $('#allChatMessages').height()}, 'slow');
   $(".chat-height").scrollTop( $("#allChatMessages")[0].scrollHeight);
}


function savechat(param){
   $.ajax({
      type: "POST",
      url: "{{route('save_chatid') }}",
      data: {
         '_token': '{{csrf_token()}}',
         'chat_room_id': param,
         'member_id':'{{(isset($to_member_id)) ? $to_member_id : 0}}'
      },
      success: function(data) {
         console.log(data);
      }
   });
}

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