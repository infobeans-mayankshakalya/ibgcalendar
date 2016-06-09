<?php 
if($_POST){
// the message
$msg = json_encode($_POST);
// send email
$myfile = fopen("push_notification.txt", "w") or die("Unable to open file!");
$txt = "POST DATA:\n";
fwrite($myfile, $txt.$msg);
fclose($myfile);
}

?>
