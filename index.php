<?php 
if($_POST){
    chmod('push_notification.txt', '0777');
// the message
$msg = json_encode($_POST);
// send email
$myfile = fopen("push_notification.txt", "w") or die("Unable to open file!");
$txt = "POST DATA:\n";
fwrite($myfile, $txt.$msg);
fclose($myfile);
}else{
        chmod('push_notification.txt', '0777');
// the message
$msg = "no data found\nTime: ".date('H:i A',time());
// send email
$myfile = fopen("push_notification.txt", "w") or die("Unable to open file!");
fwrite($myfile, $msg);
fclose($myfile);
}

?>
