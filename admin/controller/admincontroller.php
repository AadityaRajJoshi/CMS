<?php 
include('../model/model.php');
$admincontroller = new model;
require 'setting.php';
global $site_url;
/**
 * 
 */
class Admin extends model
{
	
	public function Password()
	{
		$data = array(
			'Password' 
		);
		$condition = array(
			'Email' => $_POST['email']
		);
		$password = $this->select('login', $data, $condition);
		$fetch_password = $this->fetch($password);
		foreach ($fetch_password as $key => $value) {
			$old_password = $value['Password'];
		}
		//echo $old_password;die;
		if ($old_password !== md5($_POST['password'])){
			echo "password not match";
		}else{
			if ($_POST['newpassword'] == $_POST['confirmnewpassword']){
				$condition = array(
					'Email' => $_POST['email']
				);
				$data = array(
					'Password' => md5($_POST['newpassword'])
				);
				$this->update('login', $data, $condition);
				header('Location:'. $site_url. 'login');
			}else{
				echo "password must match";
			}
		}

	}
}
