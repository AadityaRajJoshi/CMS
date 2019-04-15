<?php 
include('../model/model.php');
require 'setting.php';
global $site_url;
$pagemanagercontroller = new model;

class Pagemanagercontroller extends model{ 

	public function insertPage(){
	//page manager
		if(isset($_POST['pagetitle']) && isset($_POST['pagecontent']) && isset($_FILES['file'])){

			if (empty($_POST['selectPage'])){
				$data = array(
				'pageTitle' => $_POST['pagetitle'],
				'pageContent' =>  $_POST['pagecontent'],
				'parent_id' => '-1',	
				'slug' => $_POST['pageslug']
			 );
			 	if($this->Insert('page', $data)){
				 header('Location:'.  $site_url .'pagemanager');

			 } else{
				echo "page not inserted";
			 }
			}else{

				$data = array(
				'pageTitle' => $_POST['pagetitle'],
				'pageContent' =>  $_POST['pagecontent'],
				'parent_id' => $_POST['selectPage'],
				'slug' => $_POST['pageslug']
				);
				
				if($this->Insert('page', $data)){
					header('Location:'. $site_url .'pagemanager');
				}
			}
				$page_id = mysqli_insert_id($this->conn);

			if($_FILES["file"]["size"]==0){
				//var_dump($_FILES["file"]["size"]);die;
				echo "please select a image";
			 }else{
				$targetDir = "../static/image/";
				//echo $targetDir; die;
				$allowTypes = array('jpg','png','jpeg','gif');

			 if(!empty(array_filter($_FILES['file']['name']))){
			 	//var_dump($_FILES['file']['name']);die;
				foreach($_FILES['file']['name'] as $key => $val){
					//var_dump($_FILES['file']['name']);die;
					$target_file = $targetDir. basename($_FILES['file']['name'][$key]);
					//var_dump($target_file );die;
				    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
					$imagename = md5(time(). rand());
					$image_Name = $imagename. '.' .$imageFileType;
					//echo $image_Name;die;
					if (in_array($imageFileType, $allowTypes)){
						if(move_uploaded_file($_FILES["file"]["tmp_name"][$key], $targetDir.$image_Name)){
							
							$data = array(
								'image_name' => $image_Name,
								'id' => $page_id,
								'post_type' => 'page'

							);
						     $this->insert('image_upload', $data);
						     $data = array(
						     	'image_id'
						     );
						     $condition = array(
						     	'id' => $page_id,
						     );
						     $select_Image_id = $this->select('image_upload', $data, $condition);
						     $fetch_Image_id = $this->fetch($select_Image_id);
						     foreach ($fetch_Image_id as $key => $value) {
								$Image_Id = $value['image_id'];
								}
								$data = array(
									'id' => $page_id,
									'image_id' => $Image_Id,
								);
							$this-> Insert('meta_table', $data);
						}
					 }else{
						echo "error";
					}
				}	
			   } 
		    }
		 }		
    }

    //delete page
    public function deletePage(){
    	$id = $_POST['delete_Page'];
    	//var_dump($id);die;
    	$condition =array(
    		'id' => $id,
    	);

	    if($this->delete('page', $condition)){
	    	$condition = array(
	    		'id' => $id,
	    	);
	    	$this->delete('image_upload', $condition);

	    	$data = array(
	    		'id' => $id,	
	    	);
	    	$this->delete('meta_table', $data);
	   		header('Location:'. $site_url .'pagemanager');

	    }else{
	   		echo"page not deleted";
	    }
	}

      //Editing page
	public function selectEditPage($id){
		$condition = array(
			'id'=> $id
		);
		$editPage = $this->select('page', array('*'), $condition);
		$editpagefetch = $this->fetch($editPage);
		return $editpagefetch;
	}

     //updating page
	public function updatePage(){
		$data = array(
			'pageTitle' => $_POST['pagetitle'],
			'pageContent' =>  $_POST['pagecontent']
		);
		$condition = array(
			'id' => $_GET['id'],
		);
		if ($this->update('page', $data, $condition)){
			header('Location: http://localhost/cms/admin/pagemanager');
		} 
	}


	 public function displayImage(){
	  	$data = array(
		'image_id' 
		);
		$condition = array(
			'id' => $_GET['id'],
		);
		$showImageID = $this->select('meta_table', $data, $condition);
		// var_dump($showImageID);
		// die;
		$fetch_imageID = $this->fetch($showImageID);
		$return_arr = array();
 	  	foreach ($fetch_imageID as $key => $value) {
 	  		$imageID = $value['image_id'];

 	  		$data = array(
        	'*'
        	);
        $condition = array(
        	'image_id'=> $imageID,
        	'post_type' => 'page'
        );
 	  	$showImageName = $this->select('image_upload', $data, $condition);
 	  	$fetch_imageName = $this->fetch($showImageName);
 	  	 	//var_dump($fetch_imageName);
	  	//return $fetch_imageName;
	  	foreach ($fetch_imageName as $key => $value) {
	  		 $ImageName = $value['image_name'];
	  	}
	  	array_push($return_arr, $ImageName);
 	  	}
	  	return $return_arr;
 	}
 

	public function deleteImage(){
		$data = array(
			'*'
		);
		$condition = array(
			'id' => $_GET['id'],
		);
		$delete_Image_ID = $this-> select('image_upload', $data, $condition);
		//var_dump($delete_Image_ID);die;

		$fetch_Image_ID = $this->fetch($delete_Image_ID);
		//var_dump($fetch_Image_ID);die;
		foreach ($fetch_Image_ID as $key => $value) {
			 $value['image_id'];
			 $image_name = $value['image_name'];
		}
		$condition = array(
			'image_id' => $value['image_id']
			);
		$this->delete('image_upload', $condition);
		unlink('../static/image/'. $image_name);
		$data = array(
			'meta_ID'
		);	
		$condition = array(
			'id' => $_GET['id'],
		);
		$meta_Image_id = $this->select ('meta_table', $data, $condition);
		$fetch_meta_Image_id = $this->fetch($meta_Image_id);
		foreach ($fetch_meta_Image_id as $key => $value) {
			$value['meta_ID'];
		}
		$data = array(
			'meta_ID' => $value['meta_ID'],
		);
		$this->delete('meta_table', $data);
		
		echo "<meta http-equiv='refresh' content='0'>";
	}	

	public function pagination()
	 {
	 	
		$result_per_page = 5;
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
		 
		$page_list =  $this->selectLimit('page', array('*'), $limit);
		$page_fetch = $this->fetch($page_list);
	
		return $page_fetch;
		//echo '<pre>';
		//print_r($page_arr);
	}

	public function paginationNumber(){
		$result_per_page = 5;

		$result = $this->select('page', array('*'));
		$number_of_result = $this->fetch($result);
		$number_of_result_count = count ($number_of_result);
		//echo $number_of_result_count;die;
		$number_of_pages = ceil($number_of_result_count/$result_per_page);
		return $number_of_pages;
	}

	public function listPage(){
		$data = array(
			'pageTitle',
			'id'
		);
		
		$listPage =	$this->select('page',$data);
		$listPage_fetch = $this->fetch($listPage);
		return $listPage_fetch;
	}
}?>


 
