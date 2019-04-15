<?php include('header.php');
 include('../controller/postcontroller.php');
 require '../controller/setting.php';
global $site_url;

 $postmanager = new postcontroller;

 //$post_fetch = $postmanager -> displayPost();
 $post_fetch = $postmanager -> Postpagination();
 $num = $postmanager -> PostpaginationNumber();


 if(isset($_POST['delete_image'])){
 	$postmanager -> deletePost();
 }

if(isset($_POST['activate'])){
	$postmanager -> updatedeActivate();
}

if(isset($_POST['deactivate'])){
	$postmanager -> updateActivate();
}



  ?>

<div class="container mt-0 border p-4 bg-light rounded">
  <table class="table table-bordered table-dark table-stripped">
  <thead>
    <tr>
      <th scope="col">post id</th>
      <th scope="col">Post Title</th>
      <th scope="col">Post Content</th>
      <th scope="col">SEO Title</th>
      <th scope="col">Meta Title</th>
      <th scope="col">Meta keywords</th>
      <th scope="col">Added Date</th>
      <th scope="col">Is Active</th>
      <th scope="col">Page ID</th>
      <th scope="col">Edits</th>
    </tr>
  </thead>

   <tbody>
  	<?php
  	foreach ($post_fetch as $key => $value) {?>
  	<tr>	
  	<th scope="row"><?php echo $value['post_id']?></th>
      <td><?php echo $value['post_title'] ?></td>
      <td><?php echo $value['post_content'] ?></td>
      <td><?php echo $value['seo_title'] ?></td>
      <td><?php echo $value['meta_title'] ?></td>
      <td><?php echo $value['meta_keywords'] ?></td>
      <td><?php echo $value['added_date'] ?></td>
      <td>
      	<?php if( $value['isActive']==1){ ?> 
      	<form method="POST" enctype="multipart/form-data"><button type="submit" class="btn btn-primary float-left mr-1" name="activate" value="<?php echo $value['post_id'] ?>">deactivate</button></form>  
      	<?php }else{ ?>
      	<form method="POST" enctype="multipart/form-data"><button type="submit" class="btn btn-primary float-left mr-1" name="deactivate" value="<?php echo $value['post_id'] ?>">activate</button></form>
      	<?php }?>

      </td>
      <td><?php echo $value['page_id'] ?></td>
      <td><a href="<?php echo $site_url?>admin/editpost/<?php echo $value['post_id']?>"><button type="button" class="btn btn-primary float-left mr-1" name="edit">Edit</button>
      </a>
		<form method="POST" enctype="multipart/form-data" >
      <a>
      	<button type="submit" class="btn btn-danger float-left"  name='delete_image' value="<?php echo $value['post_id']?>"  onclick="return confirm('are you sure want to delete?')">Delete</button>
      	</form>
  	

	</tr>
  	<?php }?>
  	 

  </tbody>

  <a href="postform"><button class="btn btn-primary float-right mb-2" type="submit" name="addpost"> Add Post</button>
  </a>
</table>
   <nav aria-label="Page navigation example">
  <ul class="pagination">
    <?php for($page=1; $page<=$num; $page++){?>
        <?php echo  '<li class="page-item"><a class="page-link" href="'. $site_url .'admin/postmanager?page=' . $page . '">' . $page . '</a> ';
     } ?>   
  </ul>
</nav>  
</div>  