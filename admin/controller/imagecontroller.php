<?php 
include('../model/model.php');
$imagecontroller = new model;
require 'setting.php';

//echo $site_url;die;
class Imagecontroller extends model{
     
	public function upload_image(){
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
					//echo $targetDir.$image_Name;die;
				 in_array($imageFileType, $allowTypes);
					if(move_uploaded_file($_FILES["file"]["tmp_name"][$key], $targetDir.$image_Name)){
							$data = array(
								'image_name' => $image_Name,
								'id' => '0',
								'Post_type' => 'Image_manager'
							);
							$this-> Insert('image_upload', $data);
					}
				}	
			} 	    
		}
	


	public function display_all_Image(){
		$data = array('*');
		$all_image = $this-> select('image_upload', $data);
		$fectch_all_image = $this->fetch($all_image);
		return  $fectch_all_image;
    }	
}