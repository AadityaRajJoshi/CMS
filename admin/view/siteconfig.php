<?php include('header.php');
 include('../controller/siteconfigurationcontroller.php');

 $site = new siteConfigurationController;

 $getsite = $site->getSiteConfig();

 if (isset($_POST['delete_logo'])) {
   $site -> deleteSiteConfig();
 }
?>

<div class="container mt-0 border p-4 bg-light rounded">
  <table class="table table-bordered table-dark table-stripped">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Site Name</th>
      <th scope="col">Site URL</th>
      <th scope="col">Site Path</th>
      <th scope="col">Footer Text</th>
      <th scope="col">Edit</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach ($getsite as $key => $value) {?>
    <tr>  
    <th scope="row"><?php echo $value['id']?></th>
      <td><?php echo $value['site_name'] ?></td>
      <td><?php echo $value['site_url'] ?></td>
      <td><?php echo $value['site_path'] ?></td>
      <td><?php echo $value['footer_text'] ?></td>
      <td>
    <form method="POST" enctype="multipart/form-data">
      <a>
        <button type="submit" class="btn btn-danger float-left"  name='delete_logo' value="<?php echo $value['id']?>"  onclick="return confirm('are you sure want to delete?')">Delete</button>
        </form></td>
  </tr>
    <?php }?>
   </tbody> 
  <a href="siteconfiguration"><button class="btn btn-primary float-right mb-2" type="submit" name="add"> Add</button>
</table>
</div>  