<?php
include 'include/db.php';
session_start();

//If Session Does Not Exists
if(!isset($_SESSION['login_user']) || empty($_SESSION['login_user']) )
{	
?>

	<script type="text/javascript">
	window.location = "index.php";
	</script>
	
<?php
}
else
{
	$username = $_SESSION['username'];
	$query_header = mysql_query("SELECT * FROM user WHERE username = '$username' AND status = 1");
	if(mysql_num_rows($query_header) == 0)
	{
		unset($_SESSION['login_user']);
		session_destroy();
	?>
	<script type="text/javascript">
	window.location = "index.php";
	</script>
	<?php
	}
}
?>