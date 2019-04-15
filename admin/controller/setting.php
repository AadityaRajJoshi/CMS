<?php 
require_once __dir__.'/../model/model.php';
$site = new model;
//echo __dir__;die;
global $site_url;

	$sql = "SELECT * FROM SITE_CONFIGURATION";
	$result = mysqli_query($site->conn, $sql);
	//var_dump($result);
	$fecthsite = $site->fetch($result);
	foreach ($fecthsite as $key => $value) {
		$site_url = $value['site_url'];
	}
	// return $site_url;

	//var_dump($url);
?>