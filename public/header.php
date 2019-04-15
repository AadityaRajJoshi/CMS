<?php 
include('../admin/controller/Userendcontroller.php');
require '../admin/controller/setting.php';
global $user_site;
$list_page_db = new Userendcontroller();
$list_page_db_fetch = $list_page_db->UserlistPage();
//$list_sub_page_db_fetch = $list_page_db->userListSubPage();
$logo = $list_page_db -> getlogo();
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
  <link rel="stylesheet" href="../admin/static/css/style.css">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"  crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"  crossorigin="anonymous"></script>
  
</head>

<body>
  <div class="row">
  <div class="col-sm-4 bg-primary">
    <?php foreach ($logo as $key => $value) {
      $image = $value['logo'];
      $name = $value['site_name'];
      $imagepath = $site_url.'/admin/static/logo/'.$image; ?>
      <a href="index"><?php echo '<img style = "height:30px;"class="site-img border p-1 m-1" src =' .$imagepath.'>';}?> </a>  
  </div>
  <div class="col-sm-8 bg-primary" style="color:#fff" ><h1><?php echo $name;  ?></h1></div>
</div>

<nav class="navbar navbar-expand-lg  navbar-dark bg-primary">
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    
    <ul class="navbar-nav float-right" >
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo $site_url?>public/index">Home </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?php echo $site_url?>public/quotation">Request a Quote</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?php echo $site_url?>public/suscribe">Suscribe</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?php echo $site_url?>public/contactus">Contact us</a>
      </li>

      <li class="nav-item">
        <ul>
        <li class="nav-link "  href="#">
          <?php foreach ($list_page_db_fetch as $key => $value) {?>
          <!-- <a href="#" class= "text-white"><?php //echo $value['pageTitle'] ?></a> -->
          <?php $sub_page = $list_page_db -> userListSubPage($value['id']); ?>
          <?php if (count($sub_page) == 0){?>
            <a href="pagedetail/<?php echo $value['id'];?>" class= "text-white mr-1"><?php echo $value['pageTitle']?></a>
          <?php } else{ ?>
             <div class="dropdown">
            <a style="color:white;" href="pagedetail/<?php echo$value['id'];?>"><?php echo $value['pageTitle'] ?></a>
            <div class="dropdown-content">
            <?php foreach ($sub_page as $key => $value) { ?>
              <a href="pagedetail?id=<?php echo$value['id'];?>" class= "text-black mr-1"><?php echo $value['pageTitle']?></a>
            <?php } ?>
            </div>
            </div>   
           <?php } ?>

        <?php } ?></li>
      </ul> 
      </li>
    
    </ul>
  </div>
</nav>



