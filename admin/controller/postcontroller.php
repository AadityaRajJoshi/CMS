<?php 
require_once __dir__.'/../model/model.php';
$imagecontroller = new model;


class postcontroller extends model {

	public function selectPage(){  //display page from page table for post
		$data = array(
			'*'
		);
		$page = $this-> select('page', $data);
		$fetch_page = $this->fetch($page);
		return $fetch_page;
	}

	public function insertPost(){
		$data = array(
			'post_title' => $_POST['posttitle'],
			'post_content' => $_POST['postcontent'],
			'seo_title' => $_POST['seotitle'],
			'meta_title' => $_POST['metatitle'],
			'meta_keywords' => $_POST['metakeyword'],
			'added_date' => $_POST['date'],
			'isActive' => '1',
			'page_id' => $_POST['selectPage']
		);	
		 $this->Insert('post_manager', $data);

		$targetDir = "../static/image/";
		$allowTypes = array('jpg','png','jpeg','gif');

		if(!empty(array_filter($_FILES['file']['name']))){
			 	
			foreach($_FILES['file']['name'] as $key => $val){
					
				$target_file = $targetDir. basename($_FILES['file']['name'][$key]);
				$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
				$imagename = md5(time(). rand());
				$image_Name = $imagename. '.' .$imageFileType;
					
				if (in_array($imageFileType, $allowTypes)){
					if(move_uploaded_file($_FILES["file"]["tmp_name"][$key], $targetDir.$image_Name)){
						$data =array(
							'post_id'
						);
						$condition = array(
							'page_id' => $_POST['selectPage']
						);
						$id = $this->select('post_manager', $data, $condition);
						$fetch_id = $this->fetch($id);
						foreach ($fetch_id as $key => $value) {
							$post_id = $value['post_id'];
						}
						$data = array(
						'image_name' => $image_Name,
						'id' => $post_id,
						'post_type' => 'post'
						);
						$this->insert('image_upload', $data);
						header('Location:'. $site_url .'postmanager');
				    }
					}else{
					echo "error";
				}
			}	
	    }
	}

	public function deletePost(){
		$id = $_POST['delete_image'];
		$data = array(
			'post_id' => $id
		);
		$this-> delete('post_manager', $data);
		$condition = array(
			'id' => $id
		);
		$this->delete('image_upload', $condition);
		header('Location:'. $site_url .'postmanager');
	}

	public function selectEditPost($id){
		$data = array(
			'*'
		);
		$condition = array(
			'post_id' => $id
		);
		$post = $this-> select('post_manager', $data, $condition);
		$fetch_post = $this->fetch($post);
		//print_r($fetch_post);die;
		return $fetch_post;
	}

	public function updatePost($id){
		$data = array(
			'post_title' => $_POST['posttitle'],
			'post_content' => $_POST['postcontent'],
			'seo_title' => $_POST['seotitle'],
			'meta_title' => $_POST['metatitle'],
			'meta_keywords' => $_POST['metakeyword'],
		);
		$condition = array(
			'post_id' => $id
		);
		$this-> update('post_manager', $data, $condition);
		header('Location: http://localhost/cms/admin/postmanager');
	}

	public function updatedeActivate(){
		
		$data = array(
			'isActive' => '0'
		);	
		$condition = array(
			'post_id' => $_POST['activate']
		);
		$this->update('post_manager', $data, $condition);
		echo "<meta http-equiv='refresh' content='0'>";
	}

	public function updateActivate(){
		//echo "hello";die;
		
		$data = array(
			'isActive' => '1'
		);	
		$condition = array(
			'post_id' => $_POST['deactivate']
		);
		$this->update('post_manager', $data, $condition);
		echo "<meta http-equiv='refresh' content='0'>";
	}


	public function displayUserPost(){
		$data = array(
			'*'
		);
		$condition = array(
			'isActive' => 1
		);
		$order = array(
			'post_id'
		);
		$limit = array(
			3
		);
		$post_details = $this->selectWhereLimit('post_manager', $data, $condition, $order, $limit);
		$fetch_post_details = $this->fetch($post_details);
		return $fetch_post_details;
	}
	
	public function postImage($id){
		$data = array(
			'*'
		);
		$condition = array(
			'id' => $id,
			'post_type' => 'post'
		);
		$post_image = $this->select('image_upload', $data, $condition);
		$fetch_post_image = $this->fetch($post_image);
		return $fetch_post_image;
		//var_dump($fetch_post_image);
		
	}

	public function Postpagination()
	 {
		$result_per_page = 3;
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
		 
		$page =  $this->selectLimit('post_manager', array('*'), $limit);
		$page_fetch = $this->fetch($page);
		return $page_fetch;
	}

	public function PostpaginationNumber(){
		$result_per_page = 3;

		$result = $this->select('post_manager', array('*'));
		$number_of_result = $this->fetch($result);
		$number_of_result_count = count ($number_of_result);
		//echo $number_of_result_count;die;
		$number_of_pages = ceil($number_of_result_count/$result_per_page);
		return $number_of_pages;

	}

	public function getImageforPost($id){
		$data = array(
			'*'
		);
		$condition = array(
			'id' => $id,
			'Post_type' => 'post'
		);
		$image = $this->select('image_upload', $data, $condition);
		$image_fetch = $this->fetch($image);
		return $image_fetch;
	}

	public function deletePostImage($id){
		//echo"hi";die;
		$data = array(
			'image_id'
		);
		$condition = array(
			'id' => $id,
			'Post_type' => 'post'
		);
		$getid = $this->select('image_upload', $data, $condition);
		$fetch_getid = $this->fetch($getid);
		foreach ($fetch_getid as $key => $value) {
			$id =  $value['image_id'];
		}
		$condition = array(
			'image_id' => $id,
			'Post_type' =>'post'
		);
		$this-> delete('image_upload', $condition);
		echo "<meta http-equiv='refresh' content='0'>";
	}


	

		
}
