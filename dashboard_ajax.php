<?php
include 'include/db.php';
?>
<?php
//status false of notificaiton in customer table..
if(isset($_POST['customer_id_notification']))
{
	$customer_id = $_POST['customer_id_notification'];
	$query = mysql_query("UPDATE customer SET notification_status = '0' WHERE id = '$customer_id'");
}

if(isset($_POST['product_id_notification']))
{
	$product_id = $_POST['product_id_notification'];
	$query = mysql_query("UPDATE product SET notification_status = '0' WHERE product_id = '$product_id'");
}
?>
