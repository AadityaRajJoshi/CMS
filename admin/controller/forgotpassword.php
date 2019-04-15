<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once __dir__.'/../vendor/phpmailer/phpmailer/src/Exception.php';
require_once __dir__.'/../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once __dir__.'/../vendor/phpmailer/phpmailer/src/SMTP.php';
include('../model/model.php');

class forgotPassword extends model{

	public function reset(){ 

		if(isset($_POST['reset-email'])){	
			$email = $_POST['reset-email'];
			$condition = array(
			'Email'=>$_POST['reset-email']
			);
			$email_select = $this->select('login', array('*'), $condition);

			$count = mysqli_num_rows($email_select);
			$row = mysqli_fetch_array($email_select);

			if($count>0){
				$newPassword = $this->generateRandomSting();
				//echo $newPassword;
				$encrypt = md5($newPassword);
				$Data = array (
					'Password'=>$encrypt
	 			);
				$update = $this->update('login', $Data, array('id'=>'4'));
				if ($update == true){
					$this-> randomPassword($newPassword, $email);	
				}
			}
		}
	}

	public function generateRandomSting($length = 5){
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$characterslength = strlen($characters);
		$randomString = '';
		for ($i=0; $i<$length; $i++){
			$randomString .= $characters[rand(0, $characterslength -1)];
		}
		return $randomString;
	}

	public function randomPassword($password, $email){
		$mail = new PHPMailer;
        try {
            //Server settings
			
            $mail->isSMTP();                   // Set mailer to use SMTP
            $mail->Host = 'smtp.mailtrap.io';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'fe2fea799cc1be';                  // SMTP username
            $mail->Password = '37d44da1156c29';                           // SMTP password
            $mail->Port = 2525;                                    // TCP port to connect to
            //Recipients
            $mail->setFrom( 'cloudaaditya@gmail.com' );
            $mail->addAddress( $email );
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Password Recovery';
            $mail->Body    = 'Your password has been changed. Your  new password is ' . $password;
            if($mail->send()) {
                 echo 'Message has been sent to you';
                //header("Location:../admin/index.php");
            }
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
	}
}