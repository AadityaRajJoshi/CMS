<?php include('header.php');
include ('../controller/imageslidercontroller.php');
require '../controller/setting.php';
global $site_url;
$imageSlider = new imageslidercontroller;

$imagecontent = $imageSlider -> displayImagedescription();

if(isset($_POST['delete_image'])){
	//echo "delete";die;
 	 $imageSlider->deleteImage();
 		
 }


?>

<div class="container mt-0 border p-4 bg-light rounded">
  
<table class="table table-bordered table-dark table-stripped">
  <thead>
    <tr>
      <th scope="col">Image ID</th>
      <th scope="col">Image Title</th>
      <th scope="col">Image description</th>
      <th scope="col">Edits</th>
    </tr>
  </thead>

  <tbody>
  	<?php
  	foreach ($imagecontent as $key => $value) {?>
  	<tr>	
  	<th scope="row"><?php echo $value['image_id']?></th>
      <td><?php echo $value['image_title'] ?></td>
      <td><?php echo $value['image_description'] ?></td>
      <td><a href="<?php echo $site_url ?>admin/editimage/<?php echo $value['image_id']?>"><button type="button" class="btn btn-primary float-left mr-1" name="edit">Edit</button>
      </a>
		<form method="POST" enctype="multipart/form-data" >
      <a>
      		<button type="submit" class="btn btn-danger float-left"  name='delete_image' value="<?php echo $value['image_id']?>"  onclick="return confirm('are you sure want to delete?')">Delete</button>
      	</form>
  	</td>

	</tr>
  	<?php }?>
  	 

  </tbody>

<a href="imageform"><button class="btn btn-primary float-right mb-2" type="submit" name="addpage"> Add Image</button>
  </div>
</div>
<?php include('footer.php');