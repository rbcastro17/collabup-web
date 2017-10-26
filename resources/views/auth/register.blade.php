@extends('master')

@section('title')
Register
@endsection

@section('content')
<br>
<br>
<br>
<form action="{{route('auth.register')}}" method="post" class="ui form" style="margin-top: -100px">
    {{csrf_field()}}
    
    
 <h4 class="ui horizontal divider header">
  <i class="user icon"></i>
  Personal Information
</h4>
   
   <br><br>
    
  <div class="ui form">
  <div class="three fields">
     
     <div class="field{{$errors->has('first_name')? ' error' : ''}}">
        <label for="">First Name</label>
        <div><input type="text" name="first_name" id="first_name" placeholder="First Name" value="{{Request::old('first_name')}}">
        </div>
    </div>
    <div class="field{{$errors->has('middle_name')? ' error' : ''}}">
        <label for="">Middle Name</label>
        <div><input type="text" name="middle_name" id="middle_name" placeholder="Middle Name" value="{{Request::old('middle_name')}}">			</div>
    </div>
    <div class="field{{$errors->has('last_name')? ' error' : ''}}">
        <label for="">Last Name</label>
        <div><input type="text" name="last_name" id="last_name" placeholder="Last Name" value="{{Request::old('last_name')}}">
        </div>
    </div>
    
     </div>
	</div>
  

  <br>
   
   <div class="ui form">
  <div class="two fields">
    
    <div class="field{{$errors->has('email')? ' error' : ''}}">
        <label for="">Email</label>
        <div><input type="email" name="email" id="email" placeholder="Email" value="{{Request::old('email')}}"></div>
    </div>
    <div class="field{{$errors->has('username')? ' error' : ''}}">
        <label for="">Username</label>
        <div><input type="text" name="username" id="username" placeholder="Username" value="{{Request::old('username')}}"></div>
    </div>
    
    </div>
	</div>
  
  
  <br>
   
   <div class="ui form">
  <div class="two fields">
    
    <div class="field{{$errors->has('password')? ' error' : ''}}">
        <label for="">Password</label>
        <div><input type="password" name="password" id="password" placeholder="Password"></div>
    </div>
    <div class="field">
        <label for="">Confirm Password</label>
        <div><input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
        </div>
    </div>
    
    </div>
	</div>
  
  <br><br>
   
<h4 class="ui horizontal divider header">
  <i class="circle notched icon"></i>
  Captcha
</h4>
    
    <center>
    
    <div class="field{{$errors->has('g-recaptcha-response')? ' error' : ''}}">
        {!! app('captcha')->display() !!}
    </div>
    
    <br><br>

    <button type="submit" class="ui green button">Submit</button>
    
     </center>
</form>

@endsection