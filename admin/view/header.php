<?php 
session_start();

  if (!$_SESSION["sessionemail"]){
    header('Location:http://localhost/cms/admin/login');
  }
 ?>

<!DOCTYPE html>
<html>
<head>
	<title></title>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="http://localhost/cms/admin/static/js/jquery.slugify.js" type="text/javascript"></script>

<link rel="stylesheet" href="../static/css/style.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  
</head>

<body>
  <div class="container">
<ul class="nav nav-pills mb-1">
  <li class="nav-item">
    <a class="nav-link" href="http://localhost/cms/admin/pagemanager">Page manager</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="http://localhost/cms/admin/adminmanager" >Admin Manager</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="http://localhost/cms/admin/imagemanager">Image Manager</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="http://localhost/cms/admin/imageSlider">Image slider</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="http://localhost/cms/admin/postmanager">Post manager</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="http://localhost/cms/admin/siteconfig">site configuration</a>
  </li>
   <li class="nav-item">
    <a class="nav-link" href="http://localhost/cms/admin/suscriber">Suscriber</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="http://localhost/cms/admin/controller/logout.php">Log out</a>
  </li>
</ul>
</div>