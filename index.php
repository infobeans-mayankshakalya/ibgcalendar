<?php 
require 'PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'vipin.shm@gmail.com';                 // SMTP username
$mail->Password = 'Vipin123';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('vipin.shm@gmail.com', 'vipin sharma');
$mail->addAddress('vipin.sharma@infobeans.com', 'Vipin Sharma');     // Add a recipient
$mail->addReplyTo('vipin.shm@gmail.com', 'Information');

$mail->Subject = 'GOOGLE API RESPONSE';

if($_POST){
    
// the message
$msg = json_encode($_POST);
// send email

$mail->Body    = $msg;
$mail->AltBody = 'GOOGLE API RESPONSE';


}else{

$mail->Body    = 'NO POST DATA';
$mail->AltBody = 'GOOGLE API RESPONSE';
}

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}

?>
