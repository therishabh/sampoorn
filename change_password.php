<!-- Include Main Head -->
<?php include 'header.php' ?>
<!-- end Main Head -->

<?php
$username = $_SESSION['username'];

if(isset($_POST['submit-btn']))
{
	$query_password = mysql_query("SELECT password FROM user WHERE username = '$username' ");
	$row_password = mysql_fetch_array($query_password);

	$old_pswd = md5($_POST['old_pswd']);
	$new_pswd = $_POST['new_pswd'];
	$con_pswd = $_POST['con_pswd'];

	if($new_pswd == $con_pswd){
		if ($old_pswd == $row_password['password']) {
			$password = md5($new_pswd);
			$query = mysql_query("UPDATE user SET password = '$password' WHERE username = '$username'");
			$success_msg = "success";
		}
		else{
			$msg = "Old password does not match !";
		}
	}else{
		$msg = "New password and confirm password does not match !";
	}
}
if(isset($_POST['noti-submit-btn']))
{
	$notification = $_POST['notification'];
	$due_day = $_POST['due_day'];
	$stock_item = $_POST['stock_item'];
	$query = mysql_query("UPDATE user SET notification = '$notification' ,
		 due_day = '$due_day' , stock_item = '$stock_item' WHERE username = '$username'");
	$notification_msg = "success";
}

$query = mysql_query("SELECT * FROM user WHERE username = '$username'");
$row = mysql_fetch_array($query);
?>



<div class="row">

	<!-- Quick Navigation Menu -->
	<?php include 'quicknav.php' ?>
	<!-- end Quick Navigation Menu -->

	<!-- change password wrap -->
	<div class="large-9 columns viewstock">
	
	<!-- Change Password Heading -->
		<div class="row">
			<div class="large-6 large-centered columns" id="viewstock-heading">
				SETTING
			</div>
		</div>
	<!-- end Change Password Heading -->
	<?php
	if(in_array("change_password.php", $privileges))
	{
	?>
	<fieldset>
		<legend>Change Password</legend>
		<form action="" method="post">
			<?php
			//check if user is not admin
			if($_SESSION['username'] != "admin")
			{
			?>
			<div class="row">
				<div class="large-4 columns">
					<input type="password" autocomplete="off" required name="old_pswd" placeholder="Enter Your Old Password">
				</div>
			
				<div class="large-4 columns ">
					<input type="password" autocomplete="off" required name="new_pswd" placeholder="Enter Your New Password">
				</div>
			
				<div class="large-4 columns ">
					<input type="password" autocomplete="off" required name="con_pswd" placeholder="Enter Confirm Password">
				</div>
			</div>
			<?php
			}
			//if user is admin
			else{
			?>
			<div class="row">
				<div class="large-4 columns">
					<input type="password" readonly class="admin_password_textbox" placeholder="Enter Your Old Password">
				</div>
			
				<div class="large-4 columns ">
					<input type="password" readonly class="admin_password_textbox" placeholder="Enter Your New Password">
				</div>
			
				<div class="large-4 columns ">
					<input type="password" readonly class="admin_password_textbox"  placeholder="Enter Confirm Password">
				</div>
			</div>
			<?php
			}
			?>

			<?php
			if(isset($msg))
			{
			echo '<div class="row password_msg" style="margin-bottom:10px;">
				<div class="large-12 columns large-centered" style="text-align:center;">
					<span style="color:red;">'.
					$msg
					.'</span>
				</div>
			</div>';
			}
			?>

			<div class="row">
				<div class="large-3 columns large-centered">
				<?php
				if($_SESSION['username'] == "admin")
				{
				?>
					<button class="admin_password_textbox" style="width:100%">Submit</button>
				<?php
				}else{
				?>
					<button name="submit-btn" style="width:100%">Submit</button>
				<?php
				}
				?>
				</div>
			</div>
		</form>

	</fieldset>

	<?php
	}
	if( in_array("notification.php",$privileges) )
	{
	?>
		
	<fieldset>
		<legend>Notifications</legend>
		<form action="" method="post">
			<div class="row">
				<div class="large-7 columns large-centered">
					<div class="row">
						<div class="large-4 columns">Show Notifications</div>
						<div class="large-8 columns end">
							<div class="row">
								
								<div class="large-1 columns">
								<?php
								if($row['notification'] == 1)
								{
									echo '<input type="radio" class="yes_radio" checked="checked" name="notification" value="1" id="yes" style="margin-top:-11px;">';
								}
								else
								{
									echo '<input type="radio" class="yes_radio" name="notification" value="1" id="yes" style="margin-top:-11px;">';
								}
								?>
									
								</div>
								<label for="yes"><div class="large-2 columns">Yes</div></label>
						
								<label>
								<div class="large-1 columns large-offset-3">
								<?php
								if($row['notification'] == 0)
								{
									echo '<input type="radio" class="no_radio" checked="checked" name="notification" value="0" style="margin-top:-11px;">';
								}
								else
								{
									echo '<input type="radio" class="no_radio" name="notification" value="0"  style="margin-top:-11px;">';
								}
								?>
								</div>
								<div class="large-2 columns end">No</div>
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				
				<div class="large-7 columns large-centered">
					<div class="row">
						<div class="large-4 columns">Dues Days</div>
						<div class="large-6 columns end">
						<input type="number" name="due_day" id="due_day" min="1" value="<?php echo $row['due_day']?>">
						</div>
					</div>
					
				</div>
			</div>
			<div class="row">
				<div class="large-7 columns large-centered">
					<div class="row">
						<div class="large-4 columns">Stock Item</div>
						<div class="large-6 columns end">
						<input type="number" name="stock_item" id="stock_item" min='1' value="<?php echo $row['stock_item']?>">
						</div>
					</div>
					
				</div>
			</div>
			<div class="row">
				<div class="large-3 columns large-centered">
					<button name="noti-submit-btn" style="width:100%">Submit</button>
				</div>
			</div>
		</form>

	</fieldset>

	<?php
	}
	?>
	
	</div><!-- end large-9 columns -->
</div><!-- end row class -->

<!-- success message modal start -->
<div id="success_msg_modal" class="reveal-modal small" style="margin-top:0px;">
	<div class="row ">
		<div class="large-12 columns large-centered">
		
			<div class="row">
				<div class="large-2 columns ">
					<img src="img/1380650991_accepted_48.png">
				</div>
				<div class="large-10 columns end msg" style="font-size: 24px;color: green;font-weight: bold;padding-top: 9px;" >
					Password Has Been Successfully Changed
				</div>
			</div>
			

		</div> <!--end large-12 columns-->
	</div><!-- end row -->
<a class="close-reveal-modal modal_close">&#215;</a>
</div>
<!-- success message modal end -->

<?php
if(isset($success_msg))
{
?>
<script type="text/javascript">
	$("#success_msg_modal .msg").css('font-size','20px').css('text-align','center');
	$("#success_msg_modal").foundation('reveal', 'open');
</script>
<?php
}elseif(isset($notification_msg))
{
?>
<script type="text/javascript">
	$("#success_msg_modal .msg").text("Notification Successfully Saved");
	$("#success_msg_modal .msg").css('font-size','20px');
	$("#success_msg_modal").foundation('reveal', 'open');
</script>
<?php
}

?>

<!-- Include Common Footer -->
<?php include 'footer.php' ?>
<!-- end Include Common Footer -->

<script type="text/javascript">

var notification = "<?php echo $row['notification']; ?>";

if(notification == '0'){
	$("#due_day").attr('readonly','readonly');
	$("#stock_item").attr('readonly','readonly');
}

// script for close modal
$('.modal_close').click(function(){
	$(this).foundation('reveal', 'close');
});

$(".password_msg").delay(3000).slideUp(800);


$(".no_radio").click(function(){
	$("#due_day").attr('readonly','readonly');
	$("#stock_item").attr('readonly','readonly');
});
$(".yes_radio").click(function(){
	$("#due_day").removeAttr('readonly','readonly');
	$("#stock_item").removeAttr('readonly','readonly');
});

$(".admin_password_textbox").click(function() {
	alert("You have no privileges to change admin password !");
});
</script>