<?php 
session_start();

include('../model/model.php');
$model = new model();

class usercontroller extends model {

	public function login(){ 
		if(isset($_POST['email']) && isset($_POST['password'])){
			$_SESSION["sessionemail"] = $_POST["email"];
			$_SESSION["sessionpassword"] = $_POST["password"];
			//echo  $_SESSION["sessionemail"];die;
						
			$condition = array(
			'Email'=>$_POST['email'],
			'Password' => md5($_POST['password'])
			);

			$loginacces = $this->select('login', array('*'), $condition);
			if($loginacces){
				if(mysqli_num_rows($loginacces)>0){
					if(!empty($_POST['remember'])){
						setcookie("email",$_POST["email"],time()+ 3600);
						setcookie("password",$_POST["password"],time()+ 3600);
						}
						header('Location:pagemanager');
				}else{
				echo "acces denied";
				}
			}else{
			echo"user not found";
			}
		}	
	}


 }
?>