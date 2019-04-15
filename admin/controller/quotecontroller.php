<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once __dir__.'/../vendor/phpmailer/phpmailer/src/Exception.php';
require_once __dir__.'/../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once __dir__.'/../vendor/phpmailer/phpmailer/src/SMTP.php';
require_once __dir__.'/../model/model.php';
$quotecontroller = new model;



class quote extends model{

	public function selectCountry(){

		$data = array(
			'name',
			'id'
		);
		$country = $this->select('tbl_country', $data);
		$fetch_country = $this->fetch($country);
		return $fetch_country;
		//var_dump($fetch_country);
	}

	public function quoteMail(){

		$firstName = $_POST['firstname'];
		$lastName = $_POST['lastname'];
		$phoneno = $_POST['phoneno'];
		$email = $_POST['email'];
		$paddress = $_POST['paddress'];
		$taddress = $_POST['taddress'];

		if(!empty($_POST['country'])){
			$country = $_POST['country'];
		}else{
			$country = 'NULL';
		}

		if(!empty($_POST['state'])){
			$state = $_POST['state'];
		}else{
			$state = 'NULL';
		}

		if(!empty($_POST['city'])){
			$city = $_POST['city'];
		}else{
			$city = 'NULL';
		}

		if(!empty($_POST['pcode'])){
			$postalcode = $_POST['pcode'];
		}else{
			$postalcode = 'NULL';
		}

		if(!empty($_POST['date'])){
			$Date = $_POST['date'];
		}else{
			$Date = 'NULL';
		}

		if(!empty($_POST['contact'])){
			$contact = $_POST['contact'];
			//var_dump($contact);die;
			$contact = implode(',', $_POST['contact']);
		}else{
			echo $contact = 'NULL';
		}

		if(!empty($_POST['service'])){
			$service = $_POST['service'];
			$service = implode(',', $_POST['service']);
		}else{
			echo $service = 'NULL';
		}

		if(!empty($_POST['note'])){
			$note = $_POST['note'];
		}else{
			$note = 'NULL';
		}

		if(!empty($_POST['gender'])){
			$gender = $_POST['gender'];
		}else{
			$note = 'NULL';
		}

		$robotest = $_POST['robotest'];

		$data = array(
			'*'
		);
		$admin_name = $this->select('login', $data);
		$fetch_admin_name = $this->fetch($admin_name);
		foreach ($fetch_admin_name as $key => $value) {
			$email = $value['Email'];
		}
		$admin_email = $email;

		if($robotest){
			echo "mofo robot";
		}else{
			$this->mailer($firstName, $lastName, $phoneno, $email, $paddress, $taddress, $Date, $city, $note, $service, $contact, $postalcode, $contact);
		}
	}

	public function mailer($firstName, $lastName, $phoneno, $email, $paddress, $taddress, $Date, $city, $note, $service, $postalcode,  $contact ){
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
            $mail->Subject = 'Quote request from ' .$firstName.' '.$lastName;
            $mail->Body    = 'From :' .$email. '<br>
							To: '.$email.
							'<br>Reply To: ' .$email.
							'<br><br>
							Hi Admin,<br>
							You have received a quote request from website on:' .$Date.
							'<br><b>Details below:</b><br>
							<b>Phone Number:</b>'.$phoneno.'<br>
							<b>Permanent Address:</b>'.$paddress.'<br>
							<b>Temporary Address:</b>'.$taddress.'<br>
							<b>city:</b>'.$city.'<br>
							<b>Postal Code:</b>'.$postalcode.'<br>
							<b>Contact me via:</b>'.$contact.'<br>
							<b>Services Interested:</b>'.$service.'<br>
							<b>Other Note:</b>'.$note.
							'<br><br>Thank you,<br>' .$firstName.' '.$lastName;
            if($mail->send()) {
                 echo 'Message has been sent to you';
                //header("Location:../../public/index.php");
            }
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
	}
}