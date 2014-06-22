<!--Include Main Head -->
<?php include 'header.php' ?>
<!-- end Main Head -->

<?php

	if(isset($_POST['add_user_btn']))
	{
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		$privileges = $_POST['priv_check'];
		array_push($privileges,"dashboard.php");

		$query = mysql_query("SELECT * FROM user WHERE username = '$username'");
		//if user exist in database.
		if(mysql_num_rows($query) != 1 )
		{
			//check billing
			if(in_array("new_bill.php",$privileges) || in_array("manage_bill.php",$privileges)){
				array_push($privileges,"billing.php");
			}

			//check stock
			if(in_array("addstock.php",$privileges) || in_array("viewstock.php",$privileges)){
				array_push($privileges,"stock.php");
				array_push($privileges,"barcode.php");
			}

			//check system wizard
			if(in_array("change_password.php",$privileges) || in_array("manage_user.php",$privileges) || in_array("notification.php",$privileges))
			{
				array_push($privileges,"system_wizard.php");
			}

			if(in_array("addstock.php",$privileges))
			{
				array_push($privileges,"current_barcode.php");
			}

			if(in_array("notification.php", $privileges))
			{
				$privileges = implode($privileges,"/");
				$query_insert = mysql_query("INSERT INTO user (username , password , privileges , notification)  VALUES 
				('$username','$password','$privileges','1')");	
			}
			else
			{
				$privileges = implode($privileges,"/");
				$query_insert = mysql_query("INSERT INTO user (username , password , privileges)  VALUES 
				('$username','$password','$privileges')");	
			}

		}//end if condition..
		
	}

	if(isset($_POST['update_user_btn']))
	{
		$user_id = $_POST['user_id'];
		$username = $_POST['username'];
		$privileges = $_POST['priv_check'];
		array_push($privileges,"dashboard.php");
		//check billing
		if(in_array("new_bill.php",$privileges) && in_array("manage_bill.php",$privileges)){
			
		}
		elseif(in_array("new_bill.php",$privileges) || in_array("manage_bill.php",$privileges))
		{
			array_push($privileges,"billing.php");
		}

		//check stock
		if(in_array("addstock.php",$privileges) && in_array("viewstock.php",$privileges)){
			
		}
		elseif(in_array("addstock.php",$privileges) || in_array("viewstock.php",$privileges))
		{
			array_push($privileges,"stock.php");
			array_push($privileges,"barcode.php");
		}

		//check system wizard
		if(in_array("change_password.php",$privileges) && in_array("manage_user.php",$privileges) && in_array("notification.php",$privileges)){
			
		}
		elseif(in_array("change_password.php",$privileges) || in_array("manage_user.php",$privileges) || in_array("notification.php",$privileges))
		{
			array_push($privileges,"system_wizard.php");
		}
		
		if(in_array("addstock.php",$privileges))
		{
			array_push($privileges,"current_barcode.php");
		}
		

		if($_POST['password'])
		{
			$password = md5($_POST['password']);
			if(in_array("notification.php", $privileges))
			{
				$privileges = implode($privileges,"/");
				$update_query = mysql_query("UPDATE user SET username = '$username' , 
				 privileges = '$privileges' , password = '$password' , notification = '1' WHERE id = '$user_id'");
				
			}
			else
			{
				$privileges = implode($privileges,"/");
				$update_query = mysql_query("UPDATE user SET username = '$username' , 
				 privileges = '$privileges' , password = '$password' , notification = '0' WHERE id = '$user_id'");
			}
			
		}
		else
		{
			if( in_array("notification.php", $privileges) )
			{
				$privileges = implode($privileges,"/");
				$update_query = mysql_query("UPDATE user SET username = '$username' , 
				 privileges = '$privileges' , notification = '1' WHERE id = '$user_id'");	
			}
			else
			{
				$privileges = implode($privileges,"/");
				$update_query = mysql_query("UPDATE user SET username = '$username' , 
				 privileges = '$privileges' , notification = '0' WHERE id = '$user_id'");
			}
		}

	}
	if(isset($_POST['delete_user_btn']))
	{
		$user_id = $_POST['user_id'];
		$query = mysql_query("UPDATE user SET status = 0 WHERE id = $user_id");
	}
?>

<?php
$query_username = mysql_query("SELECT username FROM user WHERE status = 1");
$username_array = array();
while($row_username = mysql_fetch_array($query_username)){
	array_push($username_array, $row_username['username']);
}
?>

<div class="row manage_user">

	<!-- Quick Navigation Menu -->
	<?php include 'quicknav.php' ?>
	<!-- end Quick Navigation Menu -->

	<!--start wrap large 9 columns-->
	<div class="large-9 columns viewstock">
	
	<!-- MANAGE Customer Heading -->
		<div class="row">
			<div class="large-6 large-centered columns" id="viewstock-heading">
				MANAGE USER
			</div>
		</div>
	<!-- end MANAGE Customer Heading -->
	<form action="" method="post">
	
	<fieldset>
		<legend>Add New User</legend>
		<!-- row for input text box -->
		<div class="row">
			<div class="large-4 columns">
				<div class="row">
					<div class="large-12 columns">
						<input type="text" name="username" required autocomplete="off" placeholder="Enter Username" id="username">
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
				<input type="password" name="password" required placeholder="Enter Password" id="password">
			</div>
			<div class="large-4 columns">
				<div class="large-12 columns">
					<input type="password" name="con_password" required placeholder="Enter Confirm Password" id="confirm_pass">
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

		<div class="row privileges">
			<!-- large 4 columns for first privileges -->
			<div class="large-4 columns">
				<!-- main Privileges option -->
				<div class="row">
					<label>
						<div class="large-2 columns checkbox">
							<input type="checkbox" name="priv_check[]" id="billing_check" value="billing.php">
						</div>
						<div class="large-10 columns checkbox_text">
							<u>Billing</u>
						</div>
					</label>
				</div>
				<!-- end main Privileges option -->

				<!-- sub option of privileges -->
				<div class="row">
					<label>
						<div class="large-2 columns subcheckbox">
							<input type="checkbox" name="priv_check[]" class="billing_subcheck" value="new_bill.php">
						</div>
						<div class="large-6 columns end sub_checkbox_text">
							 New Billing
						</div>
					</label>
				</div>
				<div class="row">
					<label>
						<div class="large-2 columns subcheckbox">
							<input type="checkbox" name="priv_check[]" class="billing_subcheck" value="manage_bill.php">
						</div>
						<div class="large-6 columns end sub_checkbox_text">
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
							<input type="checkbox" name="priv_check[]" id="stock_check" value="stock.php">
						</div>
						<div class="large-10 columns checkbox_text">
							<u>Stock</u>
						</div>
					</label>
				</div>
				<!-- end main Privileges option -->

				<!-- sub option of privileges -->
				<div class="row">
					<label>
						<div class="large-2 columns subcheckbox">
							<input type="checkbox" name="priv_check[]" class="stock_subcheck" value="addstock.php">
						</div>
						<div class="large-6 columns end sub_checkbox_text">
							 Add Stock
						</div>
					</label>
				</div>
				<div class="row">
					<label>
						<div class="large-2 columns subcheckbox">
							<input type="checkbox" name="priv_check[]" class="stock_subcheck" value="viewstock.php">
						</div>
						<div class="large-6 columns end sub_checkbox_text">
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
							<input type="checkbox" name="priv_check[]" id="system_check" value="system_wizard.php">
						</div>
						<div class="large-10 columns checkbox_text">
							<u>System Wizard</u>
						</div>
					</label>
				</div>
				<!-- end main Privileges option -->

				<!-- sub option of privileges -->
				<div class="row">
					<label>
						<div class="large-2 columns subcheckbox">
							<input type="checkbox" name="priv_check[]" class='system_subcheck' value="change_password.php">
						</div>
						<div class="large-7 columns end sub_checkbox_text">
							 Change Password
						</div>
					</label>
				</div>
				<div class="row">
					<label>
						<div class="large-2 columns subcheckbox">
							<input type="checkbox" name="priv_check[]" class='system_subcheck' value="manage_user.php">
						</div>
						<div class="large-6 columns end sub_checkbox_text" >
							 Manage User
						</div>
					</label>
				</div>
				<!-- end sub option of privileges -->

			</div>
			<!-- End large 4 columns for third privileges -->

		</div>
		<div class="row privileges">
			
			<!-- large 3 columns for fourth privileges -->
			<div class="large-3 columns end">
				<div class="row">
					<label>
						<div class="large-2 columns checkbox">
							<input type="checkbox" name="priv_check[]" value="customer.php">
						</div>
						<div class="large-10 columns checkbox_text">
							Customer
						</div>
					</label>
				</div>
			</div>
			<!-- end large 3 columns for fourth privileges -->

			<!-- large 3 columns for fifth privileges -->
			<div class="large-3 columns end">
				<div class="row">
					<label>
						<div class="large-2 columns checkbox">
							<input type="checkbox" name="priv_check[]" value="dues.php">
						</div>
						<div class="large-10 columns checkbox_text">
							Dues
						</div>
					</label>
				</div>
			</div>
			<!-- end large 3 columns for fifth privileges -->

			<!-- large 3 columns for fifth privileges -->
			<div class="large-3 columns end">
				<div class="row">
					<label>
						<div class="large-2 columns checkbox">
							<input type="checkbox" name="priv_check[]" value="finance.php">
						</div>
						<div class="large-10 columns checkbox_text">
							Finance
						</div>
					</label>
				</div>
			</div>
			<!-- end large 3 columns for fifth privileges -->

			<!-- large 3 columns for sixth privileges -->
			<div class="large-3 columns end">
				<div class="row">
					<label>
						<div class="large-2 columns checkbox">
							<input type="checkbox" name="priv_check[]" value="notification.php">
						</div>
						<div class="large-10 columns checkbox_text">
							Notification
						</div>
					</label>
				</div>
			</div>
			<!-- end large 3 columns for sixth privileges -->

		</div>


		<div class="row">
			<div class="large-3 columns large-centered">
				<button style="width:100%" id="add_user_btn" name="add_user_btn">Add User</button>
			</div>
		</div>

	</fieldset>
	</form>
	
	<div class="row">
		<div class="large-12 columns">
			<fieldset>
				<legend>View Users</legend>
				View All Existing Users - <span class="view">SHOW USERS</span>
			</fieldset>
		</div>
	</div>

	
	

	</div>
	<!--end wrap large 9 columns-->

</div><!--end row -->


<div class="reveal-modal medium" id="view_user" style="margin-top:-90px;">
	<div class="row">
		<div class="large-12 columns large-centered">
			<fieldset>
				<legend>View Users</legend>
				<div class="row">
					<div class="large-6 columns large-centered">
						<input type="text" placeholder="Type username here..." id="username_search">
					</div>
				</div>
				<center>
					<table style="margin-top:10px;">
						<thead>
								<tr>
									<th><center> S No. </center></th>
									<th><center> Username </center></th>
									<th><center> Operation </center></th>
								</tr>
						</thead>
						<tbody id="view_user_table">
							<?php
							$query = mysql_query("SELECT * FROM user WHERE status = 1");
							if(mysql_num_rows($query) > 0)
							{
								$a = 1;
								while($row = mysql_fetch_array($query))
								{
									echo '<tr class="'.$row['id'].'">';
									echo '<td class="serial_no" style="text-align:center">'.$a.'</td>';
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
							?>
						</tbody>
					</table>
				</center>
			</fieldset>
		</div>
	</div>
	<a class="close-reveal-modal modal_close">&#215;</a>
</div> <!-- end Modal -->


<!-- success message modal start -->
<div id="success_msg_modal" class="reveal-modal small" style="margin-top:0px;">
	<div class="row ">
		<div class="large-12 columns large-centered">
		
			<div class="row">
				<div class="large-2 columns ">
					<img src="img/1380650991_accepted_48.png">
				</div>
				<div class="large-10 columns end msg" style="font-size: 24px;color: green;font-weight: bold;padding-top: 9px;" >
					User Successfully Added
				</div>
			</div>
			

		</div> <!--end large-12 columns-->
	</div><!-- end row -->
<a class="close-reveal-modal modal_close">&#215;</a>
</div>
<!-- success message modal end -->




<!-- user Information modal start -->
<div id="user_view_modal" class="reveal-modal medium" style="margin-top:0px;">
	<div class="row">
		<div class="large-12 columns large-centered user_information_modal">
		
	
			

		</div> <!--end large-12 columns-->
	</div><!-- end row -->
<a class="close-reveal-modal modal_close">&#215;</a>
</div>
<!-- user Information modal end -->

<!-- user Edit modal start -->
<div id="user_edit_modal" class="reveal-modal large" style="margin-top:0px;">
	<div class="row">
		<div class="large-12 columns large-centered user_edit_modal_display">
		
		
			

		</div> <!--end large-12 columns-->
	</div><!-- end row -->
<a class="close-reveal-modal modal_close">&#215;</a>
</div>
<!-- user Edit modal end -->

<?php
if(isset($_POST['add_user_btn']))
{
?>
<script type="text/javascript">
	$("#success_msg_modal").foundation('reveal', 'open');
</script>
<?php
}
if(isset($_POST['update_user_btn']))
{
?>
<script type="text/javascript">
	$("#success_msg_modal .msg").text("User has been succesfully updated").css('font-size','22px');

	$("#success_msg_modal").foundation('reveal', 'open');
</script>
<?php
}
if(isset($_POST['delete_user_btn']))
{
?>
<script type="text/javascript">
	$("#success_msg_modal .msg").text("User has been succesfully deleted").css('font-size','22px');

	$("#success_msg_modal").foundation('reveal', 'open');
</script>
<?php
}
?>


<div class="username_hidden hide"></div>
<div class="password_hidden hide"></div>

<!-- Include Common Footer -->
<?php include 'footer.php' ?>
<!-- end Include Common Footer-->



<script type="text/javascript">

// script for close modal
$('.modal_close').click(function(){
	$(this).foundation('reveal', 'close');
});

$('.view').click(function(){
	$(".la-anim-10").addClass('la-animate');
	$('#view_user').foundation('reveal','open');
	$(".la-anim-10").removeClass('la-animate');
});

$(function(){
	// check all for billing
    // add multiple select / deselect functionality
    $("#billing_check").click(function () {
          if($(this).is(":checked"))
          {
          	$(".billing_subcheck").prop( "checked", true );
          }
          else
          {
          	$(".billing_subcheck").prop( "checked",false);
          }
    });
 
    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".billing_subcheck").click(function(){
 
        if($(".billing_subcheck").length == $(".billing_subcheck:checked").length) {
            $("#billing_check").prop( "checked",true);
        } else {
            $("#billing_check").prop( "checked",false);
        }
 
    });
    // end check all for billing


	// check all for stock
    // add multiple select / deselect functionality
    $("#stock_check").click(function () {
          if($(this).is(":checked"))
          {
          	$(".stock_subcheck").prop( "checked", true );
          }
          else
          {
          	$(".stock_subcheck").prop( "checked",false);
          }
    });
 
    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".stock_subcheck").click(function(){
 
        if($(".stock_subcheck").length == $(".stock_subcheck:checked").length) {
            $("#stock_check").prop( "checked",true);
        } else {
            $("#stock_check").prop( "checked",false);
        }
 
    });
    // end check all for stock

    // check all for system Widard
    // add multiple select / deselect functionality
    $("#system_check").click(function () {
          if($(this).is(":checked"))
          {
          	$(".system_subcheck").prop( "checked", true );
          }
          else
          {
          	$(".system_subcheck").prop( "checked",false);
          }
    });
 
    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".system_subcheck").click(function(){
 
        if($(".system_subcheck").length == $(".system_subcheck:checked").length) {
            $("#system_check").prop( "checked",true);
        } else {
            $("#system_check").prop( "checked",false);
        }
 
    });
    // end check all for system widard
});	
</script>

<script type="text/javascript">

$(".add_user_success_msg").delay(5000).slideUp(1000);


var username_array = <?php echo json_encode($username_array) ?>;


//add user button click event..
$("#add_user_btn").click(function(){
	var username = $(".username_hidden").text();
	var password = $(".password_hidden").text();
	if(username == "error"){
		$(".manage_user #username").focus();
		return false;
	}
	else if(password == "error"){
		$(".manage_user #confirm_pass").focus();
		return false;
	}
	if(username == "success" && password == "success")
	{
		if( $('.privileges input[type="checkbox"]:checked').length == 0)
		{
			$(".manage_user .priv_error").show();
			$("#billing_check").focus();
			return false;
		}
		else
		{
			$(".manage_user .priv_error").hide();
		}
	}
});///end click event


$('.privileges input[type="checkbox"]').click(function(){
	if( $('.privileges input[type="checkbox"]:checked').length != 0)
	{
		$(".manage_user .priv_error").hide();
	}
})


//do not accept space in username
$(".manage_user #username").keypress(function(e) {
	if(e.which == 32){
		alert("Please do not press Space");
		return false;
	}
});


//hide username message if this value is blank..
$(".manage_user #username").focusout(function(e) {
	if($(this).val() == ""){
		$(".manage_user .username_success_msg").hide();
		$(".manage_user .username_error_msg").hide();
		$(".manage_user #username").removeClass('user_input_error');
	}
});


$(".manage_user #username").keyup(function(e) {
	var username = $(this).val();

	if(username != "")
	{
		// check if entered username is exist in username array..
		if(jQuery.inArray( username, username_array ) != "-1" )
		{
			$(".manage_user .username_success_msg").hide();
			$(".manage_user .username_error_msg").show();
			$(".manage_user #username").addClass('user_input_error');
			$(".username_hidden").text("error");
		}
		///if username is not exist in username array.. that means in database.
		else
		{
			$(".manage_user .username_success_msg").show();
			$(".manage_user .username_error_msg").hide();
			$(".manage_user #username").removeClass('user_input_error');
			$(".username_hidden").text("success");	
		}

	}//end if condition if(username != "");
	else
	{
		$(".username_hidden").text("error");
		$(".manage_user #username").removeClass('user_input_error');
		$(".manage_user .username_success_msg").hide();
		$(".manage_user .username_error_msg").hide();
	}

});//close username keyup


//check password on type in password textbox
$(".manage_user #password").keyup(function(e) {
	var password = $(".manage_user #password").val();
	var confirm_pass = $(".manage_user #confirm_pass").val();
	if(confirm_pass != "")
	{
		if(password != "")
		{
			if(confirm_pass != "")
			{
				if(password == confirm_pass)
				{
					$(".manage_user #confirm_pass").removeClass('user_input_error');
					$(".manage_user .password_error_msg").hide();
					$(".manage_user .password_success_msg").show();
					$(".password_hidden").text("success");
				}
				else
				{
					$(".manage_user #confirm_pass").addClass('user_input_error');
					$(".manage_user .password_error_msg").show();
					$(".manage_user .password_success_msg").hide();
					$(".password_hidden").text("error");
				}
			}
			else
			{
				$(".manage_user #confirm_pass").removeClass('user_input_error');
				$(".manage_user .password_error_msg").hide();
				$(".manage_user .password_success_msg").hide();
				$(".password_hidden").text("error");
			}
		}
		else
		{
			$(".manage_user #confirm_pass").removeClass('user_input_error');
			$(".manage_user .password_error_msg").hide();
			$(".manage_user .password_success_msg").hide();
			$(".password_hidden").text("error");
		}
	}//end if condition for confirm password is not blank
});


$(".manage_user #confirm_pass").keyup(function(e) {
	var password = $(".manage_user #password").val();
	var confirm_pass = $(".manage_user #confirm_pass").val();
	if(password != "")
	{
		if(confirm_pass != "")
		{
			if(password == confirm_pass)
			{
				$(".manage_user #confirm_pass").removeClass('user_input_error');
				$(".manage_user .password_error_msg").hide();
				$(".manage_user .password_success_msg").show();
				$(".password_hidden").text("success");
			}
			else
			{
				$(".manage_user #confirm_pass").addClass('user_input_error');
				$(".manage_user .password_error_msg").show();
				$(".manage_user .password_success_msg").hide();
				$(".password_hidden").text("error");
			}
		}
		else
		{
			$(".manage_user #confirm_pass").removeClass('user_input_error');
			$(".manage_user .password_error_msg").hide();
			$(".manage_user .password_success_msg").hide();
			$(".password_hidden").text("error");
		}
	}//end if condition for password is not blank
});


</script>

<script type="text/javascript">

//view user detail into modal when click on view button in table
$("#view_user_table").on('click','.information_user',function(){
	var user_id = $(this).parent().parent().parent().children('.user_id').text();
	$(".la-anim-10").addClass('la-animate');
	$.ajax({
		type : "POST",
		url : "manage_user_ajax.php",
		data : {user_display : user_id},
		success : function(result){
			$("#user_view_modal").foundation('reveal', 'open');
			$(".user_information_modal").html(result);
			$(".la-anim-10").removeClass('la-animate');
		}//end success
	});///end ajax
});


//edit user detail into modal when click on edit button in table
$("#view_user_table").on('click','.edit_user',function(){
	var user_id = $(this).parent().parent().parent().children('.user_id').text();
	$(".la-anim-10").addClass('la-animate');
	$.ajax({
		type : "POST",
		url : "manage_user_ajax.php",
		data : {edit_user : user_id},
		success : function(result){
			$("#user_edit_modal").foundation('reveal', 'open');
			$(".user_edit_modal_display").html(result);
			$(".la-anim-10").removeClass('la-animate');
		}//end success
	});///end ajax
});


//delete user from table..
$("#view_user_table").on('click','.delete_user',function(){
	var confirm_msg = confirm("Do you want to delete user ?");
	if(confirm_msg == true)
	{
		$(this).parent().parent().parent().remove();
		var user_id = $(this).parent().parent().parent().children('.user_id').text();
		$.ajax({
			type : "POST",
			url : "manage_user_ajax.php",
			data : {delete_user : user_id},
			success : function(result){
				
			}//end success
		})
	}//end if condition..

	//reset serial number
	$("#view_user_table tr").each(function(id){
		$(this).children().first().html(id+1);	
	});
});

$("#username_search").keyup(function(e){
	var search_text = $(this).val();
	$(".la-anim-10").addClass('la-animate');
	$.ajax({
		type : "POST",
		url : "manage_user_ajax.php",
		data : {search_user : search_text},
		success : function(result){
			$("#view_user_table").html(result);
			$(".la-anim-10").removeClass('la-animate');
		}//end success
	});//end ajax
});

</script>