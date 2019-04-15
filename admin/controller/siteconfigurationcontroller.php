<?php 
include('../model/model.php');
$site = new model;

/**
 * 
 */
class siteConfigurationController extends model
{
	public function insertSiteConfiguration(){
		if($_FILES["file"]["size"]==0){
				//var_dump($_FILES["file"]["size"]);die;
				echo "please select a image";
			 }else{
			 	$targetDir = "../static/logo/";
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
								'logo' => $image_Name,
								'site_name' => $_POST['sitename'],
								'site_url' => $_POST['siteurl'],
								'site_path' => $_POST['sitepath'],
								'footer_text' => $_POST['footertext']
							);
						     if($this->insert('site_configuration', $data)){
						     	header('location:../view/siteconfig');
						     };
						}
					 }else{
						echo "error";
					}
				}	
			} 
	    }
	}

	public function getSiteConfig(){
		$data = array(
			'*'
		);
		$site = $this-> select('site_configuration', $data);
		$site_fetch = $this-> fetch($site);
		return $site_fetch;
		//var_dump($site_fetch);
	}

	public function deleteSiteConfig(){
		$condition = array(
			'id' => $_POST['delete_logo']
		);
		$this-> delete('site_configuration', $condition);
		echo "<meta http-equiv='refresh' content='0'>";
	}
	
}