<?php
include('header.php');
include('../admin/controller/postdetailcontroller.php');
require '../admin/controller/setting.php';
global $user_site;
$post_detail = new postdetailcontroller; 
$id = $_GET['id'];
$image = $post_detail->getImageForPost($id);
$full_post = $post_detail -> fullPost($id);
//var_dump($full_post);

foreach ($full_post as $key => $value) {
  $date = $value['added_date'];
  $title = $value['post_title'];
  $content = $value['post_content'];
  $seotitle = $value['seo_title'];
  $metatitle = $value['meta_title'];
  $metakey = $value['meta_keywords'];
}
?>
<section id="winner-of-the-day" >
  <div class="container">
    <div class="row">
      <div class="col-md-7 col-sm-7">
        <div class="winner-image">
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <?php 
      foreach ($image as $key => $value) {?>
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
        <div class="winner-date"><span class="bold"><?php echo $date; ?></span></div>
        <div class="winner-name"><br>Title &#8211; <b><I><?php echo $title; ?> </b></I></div>
        <div class="winner-sitename"><br><?php echo $content; ?></a></div>
              
    
     <span id="voteid56208">
        <div class="vote-count2"><?php echo $seotitle; ?></a></div>  
      </span>

    
          
        <div class="winer-sub-details created"><br> <?php echo $metatitle; ?></a></div>
        <div class="winer-sub-details from"><br><?php echo $metakey; ?></a></div>
          
      </div>
    </div>
  </div>
</section>
<a href="<?php echo $site_url ?>public/postlisting" class="btn btn-primary">view all</a>


<?php include('footer.php'); ?>