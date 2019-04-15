<?php 
require_once __dir__.'/../model/model.php';
$Userendcontroller = new model;


class Userendcontroller extends model{

	public function UserlistPage(){

		$data = array(
			'*'
		);
		$condition = array(
			'parent_id' => '-1'
		);
		$listPage =	$this->select('page',$data, $condition);
		$listPage_fetch = $this->fetch($listPage);
		return $listPage_fetch;
	}

	public function userListSubPage($id){

		$data = array(
			'*'
		);
		$condition = array(
			'parent_id' => "$id"
		);
		$sub_page = $this-> select('page', $data, $condition);
		$sub_page_fetch = $this->fetch($sub_page);
		return $sub_page_fetch;
	}

	public function getlogo(){
		$data = array(
			'*'
		);
		$logo = $this->select('site_configuration', $data);
		$logo_fetch = $this->fetch($logo);
		return $logo_fetch;
	}
 }
