

@extends('master')

@section('title')
Upload To OneDrive | CollabUP
@endsection

@section('head-js')

@endsection

@section('content')

<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.1.4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/anchor-js/3.2.1/anchor.min.js"></script>

<script type="text/javascript" src="https://js.live.net/v7.2/OneDrive.js"></script>
<script type="text/javascript">
  function launchSaveToOneDrive(){
    var odOptions = { 
  clientId: "c8bd3d22-2300-4e85-802d-55bfce0df04a",
  action: "save",
  sourceInputElementId: "fileUploadControl",
  sourceUri:  "",
  openInNewWindow: true,
  advanced: {
  },
  success: function(files) {
    var data = JSON.stringify(files);
    document.getElementById('result_upload').value = data;
    document.getElementById('result').innerHTML = data;
   },
  progress: function(p) {  },
  cancel: function() { alert("Canceled") },
  error: function(e) { alert(Json.stringify(e)) }
     };
    OneDrive.save(odOptions);
  }
</script>

<br>        
<h3>Upload File Using OneDrive</h3>


<input id="fileUploadControl" name="fileUploadControl" class="ui button" type="file" />
<button class="ui blue button" onclick="launchSaveToOneDrive()">Save to OneDrive</button>


    <form action ="{{route('upload.file.onedrive')}}" method="POST">
      {{csrf_field()}}      
      <input type="hidden" name ="folder_id" value="{{$folder_id}}"/>
      <input type ="hidden" name="result_upload" id="result_upload" value=""/>
      <button type="submit" class = "fluid ui green button">Save</button>
    </form>

    <pre id="result"></pre>

    <script type="text/javascript" src="https://js.live.net/v7.2/OneDrive.js"></script> 
@endsection
