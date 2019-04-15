<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php 
	include("../controller/forgotpassword.php");
	$forgot_password = new forgotpassword;
	if(isset($_POST['reset-password'])){
		$forgot_password->reset();
	}


	?>

<h1>Reset your password</h1>
<p>An e-mail will be send to you for reseting your password</p>
<form method="POST">
	<input type="text" name="reset-email" placeholder="Enter your email">
	<button type="submit" name='reset-password' class="btn btn-success">Receve my new password</button>
	

</form>
</body>
</html>