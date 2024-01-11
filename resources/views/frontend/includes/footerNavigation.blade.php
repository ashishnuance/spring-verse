<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-6">
                <div class="footer-logo">
                    <img src="{{ asset('frontend/images/SV-03-purplewhite.png') }}" alt="" style="width: 250px; left: -25px; position: relative;">
                    <p> A Global Creative Community</p>

                    <p>© {{date('Y')}} SpringVerse. All rights reserved.</p>
                </div>
            </div>
            
            <div class="col-lg-6 col-sm-6">
                <div class="footer-text">
                    <p>Follow Us On</p>
                    <ul>
                        <li>
                            <a
                                href="{{ isset(site_social_urls()->facebook) && site_social_urls()->facebook != '' ? site_social_urls()->facebook : 'javascript:void:;' }}">
                                <i class="fa-brands fa-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a
                                href="{{ isset(site_social_urls()->twitter) && site_social_urls()->twitter != '' ? site_social_urls()->twitter : 'javascript:void:;' }}">
                                <i class="fa-brands fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a
                                href="{{ isset(site_social_urls()->youtube) && site_social_urls()->youtube != '' ? site_social_urls()->youtube : 'javascript:void:;' }}">
                                <i class="fa-brands fa-youtube"></i>
                            </a>
                        </li>
                        <li>
                            <a
                                href="{{ isset(site_social_urls()->snapchat) && site_social_urls()->snapchat != '' ? site_social_urls()->snapchat : 'javascript:void:;' }}">
                                <i class="fa-brands fa-snapchat"></i>
                            </a>
                        </li>
                        <li>
                            <a
                                href="{{ isset(site_social_urls()->instagram) && site_social_urls()->instagram != '' ? site_social_urls()->instagram : 'javascript:void(0):;' }}">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-app.js" type="module"></script>
<script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-firestore.js" type="module"></script>
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

    const userid = '{{(isset(Auth::user()->id)) ? Auth::user()->id : 0 }}';

    firebase.initializeApp(firebaseConfig);
    let firestore = firebase.firestore();

    let newArr = [];
    firestore.collection('chats').orderBy('current_time','desc').onSnapshot(async(snap)=>{
        snap.docs.map((doc,index_in)=>{
            let filteredMsg = newArr.filter(item => item.id === doc.id)
            let filteredIndex = newArr.findIndex(item => item.id === doc.id)
            
            if(filteredMsg.length === 0){
                newArr.push({id:doc.id,msg:'',count:0});
            } else {
                newArr[filteredIndex] = {id:doc.id,msg:'',count:0}
            }
        })
        let counter = 0;
        await newArr.map(async(chat,index)=>{
        let messages_ref = firebase.firestore().collection('chats').doc(chat.id).collection('messages')
        await messages_ref.orderBy('time','desc').limit(1).onSnapshot(async items=>{
            items.docs.map(async (response,index)=>{
                await messages_ref.orderBy('time').onSnapshot(async (snapshot)=>{
                    let count = 0;
                    snapshot.docs.map((doc_msg)=>{
                    let messages = doc_msg.data()
                    if(messages.member === userid){
                        if(messages.read_status == 0){
                            count = count+1;
                        }
                    }
                    });
                    let index = newArr.findIndex(item => item.id === chat.id );
                    newArr[index].msg = response.data().message;
                    newArr[index].count = count;

                    let countMsg = newArr.filter(item => item.msg != '')
                    if(countMsg.length === newArr.length) {
                    totalCount(newArr);
                    }
                })
            })
        })
        })
    })

    function totalCount(array){
        let totalCount = 0;
        array.map((result)=>{
            if(result.count>0){
                totalCount = totalCount + 1;
            }
        })
        $('.message-count').text(totalCount);
        $('.newMessage').text(totalCount+' New Messages');
    }
</script>