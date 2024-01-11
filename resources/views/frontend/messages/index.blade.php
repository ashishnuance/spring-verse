@extends('frontend.layouts.frontLayout')
@section('content')
      <!-- header -->
      <div class="messages-section">
         <div class="container">
            <div class="home_text">
               <h1>Messages</h1>
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
                           <img src="https://media.tenor.com/On7kvXhzml4AAAAj/loading-gif.gif" class="show-loader-frndlist show" />
                           <ul class="list-unstyled all-frnd-records hide">
                              @include('frontend.messages.friends-list')
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
                  <input name="chat_memberid" type="hidden" value="{{$to_member_id}}"/>
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
                                       @if(isset($member_data->provider_id) && $member_data->provider_id!='' && $member_data->social_login!='' && $member_data->profile_image!='')
                                       @php 
                                       $sender_profile_image = $member_data->profile_image;
                                       @endphp
                                          <img src="{{ $sender_profile_image }}" alt="..." onerror="this.onerror=null;this.src='{{default_image()}}';" class="media-object"/>
                                       @else
                                       @php 
                                       $sender_profile_image = default_image($member_data->profile_image);
                                       @endphp
                                       <img src="{{ (isset($member_data->profile_image)) ? default_image($member_data->profile_image) : default_image()}}" alt="..." class="media-object"/>
                                       @endif
                                    {{-- <img class="media-object" src="{{default_image()}}" alt="..."> --}}
                                    </a>
                                 </div>
                                 <div class="media-body">
                                    <h4 class="media-heading">{{(isset($member_data) && $member_data->full_name!='') ? $member_data->full_name : ''}}</h4>
                                 </div>
                              </div>
                           </div>
                           <div class="">
                              <div class="message-header-btn">
                                 {{-- <a href="javascript:void(0);" class="btn btn-call"><span class="fa fa-phone"></span> Call</a> --}}
                                 <a href="{{route('profile',$member_data->username)}}" target="_blank" class="btn btn-view">View Profile</a>
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
         if(isset($_GET['mmid']) && $_GET['mmid']!='' && $_GET['mmid']>0){
            $to_member_id = $_GET['mmid'];
            $newchatroomid = 'roomid@'.Auth::user()->id.'@'.$_GET['mmid'];
         }
      }
      if(isset($_GET['mmid']) && $_GET['mmid']!='' && $_GET['mmid']>0){
         $to_member_id = $_GET['mmid'];
      }
      @endphp
      
      <script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-app.js"></script>
      <script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-database.js"></script>
     
      <script type="module">
         // Import the functions you need from the SDKs you need
         import { initializeApp } from "https://www.gstatic.com/firebasejs/9.6.10/firebase-app.js";  
         import { getDatabase,ref } from "https://www.gstatic.com/firebasejs/9.6.10/firebase-database.js";  
         
         // firebase databse config
         const firebaseConfig = {
          apiKey: "AIzaSyAkf_ZZLu9TieEoENjeN1uoqZwR-EN0WjI",
          authDomain: "springverse-chat.firebaseapp.com",
          databaseURL: "https://springverse-chat-default-rtdb.firebaseio.com",
          projectId: "springverse-chat",
          storageBucket: "springverse-chat.appspot.com",
          messagingSenderId: "347968820501",
          appId: "1:347968820501:web:2bf21b5366ae20f0c0851c",
          measurementId: "G-Y5SZJHGSG2"
        };
         const userid = '{{Auth::user()->id}}';
         // Initialize Firebase
         firebase.initializeApp(firebaseConfig);
         // const analytics = getAnalytics(app);
         const db = firebase.database();
         const mychatroomdata = db.ref("messages-{{$newchatroomid}}");
         const fetchChat = db.ref("messages/");
         mychatroomdata.limitToLast(1).on("child_added", function (snapshot) {
         const messages = snapshot.val();
         console.log(messages);
         })

         /*****/
         // let chat_member = document.getElementsByClassName('chat_member')
         // console.log(chat_member);
         // chat_member.length && chat_member.map(element => {
         //    console.log(element);
         // });
         var current_member_id = '{{$to_member_id}}';
         let order_sequence,order_number;
         $('.chat_member').each(async(index, item)=>{
            if($(item).attr('data-chatroomid') && $(item).attr('data-chatroomid')!==''){
               let roomid = $(item).attr('data-chatroomid');
               let room_mmid = $(item).attr('data-memberid');
               
               console.log('roomid', roomid);
               let mychatroomdata_new = db.ref("messages-"+roomid);
               // console.log('mychatroomdata_new', mychatroomdata_new)
               console.log(current_member_id);
               await mychatroomdata_new.limitToLast(1).once("child_added", function (snapshot_new) {
                  let messages_new = snapshot_new.val();
                  let ordertime = diff_minutes(messages_new.time,'sec');
                  // if(!order_number){
                  //    order_sequence = ordertime
                  //    order_number=+1;
                  // }
                  $(item).find('.lastmesg').text(messages_new.message)
                  $(item).find('.lastmsgtime').text(diff_minutes(messages_new.time))
                  let item_html = $(item).html();
                  $(item).remove()
                  let activeClass = (current_member_id==room_mmid) ? 'active' : '';
                  let li_html = '<li class="left clearfix chat_member '+activeClass+'" data-chatroomid="'+roomid+'" data-memberid="'+room_mmid+'">';
                  if(activeClass==''){
                     $(li_html+item_html+'</li>').insertAfter('.all-frnd-records li:nth-child(1)');
                  }else{
                     $('.all-frnd-records').prepend(li_html+item_html+'</li>');
                  }
                  // console.log('messages_new',messages_new, "messages-"+roomid);
                  
               })
            }
         })

         /*****/
         
         
         // console.log(fetchChat.orderBy("time", "desc").limit(2));
         mychatroomdata.on("child_added", function (snapshot) {
            const messages = snapshot.val();
            let message ='';
            // if(messages.member==userid){
            //    snapshot.ref.update({'read_status':1});
            // }


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
                  <img src="{{$sender_profile_image}}" class="img-circle" onerror="this.onerror=null;this.src='{{default_image()}}';">
                  </span>
                  <div class="chat-body1 clearfix">
                     <div class="chat_time">${messages.time}</div>
                     <p>${messages.message}</p>
                  </div>
               </li>`;
            }
            // append the message on the page
            $('#allChatMessages').append(message);
         
         // document.getElementById("allChatMessages").innerHTML += message;
         scrollToBottom()
         });
         
         $(document).ready(function(){
            console.log();
            // check and save room id in database
            savechat('{{$newchatroomid}}');

            // messgage sectio scroll to bottom
            scrollToBottom()

            // save message in firebase using enter key press
            $('#textMessage').keyup(function(e){
               
               if(e.which==13 && $(this).val().length>1){
                  $("#sendMessage").trigger('click');
               }
            })

            // save message in firebase
            $("#sendMessage").click(function(){
                let datetime = currentdatetime();
               var text = $('#textMessage').val();
               // var img_value_assgin = $('#img_value_assgin').val();
               if (text?.trim().length>0) 
               { 
                  var member_id = '{{$to_member_id}}';
                  var user_id = '{{Auth::user()->id}}';
                  const obj = {'user_id':user_id,'message':text,'member':member_id,'time':datetime,'read_status':0};
                  mychatroomdata.push(obj);
                  $('#textMessage').val('');
               }
               //savechat('{{$newchatroomid}}');
            });
         })
         

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

function scrollToBottom() {
   let section_height =  $(document).height()-$('#allChatMessages').height();
   // console.log('ssss',$('.chat-height').height(),$('#allChatMessages').height());
   // $(".chat-height").animate({ scrollTop: $('#allChatMessages').height()}, 'slow');
   $(".chat-height").scrollTop( $("#allChatMessages")[0].scrollHeight);
}


function savechat(param){
   console.log('save_chatid',param);
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