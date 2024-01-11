@extends('frontend.layouts.frontLayout')
@section('content')
      <!-- header -->
      <div class="messages-section">
         <div class="container">
            <div class="row">
               <div class="col-lg-12">
                  <div class="home_text">
                     <h2>Messages</h2>
                  </div>
               </div>

               <div class="col-lg-12">
                  <div class="account-box">
                     <div class="messages-header">
                        <div class="mh-left">
                           <h3>Inbox</h3>
                           <div class="chatList-options">
                              <button id='chat_list' class="activeChat">Chat List</button>
                              <button id='friend_list'>Friend List</button>
                           </div>
                        </div>
                        <button class="newMessage">0 New Messages</button>
                     </div>
                     
                     <!-- chat -->
                     <div class="chat_container wow fadeInDown">
                        <div class="col-lg-3 chat_sidebar">
                           <div class="chatList-container chat-scrollBar">
                              <div class="member_list chat-list" id="style-4">
                                 <ul class="list-unstyled all-frnd-records-live">
                                    {{-- @include('frontend.messages.friends-list') --}}
                                    @if(isset($allfriends_list['total_friends_count']) && $allfriends_list['total_friends_count']>5)
                                    {{-- <button onclick="load_more_friends()">Load More</button> --}}
                                    @endif
                                 </ul>
                              </div>

                              <div class="member_list friend-list hide" id="style-5">
                                 <ul class="list-unstyled all-frnd-records">
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
                           
                        @endif
      
                        <!--chat_sidebar-->
                        <div class="col-sm-8 col-md-9 message_section" >
                           <div class="row">
                              <div class="chatContainer">
                                 <div class="new_message_head">
                                    <div class="">
                                       <!-- <button><i class="fa fa-plus-square-o" aria-hidden="true"></i> New Message</button> -->
                                       <div class="media">
                                          <div class="media-left">
                                             <a href="javascript:void(0);" class="profile-image">
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
                                 <div class="chat_area chat-height chat-scrollBar" id="style-4">
                                    <ul class="list-unstyled" id="allChatMessages">
                                       
                                    </ul>
                                 </div>
                                 <!--chat_area-->
                                 <div class="message_write message-footer-btn">
                                    <div class="textarea-box">
                                       <textarea class="form-control" placeholder="Type your message here....." id="textMessage"></textarea>
                                       <a href="javascript:void(0);" class="pull-right btn btn-sentbtn" id="sendMessage">Send Message</a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!--message_section-->
                     </div>
                  </div>
                  <!-- account-box -->
               </div>
            </div>
           
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
      <input name="chat_memberid" type="hidden" value="{{$to_member_id}}"/>
      <script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-app.js"></script>
      <script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-firestore.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
     
      <script type="module">
         // Import the functions you need from the SDKs you need
         import { initializeApp } from "https://www.gstatic.com/firebasejs/9.6.10/firebase-app.js";  
         import { doc, getFirestore } from "https://www.gstatic.com/firebasejs/9.6.10/firebase-firestore.js";  
            var arr = []
            // twinky
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
      var firestore = firebase.firestore();

      let api_data = [];
      axios.get("https://devfolio.co.in/spring-verse/api/getmemberdata/"+userid+"").then(response =>{
         api_data = response.data.data;
         getChats(api_data)
      }).catch((err)=>{
         console.log(err, 'error');
      })

      var get_memberid = '{{(isset($_GET["mmid"]) && $_GET["mmid"]!='') ? $_GET["mmid"] : 0 }}';
         
      // live chat list from firestore start
      let logged_in_user = '{{Auth::user()->id}}'; 
      
      function getChats(chatArray){
         const chatArrayRoomId = chatArray.map((item) => item.chat_room_id)
         let chat_ref = firestore.collection('chats');
         chat_ref.orderBy('current_time','desc').onSnapshot(async(snap)=>{
            let msgs = snap.docs.map((item) => item.id)
            snap.docs.map((doc,index_in)=>{
               let filteredMsg = arr.filter(item => item.id === doc.id)
               let filteredIndex = arr.findIndex(item => item.id === doc.id)
               if(chatArrayRoomId.indexOf(doc.id)>=0){
                  if(filteredMsg.length === 0){
                     arr.push({id:doc.id,msg:'',lastTime:'',count:0,chatId:'',member:''});
                  } else {
                     arr[filteredIndex] = {id:doc.id,msg:'',lastTime:'',count:0,chatId:'',member:''}
                  }
               }
            })
            arr.sort(function (a, b) {
               console.log(a,a.id,msgs,msgs.indexOf(a.id),b.id,msgs.indexOf(b.id))
               return msgs.indexOf(a.id) - msgs.indexOf(b.id);
            })
            console.log(arr, "arr");
            arr.map(async(chat,index)=>{
               console.log(chat,"chat");
               let messages_ref = firestore.collection('chats').doc(chat.id).collection('messages');
               await messages_ref.orderBy('time','desc').limit(1).onSnapshot(async items=>{
                  console.log(items.docs,"items");
                  items.docs.map(async (response,index)=>{
                     console.log(response, "response");
                     if(logged_in_user == response.data().member || logged_in_user == response.data().user_id){
                        await messages_ref.orderBy('time').onSnapshot(async (snapshot)=>{
                           let count = 0;
                           snapshot.docs.map((doc_msg)=>{
                              let messages = doc_msg.data()
                              if(messages.member === userid){
                                 if(messages.read_status === 0){
                                    count = count+1;
                                 }
                              }
                           });
                           
                           let chatid = (response.data().member==logged_in_user) ? response?.data().user_id : response.data().member;
                           let index = arr.findIndex(item => item.id === chat.id );
                           arr[index].msg = response.data().message;
                           arr[index].lastTime = response?.data().time;
                           arr[index].member = response.data().member;
                           arr[index].count = count;
                           arr[index].user = response.data().user_id;
                           
                           let countMsg = arr.filter(item => item.msg != '')
                           if(countMsg.length === arr.length) {
                              console.log(countMsg.length === arr.length, "countMsg.length === arr.length")
                              generate_html(arr);
                           }
                        })
                     }
                  })
               })
            })
         })
      }
         
      // live chat list from firestore end
      
      $(document).ready(function(){
         $('#textMessage').keyup(function(e){ 
            if(e.which==13 && $(this).val().length>1){
               $("#sendMessage").trigger('click');
            }
         })

         savechat('{{$newchatroomid}}');
         // save message in firebase
         $("#sendMessage").click(function(){
            let datetime = currentdatetime();
            var text = $('#textMessage').val();
            if (text?.trim().length>0) 
            {
               let member = $("input[name='chat_memberid']").val();
               console.log(member,'to_member_id',userid,"user_id")
               let room_id = $('.'+member).attr('data-chatroomid');

               var member_id = '{{$to_member_id}}';
               var user_id = '{{Auth::user()->id}}';
               let obj = {'user_id':userid,'message':text,'member':member,'time':datetime,'read_status':0};
               let obj2 = {'user_id': userid, 'member': member, current_time: datetime};
               console.log('obj2',obj2,'obj',obj, 'newchatroomid','{{$newchatroomid}}', room_id);
               console.log('{{$newchatroomid}}', room_id, room_id ? room_id : '{{$newchatroomid}}');
               firestore.collection('chats').doc(room_id ? room_id : '{{$newchatroomid}}').set(obj2);
               firestore.collection('chats').doc(room_id ? room_id : '{{$newchatroomid}}').collection('messages').doc().set(obj);
               $('#textMessage').val('');
            }
         });
      })
        
$("#chat_list").click(function(){
   $('.chat-list').removeClass('hide');
   $('.chat-list').addClass('show');
   $('#chat_list').addClass('activeChat');
   $('#friend_list').removeClass('activeChat');
   $('.friend-list').removeClass('show');
   $('.friend-list').addClass('hide');
})

$("#friend_list").click(function(){
   $('#chat_list').removeClass('activeChat');
   $('#friend_list').addClass('activeChat');
   $('.chat-list').removeClass('show');
   $('.chat-list').addClass('hide');
   $('.friend-list').removeClass('hide');
   $('.friend-list').addClass('show');
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
      let hours = dt1.getHours() < 10 ? "0"+dt1.getHours() : dt1.getHours();
      let minutes = dt1.getMinutes() < 10 ? "0"+dt1.getMinutes() : dt1.getMinutes();
      lastmsg = hours+':'+minutes
   }
   if(format==''){
   return lastmsg;
   }else{
      let diff_new = (dt2.getTime() - dt1.getTime()) /(1000*60)
      return Math. abs(Math. round(diff_new));
   }
}

function scrollToBottom() {
   let section_height =  $(document).height()-$('#allChatMessages').height();
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

async function generate_chat_data(room_id,api_data){
   let image = '';
   if(api_data !== ''){
      console.log('api_data',api_data);
      await axios.get("https://devfolio.co.in/spring-verse/api/getsinglememberdata/"+api_data+"").then(response =>{
         image = response.data.data.profile_image
      })
   }else{
      image = '{{$sender_profile_image}}';
   }
   
   let collection_ref = firestore.collection('chats').doc(room_id).collection('messages');
   collection_ref.orderBy('time','asc').onSnapshot((snapshot)=>{
      $('#allChatMessages').html('');
      let message ='';
      snapshot.docs.map(doc => {
         let messages = doc.data()
         console.log(messages, 'messages');
         if(messages.member === userid && messages.read_status == 0){
            collection_ref.doc(doc.id).update({
               read_status: 1
            }).then(() => {
               console.log("Document successfully updated!");
            }).catch((err)=>{
               console.log(err,'error doc')
            })
         }
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
               <img id="headerImage" src="${image}" class="img-circle" onerror="this.onerror=null;this.src='{{default_image()}}';">
               </span>
               <div class="chat-body1 clearfix">
                     <div class="chat_time">${messages.time}</div>
                     <p>${messages.message}</p>
               </div>
            </li>`;
         }
      });
      $('#allChatMessages').append(message);
      scrollToBottom();
   })
}

function generate_html(array, callback){

   let count = array.filter(item => item.msg != '')
   if(count.length ===  array.length){
         $('.all-frnd-records-live').html('')
         let totalCount = 0;
         array.map((result)=>{
            api_data.map((api_response)=>{
               if(result.id == api_response.chat_room_id){
                  if(result.count>0){
                     totalCount = totalCount + 1;
                  }
                  $('.message-count').text(totalCount);
                  let chatid = (result.member==logged_in_user) ? result.user : result.member;
                  let activeClass = (get_memberid==chatid) && get_memberid != 0 ? 'active' : /* get_memberid == 0 &&  ? "active" : */ array.length === 1 ? 'active' : '';
                  var li_html = '<li id="'+result.id+'" class="left clearfix chat_member '+chatid+' '+activeClass+'" data-chatroomid="'+result.id+'" data-memberid="'+result.member+'">';
                  var innerLiHtml = '<a href="{{route("messages")}}?mmid='+chatid+'"><span class="chat-img"><img src="'+api_response.profile_image+'" alt="..." class="img-circle"/></span><div class="chat-body clearfix"><div class="header_sec"><h5 class="primary-font">'+api_response.full_name+'</h5>'+(result.count > 0 ? '<span class="unread-count">'+result.count+'</span>' : '')+'</div><div class="msg-dec"><p class="lastmesg">'+(result.msg.length > 40 ? result.msg.substring(0,40)+".." : result.msg)+'</p><span class="chat-time lastmsgtime">'+diff_minutes(result.lastTime)+'</span></div></div></a>';
                  if(get_memberid == 0){
                     let default_selected = document.getElementById(array[0].id);
                     default_selected.classList.add("active");
                     if(array[0].id == api_response.chat_room_id){
                        let member_id = (array[0].member==logged_in_user) ? array[0].user : array[0].member;
                        console.log(member_id, 'member_id');
                        generate_chat_data(arr[0].id, member_id);
                        // $to_member_id = member_id;
                        $("input[name='chat_memberid']").val(member_id);
                        console.log($("input[name='chat_memberid']").val(),'val');
                        $('.new_message_head .media-heading').text(api_response.full_name);
                        $('.profile-image .media-object').attr("src",''+api_response.profile_image+'');
                     }
                  }else{
                     let current_member = '{{$to_member_id}}'
                     if(chatid == current_member){
                        generate_chat_data(result.id, '');
                     }
                  }
                  if($('[data-chatroomid="'+result?.id+'"]').length === 0) {
                     $('.all-frnd-records-live').append(li_html+innerLiHtml+'</li>');
                  }else{
                     const context = document.getElementById(result.id)
                     context.querySelectorAll('.lastmesg')[0].innerHTML = result.msg
                     context.querySelectorAll('.lastmsgtime')[0].innerHTML = diff_minutes(result.lastTime)
                     context.querySelectorAll('.unread-count')[0].innerHTML = result.count;
                  }
               }
            })
         })
      
   }
}

function currentdatetime(){
   const d = new Date();
   let date = moment(d).format('MM/DD/YYYY');
   let time = moment(d).format("LTS");
   let datetime = date+' '+time;
   console.log(datetime, "datetime")
   return datetime;
}


// var firestoreNew1 = firebase.firestore();
         // let chat_ref1 = firestoreNew1.collection('chats');
         // let arr = [];
         // let chatsDesc = await chat_ref.orderBy('current_time','desc').get()
         // console.log('desc',chatsDesc)
         // //chat_ref.orderBy('current_time','desc').get().then((items) =>{
         //    console.log(chatsDesc.docs, 'imple')
         //    chatsDesc.docs.map((doc) => {
         //       arr.push(doc.id)
         //    })
         //    Object.freeze(arr)
         //    console.log(arr, 'arr')

         // $('.chat_member').each(async(index, item)=>{
            // console.log(item,'item')
         //   let chat_ref = firestore.collection('chats');
         //    chat_ref.onSnapshot(async(snap)=>{
         //      let memberid_attr = $(item).attr('data-memberid');
         //      await snap.docs.map((doc,index_in)=>{
         //       console.log($(item).attr('data-chatroomid'),doc.id);
         //       let id_attr = $(item).attr('data-chatroomid');
         //       console.log(id_attr)
         //       if(id_attr === doc.id){
         //          firestore.collection('chats').doc(doc.id).collection('messages').orderBy('time','desc').limit(1).onSnapshot(items=>{
         //             items.docs.map((res)=>{
         //                console.log(res.data().member);
         //                console.log(memberid_attr)
         //                let activeClass = (get_memberid==doc.data().member) && get_memberid != 0 ? 'active' : '';
         //                var li_html = '<li id="'+doc.id+'" class="left clearfix chat_member '+activeClass+'" data-chatroomid="'+doc.id+'" data-memberid="'+doc.data().member+'" data-index="'+counter+'">';
         //                   // console.log($('[data-chatroomid="'+doc.id+'"]').length, 'roomid12334') 
         //                var item_html = $(item).html();
         //                $(item).find('.lastmesg').text(res.data().message)
         //                $(item).find('.lastmsgtime').text(diff_minutes(res.data().time))
         //                if(res.data().member == memberid_attr){
         //                   console.log($(item))
         //                }
         //                $(item).remove()
         //                console.log('here',res.data().time,diff_minutes(res.data().time,'sec'));
         //                console.log(counter, 'counter',index_in);
         //                if(get_memberid>0) {
         //                   $('.show-loader-frndlist').addClass('hide');
         //                   $('.all-frnd-records').removeClass('hide');
         //                }
         //                if(counter == 0){
         //                   counter = counter + 1;
         //                   // if($('[data-chatroomid="'+doc.id+'"]').length)
         //                   $('.all-frnd-records').prepend(li_html+item_html+'</li>');
         //                   if(get_memberid == 0){
         //                      window.location.assign('https://devfolio.co.in/spring-verse/newchat'+doc.data().member ? '?mmid='+doc.data().member : '')
         //                   }
         //                }else if(counter > 0){
         //                   console.log(counter,'counter_else')
         //                   if($('[data-chatroomid="'+doc.id+'"]').length === 0) {
         //                      $(li_html+item_html+'</li>').insertAfter(".all-frnd-records li:nth-child("+counter+")");
         //                   } else {
         //                      const context = document.getElementById(doc.id)
         //                      context.querySelectorAll('.lastmesg')[0].innerHTML = res.data().message
         //                      context.querySelectorAll('.lastmsgtime')[0].innerHTML = diff_minutes(res.data().time)
         //                      // console.log(context.querySelectorAll('.unread-count'), 'here')
         //                   }
         //                   counter = counter + 1;
         //                }
         //                // $('.all-frnd-records').prepend(li_html+item_html+'</li>');
         //             })
         //          })
         //       }else{
         //          $('.show-loader-frndlist').addClass('hide');
         //          $('.all-frnd-records').removeClass('hide');
         //       }
         //       // console.log(doc.id);
         //    })
         //    console.log('sss');
         //    $('.all-frnd-record li:first-child').trigger('click');
         //    console.log('cccc');
         // })
         //    console.log($(item).attr('data-chatroomid'), 'here')
         //    if($(item).attr('data-chatroomid') && $(item).attr('data-chatroomid')!==''){
         //       console.log('not null')
         //       let roomid = $(item).attr('data-chatroomid');
         //       let room_mmid = $(item).attr('data-memberid');
         //       let messages_ref = firestore.collection('chats').doc(roomid).collection('messages');
         //       messages_ref.orderBy('time','desc').limit(1).onSnapshot((snapshot)=>{
         //          snapshot.docs.map((doc)=>{
         //             let messages_new = doc.data();
         //             $(item).find('.lastmesg').text(messages_new.message)
         //             $(item).find('.lastmsgtime').text(diff_minutes(messages_new.time))
         //          })
         //       })
         //       messages_ref.orderBy('time').onSnapshot((snapshot)=>{
         //          let count = 0;
         //          snapshot.docs.map((doc)=>{
         //             let messages = doc.data()
         //             if(messages.member === userid){
         //                if(messages.read_status === 0){
         //                   count = count+1;
         //                }
         //             }  
         //          })
                  
         //          if(count > 0){
         //                $(item).find('.unread-count').removeClass("hide");
         //                // console.log('not null', count, $(item).find('.unread-count').text())
         //                $(item).find('.unread-count').removeClass("hide");
         //                const context = document.getElementById(roomid)
         //                // console.log(context.querySelectorAll('.unread-count'), 'here')
         //                context.querySelectorAll('.unread-count')[0].className = 'unread-count'
         //                context.querySelectorAll('.unread-count')[0].innerHTML = count
         //             }else{
         //                $(item).find('.unread-count').addClass("hide");
         //             }
         //       })
         //    }
      //   })
</script>

