<?php include('header.php');
  include('../controller/pagemanagercontroller.php');
  require '../controller/setting.php';
  global $site_url;
  $page_id = $_GET['id'];
 //echo $id;die;
 $editpage = new Pagemanagercontroller;
// global $url;
// echo $url;die;

   $fetch= $editpage->selectEditPage($page_id);
   // var_dump($fetch);die;
   foreach ($fetch as $key => $value) {
   		$pagetitle = $value['pageTitle'];
   		$pagecontent = $value['pageContent'];   
    }

    $Image_Name = $editpage -> displayImage();
    //var_dump($Image_Name);die;


   if(isset($_POST['delete_Image'])){

    $editpage -> deleteImage();
   }
    
   if(isset($_POST['update'])){
    //echo "hello";die;
   	$editpage->updatePage();
   }
 ?>

 <div class="container" id="edit">
	<form method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="exampleInputEmail1">Page title</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter page title" name="pagetitle"  value="<?php echo $pagetitle?>">
  </div>

  <div class="form-group">
    <label for="exampleFormControlTextarea1">Page Content</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="pagecontent" required><?php echo $pagecontent ?></textarea>
  </div>
  <script src="<?php echo $site_url; ?>admin/view/ckeditor/ckeditor.js"></script>
  <script >
    CKEDITOR.replace('pagecontent');
  </script>

  <div class="form-group">
    <?php foreach ($Image_Name as $key => $value) {
      $image = $value;
        $imagepath = "admin/static/image/" . $image; ?>
      <a href="<?php echo $site_url ?>admin/editpage.php?id=<?php echo $page_id;?>"><button type="submit" class="close mr-3 my-5"  aria-label="Close" name='delete_Image' onclick="return confirm('are you sure want to delete?')"></a>
      <span aria-hidden="true" class="float-right">&times;</span>  
      <?php echo '<img style = "width:250px; height:250px; "class="site-img border p-1 m-1" src ='?><?php echo $site_url; echo $imagepath; '>';} ?>
      </button>
  </div>
 
  <button type="submit" class="btn btn-primary" name="update">Update</button>

 </form>
</div>

<?php include('footer.php');