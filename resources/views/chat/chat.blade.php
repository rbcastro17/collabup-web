
@extends('master')

 @section('title')
    {{$group->group_name}} | Chat 
@endsection

<script src="https://www.gstatic.com/firebasejs/4.6.0/firebase.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

<script>
  // Initialize Firebase
  // TODO: Replace with your project's customized code snippet
  var config = {
    apiKey: "AIzaSyDqDH5zOwoFw_3QUiyGWOcGaSwlhkabcbI",
//    authDomain: "<PROJECT_ID>.firebaseapp.com",
    databaseURL: "https://collabupchat-70ad8.firebaseio.com",
//    messagingSenderId: "<SENDER_ID>",
  };
  firebase.initializeApp(config);

var database = firebase.database();
                <?php
                $group_roomid= $group->id."-".$group->group_name. "-".$group->code; 
                ?>

    database.ref().child("{{$group_roomid}}").on('value', function(snapshot){
        if(snapshot.exists()){
            var content = '';
       
       snapshot.forEach(function(data){
            var val = data.val();

            content += '<div class="item">';
            content += '<image class="ui avatar image" src="https://semantic-ui.com/images/avatar/small/veronika.jpg" />';
            content += '<div class="content">';
            content += '<a class="header">'+ val.name+'</a>';    
            content += '<div class="description">'+val.msg+'</div>';        
            content += '</div> </div>';
            
       });
        $('#messagefeed').append(content);
        }

    }); 



function sendMessage(){
    var dbRef = firebase.database();

var contactsRef = dbRef.ref().child('{{$group_roomid}}');   
contactsRef.push({
  name: '{{Auth::user()->username}}',
  msg: document.getElementById("messagetext").value
}).then(function(){
    document.getElementById("messagetext").value = " ";
    var mydiv = $("#messagefeed");
mydiv.scrollTop(mydiv.prop("scrollHeight"));
});

}


</script>   
@section('content')
<h3>Chat Room: {{$group->name}}</h3>

<div class="ui list" id="messagefeed" style="
overflow: auto; max-height: 400px;   
    width: 100%;
">
                        
            </div>   


<div class="ui fluid large action input">
<input id="messagetext" type="text" placeholder="Something to say..."  onkeydown = "if (event.keyCode == 13)
                        document.getElementById('btnsend').click()">
<button id="btnsend"class="ui button" onclick="sendMessage()">Send</button>
</div>

@endsection

