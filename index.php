<?php 

# This function reads your DATABASE_URL config var and returns a connection
# string suitable for pg_connect. Put this in your app.
function pg_connection_string_from_database_url() {
    $user = "tcpqujlrgdxpqx";
    $pass = "b_wZht5KuCU1WjqZx0mLX7XkOK";
    $host = "ec2-54-163-238-222.compute-1.amazonaws.com";
  extract(parse_url($_ENV["postgres://tcpqujlrgdxpqx:b_wZht5KuCU1WjqZx0mLX7XkOK@ec2-54-163-238-222.compute-1.amazonaws.com:5432/d5ejpv5kc8s1je"]));
  return "user=$user password=$pass host=$host dbname=" . substr($path, 1); # <- you may want to add sslmode=require there too
}
# Here we establish the connection. Yes, that's all.
$pg_conn = pg_connect(pg_connection_string_from_database_url());
# Now let's use the connection for something silly just to prove it works:
//$result = pg_query($pg_conn, "CREATE TABLE postdata(
//   ID INT PRIMARY KEY     NOT NULL,
//   NAME           TEXT    NOT NULL
//   
//);");
//var_dump($result);
print "<pre>\n";
if (!pg_num_rows($result)) {
  print("Your connection is working, but your database is empty.\nFret not. This is expected for new apps.\n");
} else {
  print "Tables in your database:\n";
  while ($row = pg_fetch_row($result)) { print("- $row[0]\n"); }
}
print "\n";


die;



require 'PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;
 
//$mail->SMTPDebug = 3;                               // Enable verbose debug output

//$mail->isSMTP();                                      // Set mailer to use SMTP
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
