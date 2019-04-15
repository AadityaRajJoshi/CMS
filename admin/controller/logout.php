<?php 
require 'setting.php';
global $site_url;
session_start();
	 	if (session_destroy()){
	 		header('Location:'. $site_url .'admin/login');
	 	}
	 ?>