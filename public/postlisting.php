<?php
include('header.php');
include('../admin/controller/postdetailcontroller.php');

$post_list = new postdetailcontroller();
$fetch_post_list = $post_list -> pagination();
$num = $post_list -> paginationNumber();
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
    </tr>
  </thead>

   <tbody>
  	<?php
  	foreach ($fetch_post_list as $key => $value) {?>
  	<tr>	
  	<th scope="row"><?php echo $value['post_id']?></th>
      <td><?php echo $value['post_title'] ?></td>
      <td><?php echo $value['post_content'] ?></td>
      <td><?php echo $value['seo_title'] ?></td>
      <td><?php echo $value['meta_title'] ?></td>
      <td><?php echo $value['meta_keywords'] ?></td>
      <td><?php echo $value['added_date'] ?></td>
      
	</tr>
  	<?php }?>
  </tbody>
</table>
<nav aria-label="Page navigation example">
  <ul class="pagination">
    <?php for($page=1; $page<=$num; $page++){?>
        <?php echo  '<li class="page-item"><a class="page-link" href="postlisting.php?page=' . $page . '">' . $page . '</a> ';
     } ?>   
  </ul>
</nav>  

  
</div>  
