<?php include('header.php');
 include('../controller/siteconfigurationcontroller.php');

 $site = new siteConfigurationController;
 if (isset($_POST['done'])) {
 	$site -> insertSiteConfiguration();
 }
?>

<div class="container mt-0 border p-4 bg-light rounded">
<form method="POST" enctype="multipart/form-data" >
  
<div>
  <label for="title">Site Name</label>
    <input type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Enter site Name" name="sitename" required>
</div>

<div class="form-group">
    <label for="exampleFormControlTextarea1">Site URL</label>
     <input type="text" class="form-control" id="title" aria-describedby="emailHelp" name="siteurl" required>
</div>
  
<div>
  <label for="title">Site Path</label>
    <input type="text" class="form-control" id="title" aria-describedby="emailHelp" name="sitepath">
</div>

<div>
  <label for="title">Footer Text</label>
    <input type="text" class="form-control" id="title" aria-describedby="emailHelp" name="footertext">
</div>

  <div class="form-group">
    <label for="exampleFormControlFile1">Upload logo</label>
    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="file[]" multiple>
  </div>  	

   <button type="submit" class="btn btn-primary" name="done">Done</button>
</form>
</div>