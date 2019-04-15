<?php
include('header.php');
include('../admin/controller/suscribecontroller.php');
$suscribe = new suscribeController;

if (isset($_POST['email'])) {
	$suscribe -> insertSuscriber();	
}


?>

<h1 class="bg-primary" style="color:white;"> Suscribe to our newsletter </h1>

<div class="container">
<form method="POST" enctype="multipart/form-data">
	<div>
  		<label for="title">Email: </label>
    	<input type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Enter your email" name="email" required>
	</div>
	<button type="submit" class="btn btn-primary" name="createpost">suscribe</button>
</form>
</div>
<?php include('footer.php'); ?>