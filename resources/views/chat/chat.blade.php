@extends('master')

 @section('title')
    Chat
@endsection
   
@section('content')
   <div class="panel-body">  
    <chat inline-template>

    You are logged in!

    <hr>

    <h2>Write something to all users</h2>
    
    <form>
    <input type="text" class="form-control" placeholder="something" required="required" v-model="newMsg" @keyup.enter="press()">

   <input type="button" @click="click()">Send</button>
   
   </form>
    <hr>
    <h3>Messages</h3>

    <ul v-for="post in posts">
    <b>@{{ post.username }} says:</b> @{{ post.message }}</li>
    </ul>

    </chat>
</div><!-- panel-body --> 
@endsection

