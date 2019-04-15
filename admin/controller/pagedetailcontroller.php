<?php 
require_once __dir__.'/../model/model.php';
$post_detail = new model;

/**
 * 
 */
class pageDetailController extends model
{
	public function pageDetail($id){
		$data =array(
			'*'
		);
		$condition = array(
			'id' => $id
		);
		$page = $this->select('page', $data, $condition);
		$page_fetch = $this->fetch($page);
		return $page_fetch;
	}

	public function getImageForPage($id){
		$data = array(
			'*'
		);
		$condition = array(
			'id' => $id
		);
		$image = $this-> select('image_upload', $data, $condition);
		$image_fetch = $this-> fetch($image);
		return $image_fetch;
	}
}