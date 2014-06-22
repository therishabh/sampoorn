<?php
include 'include/db.php';
date_default_timezone_set('Asia/Calcutta'); 


if(isset($_POST['customer_id_modal']))
{
	$customer_id = $_POST['customer_id_modal'];
	$sql = "SELECT * FROM customer WHERE id = $customer_id";
	$query = mysql_query($sql);
	$row = mysql_fetch_assoc($query);

	$bill_no = $row['bill_no'];
	$bill_no = explode("/", $bill_no);
	$bill_no = array_reverse($bill_no);

	$due = $row['due'];
	$due = explode("/", $due);
	$due = array_reverse($due);

	$paid_due = $row['paid_due'];
	if($paid_due != "")
	{
		$paid_due = explode("/", $paid_due);
		$total_paid_due = 0;
		for($a = 0; $a < count($paid_due);  $a++)
		{
			$total_paid_due += $paid_due[$a];
		}
	}
	else
	{
		$total_paid_due = 0;
	}
	echo '<fieldset>
				<legend>
					Customer Information
				</legend>
				<div class="customer_information">
					<div class="row">
						<div class="large-2 columns title">
							Name :
						</div>
						<div class="large-4 columns" style="border-top:1px solid #fff;">' .
							$row['name']
						. '</div>
						<div class="large-2 columns title">
							Mobile :
						</div>
						<div class="large-4 columns" style="border-top:1px solid #fff;">' .
							$row['phone_no']
						. '</div>
					</div>
					<div class="row second_row">
						<div class="large-2 columns title">
							Email Id :
						</div>
						<div class="large-4 columns" style="border-top:1px solid #fff;">'.
							$row['email']
						.'</div>
						<div class="large-2 columns title">
							Address :
						</div>
						<div class="large-4 columns" style="border-top:1px solid #fff;">'.
							$row['address']
						.'</div>
					</div>
				</div>
			</fieldset>
			
			<fieldset>
				<legend>Bill History</legend>
				<center>
				<table class="bill_history">
					<thead>
						<tr>
							<th>S.No.</th>
							<th>Bill No.</th>
							<th>Date</th>
							<th>Grand Total</th>
							<th>Due</th>
						</tr>
					</thead>
				</table>

				<div class="bill_table_body">
					<table>
						
						<tbody>';

						$j = 1;
						$total_due_amount = 0;
						for($i = 0; $i < count($bill_no); $i++)
						{
							$total_due_amount += $due[$i];
							$bill_number = $bill_no[$i];
							$query = mysql_query("SELECT created_date,grand_total,due FROM bill WHERE bill_number = '{$bill_number}' AND status = '1'");
							$row_bill = mysql_fetch_assoc($query);

							$date = $row_bill['created_date'];
							$explode_date = explode(" ", $date);
							$date = $explode_date['0'];
							$time = $explode_date['1'];
							// echo $date;

							$final_date =  date("M jS, Y", strtotime($date));
							$final_time = date("h:i a", strtotime($time));
							$bill_date = $final_date . " &nbsp; &nbsp; &nbsp; [ $final_time ]";

							echo "<tr class='view_full_bill_row'>";
							echo "<td>".$j."</td>";
							echo "<td class='bill_number'>".$bill_number."</td>";
							echo "<td>".$bill_date."</td>";
							echo "<td>".$row_bill['grand_total']."</td>";
							echo "<td>".$row_bill['due']."</td>";
							echo "</tr>";
							$j++;
						}

						$remaining_due = $total_due_amount - $total_paid_due;
						$remaining_due = number_format($remaining_due, 2, '.', '');
						echo '</tbody>
					</table>
				</div>
				</center>
			</fieldset>

			<div class="grand_due">
				<div class="row">
					<div class="large-4 columns large-offset-3 title">Remaining Due : </div>
					<div class="large-4 columns end value"><span class="WebRupee">Rs. </span><span class="total_due_amount">'.$remaining_due.'</span></div>
				</div>';
				if($remaining_due != "0.00")
				{
					echo '<div class="row" style="margin-top:20px;">
					<div class="hide customer_id_pay_amount">'.$customer_id.'</div>
					<div class="large-4 columns large-offset-3"><input type="text" id="pay_amount" placeholder="Enter Pay Amount"> </div>';
					if($row['paid_due'] != "")
					{
						echo '<div class="large-2 columns" style="margin-top:-5px"><button style="width:100%;" id="pay_btn">Pay</button></div>';
						echo '<div class="large-3 columns end due_paid_history" style="cursor:pointer;margin-top:4px;font-size:15px;">Due Paid History</div>';
					}
					else
					{
						echo '<div class="large-2 columns" style="margin-top:-5px"><button style="width:100%;" id="pay_btn">Pay</button></div>';
						echo '<div class="large-3 columns end due_paid_history" style="cursor:pointer;margin-top:4px;font-size:15px;"></div>';
					}
					echo '</div>';
				}
				else{
					echo '<div class="row" style="margin-top:20px;">
					<div class="hide customer_id_pay_amount">'.$customer_id.'</div>
					<div class="large-4 columns large-offset-3"><input type="text" readonly placeholder="Enter Pay Amount"> </div>';
					if($row['paid_due'] != "")
					{
						echo '<div class="large-2 columns" style="margin-top:-5px"><button style="width:100%;">Pay</button></div>';
						echo '<div class="large-3 columns end due_paid_history" style="cursor:pointer;margin-top:4px;font-size:15px;">Due Paid History</div>';
					}
					else
					{
						echo '<div class="large-2 columns" style="margin-top:-5px"><button style="width:100%;">Pay</button></div>';
						echo '<div class="large-3 columns end due_paid_history" style="cursor:pointer;margin-top:4px;font-size:15px;"></div>';
					}
					echo '</div>';
				}
				
					
				
			echo '</div>';//end grand due

}

if(isset($_POST['pay_amount']))
{
	$pay_amount = $_POST['pay_amount'];
	$pay_amount = number_format($pay_amount ,2, '.', '');
	$customer_id = $_POST['pay_customer_id'];
	$sql = "SELECT * FROM customer WHERE id = $customer_id";
	$query = mysql_query($sql);
	$row = mysql_fetch_assoc($query);
	$total_due = $row['total_due'];
	$paid_due = $row['paid_due'];
	$total_paid_due = $row['total_paid_due'];
	$paid_due_date = $row['paid_due_date'];
	

	if($paid_due_date == "")
	$paid_due_date = date("Y-m-d H:i:s");
	else
	$paid_due_date = $paid_due_date . "/" . date("Y-m-d H:i:s");
	
	if($paid_due == "")
	$paid_due = $pay_amount;
	else
	$paid_due = $paid_due . "/" . $pay_amount;
	

	$total_paid_due = $total_paid_due + $pay_amount;
	$total_paid_due = number_format($total_paid_due , 2, '.' , '');

	$sql = "UPDATE customer SET paid_due = '$paid_due' , total_paid_due = '$total_paid_due' , 
			paid_due_date = '$paid_due_date' , paid_due_date = '$paid_due_date' WHERE id = $customer_id";

	$paid_date = date('Y-m-d H:i:s');
	$query = mysql_query($sql);

	$due_sql = "INSERT INTO dues (customer_id,paid_amount,paid_date) VALUES 
	('$customer_id','$pay_amount','{$paid_date}')";
	
	$due_query = mysql_query($due_sql) or die(mysql_error());

	$remaining_due = $total_due - $total_paid_due ;
	echo  number_format($remaining_due , 2,'.','')."**********";
}


if(isset($_POST['due_paid_history']))
{
	$customer_id = $_POST['due_paid_history'];
	$sql = "SELECT * FROM customer WHERE id = $customer_id";
	$query = mysql_query($sql);
	$row = mysql_fetch_array($query);
	$paid_due_date = explode("/", $row['paid_due_date']) ;
	$paid_due = explode("/", $row['paid_due']);

	echo '<fieldset>
				<legend>
					Customer Information
				</legend>
				<div class="customer_information">
					<div class="row">
						<div class="large-2 columns title">
							Name :
						</div>
						<div class="large-4 columns" style="border-top:1px solid #fff;">' .
							$row['name']
						. '</div>
						<div class="large-2 columns title">
							Mobile :
						</div>
						<div class="large-4 columns" style="border-top:1px solid #fff;">' .
							$row['phone_no']
						. '</div>
					</div>
					<div class="row second_row">
						<div class="large-2 columns title">
							Email Id :
						</div>
						<div class="large-4 columns" style="border-top:1px solid #fff;">'.
							$row['email']
						.'</div>
						<div class="large-2 columns title">
							Address :
						</div>
						<div class="large-4 columns" style="border-top:1px solid #fff;">'.
							$row['address']
						.'</div>
					</div>
				</div>
			</fieldset>';
			?>
			
			<fieldset>
				<legend>Paid Due History</legend>
				<center>
				<table class="bill_history">
					<thead>
						<tr>
							<th>S.No.</th>
							<th>Paid Amount</th>
							<th>Paid Date</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if(mysql_num_rows($query) > 0)
						{
							$j = 1;
							for($i = count($paid_due) - 1; $i >= 0 ; $i--)
							{
								$date = $paid_due_date[$i];
								$explode_date = explode(" ", $date);
								$date = $explode_date['0'];
								$time = $explode_date['1'];
								// echo $date;

								$final_date =  date("M jS, Y", strtotime($date));
								$final_time = date("h:i a", strtotime($time));
								$paid_date = $final_date . " &nbsp; &nbsp; &nbsp; [ $final_time ]";

								echo "<tr>";
								echo "<td style='text-align:center;'>".$j."</td>";
								echo "<td style='text-align:right;'><span class='WebRupee'>Rs. </span>".$paid_due[$i]."</td>";
								echo "<td style='text-align:center;'>".$paid_date."</td>";
								echo "</tr>";
								$j++;
							}

						}
						?>
						<tr>
							
						</tr>
					</tbody>				
				</table>
			</center>
			</fieldset>

<?php
}

?>

<script type="text/javascript">
	
$(".view_full_bill_row").click(function(){
	var bill_number = $(this).children('.bill_number').text();
	$(".la-anim-10").addClass('la-animate');
	$.ajax({
		type : "POST",
		url : "customer_ajax.php",
		data : {bill_number : bill_number},
		success : function(result){
			$(".full_bill_view .heading").html(result);
			$("#full_bill_view").foundation('reveal','open');
			$(".la-anim-10").removeClass('la-animate');

		}
	})
});


//accept only integer for discount
$("#pay_amount").keypress(function(e){
	// keypress(function (e) {
	//if the letter is not digit then display error and don't type anything
	if (e.which != 8  && e.which != 13 && e.which != 0 && e.which != 37 && e.which != 39 && (e.which < 48 || e.which > 57)) {
		return false;
	}
	if(e.which == 13)
	{
		$("#pay_btn").click();
	}
});

$("#pay_amount").keyup(function(e) {
	/* Act on the event */
	var remaining_due = parseInt($(".grand_due .total_due_amount").text());
	var this_amount = parseInt($(this).val());
	if(this_amount >= remaining_due)
	{
		$(this).val(remaining_due);
		return false;
	}
	//remove 0 if it is first character of pay amount..
	if($(this).val().length == 2)
	{
		if($(this).val()[0] == '0')
		{
			$(this).val($(this).val()[1])
		}
	}

});

$("#pay_btn").click(function(){
		
	var pay_amount = $("#pay_amount").val();
	if(pay_amount != "" && parseInt(pay_amount) != "0")
	{
		pay_amount = parseInt(pay_amount);
		var customer_id = $(".customer_id_pay_amount").text();
		$.ajax({
			type : "POST",
			url : "due_ajax.php",
			data : {pay_amount : pay_amount, pay_customer_id : customer_id},
			success : function(result){
				var abc = result.split("**********");
				var remaining_due = abc[0];
				$(".total_due_amount").text(remaining_due);
				$("#pay_amount").val("");
				$(".due_paid_history").html("Due Paid History");
				if(remaining_due == "0.00"){
					$("#pay_amount").prop('readonly',true);
					$("#pay_btn").prop("disabled",true);
				}

				//update remaining_due into due search table..
				remaining_due = "<span class='WebRupee'>Rs. </span>"+remaining_due;
				$("#due_table_body .customer_id").each(function(){
					if( $(this).text() == $('.customer_id_pay_amount').text() )
					{
						$(this).siblings('.remaining_due').html(remaining_due);
					}
				});
			
			}//end success..

		});//end ajax..
	}//end if condition
	else{
		$("#pay_amount").focus();
	}
});

$(".grand_due").on('click','.due_paid_history' , function(){
	var customer_id = $(".customer_id_pay_amount").text();
	$(".la-anim-10").addClass('la-animate');
	$.ajax({
		type : "POST",
		url : "due_ajax.php",
		data : {due_paid_history : customer_id},
		success : function(result){
			$("#due_paid_history").html(result);
			$("#display_due_paid_history").foundation('reveal','open');
			$(".la-anim-10").removeClass('la-animate');
		}//end success..
	});//end ajax..
})

</script>