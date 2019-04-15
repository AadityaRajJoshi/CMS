<?php
include('header.php');
include('../admin/controller/pagedetailcontroller.php');
require '../admin/controller/setting.php';
global $site_url;
$pagedetail = new pageDetailController;
$id = $_GET['id'];
$page = $pagedetail -> pageDetail($id);
foreach ($page as $key => $value) {
	$pagetitle = $value['pageTitle'];
	$pagecontent = $value['pageContent'];
}

$page_image = $pagedetail -> getImageForPage($id) 

?>
<div>
<section>
  <div class="container">
    <div class="row">
      <div class="col-md-7 col-sm-7">
        <div>
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <?php 
      foreach ($page_image as $key => $value) {?>
        <div class="carousel-item <?php echo ($key == 0) ? "active"  : ""; ?>">
          <img style="height: 300px;width:100%;" class="d-block" src="<?php echo $site_url ?>admin/static/image/<?php echo $value['image_name']; ?>" alt="First slide">
        </div>  
      <?php }
     ?>
    
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
            
        </div>
      </div>
      <div class="col-md-5 col-sm-5 padding-left">
        <div class="winner-date"><span class="bold"><b><I><?php echo $pagetitle; ?></b></I></span></div>
        
        <div class="winner-sitename"><br><?php echo $pagecontent; ?></a></div>
      </div>
    </div>
  </div>
</section>
</div>
<?php include('footer.php'); ?>