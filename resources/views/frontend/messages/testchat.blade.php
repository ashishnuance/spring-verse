<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Firebase RealTime Chat</title>
    {{-- <link rel="stylesheet" href="./index.css"> --}}
  </head>
  <body>
    <header>
      <h2>Firebase RealTime Chat</h2>
    </header>

    <div id="chat">
      <!-- messages will display here -->
      <ul id="messages"></ul>

      <!-- form to send message -->
      <form id="message-form">
        <input id="message-input" type="text" />
        <button id="message-btn" type="submit">Send</button>
      </form>
    </div>
    <!-- scripts -->
    <script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-database.js"></script>
    {{-- <script src="index.js"></script> --}}
    @php
    $newchatroomid = 'roomid@2@5';
    @endphp  
    {{$newchatroomid}}
    <script type="module">
        // Import the functions you need from the SDKs you need
        import { initializeApp } from "https://www.gstatic.com/firebasejs/9.17.2/firebase-app.js";
        // import { getAnalytics } from "https://www.gstatic.com/firebasejs/9.17.2/firebase-analytics.js";
        // TODO: Add SDKs for Firebase products that you want to use
        // https://firebase.google.com/docs/web/setup#available-libraries
      
        // Your web app's Firebase configuration
        // For Firebase JS SDK v7.20.0 and later, measurementId is optional
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
      
        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);
        // const analytics = getAnalytics(app);
        const db = firebase.database();
        let message="sjkasn dhahshdasdaksd";
        let username="testchat";
         db.ref("messages-{{$newchatroomid}}").set({
            username,
            message,
         });
      </script>
  </body>
</html>