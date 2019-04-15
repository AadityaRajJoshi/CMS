<?php include('header.php');
include('../controller/imageslidercontroller.php');
require '../controller/setting.php';
global $site_url;

$image_id = $_GET['id'];

 $editimage = new imageslidercontroller;

 $fetch= $editimage->selectEditImage($image_id);

 foreach ($fetch as $key => $value) {
 	$imagetitle = $value['image_title'];
 	$imagedescription = $value['image_description'];
 }

 $displayImage = $editimage -> displayImage($image_id);

 if(isset($_POST['updateimage'])){
    $editimage ->updateImage($image_id);
   }
?>

<div class="container mt-0 border p-4 bg-light rounded">
<form method="POST" enctype="multipart/form-data" >
  
<div>
  <label for="title">Image title</label>
    <input type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Enter image title" name="imagetitle" value="<?php echo $imagetitle?>" required>
</div>

<div class="form-group">
    <label for="exampleFormControlTextarea1">Image description</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="imagecontent" required> <?php echo $imagedescription ?></textarea>
  </div>
  <script src="<?php echo $site_url; ?>admin/view/ckeditor/ckeditor.js"></script>
  <script>
    CKEDITOR.replace('imagecontent');
  </script>

<div class="form-group">
    <?php foreach ($displayImage as $key => $value) {
      $image = $value['image_name'];
      $imagepath = '../static/sliderImage/'.$image; ?>
 
      <?php echo '<img class="site-img border p-1 m-1" src =' .$imagepath.'>';}?>        
  </div>

  <div class="form-group">
    <label for="exampleFormControlFile1">Update image</label>
    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="file[]" multiple>
  </div>

   <button type="submit" class="btn btn-primary" name="updateimage">update</button>


<?php include('footer.php');
?>