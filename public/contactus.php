<?php
	include('header.php');
	include('../admin/controller/contactcontroller.php');
	$contact  = new contactcontroller;

	if (isset($_POST['contact'])) {
		$contact -> contactMail();
	}

 ?>

<div class="container mt-0 border p-4 bg-light rounded">
<form method="POST" enctype="multipart/form-data" >
  
<div>
  <label for="title">Name</label>
    <input type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Enter your name" name="name" required>
</div>

<div>
  <label for="title">Email</label>
    <input type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Enter email" name="email" required>
</div>

<div>
  <label for="title">Phone</label>
    <input type="text" class="form-control" id="title" aria-describedby="emailHelp" name="phone" required>
</div>

<div class="form-group">
    <label for="exampleFormControlTextarea1">Message</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="message" required></textarea>
 </div>
  <script src="../admin/view/ckeditor/ckeditor.js"></script>
  <script>
    CKEDITOR.replace('message');
  </script>

<button type="submit" class="btn btn-primary" name="contact">Make Contact</button>
</form>
</div> 

<?php include('footer.php'); ?>