<!-- Include Main Head -->
<?php include 'header.php' ?>
<!-- end Main Head -->

<?php
date_default_timezone_set('Asia/Calcutta'); 
$today_date = date('Y-m-d');
if(isset($_POST['search_btn']))
{
	if(!empty($_POST['bill_number']))
	$bill_number = $_POST['bill_number'];
	else
	$bill_number = "%";

	if(!empty($_POST['product_name']))
	{
		$product_name = $_POST['product_name'];
		$query = mysql_query("SELECT * FROM product WHERE product_name = '$product_name' AND status = '1'");
		$row = mysql_fetch_array($query);
		if(mysql_num_rows($query) > 0)
		$product_id = "*".$row['product_id']."*";
		else
		$product_id = "******";
	}
	else
	$product_id = "%";
	
	if(!empty($_POST['date']))
	$date = $_POST['date'];
	else
	$date = "%";
	
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
	


	if(!empty($_POST['grand_total']))
	{
		$grand_total = $_POST['grand_total'];
		if($grand_total <= 100 && $grand_total > 0)
		{
			$min_grand_total = 0;
			$max_grand_total = 100;
		}
		elseif($grand_total <= 1000 && $grand_total >100)
		{
			$min_grand_total = $grand_total - 100;
			$max_grand_total = $grand_total + 100;
		}
		elseif($grand_total <= 10000 && $grand_total >1000)
		{
			$min_grand_total = $grand_total - 1000;
			$max_grand_total = $grand_total + 1000;
		}
		elseif($grand_total <= 100000 && $grand_total >10000)
		{
			$min_grand_total = $grand_total - 10000;
			$max_grand_total = $grand_total + 10000;
		}
		elseif($grand_total <= 1000000 && $grand_total >100000)
		{
			$min_grand_total = $grand_total - 100000;
			$max_grand_total = $grand_total + 100000;
		}
		elseif($grand_total <= 10000000 && $grand_total >1000000)
		{
			$min_grand_total = $grand_total - 1000000;
			$max_grand_total = $grand_total + 1000000;
		}
		elseif($grand_total <= 100000000 && $grand_total >10000000)
		{
			$min_grand_total = $grand_total - 10000000;
			$max_grand_total = $grand_total + 10000000;
		}
		elseif($grand_total <= 1000000000 && $grand_total >100000000)
		{
			$min_grand_total = $grand_total - 100000000;
			$max_grand_total = $grand_total + 100000000;
		}
		elseif($grand_total <= 10000000000 && $grand_total >1000000000)
		{
			$min_grand_total = $grand_total - 1000000000;
			$max_grand_total = $grand_total + 1000000000;
		}
		elseif($grand_total <= 100000000000 && $grand_total >10000000000)
		{
			$min_grand_total = $grand_total - 10000000000;
			$max_grand_total = $grand_total + 10000000000;
		}
		$sql = "SELECT bill.bill_number AS bill_number, customer.name AS customer_name , customer.phone_no AS customer_mobile , bill.created_date AS bill_date,bill.grand_total AS grand_total , bill.total_item AS total_item, bill.due AS due FROM bill,customer WHERE bill.bill_number like '%{$bill_number}%' AND bill.product_id LIKE '%{$product_id}%' AND bill.created_date LIKE '%{$date}%' AND ( bill.grand_total >= {$min_grand_total} AND bill.grand_total <= {$max_grand_total} ) AND customer.name LIKE '%{$customer_name}%' AND customer.phone_no LIKE '%{$customer_mobile}%' AND customer.email LIKE '%{$customer_email}%' AND customer.address LIKE '%{$customer_address}%' AND bill.customer_id = customer.id AND bill.status = 1 order by bill.id DESC";
		$query = mysql_query($sql);
	}
	else
	{
		$sql = "SELECT bill.bill_number AS bill_number, customer.name AS customer_name , customer.phone_no AS customer_mobile , bill.created_date AS bill_date,bill.grand_total AS grand_total , bill.total_item AS total_item, bill.due AS due FROM bill,customer WHERE bill.bill_number like '%{$bill_number}%' AND bill.product_id LIKE '%{$product_id}%' AND bill.created_date LIKE '%{$date}%' AND customer.name LIKE '%{$customer_name}%' AND customer.phone_no LIKE '%{$customer_mobile}%' AND customer.email LIKE '%{$customer_email}%' AND customer.address LIKE '%{$customer_address}%' AND bill.customer_id = customer.id AND bill.status = 1 order by bill.id DESC";
		$query = mysql_query($sql);
	}

}

?>




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
				MANAGE BILL
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

				<!-- Product Name -->
				<div class="large-3 columns">
					<input type="text" list='product_name_list' autocomplete = 'off' id="product_name" name="product_name" value="" placeholder="Enter Product Name">
					<datalist id="product_name_list">
						<?php
						$query_product = mysql_query("SELECT product_name FROM product WHERE status = 1 ");
						while($row_product = mysql_fetch_assoc($query_product))
						{
							echo "<option value='".$row_product['product_name']."'>";
						}

						?>
					</datalist>
				</div>
				<!--End Product Name -->

				<!-- Date -->
				<div class="large-3 columns">
					<input type="date" id="date" value="" autocomplete="off" name="date" max='<?php echo $today_date; ?>'>
				</div>
				<!--End Date -->

				<!-- Grand Total -->
				<div class="large-3 columns">
					<input type="text" id="grand_total" autocomplete="off" name="grand_total" value="" placeholder="Enter Grand Total" >
				</div>
				<!--End Grand Total -->
			</div>
		</div>
		<div class="row">
			<div class="large-12 columns">

				<!-- Customer Name  -->
				<div class="large-3 columns">
					<input type="text" list="name_datalist" autocomplete = 'off' id="customer_name" name="customer_name" value="" placeholder="Customer Name">
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
					<input type="text" list="phone_datalist" id="phone_no" autocomplete = 'off' maxlength="10" name="customer_mobile" value="" placeholder="Customer Phone Number">
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
					<input type="text" list="email_datalist" id="email" autocomplete = 'off' name="customer_email" value="" placeholder="Customer Email Address" >
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
					<input type="text" list="address_datalist" autocomplete="off" id="address" name="customer_address" value="" placeholder="Customer Address" >
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

	<!-- display table division -->
	<div class="row manage_bill_table">
		<div class="large-12 columns ">
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
							<th><center> Grand Total </center></th>
							<th><center> Dues </center></th>
						</tr>
					</thead>
					<tbody>
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
								
								echo '<tr class="view_bill hide" id="'.$i.'">';
								echo "<td>".$i."</td>";
								echo "<td class='bill_no'>".$row['bill_number']."</td>";
								echo "<td>".$customer_name."</td>";
								echo "<td>".$customer_mobile."</td>";
								echo "<td>".$row['total_item']."</td>";
								echo "<td>".$bill_date."</td>";
								echo "<td><span class='WebRupee'>Rs. </span>".$row['grand_total']."</td>";
								echo "<td>".$due."</td>";
								echo '</tr>';
								$i++;
							}
							echo "</tbody>
							</table></center>";

						}
						?>
		</div>
		<!--end large-12 columns division -->
	</div>
	<!--End display table division -->

	<?php
	if(isset($_POST['search_btn']))
	{
		if(mysql_num_rows($query) == 0)
		{
	?>

	<div style="text-align:center; color:#7F7C7C;font-size:20px;">
			No Result Found.. !
	</div>

	<?php
		}
	}
	?>

		</div><!-- End large-9 columns -->
	</div> <!-- end row -->
</div> <!-- end dashboard -->




<!-- start bill modal -->
<div id="bill-display-content" class="reveal-modal expand" style="margin-top:-85px;">
	<div class="row bill_modal">
		<div class="large-12 columns heading">
		
		

		</div> <!--end large-12 columns-->
	</div><!-- end row -->
<a class="close-reveal-modal">&#215;</a>

</div>
<!-- end bill modal -->	

<div class=" hide tr_last_class"></div>
<!-- Include Common Footer -->
<?php include 'footer.php' ?>
<!-- end Include Common Footer -->


<script>
//start pagination
var last_row = $(".view_bill").last().attr("id");

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

	if( last_of_next_row >= $(".view_bill").last().attr("id") )
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


$('.close-reveal-modal').click(function(){
	$(this).foundation('reveal', 'close');
});

$(".view_bill").click(function(){
	var bill_no = $(this).children('.bill_no').text();
	$(".la-anim-10").addClass('la-animate');
	
	// $(".table_body_modal").fadeOut(1000);
	$.ajax({
		type : "POST",
		url : "manage_bill_ajax.php",
		data : {bill_number : bill_no},
		success : function(result){
			$(".bill_modal .heading").html(result);
			$("#bill-display-content").foundation('reveal', 'open');
			$(".la-anim-10").removeClass('la-animate');

		}
	})
})

//accept only integer for discount
$("#phone_no").keypress(function(e){
	// keypress(function (e) {
	//if the letter is not digit then display error and don't type anything
	if (e.which != 8  && e.which != 13 && e.which != 0 && e.which != 37 && e.which != 39 && (e.which < 48 || e.which > 57)) {
		return false;
	}
});

//accept only integer for discount
$("#grand_total").keypress(function(e){
	// keypress(function (e) {
	//if the letter is not digit then display error and don't type anything
	if (e.which != 8  && e.which != 13 && e.which != 0 && e.which != 37 && e.which != 39 && (e.which < 48 || e.which > 57)) {
		return false;
	}
});

  </script>