<?php
include 'include/db.php';
if(isset($_POST['user_display']))
{
	$user_id = $_POST['user_display'];
	$query  = mysql_query("SELECT * FROM user WHERE id = $user_id");
	$row = mysql_fetch_array($query);
	$privileges = $row['privileges'];
	$privileges = explode("/", $privileges);
?>
	<div class="user_id_hidden_modal hide"><?php echo $row['id'];?></div>
	
		<fieldset>
			<legend><span style="color:rgb(10,133,95);">Privilages <span style="color:rgba(10,133,95,1); font-weight:normal;">[ user :: <?php echo $row['username']; ?> ]</span></span></legend>
			<div class="row" style="margin-top:20px; margin-left:10px;">
				<!-- billing -->
				<div class="large-4 columns">
					<div class="row">
						<div class="large-12 columns privileges"> 
							<span>
								<?php
								if(in_array("new_bill.php", $privileges) && in_array("manage_bill.php", $privileges))
								{
									echo "<u>Billing</u>";
									// echo '<img src="img/check_mark_green.png" class="tick_icon">';
								}
								else{
									echo "<span style='text-decoration:line-through; color:#6a6a6a;'>Billing</span>";
								}
								?>
								
							</span>
						</div>
					</div>
					<div class="row">
						<div class="large-12 columns subprivileges"> 
							<span>
								<?php
								if(in_array("new_bill.php", $privileges))
								{
									echo "New Bill";
									// echo '<img src="img/check_mark_green.png" class="tick_icon">';
								}
								else{
									echo "<span style='text-decoration:line-through; color:#6a6a6a;'>New Bill</span>";
								}
								?>
							</span>
						</div>
					</div>
					<div class="row">
						<div class="large-12 columns subprivileges">
							<span>
								<?php
								if(in_array("manage_bill.php", $privileges))
								{
									echo "Manage Bill";
									// echo '<img src="img/check_mark_green.png" class="tick_icon">';
								}
								else{
									echo "<span style='text-decoration:line-through; color:#6a6a6a;'>Manage Bill</span>";
								}
								?>
							</span>
						</div>
					</div>
				</div>
				<!-- billing -->
				
				<!-- stock -->
				<div class="large-4 columns">
					<div class="row">
						<div class="large-12 columns privileges"> 
							<span>
								<?php
								if(in_array("addstock.php", $privileges) && in_array("viewstock.php", $privileges))
								{
									echo "<u>Stock</u>";
									// echo '<img src="img/check_mark_green.png" class="tick_icon">';
								}
								else{
									echo "<span style='text-decoration:line-through; color:#6a6a6a;'>Stock</span>";
								}
								?>
							</span>
						</div>
					</div>
					<div class="row">
						<div class="large-12 columns subprivileges">
							<span>
								<?php
								if(in_array("addstock.php", $privileges))
								{
									echo "Add Stock";
									// echo '<img src="img/check_mark_green.png" class="tick_icon">';
								}
								else{
									echo "<span style='text-decoration:line-through; color:#6a6a6a;'>Add Stock</span>";
								}
								?>
							</span>
						</div>
					</div>
					<div class="row">
						<div class="large-12 columns subprivileges">
							<span>
								<?php
								if(in_array("viewstock.php", $privileges))
								{
									echo "Manage Stock";
									// echo '<img src="img/check_mark_green.png" class="tick_icon">';
								}
								else{
									echo "<span style='text-decoration:line-through; color:#6a6a6a;'>Manage Stock</span>";
								}
								?>
							</span>
						</div>
					</div>
				</div>
				<!-- End stock -->
			
				<!-- system wizard -->
				<div class="large-4 columns">
					<div class="row">
						<div class="large-12 columns privileges">
							<span>
								<?php
								if(in_array("change_password.php", $privileges) && in_array("manage_user.php", $privileges))
								{
									echo "<u>System Wizard</u>";
									// echo '<img src="img/check_mark_green.png" class="tick_icon">';
								}
								else{
									echo "<span style='text-decoration:line-through; color:#6a6a6a;'>System Wizard</span>";
								}
								?>
							</span>
						</div>
					</div>
					<div class="row">
						<div class="large-12 columns subprivileges">
							<span>
								<?php
								if(in_array("change_password.php", $privileges))
								{
									echo "Change Password";
									// echo '<img src="img/check_mark_green.png" class="tick_icon">';
								}
								else{
									echo "<span style='text-decoration:line-through; color:#6a6a6a;'>Change Password</span>";
								}
								?>
							</span>
						</div>
					</div>
					<div class="row">
						<div class="large-12 columns subprivileges">
							<span>
								<?php
								if(in_array("manage_user.php", $privileges))
								{
									echo "Manage User";
									// echo '<img src="img/check_mark_green.png" class="tick_icon">';
								}
								else{
									echo "<span style='text-decoration:line-through; color:#6a6a6a;'>Manage User</span>";
								}
								?>
							</span>
						</div>
					</div>
				</div>
				<!-- end system wizard -->
			
			</div>
			
			<div class="row" style="margin-top:20px; margin-left:10px;">
				<!-- customer -->
				<div class="large-4 columns privileges">
					<div class="row">
						<div class="large-12 columns">
							<span>
								<?php
								if(in_array("customer.php", $privileges))
								{
									echo "Customer";
									// echo '<img src="img/check_mark_green.png" class="tick_icon">';
								}
								else{
									echo "<span style='text-decoration:line-through; color:#6a6a6a;'>Customer</span>";
								}
								?>
							</span>
						</div>
					</div>
				</div>
				<!-- end customer -->
			
				<!-- dues -->
				<div class="large-4 columns end privileges">
					<div class="row">
						<div class="large-12 columns">
							<span>
								<?php
								if(in_array("dues.php", $privileges))
								{
									echo "Dues";
									// echo '<img src="img/check_mark_green.png" class="tick_icon">';
								}
								else{
									echo "<span style='text-decoration:line-through; color:#6a6a6a;'>Dues</span>";
								}
								?>
							</span>
						</div>
					</div>
				</div>
				<!-- end dues -->
			
				<!-- notification -->
				<div class="large-4 columns end privileges">
					<div class="row">
						<div class="large-12 columns">
							<span>
								<?php
								if(in_array("notification.php", $privileges))
								{
									echo "Notification";
									// echo '<img src="img/check_mark_green.png" class="tick_icon">';
								}
								else{
									echo "<span style='text-decoration:line-through; color:#6a6a6a;'>Notification</span>";
								}
								?>
							</span>
						</div>
					</div>
				</div>
		</fieldset>
			<!-- end notification -->

		</div>
			<?php
			if($row['id'] != 1)
			{
			?>
			<div class="row" style="margin-top:25px;">
				<div class="large-6 columns large-centered ">
					<div class="row">
						<div class="large-6 columns modal_button">
							<button style="width:100%" id="edit_user_modal">Edit</button>
						</div>
						<div class="large-6 columns">
							<form action="" method="post">
								<input type="hidden" value="<?php echo $row['id']?>" name="user_id">
								<button style="width:100%" id="delete_user_modal" name="delete_user_btn">Delete</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<?php
			}
			?>

<script type="text/javascript">
$(".modal_button").on('click','#edit_user_modal',function(){
	var user_id = $(".user_id_hidden_modal").text();
	$(".la-anim-10").addClass('la-animate');
	$.ajax({
		type : "POST",
		url : "manage_user_ajax.php",
		data : {edit_user : user_id},
		success : function(result){
			$(".la-anim-10").removeClass('la-animate');
			$("#user_edit_modal").foundation('reveal', 'open');
			$(".user_edit_modal_display").html(result);
		}//end success
	});///end ajax
});

</script>
<?php
}
//edit user...
elseif(isset($_POST['edit_user']))
{
	$user_id = $_POST['edit_user'];
	$query  = mysql_query("SELECT * FROM user WHERE id = $user_id");
	$row = mysql_fetch_array($query);
	$privileges = $row['privileges'];
	$privileges = explode("/", $privileges);

	$query_username = mysql_query("SELECT username FROM user WHERE status = 1");
	$username_array = array();
	while($row_username = mysql_fetch_array($query_username)){
		array_push($username_array, $row_username['username']);
	}

	//delete currrent username from username array..
	if(($key = array_search($row['username'], $username_array)) !== false) {
    unset($username_array[$key]);
	}

	//reset key of array.
	$username_array = array_values($username_array);
?>
	<fieldset>
		<legend><span style="color:rgb(10,133,95);">Edit User <span style="color:rgba(10,133,95,1); font-weight:normal;">[ user :: <?php echo $row['username']; ?> ]</span></span></legend>

	<form action="" method="post">
		<input type="hidden" value="<?php echo $row['id']; ?>" name="user_id">
		<div class="username_hide hide"><?php echo $row['username'];?></div>
	<!-- row for input text box -->
	<div class="row edit_modal">
		<div class="large-4 columns">
			<div class="row">
				<div class="large-12 columns">
					<input type="text" name="username" value="<?php echo $row['username']?>" required autocomplete="off" placeholder="Enter Username" id="username_modal">
				</div>
				<div class="large-12 columns username_success_msg hide">
					<img src="img/1380591407_tick_64.png" style="height:18px;"> Username Available
				</div>
				<div class="large-12 columns username_error_msg hide">
					<img src="img/1381669121_button_cancel.png" style="height:18px;"> Username Already Exist !
				</div>
			</div>
			
		</div>
		<div class="large-4 columns">
			<input type="password" name="password" placeholder="Enter Password" id="password_modal">
		</div>
		<div class="large-4 columns">
			<div class="large-12 columns">
				<input type="password" name="con_password" placeholder="Enter Confirm Password" id="confirm_pass_modal">
			</div>
			<div class="large-12 columns password_success_msg hide">
				<img src="img/1380591407_tick_64.png" style="height:18px;"> Password Match !
			</div>
			<div class="large-12 columns password_error_msg hide ">
				<img src="img/1381669121_button_cancel.png" style="height:18px;"> Password Does Not Match !
			</div>
		</div>
	</div>
	<!-- End row for input text box -->


	<div class="row">
		<div class="large-2 columns privileges_heading">
			Privileges :
		</div>
		<div class="large-5 columns end priv_error hide" >
			Select any privileges !
		</div>
	</div>

	<div class="row edit_priv_modal">
		<!-- large 4 columns for first privileges -->
		<div class="large-4 columns">
			<!-- main Privileges option -->
			<div class="row">
				<label>
					<div class="large-2 columns checkbox">
						<?php
						if(in_array("new_bill.php", $privileges) && in_array("manage_bill.php", $privileges))
						{
							echo '<input type="checkbox" checked="checked" name="priv_check[]" class="billing_check_modal" value="billing.php">';
						}
						else
						{
							echo '<input type="checkbox" name="priv_check[]" class="billing_check_modal" value="billing.php">';
						}
						?>
					</div>
					<div class="large-10 columns checkbox_text">
						Billing
					</div>
				</label>
			</div>
			<!-- end main Privileges option -->

			<!-- sub option of privileges -->
			<div class="row">
				<label style="margin-left:22px;">
					<div class="large-2 columns subcheckbox">
						<?php
						if(in_array("new_bill.php", $privileges))
						{
							echo '<input type="checkbox" checked="checked" name="priv_check[]" class="billing_subcheck_modal" value="new_bill.php">';
						}
						else
						{
							echo '<input type="checkbox" name="priv_check[]" class="billing_subcheck_modal" value="new_bill.php">';
						}
						?>
						
					</div>
					<div class="large-10 columns end sub_checkbox_text">
						 New Billing
					</div>
				</label>
			</div>
			<div class="row">
				<label style="margin-left:22px;">
					<div class="large-2 columns subcheckbox">
						<?php
						if(in_array("manage_bill.php", $privileges))
						{
							echo '<input type="checkbox" checked="checked" name="priv_check[]" class="billing_subcheck_modal" value="manage_bill.php">';
						}
						else
						{
							echo '<input type="checkbox" name="priv_check[]" class="billing_subcheck_modal" value="manage_bill.php">';
						}
						?>
					</div>
					<div class="large-10 columns end sub_checkbox_text">
						 Manage Billing
					</div>
				</label>
			</div>
			<!-- end sub option of privileges -->

		</div>
		<!-- End large 4 columns for first privileges -->
		
		<!-- large 4 columns for second privileges -->
		<div class="large-4 columns">
			<!-- main Privileges option -->
			<div class="row">
				<label>
					<div class="large-2 columns checkbox" style="text-align:center">
						<?php
						if(in_array("addstock.php", $privileges) && in_array("viewstock.php", $privileges))
						{
							echo '<input type="checkbox" checked="checked" name="priv_check[]" class="stock_check_modal" value="stock.php">';
						}
						else
						{
							echo '<input type="checkbox" name="priv_check[]" class="stock_check_modal" value="stock.php">';
						}
						?>
					</div>
					<div class="large-10 columns checkbox_text">
						Stock
					</div>
				</label>
			</div>
			<!-- end main Privileges option -->

			<!-- sub option of privileges -->
			<div class="row">
				<label style="margin-left:22px;">
					<div class="large-2 columns subcheckbox">
						<?php
						if(in_array("addstock.php", $privileges))
						{
							echo '<input type="checkbox" checked="checked" name="priv_check[]" class="stock_subcheck_modal" value="addstock.php">';
						}
						else
						{
							echo '<input type="checkbox" name="priv_check[]" class="stock_subcheck_modal" value="addstock.php">';
						}
						?>
					</div>
					<div class="large-10 columns end sub_checkbox_text">
						 Add Stock
					</div>
				</label>
			</div>
			<div class="row">
				<label style="margin-left:22px;">
					<div class="large-2 columns subcheckbox">
						<?php
						if(in_array("viewstock.php", $privileges))
						{
							echo '<input type="checkbox" checked="checked" name="priv_check[]" class="stock_subcheck_modal" value="viewstock.php">';
						}
						else
						{
							echo '<input type="checkbox" name="priv_check[]" class="stock_subcheck_modal" value="viewstock.php">';
						}
						?>
					</div>
					<div class="large-10 columns end sub_checkbox_text">
						 Manage Stock
					</div>
				</label>
			</div>
			<!-- end sub option of privileges -->

		</div>
		<!-- End large 4 columns for second privileges -->

		<!-- large 4 columns for third privileges -->
		<div class="large-4 columns">
			<!-- main Privileges option -->
			<div class="row">
				<label>
					<div class="large-2 columns checkbox">
						<?php
						if(in_array("change_password.php", $privileges) && in_array("manage_user.php", $privileges))
						{
							echo '<input type="checkbox" checked="checked" name="priv_check[]" class="system_check_modal" value="system_wizard.php">';
						}
						else
						{
							echo '<input type="checkbox" name="priv_check[]" class="system_check_modal" value="system_wizard.php">';
						}
						?>
						
					</div>
					<div class="large-10 columns checkbox_text">
						System Wizard
					</div>
				</label>
			</div>
			<!-- end main Privileges option -->

			<!-- sub option of privileges -->
			<div class="row">
				<label style="margin-left:22px;">
					<div class="large-2 columns subcheckbox">
						<?php
						if(in_array("change_password.php", $privileges))
						{
							echo '<input type="checkbox" checked="checked" name="priv_check[]" class="system_subcheck_modal" value="change_password.php">';
						}
						else
						{
							echo '<input type="checkbox" name="priv_check[]" class="system_subcheck_modal" value="change_password.php">';
						}
						?>
						
					</div>
					<div class="large-10 columns end sub_checkbox_text">
						 Change Password
					</div>
				</label>
			</div>
			<div class="row">
				<label style="margin-left:22px;">
					<div class="large-2 columns subcheckbox">
						<?php
						if(in_array("manage_user.php", $privileges))
						{
							echo '<input type="checkbox" checked="checked" name="priv_check[]" class="system_subcheck_modal" value="manage_user.php">';
						}
						else
						{
							echo '<input type="checkbox" name="priv_check[]" class="system_subcheck_modal" value="manage_user.php">';
						}
						?>
						
					</div>
					<div class="large-10 columns end sub_checkbox_text" >
						 Manage User
					</div>
				</label>
			</div>
			<!-- end sub option of privileges -->

		</div>
		<!-- End large 4 columns for third privileges -->

	</div>
	<div class="row edit_priv_modal">
		<!-- large 4 columns for fourth privileges -->
		<div class="large-3 columns end">
			<div class="row">
				<label>
					<div class="large-2 columns checkbox">
						<?php
						if(in_array("customer.php", $privileges))
						{
							echo '<input type="checkbox" checked="checked" name="priv_check[]" value="customer.php">';
						}
						else
						{
							echo '<input type="checkbox" name="priv_check[]" value="customer.php">';
						}
						?>
						
					</div>
					<div class="large-10 columns checkbox_text">
						Customer
					</div>
				</label>
			</div>
		</div>
		<!-- end large 4 columns for fourth privileges -->

		<!-- large 4 columns for fifth privileges -->
		<div class="large-3 columns end">
			<div class="row">
				<label>
					<div class="large-2 columns checkbox">
						<?php
						if(in_array("dues.php", $privileges))
						{
							echo '<input type="checkbox" checked="checked" name="priv_check[]" value="dues.php">';
						}
						else
						{
							echo '<input type="checkbox" name="priv_check[]" value="dues.php">';
						}
						?>
					</div>
					<div class="large-10 columns checkbox_text">
						Dues
					</div>
				</label>
			</div>
		</div>
		<!-- end large 4 columns for fifth privileges -->

		<!-- large 3 columns for sixth privileges -->
		<div class="large-3 columns end">
			<div class="row">
				<label>
					<div class="large-2 columns checkbox">
						<?php
						if(in_array("finance.php", $privileges))
						{
							echo '<input type="checkbox" checked="checked" name="priv_check[]" value="finance.php">';
						}
						else
						{
							echo '<input type="checkbox" name="priv_check[]" value="finance.php">';
						}
						?>
					</div>
					<div class="large-10 columns checkbox_text">
						Finance
					</div>
				</label>
			</div>
		</div>
		<!-- end large 3 columns for sixth privileges -->

		<!-- large 4 columns for seven privileges -->
		<div class="large-3 columns end">
			<div class="row">
				<label>
					<div class="large-2 columns checkbox">
						<?php
						if(in_array("notification.php", $privileges))
						{
							echo '<input type="checkbox" checked="checked" name="priv_check[]" value="notification.php">';
						}
						else
						{
							echo '<input type="checkbox" name="priv_check[]" value="notification.php">';
						}
						?>
					</div>
					<div class="large-10 columns checkbox_text">
						Notification
					</div>
				</label>
			</div>
		</div>
		<!-- end large 4 columns for seven privileges -->

	</div>


	<div class="row">
		<div class="large-3 columns large-centered">
			<button style="width:100%" id="update_user_btn" name="update_user_btn">Update User</button>
		</div>
	</div>
	</form>

	<div class="username_hidden_modal hide">success</div>
	<div class="password_hidden_modal hide">success</div>

<script type="text/javascript">

//do not accept space in username
$(".edit_modal #username_modal , .edit_modal #password_modal , .edit_modal #confirm_pass_modal").keypress(function(e) {
	if(e.which == 32){
		alert("Please do not press Space");
		return false;
	}
});

$(".edit_modal #username_modal").keypress(function(e) {
	if(e.which == 13){
		$(".edit_modal #password_modal").focus();
		return false;
	}
});

$(".edit_modal #password_modal").keypress(function(e) {
	if(e.which == 13){
		$(".edit_modal #confirm_pass_modal").focus();
		return false;
	}
});

$(".edit_modal #confirm_pass_modal").keypress(function(e) {
	if(e.which == 13){
		$(".edit_priv_modal .billing_check_modal").focus();
		return false;
	}
});

//hide username message if this value is blank..
$(".edit_modal #username_modal").focusout(function(e) {
	if($(this).val() == ""){
		$(".edit_modal .username_success_msg").hide();
		$(".edit_modal .username_error_msg").hide();
		$(".edit_modal #username_modal").removeClass('user_input_error');
	}
});

var username_array = <?php echo json_encode($username_array); ?>

$(".edit_modal #username_modal").keyup(function(e) {
	var username = $(this).val();
	if(username != "")
	{
		// check if entered username is exist in username array..
		if(jQuery.inArray( username, username_array ) != "-1" )
		{
			$(".edit_modal .username_success_msg").hide();
			$(".edit_modal .username_error_msg").show();
			$(".edit_modal #username_modal").addClass('user_input_error');
			$(".username_hidden_modal").text("error");
		}
		///if username is not exist in username array.. that means in database.
		else
		{
			$(".edit_modal .username_success_msg").show();
			$(".edit_modal .username_error_msg").hide();
			$(".edit_modal #username_modal").removeClass('user_input_error');
			$(".username_hidden_modal").text("success");	
		}

	}//end if condition if(username != "");
	else
	{
		$(".edit_modal #username_modal").removeClass('user_input_error');
		$(".edit_modal .username_success_msg").hide();
		$(".edit_modal .username_error_msg").hide();
		$(".username_hidden_modal").text("error");
	}
});


//check password on type in password textbox
$(".edit_modal #password_modal").keyup(function(e) {
	var password = $(".edit_modal #password_modal").val();
	var confirm_pass = $(".edit_modal #confirm_pass_modal").val();
	if(confirm_pass != "")
	{
		if(password != "")
		{
			if(confirm_pass != "")
			{
				if(password == confirm_pass)
				{
					$(".edit_modal #confirm_pass_modal").removeClass('user_input_error');
					$(".edit_modal .password_error_msg").hide();
					$(".edit_modal .password_success_msg").show();
					$(".password_hidden_modal").text("success");
				}
				else
				{
					$(".edit_modal #confirm_pass_modal").addClass('user_input_error');
					$(".edit_modal .password_error_msg").show();
					$(".edit_modal .password_success_msg").hide();
					$(".password_hidden_modal").text("error");
				}
			}
			else
			{
				$(".edit_modal #confirm_pass_modal").removeClass('user_input_error');
				$(".edit_modal .password_error_msg").hide();
				$(".edit_modal .password_success_msg").hide();
				$(".password_hidden_modal").text("error");
			}
		}
		else
		{
			$(".edit_modal #confirm_pass_modal").removeClass('user_input_error');
			$(".edit_modal .password_error_msg").hide();
			$(".edit_modal .password_success_msg").hide();
			$(".password_hidden_modal").text("error");
		}
	}//end if condition for confirm passwod is not blank
});

$(".edit_modal #confirm_pass_modal").keyup(function(e) {
	var password = $(".edit_modal #password_modal").val();
	var confirm_pass = $(".edit_modal #confirm_pass_modal").val();
	if(password != "")
	{
		if(confirm_pass != "")
		{
			if(password == confirm_pass)
			{
				$(".edit_modal #confirm_pass_modal").removeClass('user_input_error');
				$(".edit_modal .password_error_msg").hide();
				$(".edit_modal .password_success_msg").show();
				$(".password_hidden_modal").text("success");
			}
			else
			{
				$(".edit_modal #confirm_pass_modal").addClass('user_input_error');
				$(".edit_modal .password_error_msg").show();
				$(".edit_modal .password_success_msg").hide();
				$(".password_hidden_modal").text("error");
			}
		}
		else
		{
			$(".edit_modal #confirm_pass").removeClass('user_input_error');
			$(".edit_modal .password_error_msg").hide();
			$(".edit_modal .password_success_msg").hide();
			$(".password_hidden_modal").text("error");
		}
	}//end if condition for passwod is not blank
});

//script for click on update user button
$("#update_user_btn").click(function(){
	var username_hidden = $(".username_hidden_modal").text();
	var password_hidden = $(".password_hidden_modal").text();
	var username = $("#username_modal").val();
	var password = $("#password_modal").val();
	var confirm_pass = $("#confirm_pass_modal").val();
	//if username is empty the focus on username textbox
	if(username == "")
	{
		$("#username_modal").focus();
		return false;
	}
	if(password != "")
	{
		if(confirm_pass == "")
		{
			$("#confirm_pass_modal").focus();
			return false;
		}
	}
	if(username_hidden == "error"){
		$(".edit_modal #username_modal").focus();
		return false;
	}
	else if(password_hidden == "error"){
		$(".edit_modal #confirm_pass_modal").focus();
		return false;
	}
	if(username_hidden == "success" && password_hidden == "success")
	{
		if( $('.edit_priv_modal input[type="checkbox"]:checked').length == 0)
		{
			$(".edit_priv_modal .billing_check_modal").focus();
			$("#user_edit_modal .priv_error").show();
			// $(".edit_priv_modal .billing_check_modal").css('outline', '3px solid red');			
			return false;
		}
		else{
			$("#user_edit_modal .priv_error").hide();
		}
	}
});//end update button click

$('.edit_priv_modal input[type="checkbox"]').click(function(){
	if( $('.edit_priv_modal input[type="checkbox"]:checked').length != 0)
	{
		$("#user_edit_modal .priv_error").hide();
	}
})

$(function(){
	// check all for billing
    // add multiple select / deselect functionality
    $(".billing_check_modal").click(function () {
          if($(this).is(":checked"))
          {
          	$(".billing_subcheck_modal").prop( "checked", true );
          }
          else
          {
          	$(".billing_subcheck_modal").prop( "checked",false);
          }
    });
 
    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".billing_subcheck_modal").click(function(){
 
        if($(".billing_subcheck_modal").length == $(".billing_subcheck_modal:checked").length) {
            $(".billing_check_modal").prop( "checked",true);
        } else {
            $(".billing_check_modal").prop( "checked",false);
        }
 
    });
    // end check all for billing


	// check all for stock
    // add multiple select / deselect functionality
    $(".stock_check_modal").click(function () {
          if($(this).is(":checked"))
          {
          	$(".stock_subcheck_modal").prop( "checked", true );
          }
          else
          {
          	$(".stock_subcheck_modal").prop( "checked",false);
          }
    });
 
    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".stock_subcheck_modal").click(function(){
 
        if($(".stock_subcheck_modal").length == $(".stock_subcheck_modal:checked").length) {
            $(".stock_check_modal").prop( "checked",true);
        } else {
            $(".stock_check_modal").prop( "checked",false);
        }
 
    });
    // end check all for stock

    // check all for system Widard
    // add multiple select / deselect functionality
    $(".system_check_modal").click(function () {
          if($(this).is(":checked"))
          {
          	$(".system_subcheck_modal").prop( "checked", true );
          }
          else
          {
          	$(".system_subcheck_modal").prop( "checked",false);
          }
    });
 
    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".system_subcheck_modal").click(function(){
 
        if($(".system_subcheck_modal").length == $(".system_subcheck_modal:checked").length) {
            $(".system_check_modal").prop( "checked",true);
        } else {
            $(".system_check_modal").prop( "checked",false);
        }
 
    });
    // end check all for system widard
});	
</script>


<?php
}
elseif(isset($_POST['delete_user']))
{
	$user_id = $_POST['delete_user'];
	$query = mysql_query("UPDATE user SET status = 0 WHERE id = $user_id");
}
elseif(isset($_POST['search_user']))
{
	$search_text = $_POST['search_user'];
	$search_text = chunk_split($search_text, 1, '%');
	$query = mysql_query("SELECT * FROM user WHERE username LIKE '%$search_text' AND status = 1");
	if(mysql_num_rows($query) > 0)
	{
		$a = 1;
		while($row = mysql_fetch_array($query))
		{
			echo '<tr class="'.$row['id'].'">';
			echo '<td class="serial_no"><center>'.$a.'</center></td>';
			echo '<td class="hide user_id">'.$row['id'].'</td>';
			echo '<td>'.$row['username'].'</td>';
			echo "<td>
				<center>";
			if($row['id'] != 1)
			{
				echo "<span class='edit_user'><img src='img/iconmonstr-pencil-icon.png' style='height:18px;' title='Edit User Details' ></span>
			<span class='done_user hide'><img src='img/1380591407_tick_64.png' style='height:18px;' title='Done User' ></span>
			<span class='information_user' style='margin-left:10px;'><img src='img/iconmonstr-info-5-icon.png' title='User Information' style='height:18px;'></span>
			<span class='delete_user' style='margin-left:10px;'><img src='img/iconmonstr-x-mark-icon.png' title='Delete User' style='height:18px;'></span>";
			}
			else
			{
				echo "<span class='information_user'><img src='img/iconmonstr-info-5-icon.png' title='User Information' style='height:18px;'></span>";
			}
			echo "</center>
			</td>";
			echo '</tr>';
			$a++;
		}
	}
	else
	{
		echo "<tr>
		<td></td>
		<td style='text-align: center;color: red;font-size: 18px;'>No user found.. !</td>
		<td></td>
		</tr>";	
	}
}
?>