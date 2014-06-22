<?php
include 'include/db.php';

date_default_timezone_set('Asia/Calcutta'); 
$bill_time =  date("M jS, Y [h:i a]");

//assign new bill number..
$query = mysql_query("SELECT id FROM bill order by id DESC LIMIT 1 ");
$row = mysql_fetch_array($query);
if(mysql_num_rows($query) > 0)
{
	$new_bill_number = $row['id'] + 1;
	$bill_number = "AWC_".$new_bill_number;
}
else{
	$bill_number = "AWC_1";
}
?>
<html>
	<head>
		<link rel="stylesheet" href="css/style.css">
	</head>
</html>
<body>

				

	<div class="row bill_modal">
		<div class="large-12 columns heading">
			<div class="header">
				<center class="cash_invoice">Cash Invoice</center>
				<!-- main heading -->
				<div class="row heading_row">
					<span>
						TIN No :- <span>09688823028c</span>
					</span>
					<span>
						Awesome Collection
					</span>
					<span>
						jasldfj asdjf laljadfs 
					</span>
					<div class="large-3 small-3 columns end phone_no">
						Phone No :- <span>01204542888</span>
					</div>
				</div>
				<!-- main heading -->
				</div>
			<div class="bill_detail">
				<!-- customer detail -->
				<div class="row customer_detail">
					<div class="large-2 columns customer_name_heading">
						Customer Name : 
					</div>
					<div class="large-2 columns customer_name" style="border:1px solid #fff">
						
					</div>
					<div class="large-2 columns customer_mobile_heading">
						Customer Mobile :
					</div>
					<div class="large-2 columns customer_mobile" style="border:1px solid #fff">
						
					</div>
					
					<div class="large-4 columns end ">
						<div class="row">
							<div class="large-4 columns bill_date_heading">
								Bill Date :
							</div>
							<div class="large-8 columns end bill_date" >
								<?php echo $bill_time; ?>
							</div>
						</div>
					</div>
				</div>

				<!--end customer detail -->
				<!-- customer detail -->
				<div class="row customer_detail second_detail_row">
					<div class="large-2 columns end customer_name_heading">
						Customer Email : 
					</div>
					<div class="large-2 columns end customer_email " style="border:1px solid #fff">
					
					</div>
					<div class="large-2 columns end customer_mobile_heading">
						Customer Address :
					</div>
					<div class="large-2 columns end customer_address" style="border:1px solid #fff">

					</div>
					
					<div class="large-4 columns">
						<div class="row">
							<div class="large-4 columns bill_date_heading">
								Bill No :
							</div>
							<div class="large-8 columns end" >
								<?php echo $bill_number; ?>
							</div>
						</div>
					</div>
				</div>

				<!--end customer detail -->
			</div>

			<center>
					<table>
						<thead>
							<tr>
								<th><center> S.No. </center></th>
								<th><center> Product Code </center></th>
								<th><center> Product Name </center></th>
								<th><center> Category </center></th>
								<th><center> Brand </center></th>
								<th><center> Size </center></th>
								<th><center> Price </center></th>
								<th><center> Quantity </center></th>
								<th><center> Discount (%) </center></th>
								<th><center> Disc Amt. </center></th>
								<th><center> Amount </center></th>
							</tr>
						</thead>
						<tbody class="table_body_modal">
							
						</tbody>
					</table>
				</center>


			<div class="row payment_detail_modal">
				<div class="large-12 columns">
					<fieldset>
					  	<legend>Payment Details</legend>
					  	<div class="row">
					  		<div class="large-2 columns">
					  			<span class="total_qty">Total Qty : </span><span class="total_item_modal"></span>
					  		</div>
					  		<div class="large-2 large-offset-6 columns sub_total">
					  			<span>Sub Total : </span>
					  		</div>
					  		<div class="large-2 columns end sub_total">
					  		<span class="WebRupee">Rs. </span><span class="sub_total_modal"></span>
					  		</div>
					  	</div>
					  	<div class="row discount">
					  		<div class="large-2 columns large-offset-8">
					  			Main Discount :
					  		</div>
					  		<div class="large-2 columns end" >
					  			<span class="main_discount_modal"></span><span> %</span>
					  		</div>
					  	</div>

					  	<div class="row grand_total">
					  		<div class="large-2 columns total_payable">
					  			Total Payable : 
					  		</div>
					  		<div class="large-6 columns amount_in_words_modal" >
					  			
					  		</div>
					  		<div class="large-2 columns grand_total_text">
					  			Grand Total :
					  		</div>
					  		<div class="large-2 columns end grand_total_text " >
					  			<span class="WebRupee">Rs. </span><span class="grand_total_modal"></span>
					  		</div>
					  	</div>					
						
					</fieldset>
				</div>
			</div>
		
		</div>
	</div>


</body>
