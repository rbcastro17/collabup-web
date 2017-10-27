<!DOCTYPE html>
<html>
<body>

<form action="{{action('UsersController@imageupload')}}" method="post" enctype="multipart/form-data">
   
    Select image to upload:
    <input type="file" name="fileimage" id="fileimage">
    <input type="submit" value="Upload Image" name="submit">
       
               <input type="hidden" name="_token" value="{{ csrf_token() }}" >
</form>
</form
</body>
</html>

 