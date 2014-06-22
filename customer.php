<!-- Include Main Head -->
<?php include 'header.php' ?>
<!-- end Main Head -->
<?php
$sql = "SELECT phone_no FROM customer WHERE status = 1";
$query = mysql_query($sql);
$customer_mobile_array = array();
while($row = mysql_fetch_assoc($query))
{
	array_push($customer_mobile_array, $row['phone_no']);
}

if(isset($_POST['search_btn']))
{
	if( empty($_POST['customer_name']) )
	$customer_name = "%";
	else
	$customer_name = $_POST['customer_name'];

	if( empty($_POST['customer_mobile']) )
	$customer_mobile = "%";
	else
	$customer_mobile = $_POST['customer_mobile'];

	if( empty($_POST['customer_email']) )
	$customer_email = "%";
	else
	$customer_email = $_POST['customer_email'];

	if( empty($_POST['customer_address']) )
	$customer_address = "%";
	else
	$customer_address = $_POST['customer_address'];

	$sql = "SELECT * FROM customer WHERE name like '%{$customer_name}%' AND 
			phone_no LIKE '%{$customer_mobile}%' AND email LIKE '%{$customer_email}%' 
			AND address LIKE '%{$customer_address}%' AND status = '1'";
	$query = mysql_query($sql);

}
?>

<div class="row">

	<!-- Quick Navigation Menu -->
	<?php include 'quicknav.php' ?>
	<!-- end Quick Navigation Menu -->

	<!-- Manage customer wrap -->
	<div class="large-9 columns viewstock">
	
	<!-- MANAGE Customer Heading -->
		<div class="row">
			<div class="large-6 large-centered columns" id="viewstock-heading">
				MANAGE CUSTOMER
			</div>
		</div>
	<!-- end MANAGE Customer Heading -->
	
	
	<!-- Customer Searching Section -->
	<form action="" method="post">
		
		<div class="row">
			<div class="large-12 columns">
				<!-- Customer Name  -->
				<div class="large-3 columns">
					<input type="text"  list="name_datalist" autocomplete = 'off' id="customer_name" name="customer_name" value="" placeholder="Customer Name">
					<datalist id="name_datalist">
						<?php
						$query_name = mysql_query("SELECT DISTINCT name FROM customer WHERE name != '' AND id != 1 AND status = 1");
						if(mysql_num_rows($query_name) > 0)
						{
							while($row_name = mysql_fetch_assoc($query_name))
							{
								echo '<option value="'.$row_name['name'].'">';
							}
						}
						?>
					</datalist>
				</div>
				<!--End Customer Name  -->

				<!-- Phone Number -->
				<div class="large-3 columns">
					<input type="text" list="phone_datalist" autocomplete="off" id="phone_no" maxlength="10" name="customer_mobile" value="" placeholder="Customer Phone Number">
					<datalist id="phone_datalist">
						<?php
						$query_phone_no = mysql_query("SELECT phone_no FROM customer WHERE phone_no != '' AND id != 1 AND status = 1");
						while($row_phone_no = mysql_fetch_assoc($query_phone_no))
						{
							echo '<option value="'.$row_phone_no['phone_no'].'">';
						}
						?>
					</datalist>
				</div>
				<!--End Phone Number -->

				<!-- Email Address -->
				<div class="large-3 columns">
					<input type="text" list="email_datalist" autocomplete="off" id="email" name="customer_email" value="" placeholder="Customer Email Address" >
					<datalist id="email_datalist">
						<?php
						$query_email = mysql_query("SELECT DISTINCT email FROM customer WHERE email != '' AND id != 1 AND status = 1");
						if(mysql_num_rows($query_email) > 0)
						{
							while($row_email = mysql_fetch_assoc($query_email))
							{
								echo '<option value="'.$row_email['email'].'">';
							}
						}
						?>
					</datalist>
				</div>
				<!--End Email Address -->

				<!-- Address -->
				<div class="large-3 columns">
					<input list="address_datalist" type="text" id="address" name="customer_address" autocomplete="off" value="" placeholder="Customer Address" >
					<datalist id="address_datalist">
						<?php
						$query_address = mysql_query("SELECT DISTINCT address FROM customer WHERE address != '' AND address != '-' AND id != 1 AND status = 1");
						if(mysql_num_rows($query_address) > 0)
						{
							while($row_address = mysql_fetch_assoc($query_address))
							{
								echo '<option value="'.$row_address['address'].'">';
							}
						}
						?>
					</datalist>
				</div>
				<!--End Address -->
			</div>
		</div>

		<!-- button section -->
		<div class="row manage_bill_btn">
			<div class="large-6 columns large-offset-3">	
				<center>
					<button name="search_btn" id="search_btn">SEARCH</button>
					<button type="reset">RESET</button>
				</center>

			</div>
			<div class="large-3 columns arrows" style="text-align:right; padding-right:60px; padding-top:10px;">
				<span class="arrow_btn left_arrow left_move"> &lt; </span>
				<span style="margin-left:40px;" class="arrow_btn right_arrow right_move"> &gt; </span>
			</div>
		</div>
		<!--End button section -->

		<div class="row manage_customer_msg hide">
			<div class="large-7 columns large-centered success_msg ">
				Customer information has been successfully updated.
			</div>
		</div>

	</form>
	<!--End Customer Searching Section -->

	<!-- result found section -->
	<div class="row">
		<div class="large-12 columns result_found" style="font-size:13px; color:#0a855f;">
			<?php
			if(isset($_POST['search_btn']))
			{
				if(mysql_num_rows($query) == 1 || mysql_num_rows($query) == 0)
				echo "<span class='result_num'>".mysql_num_rows($query)."</span> result found.";
				else
				echo "<span class='result_num'>".mysql_num_rows($query)."</span> results found.";

			}
			?>
		</div>
	</div>
	<!-- end result found section -->



	<!-- display table division -->
	<div class="row manage_customer_table">
		<div class="large-12 columns ">
			<center>
				<table>
					<thead>
						<tr>
							<th><center> S No. </center></th>
							<th><center> Customer Name </center></th>
							<th><center> Mobile No. </center></th>
							<th><center> Email Id </center></th>
							<th><center> Address </center></th>
							<th></th>
						</tr>
					</thead>
					<tbody id="customer_display_data">

						<?php
						if( mysql_num_rows($query) > 0 )
						{
							$i = 1;
							while($row = mysql_fetch_array($query))
							{
								if(empty($row['name']))
								$customer_name = "<center>-</center>";
								else
								$customer_name = $row['name'];

								if(empty($row['phone_no']))
								$customer_mobile = "<center>-</center>";
								else
								$customer_mobile = $row['phone_no'];

								if(empty($row['email']))
								$customer_email = "<center>-</center>";
								else
								$customer_email = $row['email'];

								if(empty($row['address']))
								$customer_address = "<center>-</center>";
								else
								$customer_address = $row['address'];

								echo '<tr class="view_customer hide" id="'.$i.'">';
								echo "<td class='serial_no'>".$i."</td>";
								echo "<td class='hide customer_id'>".$row['id']."</td>";
								echo "<td contentEditable='false' class='customer_name'>".$customer_name."</td>";
								echo "<td class='customer_mobile'>".$customer_mobile."</td>";
								echo "<td class='customer_email'>".$customer_email."</td>";
								echo "<td class='customer_address'>".$customer_address."</td>";
								echo "<td>";
								if($row['id'] != "1")
								{	
									echo "<span class='edit_customer'><img src='img/iconmonstr-pencil-icon.png' style='height:18px;' title='Edit Customer' ></span>
											<span class='done_customer' style='display:none;'><img src='img/1380591407_tick_64.png' style='height:18px;' ></span>
											<span class='information_customer' style='margin-left:10px;'><img src='img/iconmonstr-info-5-icon.png' title='Information' style='height:18px;'></span>
											<span class='delete_customer' style='margin-left:10px;'><img src='img/iconmonstr-x-mark-icon.png' title='Delete Customer' style='height:18px;'></span>";

								}
								else{
									echo "<span class='information_customer' style='margin-left:0px;'><img src='img/iconmonstr-info-5-icon.png' title='Information' style='height:18px;'></span>";
								}
								echo "</td>";
								echo "</tr>";	


								$i++;
							}//end while loop
						}//end if condition if( mysql_num_rows($query) > 0 )
						else{
							echo '<div class="row manage_bill">
								<div class="large-12 columns error_msg">
									No Result Found !
								</div>
							</div>';
						}
						?>

					</tbody>
				</table>
			</center>
		</div>
	</div>
	<!--End display table division -->



	</div><!-- End large-9 columns -->
	<!--end Manage customer wrap -->


</div><!-- End row -->

<!-- modal start -->
<div id="bill-display-content" class="reveal-modal small" style="margin-top:0px;">
	<div class="row ">
		<div class="large-12 columns large-centered">
		
			<div class="row">
				<div class="large-2 columns ">
					<img src="img/1380650991_accepted_48.png">
				</div>
				<div class="large-10 columns end" style="font-size: 28px;color: green;font-weight: bold;padding-top: 7px;" >
					Operation Successful !
				</div>
			</div>
			

		</div> <!--end large-12 columns-->
	</div><!-- end row -->
<a class="close-reveal-modal bill_history_close">&#215;</a>
</div>
<!-- modal end -->


<!--bill history modal start -->
<div id="display_bill_history" class="reveal-modal medium" style="margin-top:-55px;" >
	<div class="row ">
		<div class="large-12 columns" style="padding:0px;">
		
			<div id="display_bill_history_modal">
				
			</div>

		</div> <!--end large-12 columns-->
	</div><!-- end row -->
<a class="close-reveal-modal bill_history_close">&#215;</a>
</div>
<!--bill history modal end -->



<!-- full bill view start -->
<div id="full_bill_view" class="reveal-modal expand" style="margin-top:-85px;">
	<div class="row bill_modal full_bill_view">
		<div class="large-12 columns heading">
		
		

		</div> <!--end large-12 columns-->
	</div><!-- end row -->
	<a class="close-reveal-modal full_bill_info_close">&#215;</a>
</div>
<!-- full bill view end -->



<div class="hidden_customer_id hide"></div>
<div class=" hide tr_last_class"></div>
<div class="hide_customer_mobile hide"></div>
<!-- Include Common Footer -->
<?php include 'footer.php' ?>
<!-- end Include Common Footer -->

<script type="text/javascript">

//pagination..

var last_row = $(".view_customer").last().attr("id");

$(".right_arrow").removeClass('right_arrow');
$(".left_arrow").removeClass('left_arrow');


if(last_row > 10)
{
	$(".tr_last_class").text("10");
	$(".right_move").addClass('right_arrow');
}

//display starting 10 rows..
for(var i = 1; i <=10; i++)
{
	$("#"+i).show();
}


$(".arrows").on("click",'.right_arrow',function(){

	//hide current display rows
	var last_display = $(".tr_last_class").text();
	var first_display = parseInt(last_display) - 9;

	for(var i = first_display ; i <= last_display ; i++)
	{
		$("#"+i).hide();
	}

	//show next display rows..
	var first_of_next_row = parseInt(last_display) + 1;
	var last_of_next_row = parseInt(last_display) + 10;

	for(var i = first_of_next_row ; i<= last_of_next_row ; i++)
	{
		$("#"+i).show();
	}

	$(".tr_last_class").text(last_of_next_row);
	$(".left_move").addClass('left_arrow');

	if( last_of_next_row >= $(".view_customer").last().attr("id") )
	{
		$(this).removeClass('right_arrow');
	}	

});



$(".arrows").on("click",'.left_arrow',function(){

	var last_display_row = $(".tr_last_class").text();
	var next_display_row = parseInt(last_display_row) -9;
	for(var i = last_display_row ; i >= next_display_row ; i--)
	{
		$("#"+i).hide();
	}

	var show_row_first_class = parseInt(last_display_row) - 10;
	var show_row_last_class = parseInt(last_display_row) - 19;
	for(var i = show_row_last_class ; i <= show_row_first_class ; i++)
	{
		$("#"+i).show();
	}

	$(".tr_last_class").text(show_row_first_class);
	$(".right_move").addClass('right_arrow');
	
	if(show_row_last_class == 1)
	{
		$(this).removeClass('left_arrow');
	}
});
//end pagination








//display bill history modal when click on information button
$(".information_customer").click(function(){
	
	var customer_id = $(this).parent().parent().children('.customer_id').text();
	$(".hidden_customer_id").text(customer_id);
	$(".la-anim-10").addClass('la-animate');
	$.ajax({
		type : "POST",
		url : "customer_ajax.php",
		data : {customer_id_modal:customer_id},
		success : function(result){
			$("#display_bill_history_modal").html(result);
			$("#display_bill_history").foundation('reveal','open');
			$(".la-anim-10").removeClass('la-animate');
		}//end success..
	});//end ajax..
});

//display bill history modal when click on close button of full bill modal..
$(".full_bill_info_close").click(function(){

	var customer_id = $(".hidden_customer_id").text();
	$(".la-anim-10").addClass('la-animate');
	
	$.ajax({
		type : "POST",
		url : "customer_ajax.php",
		data : {customer_id_modal:customer_id},
		success : function(result){
			$("#display_bill_history_modal").html(result);
			$("#display_bill_history").foundation('reveal','open');
			$(".la-anim-10").removeClass('la-animate');
		}//end success..
	});//end ajax..
});


$('.bill_history_close').click(function(){
	$(this).foundation('reveal', 'close');
});


$(".manage_customer_table .delete_customer").click(function(){
	var customer_name = $(this).parent().prev().prev().prev().prev().html();
	if(customer_name == "<center>-</center>")
	{
		var msg = "Do you want to delete Customer ?";
	}
	else
	{
		var msg = "Do you want to delete Customer, " + customer_name + " ?";
	}
	var confirm_msg = confirm(msg);
	if(confirm_msg == true)
	{
		$("#bill-display-content").foundation('reveal', 'open');
		$(this).parent().parent().remove();
		var customer_id = $(this).parent().prev().prev().prev().prev().prev().text();
		var number_of_result = $(".result_num").text();
		var number_of_result = parseInt(number_of_result) - 1;
		$(".result_num").text(number_of_result);

		$.ajax({
			type : "POST",
			url : "customer_ajax.php",
			data : {customer_id : customer_id},
			success : function(result){
				$("#customer_display_data tr").each(function(id){
					$(this).children('.serial_no').html(id+1);	
				});
			}
		})
	}
});

$("#phone_no").keypress(function(e) {
	if (e.which != 8  && e.which != 13 && e.which != 0 && e.which != 37 && e.which != 39 && (e.which < 48 || e.which > 57)) {
			return false;
	}
});

$(".manage_customer_table .edit_customer").click(function() {

	$(".manage_customer_table .done_customer").hide();
	$(".manage_customer_table .edit_customer").show();


	$(".manage_customer_table .customer_name").attr("contentEditable",false);
	$(".manage_customer_table .customer_mobile").attr("contentEditable",false);
	$(".manage_customer_table .customer_email").attr("contentEditable",false);
	$(".manage_customer_table .customer_address").attr("contentEditable",false);


	$(this).parent().prev().prev().prev().prev().attr("contentEditable",true).focus();
	$(this).parent().prev().prev().prev().attr("contentEditable",true);
	$(this).parent().prev().prev().attr("contentEditable",true);
	$(this).parent().prev().attr("contentEditable",true);

	
	$(this).next().show();
	$(this).hide();
	$(".hide_customer_mobile").text($(this).parent().prev().prev().prev().text());
});

$(".manage_customer_table .done_customer").click(function() {

	var customer_id = $(this).parent().prev().prev().prev().prev().prev().text();
	var customer_name = $(this).parent().prev().prev().prev().prev().text();
	var customer_mobile = $(this).parent().prev().prev().prev().text();
	var customer_email = $(this).parent().prev().prev().text();
	var customer_address = $(this).parent().prev().text();

	customer_detail = [customer_id,customer_name,customer_mobile,customer_email,customer_address];

	var customer_mobile_array = <?php echo json_encode($customer_mobile_array); ?>;

	var this_mobile_number = $(".hide_customer_mobile").text();
	var index = customer_mobile_array.indexOf(this_mobile_number);
	customer_mobile_array.splice(index, 1);//remove this number from array..

	//if entered mobile number is already exist in array..
	if( jQuery.inArray( customer_mobile, customer_mobile_array ) != "-1" )
	{
		alert("Mobile number already exist !");
		$(this).parent().parent().children('.customer_mobile').focus();
		
	}
	else
	{
		$("#bill-display-content").foundation('reveal', 'open');

		$.ajax({
			type : "POST",
			url : "customer_ajax.php",
			data : {customer_detail : customer_detail},
			success : function(result){
				
			}
		})

		$(this).prev().show();
		$(this).hide();

		$(".manage_customer_table .customer_name").attr("contentEditable",false);
		$(".manage_customer_table .customer_mobile").attr("contentEditable",false);
		$(".manage_customer_table .customer_email").attr("contentEditable",false);
		$(".manage_customer_table .customer_address").attr("contentEditable",false);
	}

	
});

$(".manage_customer_table .customer_name").keypress(function(e){ 
	if(e.which == 13)
	{
		$(this).next().next().next().next().children('.done_customer').click();
		return false;
	}
});

$(".manage_customer_table .customer_mobile").keypress(function(e){ 
	if (e.which != 8  && e.which != 13 && e.which != 0 && e.which != 37 && e.which != 39 && (e.which < 48 || e.which > 57)) {
		return false;

	}
	if(e.which == 13)
	{
		$(this).next().next().next().children('.done_customer').click();
		return false;
	}
	if($(this).text().length == 10)
	{
		return false;
	}

});

$(".manage_customer_table .customer_email").keypress(function(e){ 
	if(e.which == 13)
	{
		$(this).next().next().children('.done_customer').click();
		return false;
	}
});

$(".manage_customer_table .customer_address").keydown(function(e){ 
	if(e.which == 13)
	{
		$(this).next().children('.done_customer').click();
		return false;
	}
});



$(".manage_customer_table .customer_name").focusin(function() {
	if( $(this).text() == "-" )
	{
		$(this).text("");
	}
});


$(".manage_customer_table .customer_email").focusin(function() {
	if( $(this).text() == "-" )
	{
		$(this).text("");
	}
});

$(".manage_customer_table .customer_mobile").focusin(function() {
	if( $(this).text() == "-" )
	{
		$(this).text("");
	}
});

$(".manage_customer_table .customer_address").focusin(function() {
	if( $(this).text() == "-" )
	{
		$(this).text("");
	}
});

</script>