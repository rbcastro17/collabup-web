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
    </style>

    <script type="text/javascript">
      var developerKey = 'AIzaSyCfD_BDKlRfJZvD_sdaLan0R615bm3GxZs';
     var clientId = "143151261536-nqvf0q82o4noeo517hlqlhlge5i9fq1c.apps.googleusercontent.com";

      var scope = [
        'https://www.googleapis.com/auth/drive',
        'https://www.googleapis.com/auth/photos',
        'https://www.googleapis.com/auth/youtube' 
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
      }
    </script>

@endsection

@section('content')
<table id="views">
      <tr>
      <center>
        <td><a class="ui blue button" href="#DOCS_UPLOAD" id="DOCS_UPLOAD"</a>Upload documents to Google Drive.</a></td>
      </center>
      
    </table>

    <pre id="result"></pre>

    <form action ="{{route('upload.file', $folders->id)}}" method="POST">
      {{csrf_field()}}      
      <input type ="hidden" name="result_upload" id="result_upload" value=""/>
      <button type="submit" class = "fluid ui green button">Save</button>
    </form>

    <center><h3>Or...</h3></center>
<br>
<?php 
session_start();
$_SESSION['folder_id'] = $folders->id;
?>
<a href="{{route('onedrive.page')}}" class="fluid ui blue button" > Upload to OneDrive</a>


<h3>Files</h3>
@if($files->count() == 0)
<h2>No Files Yet </h2>
@else

<div class="ui inverted segment">
@foreach($files as $file)

  <div class="item">
  <!--  
  <i class="large github middle aligned icon"></i>
    -->  
  <div class="content">
  <img src="{{$file->icon}}">    
  <a class="header" href="{{$file->view_link}}" target="_blank">{{$file->file_name}}</a>
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
          
          if (id === 'IMAGE_SEARCH' || id === 'MAPS' || id === 'VIDEO_SEARCH') {
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

@endsection