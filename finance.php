<!-- Include Main Head -->
<?php include 'header.php' ?>
<!-- end Main Head -->

<?php
date_default_timezone_set('Asia/Calcutta'); 
$today_date = date('Y-m-d');
if(isset($_POST['normal_submit_btn']))
{
	$date = $_POST['date'];
	$query = mysql_query("SELECT SUM(grand_total) AS grand_total , SUM(due) AS total_due FROM bill WHERE created_date LIKE '%{$date}%'");
	$row = mysql_fetch_assoc($query);
	$query_due = mysql_query("SELECT SUM(paid_amount) AS paid_amount FROM dues WHERE paid_date LIKE '%{$date}%'");
	$row_due = mysql_fetch_assoc($query_due);
	$query_finance = mysql_query("SELECT product_id,price,SUM(qty) AS qty FROM finance 
		WHERE purchase_date LIKE '%{$date}%' GROUP BY product_id");
	if($row_due['paid_amount'] == "")
	{
		$paid_amount = 0;
	}
	else{
		$paid_amount = $row_due['paid_amount'];
	}
	
}
elseif(isset($_POST['advance_submit_btn']))
{
	$from_date = $_POST['from_date'];
	$to_date = $_POST['to_date'];
	$query = mysql_query("SELECT SUM(grand_total) AS grand_total , SUM(due) AS total_due FROM bill 
		WHERE created_date >= '$from_date' OR created_date <= '$to_date' ");
	$row = mysql_fetch_assoc($query);

	$query_due = mysql_query("SELECT SUM(paid_amount) AS paid_amount FROM dues WHERE 
		 paid_date >= '$from_date' OR paid_date <= '$to_date'");
	$row_due = mysql_fetch_assoc($query_due);

	$query_finance = mysql_query("SELECT product_id,price,SUM(qty) AS qty FROM finance 
		WHERE purchase_date >= '$from_date' OR purchase_date <= '$to_date' GROUP BY product_id");
	if($row_due['paid_amount'] == "")
	{
		$paid_amount = 0;
	}
	else{
		$paid_amount = $row_due['paid_amount'];
	}
}

?>



<div class="row">

	<!-- Quick Navigation Menu -->
	<?php include 'quicknav.php' ?>
	<!-- end Quick Navigation Menu -->

	<!-- change password wrap -->
	<div class="large-9 columns viewstock">

		<!-- Finance Heading -->
		<div class="row">
			<div class="large-6 large-centered columns" id="viewstock-heading">
				Finance
			</div>
		</div>
		<!-- end Finance Heading -->

		<div class="row normal_search">
			<div class="large-7 columns large-centered">
				<form action="" method="post">
					<div class="row">
						<div class="large-4 columns">
							<input type="date" name="date" value="<?php echo $today_date ; ?>" required max='<?php echo $today_date; ?>'>		
						</div>
						<div class="large-4 columns">
							<button style="width:100%;" name="normal_submit_btn">Submit</button>
						</div>
						<div class="large-4 columns">
							<button style="width:100%;" id="advance_btn">Advance</button>
						</div>
					</div>
				</form>
			</div>
		</div>

		<div class="row advance_search hide" >
			<div class="large-10 columns large-centered">
				<form action="" method="post">
					<div class="row">
						<div class="large-3 columns">
							<input type="date" name="from_date" required max='<?php echo $today_date; ?>'>		
						</div>
						<div class="large-3 columns">
							<input type="date" name="to_date" required max='<?php echo $today_date; ?>'>		
						</div>
						<div class="large-3 columns">
							<button style="width:100%;" name="advance_submit_btn">Submit</button>
						</div>
						<div class="large-3 columns">
							<button style="width:100%;" id="normal_btn">Normal</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		
		<?php
		if(isset($_POST['normal_submit_btn']) || isset($_POST['advance_submit_btn']))
		{
			if($row['grand_total'] != "")
			{
		?>
		<div class="row">
			<div class="large-4 columns">

				<div class="finance_heading">
					SUMMARY
				</div>
				<center><div style="border-bottom: 5px double #0a855f;margin-bottom: 15px; width:50%;"></div></center>
				<div class="row" style="margin-top:20px;">
					<div class="large-7 columns" style="text-align:right; font-size:18px;">
						Grand Amount :
					</div>

					<div class="large-5 columns" style="text-align:left; font-size:18px;">
						<span class='WebRupee'>Rs. </span> <?php echo $row['grand_total']?>
					</div>
				</div>

				<div class="row" style="margin-top:20px;">
					<div class="large-7 columns" style="text-align:right; font-size:18px;">
						Due Amount : 
					</div>

					<div class="large-5 columns" style="text-align:left; font-size:18px;">
						<span class='WebRupee'>Rs. </span> <?php echo $row['total_due']?>
					</div>
				</div>

				<div class="row" style="margin-top:20px;">
					<div class="large-7 columns" style="text-align:right; font-size:18px;">
						Due Paid : 
					</div>

					<div class="large-5 columns" style="text-align:left; font-size:18px;">
						<span class='WebRupee'>Rs. </span> <?php echo $paid_amount; ?>
					</div>
				</div>

				<div class="row" style="margin-top:20px;">
					<div class="large-7 columns" style="text-align:right; font-size:18px;">
						Net Amount : 
					</div>

					<div class="large-5 columns" style="text-align:left; font-size:18px;">
						<span class='WebRupee'>Rs. </span> <?php echo $row['grand_total'] - $row['total_due']; ?>
					</div>
				</div>
			</div><!-- End large-4 columns -->
			<div class="large-8 columns">
				<div class="row">
					<div class="large-4 columns">
						<div class="finance_heading">
							PRODUCT
						</div>
						<center><div style="border-bottom: 5px double #0a855f;margin-bottom: 15px; width:80%;"></div></center>
					</div>
					<div class="large-4 columns" style="font-size: 0.8em; color: gray; text-align: center; margin-top: 29px;"> 
						<?php
				if(mysql_num_rows($query_finance) == 1 || mysql_num_rows($query_finance) == 0)
				echo mysql_num_rows($query_finance)." result found.";
				else
				echo mysql_num_rows($query_finance)." results found.";
						?>
					</div>
					<!-- arrow div -->
					<div class="large-4 columns arrows" style="text-align:right; padding-right:60px; padding-top:10px;">
						<span class="arrow_btn left_arrow left_move"> &lt; </span>
						<span style="margin-left:40px;" class="arrow_btn right_arrow right_move"> &gt; </span>
					</div>
				</div>
				<table>
					<thead>
						<tr>
							<th style="width:14%;">S.No.</th>
							<th>Product Name</th>
							<th>Quantity</th>
							<th>Price</th>
						</tr>
					</thead>
					<tbody>
					<?php
					
					if(mysql_num_rows($query_finance) > 0)
					{
						$i=1;
						while($row_finance = mysql_fetch_assoc($query_finance))
						{
							$product_id = $row_finance['product_id'];
							$query_product = mysql_query("SELECT product_name FROM product WHERE product_id = '$product_id' ");
							$row_product = mysql_fetch_assoc($query_product);

							echo "<tr class='barcode_view hide' id='".$i."'>";
							echo "<td>{$i}</td>";
							echo "<td>".$row_product['product_name']."</td>";
							echo "<td>".$row_finance['qty']."</td>";
							echo "<td><span class='WebRupee'>Rs. </span>".$row_finance['qty'] * $row_finance['price']."</td>";
							echo "</tr>";
							$i++;
						}
						
					}
					?>
					</tbody>

				</table>
			</div>
		</div><!-- End row -->
		<?php
			}
			//if there is no result found..
			else
			{
				?>
				<div class="row" style="margin-top:20px;">
					<div class="large-6 columns large-centered" style="text-align:center; color:red; font-size:20px;">
						No Sales Record Found..!
					</div>
				</div>
				<?php
			}
		}
		?>

	</div><!-- End large-9 columns -->
</div><!-- End row -->

<div class=" hide tr_last_class"></div>


<!-- Include Common Footer -->
<?php include 'footer.php' ?>
<!-- end Include Common Footer -->

<script type="text/javascript">
	$("#advance_btn").click(function(event) {
		$(".normal_search").hide();
		$(".advance_search").show();
		return false;
	});
	$("#normal_btn").click(function(event) {
		$(".advance_search").hide();
		$(".normal_search").show();
		return false;
	});

//start pagination

var last_row = $(".barcode_view").last().attr("id");

$(".right_arrow").removeClass('right_arrow');
$(".left_arrow").removeClass('left_arrow');

if(last_row > 5)
{
	$(".tr_last_class").text("5");
	$(".right_move").addClass('right_arrow');
}

for(var i = 1; i <=5; i++)
{
	$("#"+i).show();
}

$(".arrows").on("click",'.right_arrow',function(){

	//hide current display rows
	var last_display = $(".tr_last_class").text();
	var first_display = parseInt(last_display) - 4;

	for(var i = first_display ; i <= last_display ; i++)
	{
		$("#"+i).hide();
	}

	//show next display rows..
	var first_of_next_row = parseInt(last_display) + 1;
	var last_of_next_row = parseInt(last_display) + 5;

	for(var i = first_of_next_row ; i<= last_of_next_row ; i++)
	{
		$("#"+i).show();
	}

	$(".tr_last_class").text(last_of_next_row);
	$(".left_move").addClass('left_arrow');

	if( last_of_next_row >= $(".barcode_view").last().attr("id") )
	{
		$(this).removeClass('right_arrow');
	}	

});



$(".arrows").on("click",'.left_arrow',function(){

	var last_display_row = $(".tr_last_class").text();
	var next_display_row = parseInt(last_display_row) -4;
	for(var i = last_display_row ; i >= next_display_row ; i--)
	{
		$("#"+i).hide();
	}

	var show_row_first_class = parseInt(last_display_row) - 5;
	var show_row_last_class = parseInt(last_display_row) - 9;
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
</script>
