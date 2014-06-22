<!-- Include Main Head -->
<?php include 'header.php' ?>
<!-- end Main Head -->

<!-- Database Operations -->
	<!-- Fetching Category Name & Brand Name -->
<?php 
	//Fetch Category Name From Tabel Category
	$category_query = "SELECT id,category FROM category WHERE status = '1';";
	//Execute The Sql Query
	$category_data = mysql_query($category_query);

	//Fetch Brand Name From Tabel Brand
	$brand_query = "SELECT id,brand FROM brand WHERE status = '1';";
	//Execute The Sql Query
	$brand_data = mysql_query($brand_query);
?>
<!-- end Database Operations -->

<!-- Search Form Action -->
<?php
if(isset($_POST['search-submit']))
{
			
	if(!empty($_POST['category']))
	$category = $_POST['category'];
	else
	$category = "%";


	if(!empty($_POST['pname']))	
	$pname = $_POST['pname'];
	else
	$pname = "%";	


	if(!empty($_POST['brand']))
	$brand = $_POST['brand'];
	else
	$brand = "%";	


	if(!empty($_POST['price']))	
	$price = $_POST['price'];
	else
	$price = "%";	


	if(!empty($_POST['colour']))	
	$colour = $_POST['colour'];
	else
	$colour = "%";	


	if(!empty($_POST['size']))	
	$size = $_POST['size'];
	else
	$size = "%";
	

	$search_query = "SELECT product.barcode AS barcode, product.product_id  AS product_id , category.category AS category , 
	product.product_name AS product_name , product.qty AS qty , product.price AS price, 
	brand.brand AS brand , product.color AS color , product.size AS size , product.type AS type ,
	category.id AS category_id , brand.id AS brand_id , product.sell_qty AS sell_qty 
	FROM product,category,brand WHERE category.category LIKE '%$category%' AND product.product_name LIKE '%$pname%' AND 
	product.price LIKE '%$price%' AND brand.brand LIKE '%$brand%' AND product.color LIKE '%$colour%' AND 
	product.size LIKE '%$size%' AND product.category = category.id AND product.brand = brand.id AND product.status = 1 ORDER BY barcode ASC";

	$search_data = mysql_query($search_query) or die(mysql_error());
	 
} //Check If Submit Button is SET
?>
<!-- end Search Form Action -->


<div class="row viewstock-wrap">
	<!-- Quick Navigation Menu -->
		<?php include 'quicknav.php' ?>
	<!-- end Quick Navigation Menu -->
	
	<!-- View Stock Wrap -->
	<div class="large-9 columns viewstock">
		<!-- Search Heading -->
			<div class="row">
				<div class="large-4 large-centered columns" id="viewstock-heading">
					MANAGE STOCK
				</div>
			</div>
		<!-- end Search Heading -->

		<!-- Search Section -->
		<div class="row">
			<!-- Search Form -->
			<form method="POST" action="viewstock.php">

				<div class="large-9 columns">
					<!-- First Search Row -->
					<div class="row">

						<!-- Category Field -->
						<div class="large-4 columns">
							<select name="category" id="category">
								<option value="">Select Category</option>
								<!-- Fetch Catergories and Create Associative Array -->
								<?php
									while ($category_row = mysql_fetch_assoc($category_data)) {
										echo'<option value = "'.$category_row['category'].'">'.$category_row['category'].'</option>'; 
									}
								?>
								<!-- end Associative Array -->
							</select>
						</div>
						<!-- end Category Field -->

						<!-- Product Name Field -->
						<div class="large-4 columns">
							<input type="text" name="pname" list="product_name_list" placeholder="Product Name" autocomplete="off">
							<datalist id="product_name_list">
								<?php
								$query = mysql_query("SELECT product_name FROM product WHERE status = 1 ");
								while($row = mysql_fetch_assoc($query))
								{
									echo "<option value='".$row['product_name']."'>";
								}

								?>
							</datalist>
						</div>
						<!-- end Product Name Field -->

						<!-- Brand Field -->
						<div class="large-4 columns">
							<select name="brand" id="brand">
								<option value="">Select Brand</option>
								<!-- Fetch Brand Name and Create Associative Array -->
								<?php 
									while ($brand_row = mysql_fetch_assoc($brand_data)) {
										echo'<option value = "'.$brand_row['brand'].'">'.$brand_row['brand'].'</option>'; 
									}
								?>
								<!-- end Associative Array -->
							</select>
						</div>
						<!-- end Brand Field -->
					</div>
					<!-- end First Search Row -->

					<!-- Second Search Row -->
					<div class="row">
						
						<!-- Price Field -->
						<div class="large-4 columns">
							<input type="text" id="product_price" autocomplete="off" name="price" placeholder="Price">
						</div>
						<!-- end Price Field -->

						<!-- Colour Field -->
						<div class="large-4 columns">
							<input type="text" name="colour" autocomplete="off" placeholder="Colour">
						</div>
						<!-- end Colour Field -->

						<!-- Size Field -->
						<div class="large-4 columns">
							<input type="text" name="size" autocomplete="off" placeholder="Size">
						</div>
						<!-- end Size Field -->

					</div>
					<!-- end Second Search Row -->

				</div>
				
				<div class="large-3 columns" id="viewstock-btn">
					<button type="submit" name="search-submit">Search</button>
					<button type="reset">Reset</button>
				</div>

			</form>
			<!-- end Search Form -->
		</div>
		<!-- end Search Section -->

		<!-- result found section -->
	<div class="row">
		<div class="large-6 columns result_found" style="font-size:13px; color:#0a855f; margin-bottom:12px; padding-top:10px; padding-left:24px;">
			<?php
			if(isset($_POST['search-submit']))
			{
				if(mysql_num_rows($search_data) == 1 || mysql_num_rows($search_data) == 0)
				echo "<span class='result_num'>".mysql_num_rows($search_data)."</span> result found.";
				else
				echo "<span class='result_num'>".mysql_num_rows($search_data)."</span> results found.";
			}
			?>
		</div>
		<div class="large-6 columns arrows" style="text-align:right; padding-right:60px; padding-top:0px;">
			<span class="arrow_btn left_arrow left_move"> &lt; </span>
			<span style="margin-left:40px;" class="arrow_btn right_arrow right_move"> &gt; </span>
		</div>
	</div>
	<!-- end result found section -->
		
		<div class="row">
			<div class="large-12 columns search-result">
				<center>
				
					<table class="view_stock_table">
						<thead>
							<tr>
								<th><center> Barcode</center></th>
								<th><center> Category </center></th>
								<th><center> Pro. Name </center></th>
								<th><center> Quantity </center></th>
								<th><center> Sell Qty</center></th>
								<th><center> Price </center></th>
								<th><center> Brand </center></th>
								<th><center> Colour </center></th>
								<th><center> Size </center></th>
								<th><center> Type </center></th>
								<th>Operation</th>
							</tr>
						</thead>
				<?php
				if(isset($_POST['search-submit']))
				{
					if(mysql_num_rows($search_data) > 0)
					{
						echo "<tbody class='view_stock_tbody'>";
						$i= 1;
						while($row = mysql_fetch_assoc($search_data))
						{
							$query_category = mysql_query("SELECT * FROM category WHERE status = 1 order by category ASC");
							$query_brand = mysql_query("SELECT * FROM brand WHERE status = 1 order by brand ASC");

							echo "<tr class='view_customer hide' id=".$i.">";
							echo "<td style='text-align:center;'>".$row['barcode']."</td>";
							echo "<td class='hide category_edit'>";
									echo "<select class='category_select'>";
									while($row_category = mysql_fetch_assoc($query_category))
									{
										echo "<option value = '".$row_category['id']."'>".$row_category['category']."</option>";
									}
									echo "</select>";
							echo "</td>";
							echo "<td class='product_id hide'>".$row['product_id']."</td>";
							echo "<td class='hide category_id'>".$row['category_id']."</td>";
							echo "<td class='category'>".$row['category']."</td>";
							echo "<td class='product_name'>".$row['product_name']."</td>";
							echo "<td class='qty' style='text-align:center'>".$row['qty']."</td>";
							echo "<td class='sell_qty' style='text-align:center'>".$row['sell_qty']."</td>";
							echo "<td class='price'>".$row['price']."</td>";
							echo "<td class='hide brand_edit'>";
									echo "<select class='brand_select'>";
									while($row_brand = mysql_fetch_assoc($query_brand))
									{
										echo "<option value = '".$row_brand['id']."'>".$row_brand['brand']."</option>";
									}
									echo "</select>";
							echo "</td>";
							echo "<td class='hide brand_id'>".$row['brand_id']."</td>";
							echo "<td class='brand'>".$row['brand']."</td>";
							echo "<td class='color'>".$row['color']."</td>";
							echo "<td class='size'>".$row['size']."</td>";
							echo "<td class='type'>".$row['type']."</td>";
							echo "<td><center><span class='edit_stock'><img src='img/iconmonstr-pencil-icon.png' style='height:18px;' title='Edit Customer' ></span>
											<span class='done_stock hide'><img src='img/1380591407_tick_64.png' style='height:18px;' ></span>
											<span class='delete_stock' style='margin-left:10px;'><img src='img/iconmonstr-x-mark-icon.png' title='Delete Customer' style='height:18px;'></span></center></td>";

							echo "</tr>";
							$i++;
						}//end while loop.
						echo "</tbody>";
					}//end if condition if(mysql_num_rows($search_data) > 0)
					else
					{
						echo "<div style='color:red; font-size:20px;'>No Result Found !</div>";
					}
				}//end if condition if(isset($_POST['search-submit']))
				
				 ?>
				</table>
				</center>	
			</div> <!-- end search-result -->
		</div> <!-- end row -->

	</div> <!-- end viewstock -->
</div> <!-- end viewstock-wrap -->


<!-- div for paggination -->
<div class=" hide tr_last_class"></div>
<!-- End div for paggination -->

<!-- Include Common Footer -->
<?php include 'footer.php' ?>
<!-- end Include Common Footer -->
<script>

	

//accept only integer for product_price , price and quantity..
$(".qty , .price , #product_price").keypress(function(e){
	//if the letter is not digit then display error and don't type anything
	if (e.which != 8  && e.which != 13 && e.which != 0 && e.which != 37 && e.which != 39 && (e.which < 48 || e.which > 57)) {
		return false;
	}
});


//do not accept enter key..
$(".product_name , .qty , .price , .color , .size , .type").keypress(function(e){
	//if pressed key has Enter button then return false..
	if(e.which == 13)
	{
		return false;
	}
})

//execute when click on edit button..
$(".edit_stock").click(function(){

	//select category into select dropdown
	var category_id = $(this).parent().parent().parent().children('.category_id').html();
	$(this).parent().parent().parent().children('.category_edit').children('.category_select').val(category_id);

	//hide all select category..
	$(".category_edit").hide();
	//show all category text..
	$(".category").show();

	//hide this category text..
	$(this).parent().parent().parent().children('.category').hide();
	//show this category dropdown..
	$(this).parent().parent().parent().children('.category_edit').show();

		//select brand into select dropdown
	var category_id = $(this).parent().parent().parent().children('.brand_id').html();
	$(this).parent().parent().parent().children('.brand_edit').children('.brand_select').val(category_id);

	//hide all select category..
	$(".brand_edit").hide();
	//show all category text..
	$(".brand").show();

	//hide this category text..
	$(this).parent().parent().parent().children('.brand').hide();
	//show this category dropdown..
	$(this).parent().parent().parent().children('.brand_edit').show();

	$(".product_name").attr('contentEditable',false);
	$(".qty").attr('contentEditable',false);
	$(".price").attr('contentEditable',false);
	$(".color").attr('contentEditable',false);
	$(".size").attr('contentEditable',false);
	$(".type").attr('contentEditable',false);

	$(this).parent().parent().parent().children('.product_name').attr('contentEditable', true).focus();
	$(this).parent().parent().parent().children('.qty').attr('contentEditable', true);
	$(this).parent().parent().parent().children('.price').attr('contentEditable', true);
	$(this).parent().parent().parent().children('.color').attr('contentEditable', true);
	$(this).parent().parent().parent().children('.size').attr('contentEditable', true);
	$(this).parent().parent().parent().children('.type').attr('contentEditable', true);


	$('.done_stock').hide();
	$(".edit_stock").show();

	$(this).hide();
	$(this).next().show();

});


$(".done_stock").click(function(){
	
	
	var category_id = $(this).parent().parent().parent().children('.category_edit').children('select').val();
	var brand_id = $(this).parent().parent().parent().children('.brand_edit').children('select').val();
	var product_name = $(this).parent().parent().parent().children('.product_name').text();
	var product_qty = $(this).parent().parent().parent().children('.qty').text();
	var sell_qty = $(this).parent().parent().parent().children('.sell_qty').text();
	var price = $(this).parent().parent().parent().children('.price').text();
	var color = $(this).parent().parent().parent().children('.color').text();
	var size = $(this).parent().parent().parent().children('.size').text();
	var type = $(this).parent().parent().parent().children('.type').text();
	var product_id = $(this).parent().parent().parent().children('.product_id').text();
	var category = $(this).parent().parent().parent().children('.category_edit').children('.category_select').children("option").filter(":selected").text();
	var brand = $(this).parent().parent().parent().children('.brand_edit').children('.brand_select').children("option").filter(":selected").text();

	var product_details = [product_id,category_id,brand_id,product_name,product_qty,price,color,size,type];

	if(parseInt(product_qty) < parseInt(sell_qty))
	{
		// $(this).text(sell_qty);
		alert("You can not assign quantity less than sell quantity.");
		$(this).parent().parent().parent().children('.qty').focus();
		return false;
	}
	else
	{
		$(".product_name").attr('contentEditable',false);
		$(".qty").attr('contentEditable',false);
		$(".price").attr('contentEditable',false);
		$(".color").attr('contentEditable',false);
		$(".size").attr('contentEditable',false);
		$(".type").attr('contentEditable',false);

		$(this).parent().parent().parent().children('.category').addClass("category_"+product_id);
		$(this).parent().parent().parent().children('.brand').addClass("brand_"+product_id);

		$(this).parent().parent().parent().children('.category_id').addClass("category_id_"+product_id);
		$(this).parent().parent().parent().children('.brand_id').addClass("brand_id_"+product_id);

		$(".category_id_"+product_id).text(category_id).hide();
		$(".brand_id_"+product_id).text(brand_id).hide();
		
		$(".category_edit").hide();
		$(".category").show();
		$(this).parent().parent().parent().children('.category').text(category);
		$(".brand_edit").hide();
		$(".brand").show();
		$(this).parent().parent().parent().children('.brand').text(brand);

		$.ajax({
			type : "POST",
			url : "viewstock_ajax.php",
			data : {product_update : product_details},
			success : function(result){				
				
			}//end success
		});//end ajax
	}//end else..

	$('.done_stock').hide();
	$(".edit_stock").show();
});

	$(".delete_stock").click(function(){
		var product_id = $(this).parent().parent().parent().children('.product_id').text();
		var confirm_msg = confirm("Do you want to delete product ?");
		if(confirm_msg == true)
		{
			$(this).parent().parent().parent().fadeOut(800);
			$.ajax({
				type : "POST",
				url : "viewstock_ajax.php",
				data : {product_delete : product_id},
				success : function(result){

				}
			})
		}
	});

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
</script>