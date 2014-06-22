<!-- include Main Head -->
<?php include 'header.php' ?>
<?php
date_default_timezone_set('Asia/Calcutta'); 
$today_date = date('Y-m-d');

if(isset($_POST['search_btn']))
{
	if(!empty($_POST['bill_number']))
	$bill_number = $_POST['bill_number'];
	else
	$bill_number = "%";

	if(!empty($_POST['customer_name']))
	$customer_name = $_POST['customer_name'];
	else
	$customer_name = "%";
	
	if(!empty($_POST['customer_mobile']))
	$customer_mobile = $_POST['customer_mobile'];
	else
	$customer_mobile = "%";

	if(!empty($_POST['customer_email']))
	$customer_email = $_POST['customer_email'];
	else
	$customer_email = "%";

	if(!empty($_POST['customer_address']))
	$customer_address = $_POST['customer_address'];
	else
	$customer_address = "%";
	
	if(!empty($_POST['date']))
	$date = $_POST['date'];
	else
	$date = "%";
	
	if(!empty($_POST['due_from']) || !empty($_POST['due_to']))
	{
		if( !empty($_POST['due_from']) && !empty($_POST['due_to']) )
		{
			$due_from_enter = $_POST['due_from'];
			$due_to_enter = $_POST['due_to'];

			$sql = "SELECT customer.id AS customer_id , customer.total_paid_due AS total_paid_due , bill.bill_number AS bill_number, customer.name AS customer_name , customer.phone_no AS customer_mobile , 
					bill.created_date AS bill_date , bill.grand_total AS grand_total , bill.total_item AS total_item, bill.due AS due , 
					customer.total_due AS total_due FROM bill,customer WHERE bill.bill_number LIKE '%{$bill_number}%' AND 
					bill.created_date LIKE '%{$date}%' AND customer.name LIKE '%{$customer_name}%' AND 
					customer.phone_no LIKE '%{$customer_mobile}%' AND customer.email LIKE '%{$customer_email}%' AND 
					customer.address LIKE '%{$customer_address}%' AND customer.total_due - customer.total_paid_due >= $due_from_enter AND 
					customer.total_due - customer.total_paid_due <= $due_to_enter AND	bill.customer_id = customer.id AND 
					customer.status = 1 order by bill.id DESC";

		}
		else if(!empty($_POST['due_from']))
		{
			$due_from_enter = $_POST['due_from'];

			$sql = "SELECT customer.id AS customer_id , customer.total_paid_due AS total_paid_due , bill.bill_number AS bill_number, customer.name AS customer_name , customer.phone_no AS customer_mobile , 
					bill.created_date AS bill_date , bill.grand_total AS grand_total , bill.total_item AS total_item, bill.due AS due , 
					customer.total_due AS total_due FROM bill,customer WHERE bill.bill_number LIKE '%{$bill_number}%' AND 
					bill.created_date LIKE '%{$date}%' AND customer.name LIKE '%{$customer_name}%' AND 
					customer.phone_no LIKE '%{$customer_mobile}%' AND customer.email LIKE '%{$customer_email}%' AND 
					customer.address LIKE '%{$customer_address}%' AND customer.total_due - customer.total_paid_due >= $due_from_enter AND  
					bill.customer_id = customer.id AND customer.status = 1 order by bill.id DESC";
		}
		else if(!empty($_POST['due_to']))
		{
			$due_to_enter = $_POST['due_to'];

			$sql = "SELECT customer.id AS customer_id , customer.total_paid_due AS total_paid_due , bill.bill_number AS bill_number, customer.name AS customer_name , customer.phone_no AS customer_mobile , 
					bill.created_date AS bill_date , bill.grand_total AS grand_total , bill.total_item AS total_item, bill.due AS due , 
					customer.total_due AS total_due FROM bill,customer WHERE bill.bill_number LIKE '%{$bill_number}%' AND 
					bill.created_date LIKE '%{$date}%' AND customer.name LIKE '%{$customer_name}%' AND 
					customer.phone_no LIKE '%{$customer_mobile}%' AND customer.email LIKE '%{$customer_email}%' AND 
					customer.address LIKE '%{$customer_address}%' AND customer.total_due - customer.total_paid_due <= $due_to_enter AND  
					bill.customer_id = customer.id AND customer.status = 1 order by bill.id DESC";
		}
	}
	else
	{
		$sql = "SELECT customer.id AS customer_id , customer.total_paid_due AS total_paid_due , bill.bill_number AS bill_number, customer.name AS customer_name , customer.phone_no AS customer_mobile , 
		bill.created_date AS bill_date , bill.grand_total AS grand_total , bill.total_item AS total_item, bill.due AS due , 
		customer.total_due AS total_due FROM bill,customer WHERE bill.bill_number LIKE '%{$bill_number}%' AND 
		bill.created_date LIKE '%{$date}%' AND customer.name LIKE '%{$customer_name}%' AND 
		customer.phone_no LIKE '%{$customer_mobile}%' AND customer.email LIKE '%{$customer_email}%' AND 
		customer.address LIKE '%{$customer_address}%' AND bill.customer_id = customer.id AND 
		customer.status = 1 order by bill.id DESC";
	}

	$query = mysql_query($sql);
}
?>
<!-- end Main Head -->



<div class="dashboard">
	<div class="row">

	<!-- Quick Navigation Menu -->
	<?php include 'quicknav.php' ?>
	<!-- end Quick Navigation Menu -->

		<!-- Manage Bill Wrap -->
		<div class="large-9 columns viewstock">
		
			<!-- Search Heading -->
			<div class="row">
				<div class="large-4 large-centered columns" id="viewstock-heading">
					DUES
				</div>
			</div>
			<!-- end Search Heading -->
		

			<!-- Searching Section -->
			<form action="" method="post">
				<div class="row">
					<div class="large-12 columns">
						

						<!-- Bill Number -->
						<div class="large-3 columns">
							<input type="text" id="bill_number" autocomplete="off" name="bill_number" value="" placeholder="Enter Bill Number">
						</div>
						<!--End Bill Number -->

						<!-- Due date from -->
						<div class="large-3 columns">
							<input type="text"  id="due_from" autocomplete="off" name="due_from" value="" placeholder="Enter Due (From)">
							
						</div>
						<!--End Due date from -->

						<!-- Due date to -->
						<div class="large-3 columns">
							<input type="text" id="due_to" autocomplete="off" value="" name="due_to" placeholder="Enter Due (To)" >
						</div>
						<!--End Due date to -->

						<!-- Grand Total -->
						<div class="large-3 columns">
							<input type="date" id="date" autocomplete="off" name="date" value="" max='<?php echo $today_date; ?>'>
						</div>
						<!--End Grand Total -->
					</div>
				</div>
				<div class="row">
					<div class="large-12 columns">

						<!-- Customer Name  -->
						<div class="large-3 columns">
							<input type="text" list="name_datalist" autocomplete="off" id="customer_name" name="customer_name" value="" placeholder="Customer Name">
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
							<input type="text" list="address_datalist" id="address" autocomplete="off" name="customer_address" value="" placeholder="Customer Address" >
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

			</form>
			
	<!-- result found section -->
	<div class="row">
		<div class="large-12 columns result_found" style="font-size:13px; color:#0a855f;">
			<?php
			if(isset($_POST['search_btn']))
			{
				if(mysql_num_rows($query) == 1 || mysql_num_rows($query) == 0)
				echo mysql_num_rows($query)." result found.";
				else
				echo mysql_num_rows($query)." results found.";

			}
			?>
		</div>
	</div>
	<!-- end result found section -->


			<!-- display table division -->
			<div class="row manage_bill_table">
				<div class="large-12 columns dues_customer_list ">


					<center>
						<table>
							<thead>
								<tr>
									<th><center> S No. </center></th>
									<th><center> Bill No. </center></th>
									<th><center> Customer Name </center></th>
									<th><center> Mobile No. </center></th>
									<th><center> Items </center></th>
									<th><center> Date </center></th>
									<th><center> Due </center></th>
									<th><center> Remaining Due </center></th>
								</tr>
							</thead>
							<tbody id="due_table_body">
							<?php
							if( mysql_num_rows($query) > 0 )
							{
								$i = 1;
								while($row = mysql_fetch_array($query))
								{
									if(empty($row['customer_name']))
									$customer_name = "-";
									else
									$customer_name = $row['customer_name'];

									if(empty($row['customer_mobile']))
									$customer_mobile = "-";
									else
									$customer_mobile = $row['customer_mobile'];

									if(($row['due'] == "0.00"))
									$due = "<center>-</center>";
									else
									$due = "<span class='WebRupee'>Rs. </span>".$row['due'];


									$date = $row['bill_date'];
									$explode_date = explode(" ", $date);
									$date = $explode_date['0'];
									$time = $explode_date['1'];
									// echo $date;

									$final_date =  date("M jS, Y", strtotime($date));
									$final_time = date("h:i a", strtotime($time));
									$bill_date = $final_date . " &nbsp; &nbsp; &nbsp; [ $final_time ]";

									$remaining_due = $row['total_due'] - $row['total_paid_due'];

									$remaining_due = number_format($remaining_due , 2 , '.' , '');
									
									if($remaining_due == "0.00")
									$remaining_due = "<center>-</center>";
									else
									$remaining_due = "<span class='WebRupee'>Rs. </span>".$remaining_due;


									echo '<tr class="bill_history_click hide" id="'.$i.'">';
									echo "<td class='customer_id hide' >".$row['customer_id']."</td>";
									echo "<td>".$i."</td>";
									echo "<td style='text-align:center;'>".$row['bill_number']."</td>";
									echo "<td>".$customer_name."</td>";
									echo "<td>".$customer_mobile."</td>";
									echo "<td style='text-align:center;'>".$row['total_item']."</td>";
									echo "<td>".$bill_date."</td>";
									echo "<td>".$due."</td>";
									echo "<td style='text-align:right' class='remaining_due'>".$remaining_due."</td>";
									echo '</tr>';
									$i++;
								}
								echo "</tbody>
								</table></center>";

							}
							else
							{
								echo '<div class="row manage_bill">
									<div class="large-12 columns error_msg">
										No Result Found !
									</div>
								</div>';
							
							}
							?>					
							
					
				</div>
				<!--end large-12 columns division -->
			</div>
			<!--End display table division -->


		</div><!-- End large-9 columns -->
	</div><!-- End row -->
</div><!-- End dashboard -->


<!-- bill history modal start -->
<div id="display_bill_history" class="reveal-modal medium" style="margin-top:-85px;" >
	<div class="row ">
		<div class="large-12 columns" style="padding:0px;">
		
			<div id="display_bill_history_modal">
				
			</div>

		</div> <!--end large-12 columns-->
	</div><!-- end row -->
<a class="close-reveal-modal bill_history_close">&#215;</a>
</div>
<!--bill history modal end -->


<!-- due paid history modal start -->
<div id="display_due_paid_history" class="reveal-modal medium" style="margin-top:-85px;" >
	<div class="row ">
		<div class="large-12 columns" style="padding:0px;">
		
			<div id="due_paid_history">
				
			</div>

		</div> <!--end large-12 columns-->
	</div><!-- end row -->
<a class="close-reveal-modal full_bill_info_close">&#215;</a>
</div>
<!--due paid history modal end -->


<!-- full bill view start -->
<div id="full_bill_view" class="reveal-modal expand" style="margin-top:-85px;">
	<div class="row bill_modal full_bill_view">
		<div class="large-12 columns heading">
		
		

		</div> <!--end large-12 columns-->
	</div><!-- end row -->
	<a class="close-reveal-modal full_bill_info_close">&#215;</a>
</div>
<!-- full bill view end -->


<!-- div for store customer id -->
<div class="hidden_customer_id hide"></div>

<!-- hidden div for paggination -->
<div class=" hide tr_last_class"></div>
<!-- Include Common Footer -->
<?php include 'footer.php' ?>
<!-- end Include Common Footer -->


<script type="text/javascript">

//start pagination
var last_row = $(".bill_history_click").last().attr("id");

$(".right_arrow").removeClass('right_arrow');
$(".left_arrow").removeClass('left_arrow');

if(last_row > 10)
{
	$(".tr_last_class").text("10");
	$(".right_move").addClass('right_arrow');
}

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

	if( last_of_next_row >= $(".bill_history_click").last().attr("id") )
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

//end pagination..





$(".bill_history_click").click(function(){
	
	var customer_id = $(this).children().first().text();
	$(".hidden_customer_id").text(customer_id);
	$(".la-anim-10").addClass('la-animate');
	$.ajax({
		type : "POST",
		url : "due_ajax.php",
		data : {customer_id_modal:customer_id},
		success : function(result){
			$(".la-anim-10").removeClass('la-animate');
			$("#display_bill_history_modal").html(result);
			$("#display_bill_history").foundation('reveal','open');
		}//end success..
	});//end ajax..
});

//display bill history modal when click on close button of full bill modal..
$(".full_bill_info_close").click(function(){
	$(".la-anim-10").addClass('la-animate');
	var customer_id = $(".hidden_customer_id").text();
	$.ajax({
		type : "POST",
		url : "due_ajax.php",
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

//accept only integer for discount
$("#phone_no , #due_from , #due_to").keypress(function(e){
	// keypress(function (e) {
	//if the letter is not digit then display error and don't type anything
	if (e.which != 8  && e.which != 13 && e.which != 0 && e.which != 37 && e.which != 39 && (e.which < 48 || e.which > 57)) {
		return false;
	}
});


$(".manage_bill .error_msg").delay(5000).slideUp(800);

</script>

