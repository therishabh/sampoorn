<?php
include("include/db.php");
if(isset($_POST['search_text']))
{
	$search_string = $_POST['search_text'];
	$query = mysql_query("SELECT * FROM sam WHERE command = '$search_string' AND status = '1'");
	if(mysql_num_rows($query) != 0)
	{
		$row = mysql_fetch_assoc($query);
		echo $row['address'];
	}
	else
	{
		echo "fail";
	}
}
?>