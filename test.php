<?php
include 'include/db.php';
?>
<?php
$to = "agrawal.rishab609@gmail.com";
$subject = "Password Reset";
$message = "Hello Rishabh,<br> Your Password is rishabh_123. <br> Thanks.";
$from = "rishabh@kasovious.com";
$headers = "From:" . $from;
mail($to,$subject,$message,$headers);
echo "Mail Sent.";
?>
