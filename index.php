<?php
//Includes Database Connection
include 'include/db.php';
//Start Session For Username
session_start();

//Check Session Variable & Redirect To Dashboard
if(isset($_SESSION['login_user']) && !empty($_SESSION['login_user']))
{
?>

	<script type="text/javascript">
	window.location = "dashboard.php";
	</script>
	
<?php
}
else
{
	//execute if click on login button.
	if(isset($_POST['login-submit']))
	{
		//Retrieve Login Form Variables
		$username = $_POST['username'];
		$password = md5($_POST['password']);

		//Fetch Correct Username
		$query = "SELECT * FROM user WHERE username = '$username' and status = '1'";
		$data = mysql_query($query);

		//execute if user exist in database..
		if(mysql_num_rows($data) != 0)
		{
			//Create Associative Array
			$row = mysql_fetch_assoc($data);

			if(mysql_num_rows($data) != 0)
			{
				if($password == $row['password'])
				{
					$_SESSION['username'] = $username;
					$_SESSION['login_user'] = $username;
					//start session for display notification modal
					$_SESSION['show_notificaiton'] = "success";
					//redirect to dashboard
					header('location:dashboard.php');
				}// end if condition if($password == $row['password'])
				else
				{
					//Error Message
					$error_msg = "You Have Entered Wrong Password !";
					
				}//end else condition
			}//end if condition if(mysql_num_rows($data) != 0)
			else
			{
				//Error Message
				$error_msg = "Your Have Entered Wrong Username !";
			}//end else condition..
		}
		//execute if user is not exist..
		else
		{
			//Error Message
			$error_msg = "User Does Not Exist !";
		}

	}//end if condition if(isset($_POST['login-submit']))

}//end else condition..

	
?>
<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width" />
	<title>Sampoorn : Kasovious</title>

  
	<link rel="stylesheet" href="css/style.css" /> 
	<script src="js/vendor/custom.modernizr.js"></script>

</head>
<body>
	<header>
		<div class="row">
			<div class="large-8 columns large-centered logo">
				<p>Sampoorn</p>
				<p>A-249 Lajpat Nagar, Sahibabad, Ghaziabad [+91-9871198786]</p>
			</div>
		</div>
	</header>

	<!-- Login Panel Section -->
	<section class="login-panel">
		<form action="index.php" method="POST">
			<div class="row">
				<div class="large-5 columns large-centered login-wrap">

					<div class="row">
						<div class="large-5 columns " id="lbl_username">Username</div>
						
						<div class="large-7 columns">
							<input type="text" name="username" placeholder="Demo User :: admin" autocomplete="off" required>
						</div>
					</div> <!-- /row -->

					<div class="row">
						<div class="large-5 columns" id="lbl_password">Password</div>

						<div class="large-7 columns">
							<input type="password" name="password" placeholder="Password :: admin" required>
						</div>
					</div> <!-- /row -->

					<div class="row">
						
						<div class="large-12 columns login_error" style="text-align:center;color:red;font-size:18px;">
							<?php
							if(isset($error_msg))
							{
								echo $error_msg;
							}
							?>
						</div>
					</div> <!-- /row -->
					
					<div class="row">
						<div class="large-7 columns large-centered  login-btn-wrap">
							<center>
								
								<button type="submit" name="login-submit" style="width:100%;">Login</button>
							</center>
						</div> <!-- /login-btn-wrap -->
					</div> <!-- /row -->
					
					<div class="row">
						<div class="large-5 columns large-centered copyright"><a href="http://www.kasovious.com">&copy; Kasovious Inc</a></div>
					</div>

				</div> <!-- /login-wrap -->
			</div>
		</form>
	</section>
	<!-- end Login Panel Section -->

		
</body>
</html>
