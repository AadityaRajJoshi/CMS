<?php 
	include ('header.php');
	include('../controller/suscribecontroller.php');
	$suscriber = new suscribeController();
	$fetch_susciber = $suscriber -> selectSuscriber();

	if (isset($_POST['delete'])) {
		$suscriber -> deleteSuscriber();
	}
	if (isset($_POST['export'])){
		$suscriber -> exportToExcel();
	}
?>

<div class="container mt-0 border p-4 bg-light rounded">
  <table class="table table-bordered table-dark table-stripped">
  <thead>
    <tr>
      <th scope="col">Suscriber id</th>
      <th scope="col">Email</th>
      <th scope="col">Date</th>
      <th scope="col">delete</th>
    </tr>
  </thead>

  <tbody>
  	<?php
  	foreach ($fetch_susciber as $key => $value) {?>
  	<tr>	
  	<th scope="row"><?php echo $value['id']?></th>
      <td><?php echo $value['Email'] ?></td>
      <td><?php echo $value['Date'] ?></td>
      <td><form method="POST" enctype="multipart/form-data" >
      <a>
      	<button type="submit" class="btn btn-danger float-left"  name='delete' value="<?php echo $value['id']?>"  onclick="return confirm('are you sure want to delete?')">Delete</button>
      	</form></td>
	</tr>
  	<?php }?>
  	<form method="POST" enctype="multipart/form-data" >
  	<button type="submit" class="btn btn-primary float-right" name="export">Export to Excel</button>
  	 </form>
  </tbody>
 </table>
</div> 