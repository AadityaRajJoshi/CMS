<?php include('header.php');
include ('../controller/pagemanagercontroller.php');
require '../controller/setting.php';
global $site_url;
$pagemanager = new pagemanagercontroller;
if(isset($_POST['createpage'])){
    $pagemanager->insertPage();
    //$pagemanager -> imageUpload();
  }

  $list_page_db_fetch = $pagemanager->listPage();
?>

<script type="text/javascript" charset="utf-8">
jQuery().ready(function () {
jQuery('#slug').slugify('#title');
});
</script>

<div class="container">
  <form method="POST" enctype="multipart/form-data" class="mt-5 border p-4 bg-light rounded">
  
<div>
  <label for="title">Page title</label>
    <input type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Enter page title" name="pagetitle" required>
</div>

<div>
  <label for="title">Page slug</label>
    <input type="text" class="form-control" id="slug" aria-describedby="emailHelp" placeholder="Enter page title" name="pageslug" readonly>
</div>
 


  <div class="form-group">
    <label for="exampleFormControlTextarea1">Page Content</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="pagecontent" required></textarea>
  </div>
  <script src="<?php echo $site_url; ?>admin/view/ckeditor/ckeditor.js"></script>
  <script>
    CKEDITOR.replace('pagecontent');
  </script>

 
  <div class="container">
    <div class="form-group">
      <label for="sel1">Select Page</label>
      <select class="form-control" id="sel1" name="selectPage">
        <option></option>
         <?php 
          foreach ($list_page_db_fetch as $key => $value) {
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

  <button type="submit" class="btn btn-primary" name="createpage"> Create Page</button>

</form>
</div>

<?php include('footer.php');


