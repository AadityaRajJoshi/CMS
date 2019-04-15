<?php include('header.php');
include('../controller/imagecontroller.php');
require '../controller/setting.php';
global $site_url;

$allImage = new Imagecontroller;

if(isset($_POST['upload_image'])){
	$allImage -> upload_image();
}
$all_image = $allImage -> display_all_Image();
//var_dump($all_image);
	
?>

<div class="container">
	<form method="POST" enctype="multipart/form-data">
	<form class ="mt-5 border p-4 bg-light rounded">
	<div class="my-5">
	<?php 
		foreach ($all_image as $key => $value) {
		 	$image_name = $value['image_name'];
		 	 $image = ''. $site_url . 'admin/static/image/'. $image_name.'';
			//var_dump($all_image);die;
    	 	echo '<img style = "width:250px; height:250px;"class="site-img border p-1 m-1" src="' .$image.'" />';
		 } 
	 ?>   
	</div>


<div class="form-group">
    <label for="exampleFormControlFile1">Upload image</label>
    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="file[]" multiple>
  </div>
  <button type="submit" class="bg-primary" name="upload_image" > Upload </button>

</form>
 </div>
</form>

<?php include('footer.php');