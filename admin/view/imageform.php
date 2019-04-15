
<?php include('header.php'); 
include ('../controller/imageslidercontroller.php');

$imageSlider = new imageslidercontroller;

if(isset($_POST['insertimage'])){
    $imageSlider->insertImage();
    //$pagemanager -> imageUpload();
  }
?>


<div class="container mt-0 border p-4 bg-light rounded">
<form method="POST" enctype="multipart/form-data" >
  
<div>
  <label for="title">Image title</label>
    <input type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Enter image title" name="imagetitle" required>
</div>

<div class="form-group">
    <label for="exampleFormControlTextarea1">Image description</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="imagecontent" required></textarea>
  </div>
  <script src="ckeditor/ckeditor.js"></script>
  <script>
    CKEDITOR.replace('imagecontent');
  </script>


<div class="form-group">
    <label for="exampleFormControlFile1">Upload image</label>
    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="file[]" multiple>
  </div>

   <button type="submit" class="btn btn-primary" name="insertimage">Insert Image</button>
</form>
</div>