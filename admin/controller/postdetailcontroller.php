<?php
	require_once __dir__.'/../model/model.php';
	$postdetail = new model;
 
/**
  * 
  */
 class postdetailcontroller extends model
 {
 
 	public function getImageForPost($id){
 		$data = array(
 			'*'
 		);
 		$condition = array(
 			'id' => $id
 		);
 		$image = $this->select('Image_upload', $data, $condition);
 		$fetch_image = $this->fetch($image);
 		return $fetch_image;
 	}

 	public function fullPost($id){
 		$data = array('*');
 		$condition  = array(
 			'post_id' => $id
 		);
 		$post = $this->select('post_manager', $data, $condition);
 		$fetch_post = $this->fetch($post);
 		return $fetch_post;
 	}	


 	public function pagination()
	 {
		$result_per_page = 3;
		//determine which page number is currently on
		if(!isset($_GET['page'])){
			$page = 1;
		}else{
			$page = $_GET['page'];
		}

		//sql limit
		 $this_page_first_result = ($page-1)*$result_per_page;

		 $limit = array(
		 	$this_page_first_result,
		 	$result_per_page
		 );
		 $condition = array(
		 	'isActive' => 1
		 );
		$page =  $this->selectLimit('post_manager', array('*'), $limit, $condition);
		$page_fetch = $this->fetch($page);
		return $page_fetch;
	}

	public function paginationNumber(){
		$result_per_page = 3;

		$result = $this->select('post_manager', array('*'));
		$number_of_result = $this->fetch($result);
		$number_of_result_count = count ($number_of_result);
		//echo $number_of_result_count;die;
		$number_of_pages = ceil($number_of_result_count/$result_per_page);
		return $number_of_pages;

	}

 	
 } 