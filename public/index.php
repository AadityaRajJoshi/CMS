<?php
include('header.php');

include('../admin/controller/imageslidercontroller.php');
include('../admin/controller/postcontroller.php');
$image_slider = new imageslidercontroller; 
$fetch_image = $image_slider -> displaysliderImage();

$post_card = new postcontroller;

//var_dump($post_image);die;
$post_content = $post_card -> displayUserPost();

?>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
  	<?php 
  		foreach ($fetch_image as $key => $value) {?>
  			<div class="carousel-item <?php echo ($key == 0) ? "active"  : ""; ?>">
      		<img style="height: 300px;width:100%;" class="d-block" src="../admin/static/sliderImage/<?php echo $value['image_name']; ?>" alt="First slide">
      		<div class="carousel-caption d-none d-md-block">
    		<b><h5><?php echo $value['image_title']; ?></h5></b>
    		<I><b><p><?php echo $value['image_description'];  ?></p></b></I>
  			</div>
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


<div class="row mt-10 postwrapper" >
  <?php foreach ($post_content as $key => $value) {
    $id = $value['post_id'];
    $post_title = $value['post_title'];
    $post_content = $value['post_content'];
    $post_image = $post_card -> postImage($id);
      foreach ($post_image as $key => $value) {?>
         <div class="col-sm-4">
            <img style = "width:250px; height:250px;" class="card-img-top" src="<?php echo $site_url ?>admin/static/image/<?php echo $value['image_name']; ?>" alt="Card image cap">
            <div class="card-body">
            <h5 class="card-title"><I><?php echo $post_title; ?></I></h5>
            <p class="card-text"><?php echo substr($post_content,0,149); ?>...</p>
            <a href="postdetail/<?php echo $id;?>" class="btn btn-primary">Read more</a>
            </div>
         </div><?php break; ?>
     <?php } ?>
  <?php } ?>
</div> 
<?php include('footer.php') ?>
