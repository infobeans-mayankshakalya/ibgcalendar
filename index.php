<?php 
if(mail("vipin.sharma@infobeans.com","My subject",'worked'))
echo 1;
else
echo 0;
if($_POST){
// the message
$msg = json_encode($_POST);
// send email
mail("vipin.sharma@infobeans.com","My subject",$msg);
}

?>
