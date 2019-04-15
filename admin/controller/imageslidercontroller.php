<?php 
require_once __dir__.'/../model/model.php';
$imagecontroller = new model;

/**
 * 
 */
class imageslidercontroller extends model
{
	
	public function insertImage()
	{
		if($_FILES["file"]["size"]==0){
				//var_dump($_FILES["file"]["size"]);die;
				echo "please select a image";
			 }else{
			 	$targetDir = "../static/sliderImage/";
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
								'image_title' => $_POST['imagetitle'],
								'image_description' => $_POST['imagecontent']
							);
						     if($this->insert('slider_module', $data)){
						     	header('Location:'. $site_url .'imageSlider');
						     };
						}
					 }else{
						echo "error";
					}
				}	
			} 
	    }	
	}

	public function displayImagedescription(){
		$data = array(
			'image_id',
			'image_title',
			'image_description'
		);
		$image = $this->select('slider_module', $data);
		// var_dump($image);die;
		$fetch_image = $this->fetch($image);
		return $fetch_image;
	}

	public function selectEditImage($id){
		$condition = array(
			'image_id' => $id
		);

		$selectImage = $this->select('slider_module', array('*'), $condition);
		$fetch_selectImage = $this->fetch($selectImage);
		return $fetch_selectImage;
	}

	public function displayImage($id){
		$data = array(
			'image_name'
		);
		$condition = array(
			'image_id' => $id
		);
		$display_image = $this->select('slider_module', $data, $condition);
		$display_image_fetch = $this-> fetch($display_image);
		return $display_image_fetch;
	}

	public function updateImage($id){
		$targetDir = "../static/sliderImage/";
		$allowTypes = array('jpg','png','jpeg','gif');

		if(!empty(array_filter($_FILES['file']['name']))){
			foreach($_FILES['file']['name'] as $key => $val){
				$target_file = $targetDir. basename($_FILES['file']['name'][$key]);
				$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
				$imagename = md5(time(). rand());
				$image_Name = $imagename. '.' .$imageFileType;
					if (in_array($imageFileType, $allowTypes)){
						if(move_uploaded_file($_FILES["file"]["tmp_name"][$key], $targetDir.$image_Name)){

							$data = array(
									'*'
								);
								$condition = array(
									'image_id' => $id
								);
								$image = $this->select('slider_module', $data, $condition);
								$fetch_image = $this-> fetch($image);
								foreach ($fetch_image as $key => $value) {
									$image_name = $value['image_name'];
								}
								unlink('../static/sliderImage/'. $image_name);

							$data = array(
							'image_name' => $image_Name,
							'image_title' => $_POST['imagetitle'],
							'image_description' => $_POST['imagecontent'],		
							);
							$condition = array(
								'image_id' => $id
							);
						     $this->update('slider_module',$data, $condition);
						     	header('Location:'. $site_url .'imageSlider');
						}
					}else{
						echo "error";
					}
			    }	
		  } 
	}

	public function displaysliderImage(){

		$data = array(
			'*'
		);
		$slider_image = $this-> select('slider_module', $data);
		$fetch_slider_image = $this-> fetch($slider_image);
		return $fetch_slider_image;
	}

	public function deleteImage(){
		$id = $_POST['delete_image'];
		$data = array(
			'image_id' => $id
		);
		$this->delete('slider_module', $data);
		header('Location:'. $site_url .'imageSlider');
	}
}
?>