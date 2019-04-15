
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://cdn.ckeditor.com/ckeditor5/12.0.0/classic/ckeditor.js"></script>

</head>
<body>
	<?php 
	include("../controller/usercontroller.php");
	
	
	$login = new usercontroller;
	if(isset($_POST['submit'])){
		$login->login();
	}

	?>
	<div class="container">

	<form method="POST" class="mt-5 border p-4 bg-light rounded">
		<div class="form-group">
			<label>Email</label>
			<input id="email"  name="email" type="text" class="form-control"
			<?php 
				if(isset($_COOKIE['email'])){?>
					value = "<?php echo $_COOKIE['email']?>"
				<?php } ?>
				"required="required" /> <br>
		</div>

		<div class="form-group">
			<label>Password</label>
			<input id="password"  name="password" type="password" class="form-control"
			 <?php 
				if(isset($_COOKIE['password'])){?>
					value = "<?php echo $_COOKIE['password']?>"
				<?php } ?> 
			 required /> <br>
		</div>

		<p>
			<button class="btn btn-success" type="submit" name="submit"><span>Login</span></button> 
		</p>

	<p><input type="checkbox" name="remember" /> Remember me</p>

	<p><a href = "forgot_password">forgot password?</p>
	</form>
</div>
</body>
</html>