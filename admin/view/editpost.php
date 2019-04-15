<?php include('header.php');
include('../controller/postcontroller.php');
$post_id = $_GET['id'];
require '../controller/setting.php';
global $site_url;

$editpost = new postcontroller();

$fetch_post = $editpost -> selectEditPost($post_id);
//print_r($fetch_post);die;
foreach ($fetch_post as $key => $value) {
 	$posttitle = $value['post_title'];
 	$postcontent = $value['post_content'];
 	$seotitle = $value['seo_title'];
 	$metatitle = $value['meta_title'];
 	$metakeyword = $value['meta_keywords'];
 	$date = $value['added_date'];
 } 
if (isset($_POST['updatepost'])) {
	$editpost -> updatePost($post_id);
}
$image = $editpost -> getImageforPost($post_id);
//var_dump($image)
if (isset($_POST['delete_Image'])) {
  $editpost -> deletePostImage($post_id);
}
?>

<div class="container mt-0 border p-4 bg-light rounded">
<form method="POST" enctype="multipart/form-data" >
  
<div>
  <label for="title">Post title</label>
    <input type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Enter post title" name="posttitle" value="<?php echo $posttitle; ?>" required>
</div>

<div class="form-group">
    <label for="exampleFormControlTextarea1">Post Content</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="postcontent" required> <?php echo $postcontent ?></textarea>
 </div>
  <script src="<?php echo $site_url; ?>admin/view/ckeditor/ckeditor.js"></script>
  <script>
    CKEDITOR.replace('postcontent');
  </script>

<div>
  <label for="title">SEO title</label>
    <input type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Enter seo title" name="seotitle" value="<?php echo $seotitle?>" required>
</div>

<div>
  <label for="title">Meta title</label>
    <input type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Enter meta title" name="metatitle" value="<?php echo $metatitle?>" required>
</div>

<div>
  <label for="title">Meta keyword</label>
    <input type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Enter meta keybord" name="metakeyword" value="<?php echo $metakeyword?>" required>
</div>

<div class="form-group"><label for="start">Date</label>
		<input type="date" id="start" name="date"
       value="2019-07-22"
       min="2019-01-01" max="2019-12-31">
  	</div>

<div class="form-group">
    <?php foreach ($image as $key => $value) {
      $image = $value['image_name'];
      $imagepath = $site_url.'admin/static/image/'.$image; ?>
      <a href="editpage.php?id=<?php echo $value['id']?>"><button type="submit" class="close mr-3 my-5"  aria-label="Close" name='delete_Image' onclick="return confirm('are you sure want to delete?')">
      <span aria-hidden="true" class="float-right">&times;</span>  
      <?php echo '<img class="site-img border p-1 m-1" src =' .$imagepath.'>';}?>
      </button></a>
  </div>

<button type="submit" class="btn btn-primary" name="updatepost">update Post</button>
</form>
</div>