@extends('master')

@section('title')
{{$folders->name}}
@endsection

@section('head-js')
<style>
      body {
        display: flex
      }
      #views {
        border-collapse: collapse;
        margin: 10px;
      }
      #views tr {
        border: 0;
        border-top: 1px solid #e0e0e0;
      }
      #views td {
        border-bottom:1px solid #e0e0e0;
        border-spacing: 0;
        padding: 5px
      }
      #viewsb {
        border-collapse: collapse;
        margin: 10px;
      }
      #viewsb tr {
        border: 0;
        border-top: 1px solid #e0e0e0;
      }
      #viewsb td {
        border-bottom:1px solid #e0e0e0;
        border-spacing: 0;
        padding: 5px
      }
    </style>

    <script type="text/javascript">
      var developerKey = 'AIzaSyBP14aVsZj67TWB2d3I7ZRkvzQhCs0dkII';
     var clientId = "821660307361-afujlp3gvd3mi2mmc10k087f5d38hf0j.apps.googleusercontent.com";
     
     var scope = [
      'https://www.googleapis.com/auth/drive',
      'https://www.googleapis.com/auth/photos',
      'https://www.googleapis.com/auth/youtube',

    ];

    var authApiLoaded = false;
    var pickerApiLoaded = false;
    var oauthToken;
    var viewIdForhandleAuthResult;

    // Use the API Loader script to load google.picker and gapi.auth.
    function onApiLoad() {
      gapi.load('auth', {'callback': onAuthApiLoad});
      gapi.load('picker', {'callback': onPickerApiLoad});
    }

    function onAuthApiLoad() {
      authApiLoaded = true;
    }

    function onPickerApiLoad() {
      pickerApiLoaded = true;
    }

    function handleAuthResult(authResult) {
      if (authResult && !authResult.error) {
        oauthToken = authResult.access_token;
        createPicker(viewIdForhandleAuthResult, true);
      }
    }

    // Create and render a Picker object for picking user Photos.
    function createPicker(viewId, setOAuthToken) {
      if (authApiLoaded && pickerApiLoaded) {
        var picker;
        
        if(authApiLoaded && oauthToken && setOAuthToken) {
          picker = new google.picker.PickerBuilder().
            addView(viewId).
            setOAuthToken(oauthToken).
            setDeveloperKey(developerKey).
            setCallback(pickerCallback).
            build();
        } else {
          picker = new google.picker.PickerBuilder().
            addView(viewId).
            setDeveloperKey(developerKey).
            setCallback(pickerCallback).
            build();
        }
        
        picker.setVisible(true);
      }
    }

      // A simple callback implementation.
      function pickerCallback(data) {
        var url = 'nothing';
        
        if (data[google.picker.Response.ACTION] == google.picker.Action.PICKED) {
          var doc = JSON.stringify(data[google.picker.Response.DOCUMENTS][0], null, "  ");
        }
        var json = JSON.parse(doc);
        document.getElementById('result_upload').value = doc;
    
        document.getElementById('result').innerHTML = 'You Picked: '+json['name'];
        request = window.gapi.client.request({
          path: '/drive/v2/files/'+json['id']+'/permissions',
          method: 'POST',
            body: {
           role: 'reader',
           type: 'anyone'
          }
            });
          request.execute(function (res)  {
          console.log(res);
            })
      }
    </script>

@endsection

@section('content')
<script>
 
      function opencreatefolder(){
        $('.ui.createfolder.modal')
        .modal('show');
      }

</script>
<br>
<br>


<div class="ui massive breadcrumb">
@if($folders->position == 0)
<a href="{{url('folder/'.$folders->id)}}">{{$folders->name}}</a>
<span class="divider"> / </span>

@if($folders->position != 0)
@endif

@php
$root_folder_id = $folders->id;
$container_folder_id = $folders->id;
$position = 1;
@endphp
@else
@php
$position = $folders->position + 1;
$container_folder_id =$folders->id;
$root_folder_id;
if($position == 1){
$root_folder_id = $folders->id;
}else{
  $root_folder_id = $folder->root_folder_id;
}

@endphp

@endif


<div data-tooltip="Add A Folder" onclick="opencreatefolder()"> -  <i class="add circle icon" ></i></div>
</div>
<br>
<br>
<h4>Description: {{$folders->description}}</h4>


<table id="views">

      <tr>
        <td><a href="#DOCS_UPLOAD" class="ui blue button" id="DOCS_UPLOAD">Upload to GoogleDrive</a></td>
      </tr>
      <tr><td>
      <form action ="{{route('upload.file', $folders->id)}}" method="POST">
      {{csrf_field()}}      
      <input type ="hidden" name="result_upload" id="result_upload" value=""/>
      <button type="submit" class = "ui green button">Save</button>
    </td></tr>

    @php 
session_start();
$_SESSION['folder_id'] = $folders->id;
@endphp
    </form>
    </table>
<table id="viewsb">
<tr><td>
<a href="{{route('onedrive.page')}}" class="ui blue button" > Upload to OneDrive</a>    
</td>
</tr>
</table>



<h3>&nbsp;&nbsp;&nbsp;Files</h3>
@if($files->count() == 0)
<h2>&nbsp;&nbsp;&nbsp;No Files Yet </h2>
@else

<div class="ui inverted segment">
@foreach($files as $file)

  <div class="item">
  <!--  
  <i class="large github middle aligned icon"></i>
    -->  
  <div class="content">
  <img src="{{$file->icon}}">    
  <a class="header" href="{{$file ->view_link}}" target="_blank">{{$file->file_name}}</a>
      <div class="description">{{$file->created_at->diffForHumans()}} by <a>{{"@".$file->user->username}}</a></div>
     <br>
      <a class="ui green button" href="{{$file->download_link}}" download> Download </a>
      @if(Auth::user()->role == 2 || Auth::user()->id == $file->file_owner)
      <a class="ui red button" href="{{route('delete.file',$file->id)}}"> Delete This file</a>
      @endif
    </div>
  </div>
  <hr>
@endforeach
    </div>
@endif    

    <!-- The Google API Loader script. -->
    <script type="text/javascript" src="https://apis.google.com/js/api.js?onload=onApiLoad"></script>
    <script type="text/javascript">

Array.prototype.forEach.call(document.querySelectorAll('#views a'), function (ele) {
        ele.onclick = function () {
          var viewIds = {
            "DOCS_UPLOAD": new google.picker.DocsUploadView()
            }

            var id = this.id;
            var viewId = viewIds[id];
            var setOAuthToken = true;
          
          if (id === 'IMAGE_SEARCH' ) {
            setOAuthToken = false;
            createPicker(viewId, setOAuthToken);
          } else {

            if(authApiLoaded && !oauthToken) {
              viewIdForhandleAuthResult = viewId;
              window.gapi.auth.authorize(
                {
                  'client_id': clientId,
                  'scope': scope,
                  'immediate': false
                },
                handleAuthResult
              );
            } else {
              createPicker(viewId, setOAuthToken);
            }
          }
      
          return false;
        }
      });
</script>

<div class="ui createfolder modal">
<div class="header">Create Folder in {{$folders->name}}</div>
<div class="content">
<p>Create another folder inside another folder</p>

<form action="{{url('createFolder')}}" method="post" class="ui form">
{{csrf_field()}}
<input type="hidden" name="root_folder_id" value="{{$root_folder_id}}"/>
<input type="hidden" name="container_folder_id" value="{{$container_folder_id}}"/>
<input type="hidden" name="position" value="{{$position}}"/>

<div class="field">
<label>Folder Name</label>
<div class="ui fluid icon input">
<input type="text" name="name" placeholder="Folder's Name"/> 
</div> 
</div>

<div class="field">
<label>Description</label>
<div class="ui form input">
<textarea type="text" name="description" placeholder="A folder's Description" class="form-control"
style="resize:none"
></textarea>
</div>
</div>
<input type="hidden" name="group_id" value="{{$folders->group_id}}">
<button type="submit" class="ui green button" >Save</button>
</form>
</div>
</div>

@endsection