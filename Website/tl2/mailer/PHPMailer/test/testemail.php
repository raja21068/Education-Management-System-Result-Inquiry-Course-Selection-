<?php
/**
* Simple example script using PHPMailer with exceptions enabled
* @package phpmailer
* @version $Id$
*/
$to="rajakumarlohano@gmail.com";
$body="raja123";
require '../class.phpmailer.php';


try {
	$mail = new PHPMailer(true); //New instance, with exceptions enabled

	//$body             = file_get_contents('contents.html');
	//$body             = preg_replace('/\\\\/','', $body); //Strip backslashes

	$mail->IsSMTP();                           // tell the class to use SMTP
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->Port       = 25;                    // set the SMTP server port
	$mail->Host       = "smtp.gmail.com"; // SMTP server
	$mail->Username   = "perfectmaster123@gmail.com";     // SMTP server username
	$mail->Password   = "perfectmaster";            // SMTP server password

	$mail->IsSendmail();  // tell the class to use Sendmail

	//$mail->AddReplyTo("name@domain.com","First Last");


	$mail->From       = "perfectmaster123@gmail.com";
	$mail->FromName   = "UNIVERSITY OF SINDH EXAMINATION WING";

	//$to = "rajakumarlohano@gmail.com";

	$mail->AddAddress($to);

	$mail->Subject  = "UNIVERSITY OF SINDH EXAMINATION WING";

	
	$mail->MsgHTML($body);

	$mail->IsHTML(true); // send as HTML

	$mail->Send();
	echo 'Message has been sent.';
} catch (phpmailerException $e) {
	echo $e->errorMessage();
}

?>