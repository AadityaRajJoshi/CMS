<?php include('header.php'); 
include ('../controller/postcontroller.php');
require '../controller/setting.php';
global $site_url;
$postform = new postcontroller;

$page_for_post = $postform->selectPage();

if (isset($_POST['createpost'])){
	$postform -> insertPost();
}

?>

<div class="container mt-0 border p-4 bg-light rounded">
<form method="POST" enctype="multipart/form-data" >
  
<div>
  <label for="title">Post title</label>
    <input type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Enter post title" name="posttitle" required>
</div>

<div class="form-group">
    <label for="exampleFormControlTextarea1">Post Content</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="postcontent" required></textarea>
 </div>
  <script src="<?php echo $site_url; ?>admin/view/ckeditor/ckeditor.js"></script>
  <script>
    CKEDITOR.replace('postcontent');
  </script>

<div>
  <label for="title">SEO title</label>
    <input type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Enter seo title" name="seotitle" required>
</div>

<div>
  <label for="title">Meta title</label>
    <input type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Enter meta title" name="metatitle" required>
</div>

<div>
  <label for="title">Meta keyword</label>
    <input type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Enter meta keybord" name="metakeyword" required>
</div>

<div class="form-group"><label for="start">Date</label>
		<input type="date" id="start" name="date"
       value="2019-07-22"
       min="2019-01-01" max="2019-12-31">
  	</div>

<div class="container">
    <div class="form-group">
      <label for="sel1">Select Page</label>
      <select class="form-control" id="sel1" name="selectPage">
        <option></option>
        <?php
        	foreach ($page_for_post as $key => $value) {
        		$page_title = $value['pageTitle'];
         		 $page_id = $value['id'];
          		echo '<option value=" '.$page_id.' "> '.$page_title.' </option>';
          }
         ?>
      </select>
     </div>
    </div>  

  <div class="form-group">
    <label for="exampleFormControlFile1">Upload image</label>
    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="file[]" multiple>
  </div>  	

   <button type="submit" class="btn btn-primary" name="createpost">Create Post</button>
</form>
</div>