<?php
include 'include/db.php';
if(isset($_POST['bill_number']))
{
	$bill_number = $_POST['bill_number'];
	$sql = "SELECT * FROM bill WHERE bill_number = '$bill_number' AND status = '1'";
	$query = mysql_query($sql);
	$row = mysql_fetch_array($query);

	$customer_id = $row['customer_id'];
	$sql_customer = "SELECT * FROM customer WHERE id = '$customer_id'";
	$query_customer = mysql_query($sql_customer);
	$row_customer = mysql_fetch_assoc($query_customer);

	$date = $row['created_date'];
	$explode_date = explode(" ", $date);
	$date = $explode_date['0'];
	$time = $explode_date['1'];
	// echo $date;

	$final_date =  date("M jS, Y", strtotime($date));
	$final_time = date("h:i a", strtotime($time));
	$bill_date = $final_date . " &nbsp;[ $final_time ]";

	$product_id_array = explode("/",$row['product_id']);
	$quantity_array = explode("/", $row['quantity']);
	$price_array = explode("/",$row['product_price']);
	$discount_per_item_array = explode("/", $row['discount_per_item']);
	$discount_amount_per_item_array = explode("/",$row['discount_amount_per_item']);
	$amount_per_item_array = explode("/", $row['amount_per_item']);

?>
	<div class="header">
				<center class="cash_invoice">Cash Invoice</center>
				<!-- main heading -->
				<div class="row heading_row">
					<div class="large-3 columns tin_no">
						TIN No :- <span>08010979311c</span>
					</div>
					<div class="large-6 columns ">
						<div class="row">
							<div class="large-12 columns main_heading">
								Sampoorn
							</div>
						</div>
						<div class="row">
							<div class="large-12 columns address">
								A-249 Lajpat Nagar, Sahibabad, Ghaziabad (U.P.)
							</div>
						</div>

					</div>
					<div class="large-3 columns end phone_no">
						Mobile No :- <span>+91-9871198786</span>
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
						<?php echo $row_customer['name'] ?>
					</div>
					<div class="large-2 columns customer_mobile_heading">
						Customer Mobile :
					</div>
					<div class="large-2 columns customer_mobile" style="border:1px solid #fff">
						<?php echo $row_customer['phone_no']; ?>
					</div>
					
					<div class="large-4 columns end ">
						<div class="row">
							<div class="large-4 columns bill_date_heading">
								Bill Date :
							</div>
							<div class="large-8 columns end bill_date" >
								<?php echo $bill_date; ?>
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
						<?php echo $row_customer['email']; ?>
					</div>
					<div class="large-2 columns end customer_mobile_heading">
						Customer Address :
					</div>
					<div class="large-2 columns end customer_address" style="border:1px solid #fff">
						<?php echo $row_customer['address']; ?>
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
							<?php
							$a = 1;
							for($i = 0 ; $i < count($product_id_array) ; $i++)
							{
								$product_id = $product_id_array[$i];
								$product_id = substr($product_id, 0,-1);// remove last *
								$product_id = substr($product_id,1); // remove first *

								$quantity = $quantity_array[$i];
								$quantity = substr($quantity, 0,-1);// remove last *
								$quantity = substr($quantity,1); // remove first *

								$sql_product = "SELECT product.product_id AS product_id, product.barcode AS barcode, category.category AS category , 
												product.product_name AS product_name, product.price AS price, 
												product.size AS size, product.qty AS qty , product.sell_qty AS sell_qty ,
												product.type AS type, brand.brand AS brand FROM category,product,brand 
												WHERE category.id = product.category AND brand.id = product.brand 
												AND product.product_id = '$product_id'";
								$query_product = mysql_query($sql_product);
								$row_product = mysql_fetch_assoc($query_product);

								echo "<tr>";
								echo "<td>".$a."</td>";
								echo "<td>".$row_product['barcode']."</td>";
								echo "<td>".$row_product['product_name']."</td>";
								echo "<td>".$row_product['category']."</td>";
								echo "<td>".$row_product['brand']."</td>";
								echo "<td>".$row_product['size']."</td>";
								echo "<td><span class='WebRupee'>Rs. </span>".$price_array[$i]."</td>";
								echo "<td>".$quantity."</td>";
								echo "<td>".$discount_per_item_array[$i]."</td>";
								echo "<td><span class='WebRupee'>Rs. </span>".$discount_amount_per_item_array[$i]."</td>";
								echo "<td><span class='WebRupee'>Rs. </span>".$amount_per_item_array[$i]."</td>";
								echo "</tr>";
								$a++;
							}
							?>
						</tbody>
					</table>
				</center>


			<div class="row payment_detail_modal">
					<div class="large-12 columns">
						<fieldset>
						  	<legend>Payment Details</legend>
						  	<div class="row">
						  		<div class="large-2 columns">
						  			<span class="total_qty">Total Qty : </span><span class="total_item_modal"><?php echo $row['total_item']; ?></span>
						  		</div>
						  		<div class="large-2 large-offset-6 columns sub_total">
						  			<span>Sub Total : </span>
						  		</div>
						  		<div class="large-2 columns end sub_total">
						  		<span class="WebRupee">Rs. </span><span class="sub_total_modal"><?php echo $row['sub_total']; ?></span>
						  		</div>
						  	</div>
						  	<div class="row discount">
						  		<div class="large-2 columns large-offset-8">
						  			Main Discount :
						  		</div>
						  		<div class="large-2 columns end" >
						  			<span class="main_discount_modal"><?php echo $row['main_discount']; ?></span><span> %</span>
						  		</div>
						  	</div>

						  	<div class="row grand_total">
						  		
						  		<div class="large-2 columns large-offset-8 grand_total_text">
						  			Grand Total :
						  		</div>
						  		<div class="large-2 columns end grand_total_text " >
						  			<span class="WebRupee">Rs. </span><span><?php echo $row['grand_total'];  ?></span>
						  		</div>
						  	</div>	

						  	<div class="row grand_total">
						  		
						  		<div class="large-2 columns large-offset-8 grand_total_text">
						  			Pay :
						  		</div>
						  		<div class="large-2 columns end grand_total_text " >
						  			<span class="WebRupee">Rs. </span><span><?php echo $row['pay'];  ?></span>
						  		</div>
						  	</div>

						  	<?php
							if($row['due'] != "0.00")
							{
							?>
						  	<div class="row grand_total">
						  		
						  		<div class="large-2 columns large-offset-8 grand_total_text">
						  			Due :
						  		</div>
						  		<div class="large-2 columns end grand_total_text " >
						  			<span class="WebRupee">Rs. </span><span><?php echo $row['due'];  ?></span>
						  		</div>
						  	</div>
							<?php
							}
							?>
							
						</fieldset>
					</div>
				</div>
				
				<div class="row">
					<div class="large-2 columns large-centered">
						<button id="print_btn">Print</button>
					</div>
				</div>
<?php
}//end if condition if(isset($_POST['bill_number']))
?>