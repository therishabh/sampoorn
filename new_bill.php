<!--Include Main Head -->
<?php include 'header.php' ?>
<?php
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

$sql = "SELECT product.product_id AS product_id, product.barcode AS barcode, 
		category.category AS category , 
		product.product_name AS product_name, product.price AS price, 
		product.size AS size, product.qty AS qty , product.sell_qty AS sell_qty ,
		product.type AS type, brand.brand AS brand FROM category,product,brand 
		WHERE category.id = product.category AND brand.id = product.brand 
		AND product.status = 1";
$query = mysql_query($sql);
$product_id = array();
$barcode = array();
$product_name = array();
$category = array();
$brand = array();
$size = array();
$type = array();
$price = array();
$quantity = array();
$sell_quantity = array();

if(mysql_num_rows($query) > 0 )
{
	while($row = mysql_fetch_array($query))
	{

		// $category_query = mysql_query("SELECT * FROM cat")
		empty($row['product_name']) ? $product_name_db = "-" : $product_name_db = $row['product_name'];
		array_push($product_id, $row['product_id']);
		array_push($barcode,$row['barcode']);
		array_push($product_name,$product_name_db);
		array_push($category,$row['category']);
		array_push($brand,$row['brand']);
		array_push($size, $row['size']);
		array_push($type, $row['type']);
		array_push($price, $row['price']);
		array_push($quantity, $row['qty']);
		array_push($sell_quantity, $row['sell_qty']);
	}
}

?>

<!-- end Main Head -->

<div class="dashboard">
	<div class="row">
	<div id="hidden-text" class="hide" ></div>
	<div class="hidden_div_serial_no hide">1</div>
	<div class="item_flag hide">false</div>


		
		

		<!-- View Stock Wrap -->
		<div class="large-12 columns viewstock">

		


		<!-- Search Heading -->
			<div class="row">
				<div class="large-4 large-centered columns" id="viewstock-heading">
					New Bill
				</div>
			</div>
		<!-- end Search Heading -->
	

		<!-- Customer Section -->
		<div class="row">
			<div class="large-12 columns">
				

				<!-- Customer name -->
				<div class="large-3 columns">
					<input type="text"  list="name_datalist"  autocomplete="off" id="customer_name"  value="" placeholder="Enter Customer Name">
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
				<!--End Customer name -->

				<!-- Customer Mobile -->
				<div class="large-3 columns">
					<input type="text" list="mobile_datalist"  autocomplete="off" autofocus pattern="[0-9]{10}" maxlength="10" id="customer_mobile" value="" placeholder="Enter Customer Mobile">
					<datalist id="mobile_datalist">
						<?php
						$query_phone = mysql_query("SELECT phone_no FROM customer WHERE phone_no != '' AND id != 1 AND status = 1");
						if(mysql_num_rows($query_phone) > 0)
						{
							while($row_phone = mysql_fetch_assoc($query_phone))
							{
								echo '<option value="'.$row_phone['phone_no'].'">';
							}
						}
						?>
					</datalist>
				</div>

				<!--End Customer Mobile -->

				<!-- Customer Email -->
				<div class="large-3 columns">
					<input type="email" list="email_datalist"  autocomplete="off" id="customer_email" value="" placeholder="Enter Customer Email">
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
				<!--End Customer Email -->

				<!-- Customer Address -->
				<div class="large-3 columns">
					<input type="text" id="customer_address" value="" placeholder="Enter Customer Address">
				</div>
				<!--End Customer Address -->

			</div>
		</div>
		<!--End Customer Section -->

		<!-- Start Billing Section -->
		<div class="row">
			<div class="large-12 columns">
				
				<center>
					<table>
						<thead>
							<tr>
								<th><center> Barcode </center></th>
								<th><center> Product Name </center></th>
								<th><center> Category </center></th>
								<th><center> Brand </center></th>
								<th><center> Size </center></th>
								<th><center> Type </center></th>
								<th><center> Price </center></th>
								<th><center> Quantity </center></th>
								<th><center> Discount (%) </center></th>
								<th><center> Disc Amt. </center></th>
								<th><center> Amount </center></th>
								<th></th>
							</tr>
						</thead>
						<tbody id="table_body">
							<tr class="1">
								<td>
									<input type="text" list="product_barcode" class="barcode">
									<datalist id="product_barcode">
										<?php $query_barcode = mysql_query("SELECT barcode FROM product WHERE status = 1");
										if(mysql_num_rows($query_barcode) > 0)
										{
											while($row_barcode = mysql_fetch_assoc($query_barcode))
											{
												echo "<option value=".$row_barcode["barcode"].">";
											}
										}
										?>
									</datalist>
								</td>
								<td class="product_name"></td>
								<td class="category"></td>
								<td class="brand"></td>
								<td class="size"></td>
								<td class="type"></td>
								<td><span class="WebRupee">Rs. </span><span class="price"></span></td>
								<td><input type="text" class="quantity" readonly value="1"></td>
								<td><input type="text" class="item_discount" value="0"></td>
								<td><span class="WebRupee">Rs. </span><span class="disc_amt"></span></td>
								<td><span class="WebRupee">Rs. </span><span class="amount"></span></td>
								<td class="close"></td>
								<td class="product_id hide"></td>
								

							</tr>
							 

						</tbody>
							
					</table>

				</center>

				<div class="row">
					<div class="large-12 columns">
						<div>
							<fieldset>
							  	<legend>Payment Details</legend>
							  	<div class="row">
							  		<div class="large-2 large-offset-5 columns total_qty">
							  			<span class="text_field">Total Qty : </span><span class="value_field" id="total_item"></span>
							  		</div>
							  		<div class="large-2 large-offset-1 columns end sub_total">
							  			<span class="text_field">Sub Total : </span>
							  		</div>
							  		<div class="large-2 columns sub_total">
							  		<span class="WebRupee">Rs. </span><span class="value_field" id="sub_total"></span>
							  		</div>
							  	</div>
							  	<div class="row discount">
							  		<div class="large-2 columns large-offset-8 text-field">
							  			Discount ( % )
							  		</div>
							  		<div class="large-2 columns end input_field">
							  			<input type="text" value="0" id="main_discount">
							  		</div>
							  	</div>

							  	<div class="row grand_total">
							  		<div class="large-2 columns text-field">
							  			Total Payable : 
							  		</div>
							  		<div class="large-6 columns" id="amount_in_words">
							  			
							  		</div>
							  		<div class="large-2 columns  text-field">
							  			Grand Total
							  		</div>
							  		<div class="large-2 columns end input_field " >
							  			<span class="WebRupee">Rs. </span><span id="grand_total"></span>
							  		</div>
							  	</div>
							  	<div class="row pay">
							  		<div class="large-2 columns large-offset-8 text-field">
							  			Pay : 
							  		</div>
							  		<div class="large-2 columns end input_field">
							  			<input type="text" id="pay" value="0">
							  		</div>
							  	</div>
								
								<div class="row pay" id="return_row" style="display:none">
							  		<div class="large-2 columns large-offset-8 text-field">
							  			Return : 
							  		</div>
							  		<div class="large-2 columns end input_field">
							  			<span class="WebRupee">Rs. </span><span id="return_amount"></span>
							  		</div>
							  	</div>

							  	<div class="row pay" id="due_row" style="display:none">
							  		<div class="large-2 columns large-offset-8 text-field">
							  			Due :  
							  		</div>
							  		<div class="large-2 columns end input_field">
							  			<span class="WebRupee">Rs. </span><span id="due_amount"></span>
							  		</div>
							  	</div>
							  	<div class="row">
							  		<div class="large-2 columns large-centered">
							  			<button id="submit_btn">Submit</button>
							  		</div>
							  	</div>

							</fieldset>
						</div>	
					</div>
				</div>

			</div>	
		</div>
		<!-- End Billing Section -->


	</div> <!-- end row -->
</div> <!-- end dashboard -->


<!-- start bill modal -->
<div id="bill-display-content" class="reveal-modal expand" style="margin-top:-85px;">
	<div class="row bill_modal">
		<div class="large-12 columns heading">
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
						  			<span class="WebRupee">Rs. </span><span class="grand_total_amount"></span>
						  		</div>
						  	</div>	

						  	<div class="row grand_total">
						  		
						  		<div class="large-2 columns large-offset-8 grand_total_text">
						  			Pay :
						  		</div>
						  		<div class="large-2 columns end grand_total_text " >
						  			<span class="WebRupee">Rs. </span><span class="total_pay_amount"></span>
						  		</div>
						  	</div>

						  	<div class="row grand_total hide bill_due_amount">
						  		
						  		<div class="large-2 columns large-offset-8 grand_total_text">
						  			Due :
						  		</div>
						  		<div class="large-2 columns end grand_total_text " >
						  			<span class="WebRupee">Rs. </span><span class="total_due_amount"></span>
						  		</div>
						  	</div>
											
							
						</fieldset>
					</div>
				</div>
				
				<div class="row">
					<div class="large-2 columns large-centered">
						<button id="print_btn">Print</button>
					</div>
				</div>
		

		</div> <!--end large-12 columns-->
	</div><!-- end row -->
<a class="close-reveal-modal">&#215;</a>

</div>
<!-- end bill modal -->

<!-- Include Common Footer -->
<?php include 'footer.php' ?>
<!-- end Include Common Footer -->


<script type="text/javascript">

//function for convert number to word format..
function numtoword()
{
	var number= $("#grand_total").text();
	var grand_total = number.split(".");
	var numbr = parseInt(grand_total['0']);
	var str=new String(numbr)   
	var splt=str.split("");
	var rev=splt.reverse();
	var once=['Zero', ' One', ' Two', ' Three', ' Four',  ' Five', ' Six', ' Seven', ' Eight', ' Nine'];
	var twos=[' Ten', ' Eleven', ' Twelve', ' Thirteen', ' Fourteen', ' Fifteen', ' Sixteen', ' Seventeen', ' Eighteen', ' Nineteen'];
	var tens=[ '', ' Ten', ' Twenty', ' Thirty', ' Forty', ' Fifty', ' Sixty', ' Seventy', ' Eighty', ' Ninety' ];
	numlen=rev.length;
	var word=new Array();

	var j=0;   
	for(i=0;i<numlen;i++)
	{
		switch(i)
		{
			case 0:
				if((rev[i]==0) || (rev[i+1]==1))
				{
					word[j]='';                    
				}
				else
				{
				word[j]=" "+once[rev[i]]+" ";
				}
				word[j]=word[j] ;

				break;
        	
        	case 1:
            	abovetens();  
                break;
            
            case 2:
                if(rev[i]==0)
                {
            	    word[j]='';
                } 
               	else if((rev[i-1]==0) || (rev[i-2]==0) )
                {
                	word[j]=once[rev[i]]+" Hundred ";                
                }
                else 
                {
                    word[j]=once[rev[i]]+" Hundred and ";
                } 
               	break;
            
            case 3:
				if(rev[i]==0 || rev[i+1]==1)
				{
					word[j]='';                    
				} 
				else
				{
					word[j]=once[rev[i]];
				}
				if((rev[i+1]!=0) || (rev[i] > 0))
				{
					word[j]= word[j]+" Thousand ";
				}
				break;  

            	case 4:
                	abovetens(); 
                    break;  
           
              	case 5:
					if((rev[i]==0) || (rev[i+1]==1))
					{
						word[j]='';                    
					} 
					else
					{
						word[j]=once[rev[i]];
					}
					word[j]=word[j]+" Lakhs ";
					break;  
          
        		case 6:
                	abovetens(); 
                    break;
         
          		case 7:
					if((rev[i]==0) || (rev[i+1]==1))
					{
						word[j]='';                    
					} 
					else
					{
						word[j]=once[rev[i]];
					}
					word[j]= word[j]+"Crore";
				    break;  
          
				case 8:
					abovetens(); 
					break;    
				default:
					break;
        }//end switch
       
        j++;  
       
    }//end for loop
  
	function abovetens()
	{
	    if(rev[i]==0)
	    {
	    	word[j]='';
	    }
		else if(rev[i]==1)
	    {
	    	word[j]=twos[rev[i-1]];
	    }
		else
		{
			word[j]=tens[rev[i]];
		}
	}//close function

	word.reverse();
	var finalw='';
	for(i=0;i<numlen;i++)
	{

	  finalw= finalw+word[i];

	}
	if(finalw != ""){
	finalw = finalw+" Only"
	}

	$("#amount_in_words").text(finalw);
	
}//close main function numtoword




//script for autofill customer details when mobile number is entered...
$("#customer_mobile").focusout(function() {
	var customer_mobile = $("#customer_mobile").val();
	//execute if customer mobile is not empty..
	if(customer_mobile != "")
	{
		$.ajax({
				type : "POST",
				url : "newbill_ajax.php",
				data : {customermobile : customer_mobile},
				success : function(result){
					if(result != "fail"){
						var result_row = eval(result);
						$("#customer_name").val(result_row[0]);
						$("#customer_email").val(result_row[1]);
						$("#customer_address").val(result_row[2]);
					}//end if condition
				}//end success
			})//end ajax

	}//end if condition
});//end focusout event


//check if press enter key in customer name textbox then
// customer mobile number textbox is focused..!
$("#customer_name").keyup(function(event) {
	if(event.which == 13)
	$("#customer_mobile").focus().select();
});

//check if press enter key in customer mobile number textbox then
// customer email address textbox is focused..!
$("#customer_mobile").keyup(function(event) {
	if(event.which == 13)
	$("#customer_email").focus().select();
});

//check if press enter key in customer email address textbox then
// customer address textbox is focused..!
$("#customer_email").keyup(function(event) {
	if(event.which == 13)
	$("#customer_address").focus().select();
});

//check if press enter key in customer address textbox then 
//focus first columns of first row in billing table means first product barcode
$("#customer_address").keyup(function(event) {
	if(event.which == 13)
	//focus first column of first row in billing table
	$("#table_body").children().children().children('.barcode').focus();
});



//defined a array with product name ..
var arrayFromPHP = <?php echo json_encode($product_name); ?>;

//execute code when enter barcode of product then autofill product details..
$("tbody").on('change','.barcode' ,function(){
	//entered barcode..
	var entered_barcode = $(this).val();
	//get row class of entered product barcode..
	// find class value of it's tr tab
	var row_class = $(this).parent().parent().attr('class');

	var barcode = <?php echo json_encode($barcode); ?>;
	var product_name = <?php echo json_encode($product_name); ?>;
	var category = <?php echo json_encode($category); ?>;
	var brand = <?php echo json_encode($brand); ?>;
	var size = <?php echo json_encode($size); ?>;
	var type = <?php echo json_encode($type); ?>;
	var price = <?php echo json_encode($price); ?>;
	var product_id = <?php echo json_encode($product_id); ?>;

	//if entered barcode is in barcode array...
	if( jQuery.inArray( entered_barcode, barcode ) != "-1" )
	{
		//find key value of entered_barcode into barcode array..
		var key = jQuery.inArray(entered_barcode, barcode);//find key
		

		var amount = parseInt(price[key]).toFixed(2);
	
		$("."+row_class+" .product_name").text(product_name[key]);
		$("."+row_class+" .category").text(category[key]);
		$("."+row_class+" .brand").text(brand[key]);
		$("."+row_class+" .size").text(size[key]);
		$("."+row_class+" .type").text(type[key]);
		$("."+row_class+" .price").text(amount);
		$("."+row_class+" .quantity").val("1");
		$("."+row_class+" .item_discount").val("0");
		$("."+row_class+" .disc_amt").text("0.00");
		$("."+row_class+" .amount").text(amount);
		$("."+row_class+" .product_id").text(product_id[key]);

		//insert close button and remove_item class
		$("."+row_class+" .close").html("<center><span>x</span></center>");
		$("."+row_class+" .close").addClass('remove_item')

		//remove readonly form quantity textbox
		$(".quantity").removeAttr('readonly', true);

		//append new row for next items
		//check if amount of current row is filled by some value
		if($("."+row_class+" .amount").text() != "")
		{
			//get class of last row in table..
			var last_class = $("#table_body tr:last-child").attr("class");
		
			//execute if amount of the last row is filled.
			if( ($("."+last_class+" .amount").text() != "") && ($("."+last_class+" .amount").text() != "0.00") )
			{
				var new_class = parseInt(last_class) + 1;
				var new_row = '<tr class="'+new_class+'"><td> <input type="text" list="product_barcode" class="barcode"> <datalist id="product_barcode"> <?php $query_barcode = mysql_query("SELECT barcode FROM product WHERE status = 1"); if(mysql_num_rows($query_barcode) > 0) {while($row_barcode = mysql_fetch_assoc($query_barcode)) {echo "<option value=".$row_barcode["barcode"].">"; } } ?> </datalist> </td><td class="product_name"></td><td class="category"></td><td class="brand"></td><td class="size"></td><td class="type"></td><td><span class="WebRupee">Rs. </span><span class="price"></span></td><td><input type="text" class="quantity" readonly value="1"></td><td><input type="text" class="item_discount" value="0"></td><td><span class="WebRupee">Rs. </span><span class="disc_amt"></span></td><td><span class="WebRupee">Rs. </span><span class="amount"></span></td><td class="close"></td><td class="product_id hide"></td>';
				$('#table_body').append(new_row);
			}
			
		}//end if condition for append new row

		//for subtotal amount
		var sub_total = 0;
		//each loop for all amount of each product
		$("#table_body .amount").each(function() {
			if($(this).text() != "")
			{
				var abc = parseFloat($(this).text());
				sub_total = abc + sub_total;
			}
		});//end each condition
		sub_total = sub_total.toFixed(2)
		$("#sub_total").text(sub_total);


		//for total items
		var total_item = 0;
		$("#table_body .price").each(function() {
			if($(this).text() != "")
			{
				var xyz = parseInt($(this).parent().next().children('.quantity').val());
				total_item = xyz + total_item;
			}
		});//end each condition
		$(".total_qty #total_item").text(total_item);

		//for display and update Grand total after main discount
		var main_discount = $("#main_discount").val();
		if(main_discount != "" && sub_total != "")
		{
			main_discount = parseFloat(main_discount);
			var total_disc_amt = (sub_total - ( sub_total * (main_discount/100) ) );
			total_disc_amt = Math.round(total_disc_amt).toFixed(2);
			$("#grand_total").text(total_disc_amt);
			numtoword();
		}

		//update return_amount and due amount
		var grand_total = $("#grand_total").text();
		var pay = $("#pay").val();
		//check if pay amount and grand total amount is not empty
		if(pay != "" && grand_total != ""){
			var grand_total = parseFloat(grand_total);
			var pay = parseInt(pay);
			if(pay >= grand_total)
			{
				var return_amount = pay - grand_total;
				$("#return_row").show()
				$("#due_row").hide();
				$("#return_amount").text(return_amount.toFixed(2));
				$("#due_amount").text("0.00");
			}
			else if(pay < grand_total)
			{
				var due_amount = grand_total - pay;
				$("#due_row").show();
				$("#return_row").hide();
				$("#due_amount").text(due_amount.toFixed(2));
				$("#return_amount").text("0.00");
			}
		}//close if condition for check pay and grand total is not empty

	}//end if condition for check entered barcode exist in barcode array..
	//else condition if entered_barcode is not exist in barcode_array
	else{
		//execute if user delete barcode after enter.
		if( entered_barcode == "" )
		{
			
			$("."+row_class).remove();

			//for subtotal amount
			var sub_total = 0;
			$("#table_body .amount").each(function() {
				if($(this).text() != "")
				{
					var abc = parseFloat($(this).text());
					sub_total = abc + sub_total;

				}
			});//end each condition
			sub_total = sub_total.toFixed(2)
			$("#sub_total").text(sub_total);


			//for total items
			var total_item = 0;
			$("#table_body .price").each(function() {

				if($(this).text() != "")
				{
					var xyz = parseInt($(this).parent().next().children('.quantity').val());
					total_item = xyz + total_item;
				}
			});//end each condition
			$(".total_qty #total_item").text(total_item);

			
			//for display and update Grand total after main discount
			var main_discount = $("#main_discount").val();
			if(main_discount != "" && sub_total != "")
			{
				main_discount = parseFloat(main_discount);
				var total_disc_amt = (sub_total - ( sub_total * (main_discount/100) ) );
				total_disc_amt = Math.round(total_disc_amt).toFixed(2);
				$("#grand_total").text(total_disc_amt);
				numtoword();
			}

			//update return_amount and due amount
			var grand_total = $("#grand_total").text();
			var pay = $("#pay").val();
			//check if pay amount and grand total amount is not empty
			if(pay != "" && grand_total != ""){
				var grand_total = parseFloat(grand_total);
				var pay = parseInt(pay);
				if(pay >= grand_total)
				{
					var return_amount = pay - grand_total;
					$("#return_row").show()
					$("#due_row").hide();
					$("#return_amount").text(return_amount.toFixed(2));
					$("#due_amount").text("0.00");
				}
				else if(pay < grand_total)
				{
					var due_amount = grand_total - pay;
					$("#due_row").show();
					$("#return_row").hide();
					$("#due_amount").text(due_amount.toFixed(2));
					$("#return_amount").text("0.00");
				}
			}//close if condition for check pay and grand total is not empty
		}
		else
		{
			alert("Entered Barcode does not exist");
			$(this).val("");

			var last_row_class = parseInt(row_class) - 1;
			var next_row_class = parseInt(row_class) + 1;
			if( $(this).parent().parent().prev().hasClass(last_row_class) ||  $(this).parent().parent().next().hasClass(next_row_class) )
			{
				if($("#table_body tr:last-child").attr("class") != row_class )
				$("."+row_class).remove();
			}
			// $(this).select();
		}
		
	}//end else condition
});


$("#table_body").on('keyup','.barcode' ,function(e){

	//when press enter key or down key focus quantity of that product
	if(e.which == 13)
	{
		$(this).parent().next().next().next().next().next().next().next().children('.quantity').focus().select();
	}

});



$("#table_body").on('keyup','.quantity' ,function(e){
	//when press enter key or down key focus discount of that product
	if(e.which == 13 || e.which == 40)
	{
		$(this).parent().next().children('.item_discount').focus().select();
	}
	//when press up key focus product barcode..
	if(e.which == 38)
	{
		$(this).parent().prev().prev().prev().prev().prev().prev().prev().children('.barcode').focus().select();
	}
	if($(this).val().length == 2)
	{
		if($(this).val() != "0.")
		{
			if($(this).val()[0] == '0')
			{
				$(this).val($(this).val()[1])
			}
		}
	}

});




$("#table_body").on('keyup','.item_discount' ,function(e){
	//when press enter key or down key
	if( e.which == 13 || e.which == 40 )
	{
		//get last row class
		var last_row_class = $("#table_body tr:last-child").attr("class");
		//get this row class
		var this_row_class = $(this).parent().parent().attr("class");
		//if this row is last row of billing table then focus main discount
		if(last_row_class == this_row_class)
		{
			$("#main_discount").focus().select();
		}
		//else focus barcode
		else
		{
			$(this).parent().parent().next().children().first().children('.barcode').focus().select();
		}
	}
	//when press up arrow key focus quantity of that product
	if(e.which == 38)
	{
		$(this).parent().prev().children('.quantity').focus().select();
	}
	//when this value is greater than 100 then return 0
	if($(this).val() >100)
	{
		$(this).val("0");
	}
	if($(this).val().length == 2)
	{
		if($(this).val() != "0.")
		{
			if($(this).val()[0] == '0')
			{
				$(this).val($(this).val()[1])
			}
		}
	}
});

//when key press on main discount text box
$("#main_discount").keyup(function(e) {
	//when press enter key or key down key focus pay textbox
	if(e.which == 13 || e.which == 40)
	{
		$("#pay").focus();
	}
	//if this value is greater than 100 then return 0
	if($(this).val() >=100)
	{
		$(this).val('0');
	}
	if($(this).val().length == 2)
	{
		if($(this).val() != "0.")
		{
			if($(this).val()[0] == '0')
			{
				$(this).val($(this).val()[1])
			}
		}
	}
});



//click on remove button
$("#table_body").on('click' , '.remove_item' , function(){

	var row_class = $(this).parent().attr("class");

	var confirm_msg = confirm("Do you want to delete this item ?");
	if(confirm_msg == true)
	{
		//remove text of that row
		$("."+row_class+" .price").text("");
		$("."+row_class+" .quantity").val("");
		$("."+row_class+" .item_discount").val("0");
		$("."+row_class+" .amount").text("");

		//reconfigure sub total and total items
		//for subtotal total
		var sub_total = 0;
		$("#table_body .amount").each(function() {
			if($(this).text() != "")
			{
				var abc = parseFloat($(this).text());
				sub_total = abc + sub_total;
			}
		});//end each condition
		sub_total = sub_total.toFixed(2)
		$("#sub_total").text(sub_total);


		//for total items
		var total_item = 0;
		$("#table_body .price").each(function() {
			if($(this).text() != "")
			{
				var xyz = parseInt($(this).parent().next().children('.quantity').val());
				total_item = xyz + total_item;
			}
		});//end each condition
		$(".total_qty #total_item").text(total_item);



		//fadeout those row..
		$("."+row_class).remove();

		//for display and update Grand total after main discount
		var main_discount = $("#main_discount").val();
		if(main_discount != "" && sub_total != "")
		{
			main_discount = parseFloat(main_discount);
			var total_disc_amt = (sub_total - ( sub_total * (main_discount/100) ) );
			total_disc_amt = Math.round(total_disc_amt).toFixed(2);
			$("#grand_total").text(total_disc_amt);
			numtoword();
		}

		
		//update return_amount and due amount
		var grand_total = $("#grand_total").text();
		var pay = $("#pay").val();
		//check if pay amount and grand total amount is not empty
		if(pay != "" && grand_total != ""){
			var grand_total = parseFloat(grand_total);
			var pay = parseInt(pay);
			if(pay >= grand_total)
			{
				var return_amount = pay - grand_total;
				$("#return_row").show()
				$("#due_row").hide();
				$("#return_amount").text(return_amount.toFixed(2));
				$("#due_amount").text("0.00");
			}
			else if(pay < grand_total)
			{
				var due_amount = grand_total - pay;
				$("#due_row").show();
				$("#return_row").hide();
				$("#due_amount").text(due_amount.toFixed(2));
				$("#return_amount").text("0.00");
			}
		}//close if condition for check pay and grand total is not empty
	}	

});//close click..


$("#customer_mobile").keypress(function(e){
	//if the letter is not digit then display error and don't type anything
	if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
		return false;
	}
});//end keypress of customer_mobile


//accept only integer for discount
$("#table_body").on('keypress','.quantity' ,function(e){
	//if the letter is not digit then display error and don't type anything
	if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
		return false;
	}
});//end quantity keypress..


//when focusin of qunatity 
$("#table_body").on('focusin','.quantity' ,function(e){
	$(this).select();
});

//execute when foucsout on quantity textfield
//execute on quantity change and display amount
$("tbody").on('focusout','.quantity' ,function(){
	if( parseInt($(this).val()) == "0")
	{
		$(this).val("1");
		alert("Minimum value can be only 1. You may delete product if you want.");
	}
	if($(this).val() == "")
	{
		$(this).val("1");
	}

	var quantity = $(this).val();

	//get Barcode of this item
	var this_item_barcode = $(this).parent().prev().prev().prev().prev().prev().prev().prev().children('.barcode').val();
	
	//Barcode , total quantity, sell_quantity array..
	var barcode = <?php echo json_encode($barcode); ?>;
	var quantity_array = <?php echo json_encode($quantity); ?>;
	var sell_quantity_array = <?php echo json_encode($sell_quantity); ?>;

	//find the key of this item in barcode_array..
	var key = jQuery.inArray(this_item_barcode, barcode);//find key

	//get total pieces in database.
	var total_pieces_database = parseInt(quantity_array[key]);
	//get sell pieces in database..
	var sell_pieces_database = parseInt(sell_quantity_array[key]);
	//find remaining pieces in database
	var remaining_quantity = total_pieces_database - sell_pieces_database;

	//find quantity of all that products where barcode is same 
	//by default assign total purchase item is zero..
	var product_purchase_pieces = 0;
	//runing a loop for all Barcode.
	$("#table_body .barcode").each(function(){
		//check if the value of Barcode is not blank
		if($(this).val() != "")
		{
			//check if Barcode and entered item Barcode is same
			if($(this).val() == this_item_barcode)
			{
				//took total pieces of this product which is enterd by user.
				product_purchase_pieces = parseInt(product_purchase_pieces) + parseInt($(this).parent().next().next().next().next().next().next().next().children('.quantity').val());
			}
		}
	});

	//if entered product total pieces is greater than remaining quantity in database
	if(product_purchase_pieces > remaining_quantity)
	{
		var abc = product_purchase_pieces - quantity;
		var pqr = remaining_quantity - abc;
		//alert a messase and change the value of this product is 0 and focus this item.
		var confirm_msg = confirm("There are only "+pqr+" pieces left in stock. Continue anyway ?");
		
		if(confirm_msg == true)
		{
			//assign a item flag 
			$(".item_flag").html("true");
		}
		else{
			//delete item flag
			$(".item_flag").html("false");
			var row_class = $(this).parent().parent().attr('class');
			$("."+row_class).remove();
		}
	}

	var price = $(this).parent().prev().children('.price').text();
	var discount = $(this).parent().next().children('.item_discount').val();
	
	if(quantity != "" && price != "")
	{
		quantity = parseInt(quantity);
		price = parseFloat(price);
		discount = parseFloat(discount);
		var total_amount = quantity * price;
		
		var discount_amount = (total_amount * (discount/100)).toFixed(2);
		var amount = (total_amount - discount_amount ).toFixed(2);

		//insert discount amount and amount of each product
		$(this).parent().next().next().children(".disc_amt").text(discount_amount);
		$(this).parent().next().next().next().children('.amount').text(amount);

		//for subtotal total
		var sub_total = 0;
		$("#table_body .amount").each(function() {
			if($(this).text() != "")
			{
				var abc = parseFloat($(this).text());
				sub_total = abc + sub_total;

			}
		});//end each condition
		sub_total = sub_total.toFixed(2)
		$("#sub_total").text(sub_total);


		//for total items
		var total_item = 0;
		$("#table_body .price").each(function() {

			if($(this).text() != "")
			{
				var xyz = parseInt($(this).parent().next().children('.quantity').val());
				total_item = xyz + total_item;
			}
		});//end each condition
		$(".total_qty #total_item").text(total_item);


		//for display and update Grand total after main discount
		var main_discount = $("#main_discount").val();
		if(main_discount != "" && sub_total != "")
		{
			main_discount = parseFloat(main_discount);
			var total_disc_amt = (sub_total - ( sub_total * (main_discount/100) ) );
			total_disc_amt = Math.round(total_disc_amt).toFixed(2);
			$("#grand_total").text(total_disc_amt);
			numtoword();
		}


		//update return_amount and due amount
		var grand_total = $("#grand_total").text();
		var pay = $("#pay").val();
		//check if pay amount and grand total amount is not empty
		if(pay != "" && grand_total != ""){
			var grand_total = parseFloat(grand_total);
			var pay = parseInt(pay);
			if(pay >= grand_total)
			{
				var return_amount = pay - grand_total;
				$("#return_row").show()
				$("#due_row").hide();
				$("#return_amount").text(return_amount.toFixed(2));
				$("#due_amount").text("0.00");
			}
			else if(pay < grand_total)
			{
				var due_amount = grand_total - pay;
				$("#due_row").show();
				$("#return_row").hide();
				$("#due_amount").text(due_amount.toFixed(2));
				$("#return_amount").text("0.00");
			}
		}//close if condition for check pay and grand total is not empty

	}//end if condition for check not empty
	else{
		$(this).parent().next().next().children(".disc_amt").text("");
		$(this).parent().next().next().next().children('.amount').text("");

		//for subtotal total
		var sub_total = 0;
		$("#table_body .amount").each(function() {
			if($(this).text() != "")
			{
				var abc = parseFloat($(this).text());
				sub_total = abc + sub_total;

			}
		});//end each condition
		sub_total = sub_total.toFixed(2)
		$("#sub_total").text(sub_total);


		//for total items
		var total_item = 0;
		$("#table_body .price").each(function() {

			if($(this).text() != "")
			{
				var xyz = parseInt($(this).parent().next().children('.quantity').val());
				total_item = xyz + total_item;
			}
		});//end each condition
		$(".total_qty #total_item").text(total_item);


		//for display and update Grand total after main discount
		var main_discount = $("#main_discount").val();
		if(main_discount != "" && sub_total != "")
		{
			main_discount = parseFloat(main_discount);
			var total_disc_amt = (sub_total - ( sub_total * (main_discount/100) ) );
			total_disc_amt = Math.round(total_disc_amt).toFixed(2);
			$("#grand_total").text(total_disc_amt);
			numtoword();
		}


		//update return_amount and due amount
		var grand_total = $("#grand_total").text();
		var pay = $("#pay").val();
		//check if pay amount and grand total amount is not empty
		if(pay != "" && grand_total != ""){
			var grand_total = parseFloat(grand_total);
			var pay = parseInt(pay);
			if(pay >= grand_total)
			{
				var return_amount = pay - grand_total;
				$("#return_row").show()
				$("#due_row").hide();
				$("#return_amount").text(return_amount.toFixed(2));
				$("#due_amount").text("0.00");
			}
			else if(pay < grand_total)
			{
				var due_amount = grand_total - pay;
				$("#due_row").show();
				$("#return_row").hide();
				$("#due_amount").text(due_amount.toFixed(2));
				$("#return_amount").text("0.00");
			}
		}//close if condition for check pay and grand total is not empty

	}//end else condition
});


//accept only integer for discount
$("#table_body").on('keypress','.item_discount' ,function(e){

	//if the letter is not digit then display error and don't type anything
	if (e.which != 8 && e.which != 0 && e.which != 46 && (e.which < 48 || e.which > 57)) {

		return false;
	}
	//when press dot 
	if(e.which == 46)
	{
		//check if one dot is exist in string then return false
		if($(this).val().indexOf('.') !== -1)
		{
			return false
		}
	}
	//if only one digit is enter in discount textbox
	if( $(this).val().length == 1 )
	{
		//if there is only one dot and it is starting digit then return 0.
		if($(this).val().indexOf('.') !== -1)
		{
			$(this).val("0.");
		}
	}

});



$("#table_body").on('focusin','.item_discount' ,function(e){
	$(this).select();
	if($(this).val() == "0")
	{
		$(this).val("");
	}
});



//execute on item discount change and display amount
$("#table_body").on('focusout','.item_discount' ,function(){
	
	if(parseFloat($(this).val()) == "0")
	$(this).val("0");
	

	var discount = parseFloat($(this).val());
	var price = $(this).parent().prev().prev().children('.price').text();
	var quantity = $(this).parent().prev().children().val();
	var sub_total = 0;

	if(quantity != "" && price != "" && (discount == "0" || discount <= "100" ))
	{
		price = parseFloat(price);
		discount = parseFloat(discount);
		var total_amount = quantity * price;
		var discount_amount = (total_amount * (discount/100)).toFixed(2);
		var amount = (total_amount - discount_amount ).toFixed(2);
		
		$(this).parent().next().children('.disc_amt').text(discount_amount);
		$(this).parent().next().next().children('.amount').text(amount);


		//for grand total
		$("#table_body .amount").each(function() {
			if($(this).text() != "")
			{
				var abc = parseFloat($(this).text());
				sub_total = abc + sub_total;

			}
		});//end each condition
		sub_total = sub_total.toFixed(2);
		$("#sub_total").text(sub_total);

		//for display and update Grand total after main discount
		var main_discount = $("#main_discount").val();
		if(main_discount != "" && sub_total != "")
		{
			main_discount = parseFloat(main_discount);
			var total_disc_amt = (sub_total - ( sub_total * (main_discount/100) ) );
			total_disc_amt = Math.round(total_disc_amt).toFixed(2);
			$("#grand_total").text(total_disc_amt);
			numtoword();
		}


		//update return_amount and due amount
		var grand_total = $("#grand_total").text();
		var pay = $("#pay").val();
		//check if pay amount and grand total amount is not empty
		if(pay != "" && grand_total != ""){
			var grand_total = parseFloat(grand_total);
			var pay = parseInt(pay);
			if(pay >= grand_total)
			{
				var return_amount = pay - grand_total;
				$("#return_row").show()
				$("#due_row").hide();
				$("#return_amount").text(return_amount.toFixed(2));
				$("#due_amount").text("0.00");
			}
			else if(pay < grand_total)
			{
				var due_amount = grand_total - pay;
				$("#due_row").show();
				$("#return_row").hide();
				$("#due_amount").text(due_amount.toFixed(2));
				$("#return_amount").text("0.00");
			}
		}//close if condition for check pay and grand total is not empty

	}//end if condition for check
	else
	{
		if($(this).val() == "")
		{
			$(this).val("0");
		}

		if(price != "")
		{
			price = parseFloat(price);
			discount = 0;
			var total_amount = quantity * price;
			var discount_amount = 0;
			var amount = (total_amount - discount_amount ).toFixed(2);
			
			$(this).parent().next().children('.disc_amt').text("0.00");
			$(this).parent().next().next().children('.amount').text(amount);
		}
		else
		{
			$(this).parent().next().children('.disc_amt').text("0.00");
			$(this).parent().next().next().children('.amount').text("0.00");
		}

		//for grand total
		$("#table_body .amount").each(function() {
			if($(this).text() != "")
			{
				var abc = parseFloat($(this).text());
				sub_total = abc + sub_total;

			}
		});//end each condition
		sub_total = sub_total.toFixed(2);
		$("#sub_total").text(sub_total);

		//for display and update Grand total after main discount
		var main_discount = $("#main_discount").val();
		if(main_discount != "" && sub_total != "")
		{
			main_discount = parseFloat(main_discount);
			var total_disc_amt = (sub_total - ( sub_total * (main_discount/100) ) );
			total_disc_amt = Math.round(total_disc_amt).toFixed(2);
			$("#grand_total").text(total_disc_amt);
			numtoword();
		}

		//update return_amount and due amount
		var grand_total = $("#grand_total").text();
		var pay = $("#pay").val();
		//check if pay amount and grand total amount is not empty
		if(pay != "" && grand_total != ""){
			var grand_total = parseFloat(grand_total);
			var pay = parseInt(pay);
			if(pay >= grand_total)
			{
				var return_amount = pay - grand_total;
				$("#return_row").show()
				$("#due_row").hide();
				$("#return_amount").text(return_amount.toFixed(2));
				$("#due_amount").text("0.00");
			}
			else if(pay < grand_total)
			{
				var due_amount = grand_total - pay;
				$("#due_row").show();
				$("#return_row").hide();
				$("#due_amount").text(due_amount.toFixed(2));
				$("#return_amount").text("0.00");
			}
		}//close if condition for check pay and grand total is not empty

	}//end else condition
});





$("#pay").focusin(function (e) {
	if($(this).val() == "0")
	$(this).val("");
});

$("#pay").focusout(function (e) {
	
	if($(this).val() == "")
	$(this).val("0");

	if(parseInt($(this).val()) == "0")
	$(this).val("0");
	
	//update return_amount and due amount
	var grand_total = $("#grand_total").text();
	var pay = $("#pay").val();
	//check if pay amount and grand total amount is not empty
	if(pay != "" && grand_total != ""){
		var grand_total = parseFloat(grand_total);
		var pay = parseInt(pay);
		if(pay >= grand_total)
		{
			var return_amount = pay - grand_total;
			$("#return_row").show()
			$("#due_row").hide();
			$("#return_amount").text(return_amount.toFixed(2));
			$("#due_amount").text("0.00");
		}
		else if(pay < grand_total)
		{
			var due_amount = grand_total - pay;
			$("#due_row").show();
			$("#return_row").hide();
			$("#due_amount").text(due_amount.toFixed(2));
			$("#return_amount").text("0.00");
		}
	}//close if condition for check pay and grand total is not empty


});



//accept only integer for discount
$("#pay").keypress(function(e){
	// keypress(function (e) {
	//if the letter is not digit then display error and don't type anything
	if (e.which != 8  && e.which != 13 && e.which != 0 && e.which != 37 && e.which != 39 && (e.which < 48 || e.which > 57)) {
		return false;
	}
	//when press enter key..
	if(e.which == 13)
	{
		$("#submit_btn").click();
	}
});



$("#pay").keyup(function (e) {

	if($(this).val().length == 2)
	{
		if($(this).val() != "0.")
		{
			if($(this).val()[0] == '0')
			{
				$(this).val($(this).val()[1])
			}
		}
	}

	var pay = $(this).val();
	$("#hidden-text").text(pay);

	//update return_amount and due amount
	var grand_total = $("#grand_total").text();
	var pay = $("#hidden-text").text();
	//check if pay amount and grand total amount is not empty
	if(pay != "" && grand_total != ""){
		var grand_total = parseFloat(grand_total);
		var pay = parseInt(pay);
		if(pay >= grand_total)
		{
			var return_amount = pay - grand_total;
			$("#return_row").show()
			$("#due_row").hide();
			$("#return_amount").text(return_amount.toFixed(2));
			$("#due_amount").text("0.00");
		}
		else if(pay < grand_total)
		{
			var due_amount = grand_total - pay;
			$("#due_row").show();
			$("#return_row").hide();
			$("#due_amount").text(due_amount.toFixed(2));
			$("#return_amount").text("0.00");
		}
	}//close if condition for check pay and grand total is not empty

}); //end keydown()


//accept only integer for discount
$("#main_discount").keypress(function(e) {

	//if the letter is not digit then display error and don't type anything
	if (e.which != 8  && e.which != 46 && (e.which < 48 || e.which > 57)) {
		return false;
	}

	//when press dot key
	if(e.which == 46)
	{
		//check if one dot is exist in string then return false
		if($(this).val().indexOf('.') !== -1)
			return false;
	}

	if( $(this).val().length == 1 )
	{
		if($(this).val().indexOf('.') !== -1)
			$(this).val("0.");
	}
});//end main_discount keypress..



$("#main_discount").mouseup(function() {
	$(this).select();
});


$("#main_discount").focusout(function() {
	if(parseFloat($(this).val()) == "0")
	$(this).val("0");
	
	var main_discount = $(this).val();
	var sub_total = $("#sub_total").text();
	if(main_discount != "" && sub_total != "")
	{
		main_discount = parseFloat(main_discount);
		sub_total = parseFloat(sub_total);
		var total_disc_amt = (sub_total - ( sub_total * (main_discount/100) ) );
		total_disc_amt = Math.round(total_disc_amt).toFixed(2);
		$("#grand_total").text(total_disc_amt);
		numtoword();

		//update return_amount and due amount
		var grand_total = $("#grand_total").text();
		var pay = $("#pay").val();
		//check if pay amount and grand total amount is not empty
		if(pay != "" && grand_total != ""){
			var grand_total = parseFloat(grand_total);
			var pay = parseInt(pay);
			if(pay >= grand_total)
			{
				var return_amount = pay - grand_total;
				$("#return_row").show()
				$("#due_row").hide();
				$("#return_amount").text(return_amount.toFixed(2));
				$("#due_amount").text("0.00");
			}
			else if(pay < grand_total)
			{
				var due_amount = grand_total - pay;
				$("#due_row").show();
				$("#return_row").hide();
				$("#due_amount").text(due_amount.toFixed(2));
				$("#return_amount").text("0.00");
			}
		}//close if condition for check pay and grand total is not empty
	}
	if(main_discount == "")
	{
		$(this).val("0");
	}

});

//click on submit button for display bill in modal
$("#submit_btn").click(function() {

	// by default do empty table body modal
	$(".table_body_modal").html("");
	$(".hidden_div_serial_no").text("1");

	//fill customer information into modal..
	$(".bill_detail .customer_name").text($("#customer_name").val());
	$(".bill_detail .customer_mobile").text($("#customer_mobile").val());
	$(".bill_detail .customer_email").text($("#customer_email").val());
	$(".bill_detail .customer_address").text($("#customer_address").val());
	
	//assign black products array for check if there is any product is in array than modal display..
	var products = [];

	//for grand total
	$(".amount").each(function() {

		if($(this).text() != ""  && $(this).text() != "0.00")
		{
			var serial_no = $(".hidden_div_serial_no").text();
			//push serial no into product array
			products.push(serial_no); 

			var product_barcode = $(this).parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().children('.barcode').val();

			var product_name = $(this).parent().prev().prev().prev().prev().prev().prev().prev().prev().prev('.product_name').text();

			var category = $(this).parent().prev().prev().prev().prev().prev().prev().prev().prev('.category').text();

			var brand = $(this).parent().prev().prev().prev().prev().prev().prev().prev('.brand').text();

			var size = $(this).parent().prev().prev().prev().prev().prev().prev('.size').text();
			
			var price = $(this).parent().prev().prev().prev().prev().children('.price').text();

			var quantity = $(this).parent().prev().prev().prev().children('.quantity').val();

			var discount_per_item = $(this).parent().prev().prev().children('.item_discount').val();

			var discount_amount = $(this).parent().prev().children('.disc_amt').text();

			var amount_per_item = $(this).text();

			var new_row = '<tr><td>'+serial_no+'</td><td>'+product_barcode+'</td><td>'+product_name+'</td><td>'+category+'</td><td>'+brand+'</td><td>'+size+'</td><td><span class="WebRupee">Rs. </span><span>'+price+'</span></td><td>'+quantity+'</td><td>'+discount_per_item+'</td><td><span class="WebRupee">Rs. </span><span>'+discount_amount+'</span></td><td><span class="WebRupee">Rs. </span><span>'+amount_per_item+'</span></td></tr>';
			$(".table_body_modal").append(new_row);
			serial_no = parseInt(serial_no) + 1;
			$(".hidden_div_serial_no").text(serial_no);

		}
	});

	$(".payment_detail_modal .total_item_modal").text( $(".total_qty #total_item").text() );
	$(".payment_detail_modal .sub_total_modal").text( $("#sub_total").text() );
	$(".payment_detail_modal .main_discount_modal").text( $("#main_discount").val() );
	$(".payment_detail_modal .amount_in_words_modal").text( $("#amount_in_words").text() );
	$(".payment_detail_modal .grand_total_amount").text( $("#grand_total").text() );

	if($("#pay").val() == "")
	$(".payment_detail_modal .total_pay_amount").text("0.00");
	else
	$(".payment_detail_modal .total_pay_amount").text( $("#pay").val() );
	
	if($("#due_amount").text() != "0.00")
	{
		$(".payment_detail_modal .bill_due_amount").show();
		$(".payment_detail_modal .total_due_amount").text( $("#due_amount").text() );
	}
	else
	{
		$(".payment_detail_modal .bill_due_amount").hide();
	}


	if(products.length)
	{
		$("#bill-display-content").foundation('reveal', 'open');
	}

	$("#print_btn").focus();

});

$("#print_btn").click(function(){
	$(this).prop("disabled",true);
	var customer_name = $("#customer_name").val();
	var customer_mobile = $("#customer_mobile").val();
	var customer_email = $("#customer_email").val();
	var customer_address = $("#customer_address").val();
	var customer_data = [customer_name,customer_mobile,customer_email,customer_address];


	var product_id = [];
	var quantity = [];
	var product_price = [];
	var discount_per_item = [];
	var discount_amount = [];
	var amount_per_item = [];


	//for grand total
	$("#table_body .amount").each(function() {

		if($(this).text() != ""  && $(this).text() != "0.00")
		{
			var product_id_each = $(this).parent().next().next('.product_id').text(); 
			product_id.push("*"+product_id_each+"*");

			var quantity_each = $(this).parent().prev().prev().prev().children('.quantity').val();
			quantity.push("*"+quantity_each+"*");

			var discount_per_item_each = $(this).parent().prev().prev().children('.item_discount').val();
			discount_per_item_each = parseFloat(discount_per_item_each);
			discount_per_item.push(discount_per_item_each);

			var price_per_item_each = $(this).parent().prev().prev().prev().prev().children('.price').text();
			product_price.push(price_per_item_each);

			var discount_amount_each = $(this).parent().prev().children('.disc_amt').text();
			discount_amount.push(discount_amount_each);

			var amount_per_item_each = $(this).text();
			amount_per_item.push(amount_per_item_each);

		}
	});


	var number_of_item = $(".total_qty #total_item").text();
	var sub_total = $("#sub_total").text();
	var main_discount = $("#main_discount").val();
	var grand_total = $("#grand_total").text();
	var pay = $("#pay").val();
	var due = $("#due_amount").text();


	var payment_detail = [number_of_item,sub_total,main_discount,grand_total,pay,due];
	var item_flag = $(".item_flag").html();

	if(product_id.length)
	{
		$(".la-anim-10").addClass('la-animate');
		$.ajax({
			type : "POST",
			url : "newbill_ajax.php",
			data : {customer_details : customer_data,
				bill_product_id : product_id,
				bill_quantity : quantity,
				bill_product_price : product_price,
				bill_discount_per_item :  discount_per_item,
				bill_discount_amount : discount_amount,
				bill_amount_per_item : amount_per_item,
				payment_detail : payment_detail,
				item_flag : item_flag},
				success : function(result){
				$(".la-anim-10").removeClass('la-animate');
				alert("Printing The Bill....!");
				window.location = "new_bill.php";
			}
		});//end ajax
	}

});

// modal jqyery

$('.close-reveal-modal').click(function(){
	$(this).foundation('reveal', 'close');
});
</script>