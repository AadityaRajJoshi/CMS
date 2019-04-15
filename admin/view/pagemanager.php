<?php include('header.php');

include('../controller/Pagemanagercontroller.php');
//require_once __dir__.'/../controller/setting.php';
require '../controller/setting.php';
global $site_url;
//echo $_SESSION["sessionemail"];


$allPage = new Pagemanagercontroller;
//$all_page_from_db = $allPage->selectPage();
//var_dump($all_page_from_db);die;

if(isset($_POST['delete_Page'])){
	//echo "delete";die;
 	 $allPage->deletePage();
 }
$pagination = $allPage-> pagination();
$num = $allPage -> paginationNumber();


//var_dump($site_url);


//var_dump($site);die;
//$count = count($pagination);
// echo '<pre>';
//echo $count;die;
// print_r ($pagination);die;
//echo implode(($pagination));
// foreach ($pagination as $key => $value) {
//   var_dump($value->pages);
//   // echo $value;
//   // $page = $value['page'];
// }
// echo $no_of_page ;
//var_dump($page);
?>
<div class="container mt-0 border p-4 bg-light rounded">
  
<table class="table table-bordered table-dark table-stripped">                                 
  <thead>
    <tr>
      <th scope="col">Page ID</th>
      <th scope="col">Page Title</th>
      <th scope="col">Page Content</th>
      <th scope="col">Edits</th>
      <th scope="col">Parent_id</th>
    </tr>
  </thead>


  <tbody>
  	<?php foreach($pagination as $key => $value) {?>
    <tr>
      <th scope="row"><?php echo $value['id']?></th>
      <td><?php echo $value['pageTitle'] ?></td>
      <td><?php echo $value['pageContent'] ?></td>
      <td><a href="<?php echo $site_url ?>admin/edit/<?php echo $value['slug']?>/<?php echo $value['id']?>"><button type="button" class="btn btn-primary float-left mr-1" name="edit">Edit</button>
      </a>
		<form method="POST" enctype="multipart/form-data">
      <a>
      		<button type="submit" class="btn btn-danger float-left"  name='delete_Page' value="<?php echo $value['id']?>"  onclick="return confirm('are you sure want to delete?')">Delete</button>
      	</form>
  	</td>
    <td><?php echo $value['parent_id'] ?></td>
    </tr>
    <?php } ?>
</tbody>

<a href="pagemanagerform"><button class="btn btn-primary float-right mb-2" type="submit" name="addpage"> Add page</button>
 </a>
 </table> 
  
 <nav aria-label="Page navigation example">
  <ul class="pagination">
    <?php for($page=1; $page<=$num; $page++){?>
        <?php echo  '<li class="page-item"><a class="page-link" href="'. $site_url .'admin/pagemanager?page=' . $page . '">' . $page . '</a> ';
     } ?>   
  </ul>
</nav> 
</div>

<?php include ('footer.php');?>