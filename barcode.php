<!--Include Main Head -->
<?php include 'header.php' ?>
<!-- end Main Head -->
<?php
if(isset($_POST['search_btn']))
{
	if(!empty($_POST['barcode']))
	$barcode = $_POST['barcode'];
	else
	$barcode = "%";

	if(!empty($_POST['product_name']))
	$product_name = $_POST['product_name'];
	else
	$product_name = "%";

	$category = $_POST['category'];
	$brand = $_POST['brand'];

	$sql_search = "SELECT * FROM product WHERE barcode LIKE '%{$barcode}%' AND product_name LIKE '%{$product_name}%' AND category LIKE '%{$category}%' AND brand LIKE '%{$brand}%' AND status = 1 ";	
	$query_search = mysql_query($sql_search);
	
}
?>
<div class="search_flag hide">
<?php
if(isset($_POST['search_btn']))
{
	if(mysql_num_rows($query_search) != "0")
	echo "true";
	else
	echo "false";
}
else
echo "false";
?>
</div>

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
			BARCODE
		</div>
	</div>
	<!-- end Search Heading -->
	<!-- Searching Section -->
	<form action="" method="post">
		<div class="row">
			<div class="large-12 columns">
				

				<!-- Barcode -->
				<div class="large-3 columns">
					<input type="text" list="barcode_list" id="barcode" autocomplete="off" name="barcode" value="" placeholder="Enter Product Code">
					<datalist id="barcode_list">
						<?php
						$query_barcode = mysql_query("SELECT barcode FROM product WHERE status = 1 ");
						while($row_barcode = mysql_fetch_assoc($query_barcode))
						{
							echo "<option value='".$row_barcode['barcode']."'>";
						}
						?>
					</datalist>
				</div>
				<!--End Barcode -->

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

				<!-- Category -->
				<div class="large-3 columns">
					<select name="category" id="category">
						<option value="%">Select Category</option>
						<?php
						$query_category = mysql_query("SELECT * FROM category WHERE status = 1 ORDER BY category ASC");
						while($row_category = mysql_fetch_assoc($query_category))
						{
							echo "<option value='".$row_category['id']."'>".$row_category['category']."</option>";
						}

						?>
					</select>
				</div>
				<!--End Category -->

					<!-- brand -->
				<div class="large-3 columns">
					<select name="brand" id="brand">
						<option value="%">Select brand</option>
						<?php
						$query_brand = mysql_query("SELECT * FROM brand WHERE status = 1 ORDER BY brand ASC");
						while($row_brand = mysql_fetch_assoc($query_brand))
						{
							echo "<option value='".$row_brand['id']."'>".$row_brand['brand']."</option>";
						}

						?>
					</select>
				</div>
				<!--End brand -->

				
			</div>
		</div>
		


		<div class="row barcode_btn">
			<div class="large-7 columns large-offset-3 ">	
				<center>
					<button name="search_btn" id="search_btn">SEARCH</button>
					<button type="reset">RESET</button>
					<button id="print_all">PRINT ALL</button>
				</center>

			</div>
			<div class="large-2 columns arrows" style="text-align:right; padding-right:60px; padding-top:10px;">
				<span class="arrow_btn left_arrow left_move"> &lt; </span>
				<span style="margin-left:40px;" class="arrow_btn right_arrow right_move"> &gt; </span>
			</div>
		</div>

	</form>

	<!-- result fond div -->
	<div class="row">
		<div class="large-12 columns result_found" style="font-size:13px; color:#0a855f;">
			<?php
			if(isset($_POST['search_btn']))
			{
				if(mysql_num_rows($query_search) == 1 || mysql_num_rows($query_search) == 0)
				echo mysql_num_rows($query_search)." result found.";
				else
				echo mysql_num_rows($query_search)." results found.";

			}
			?>
		</div>
	</div>
	<!-- end result fond div -->


	

	<!-- start searching table -->
	<div class="row" style="margin-top:20px;">
		<div class="large-12 columns search-result">
			<center>
				<table class="barcode_table">
					<thead>
						<tr>
							<th><center> S.No </center></th>
							<th><center> Barcode</center></th>
							<th><center> Pro. Name </center></th>
							<th><center> Category </center></th>
							<th><center> Brand </center></th>
							<th><center> Quantity </center></th>
							<th><center> Copies to be Printed </center></th>
							<th>Operation</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if(isset($_POST['search_btn']))
						{
							$a = 1;
							while($row = mysql_fetch_assoc($query_search))
							{
								$barcode = $row['barcode'];

								$category_id = $row['category'];
								$row_category = mysql_fetch_assoc(mysql_query("SELECT category FROM category WHERE id = '{$category_id}'") );

								$brand_id = $row['brand'];
								$row_brand = mysql_fetch_assoc(mysql_query("SELECT brand FROM brand WHERE id = '{$brand_id}'") );
								
								$barcode_image = "<span><center>
											<img src='barcode/barcode.php?codetype=Code39&size=45&text={$barcode}'>
											<br>".$barcode."
											</center></span>
											";

								echo "<tr class='barcode_view hide' id='".$a."'>"; 
								echo "<td>".$a."</td>";
								echo "<td>".$barcode_image."</td>";
								echo "<td style='text-align:center;'>".$row['product_name']."</td>";
								echo "<td style='text-align:center;'>".$row_category['category']."</td>";
								echo "<td style='text-align:center;'>".$row_brand['brand']."</td>";
								echo "<td style='text-align:center;'>".$row['qty']."</td>";
								echo "<td><input type='number' min='1' value='".$row['qty']."' class='barcode_no_print' ></td>";
								echo "<td><button class='print_barcode'>Print</button></td>";
								echo "</tr>";
								$a++; 
							}//end while loop
						}//end if condition isset($_POST['search_btn'])
						?>
						
					</tbody>
				</table>
			</center>
		</div><!-- end large-12 columns -->
	</div><!-- End row -->
	<!-- end searching table -->
	
	<?php
	if(isset($_POST['search_btn']))
	{
		if(mysql_num_rows($query_search) == 0)
		{
	?>

	<div class="row">
		<div class="large-4 column large-centered" style="text-align:center; color:#7F7C7C;font-size:20px;">
			No Result Found.. !
		</div>
	</div>

	<?php
		}
	}
	?>
	



	</div><!-- large-9 columns end -->
</div><!-- row end -->
</div><!-- dashboard end-->



<div class=" hide tr_last_class"></div>

<!-- Footer Section -->
<?php include 'footer.php' ?>
<!-- end Footer Section-->

<script type="text/javascript">
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

$("#print_all").click(function(event) {
	/* Act on the event */
	var search_flag = $(".search_flag").text();
	search_flag = $.trim(search_flag);
	if(search_flag == "true")
	{
		alert("Printing in process..!");
		return false;
	}
	else
	{
		alert("Nothing to be printed.. !");
		return false;
	}
});

$(".print_barcode").click(function(event) {
	/* Act on the event */
	alert("Printing in process..!");
	return false;
});
</script>