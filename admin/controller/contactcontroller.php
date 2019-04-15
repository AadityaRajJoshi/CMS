<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once __dir__.'/../vendor/phpmailer/phpmailer/src/Exception.php';
require_once __dir__.'/../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once __dir__.'/../vendor/phpmailer/phpmailer/src/SMTP.php';
require_once __dir__.'/../model/model.php';
$contact = new model;

/**
 * 
 */
class contactController extends model
{
	
	public function contactMail(){
		$name = $_POST['name'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$message = $_POST['message'];
		$this->mailer($name, $email, $phone, $message);
	}

	public function mailer($name, $email, $phone, $message){
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
            $mail->Subject = 'Contact Request from ' .$name;
            $mail->Body    = 'From :' .$email. '<br>
							Phone: '.$phone.
							'<br><br>
							Hi Admin,<br>
							You have a Contact request:' .$message;
            if($mail->send()) {
                // echo 'Message has been sent to you';
                header("Location:../../public/sucess.php");
            }
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
	}
}