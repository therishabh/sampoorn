<!-- Include Main Head -->
<?php include 'header.php' ?>
<!-- end Main Head -->

<!-- Action For POST METHOD -->
<?php

if(!isset($_SESSION['number_of_items']))
	$_SESSION['number_of_items'] = "0";


	// Action For Done Button
	if (isset($_POST['done_btn'])) {
		$product_code = $_POST['product_code'];
		$category = $_POST['category'];	
		$pname = htmlspecialchars($_POST['p-name'],ENT_QUOTES);
		$qty = $_POST['qty']
;		$price = $_POST['price'];
		$brand = $_POST['brand'];
		$color = $_POST['color'];
		$size = $_POST['size'];
		$type = $_POST['type'];
		
		// echo $category,$pname,$qty,$price,$brand,$color,$size,$type;
		
		$query = "INSERT INTO product(barcode,category,product_name,qty,price,brand,color,size,type) VALUES('$product_code','$category','$pname','$qty','$price','$brand','$color','$size','$type')";
		$data =  mysql_query($query);
		$pname = "";

		//Redirect the Page to Dashboard
		?>
		<script type="text/javascript">
		window.location = "dashboard.php";
		</script>
		<?php
	}
	// end Action For Done Button
	
	// Action For Add More Button
	elseif (isset($_POST['addmore_btn'])) {
		

		if(!isset($_SESSION['barcode'])){
			$_SESSION['barcode'] = $_POST['product_code'];
		}

		$product_code = $_POST['product_code'];
		$category = $_POST['category'];	
		$pname = htmlspecialchars($_POST['p-name'],ENT_QUOTES);
		$qty = $_POST['qty'];
		$price = $_POST['price'];
		$brand = $_POST['brand'];
		$color = $_POST['color'];
		$size = $_POST['size'];
		$type = $_POST['type'];
		$_SESSION['number_of_items'] = $_SESSION['number_of_items'] + $qty; 
		// echo $category,$pname,$qty,$price,$brand,$color,$size,$type;
		
		$query = "INSERT INTO product(barcode,category,product_name,qty,price,brand,color,size,type) VALUES('$product_code','$category','$pname','$qty','$price','$brand','$color','$size','$type')";
		$data =  mysql_query($query) or die(mysql_error());
		$pname = "";
	}
	
	//end Action For Add More Button
?>
<!-- end Action For POST METHOD -->

<!-- Database Operations -->
	<!-- Fetching Category Name & Brand Name -->
	<?php 
		//Fetch Category Name From Tabel product
		$category_query = "SELECT id,category FROM category WHERE status = 1 ORDER BY category ASC";
		//Execute The Sql Query
		$category_data = mysql_query($category_query);

		//Fetch Brand Name From Tabel product
		$brand_query = "SELECT id,brand FROM brand WHERE status = 1 ORDER BY brand ASC";
		//Execute The Sql Query
		$brand_data = mysql_query($brand_query);
	?>
<!-- end Database Operations -->
<!-- fetch product code for new product.. -->
<?php
	$query_product_code = mysql_query("SELECT barcode FROM product ORDER BY product_id DESC LIMIT 1");
	if(mysql_num_rows($query_product_code) != "0"){
		$row_product_code = mysql_fetch_assoc($query_product_code);
		$new_barcode = $row_product_code['barcode'] + 1;
		$new_barcode = str_pad($new_barcode, 5, "0", STR_PAD_LEFT);
	}
	else{
		$new_barcode = "00001";
	}
?>
<div class="addstock-wrap">

		<div class="row">
			<!-- Quick Navigation Menu -->
				<?php include 'quicknav.php' ?>
			<!-- end Quick Navigation Menu -->
			
			<div class="large-offset-1 large-7 columns">
				
				<!-- Form Heading -->
				<div class="row">
					<div class="large-4 large-centered columns" id="addstock-heading">
						ADD STOCK
					</div>
				</div>
				<!-- end Form Heading -->
		<form action="" method="post">
				<!-- Product Code Field -->
				<div class="row">
					<div class="large-5 columns">
						<label for="p-name">Product Code</label>
					</div>

					<div class="large-6 columns">

						<input type="text" readonly name="product_code" value="<?php echo $new_barcode;  ?>" id="barcode" required>
					</div>
					<div class="large-1 columns"></div>
				</div>
				<!-- end Product Code Field -->
			
				<!-- Category Field -->
				<div class="row">
					<div class="large-5 columns">
						<label for="category">Category</label>
					</div>

					<div class="large-6 columns category_display">
						<select name="category" id="category">

							<!-- Fetch Catergories and Create Associative Array -->
							<?php 
							while ($category_row = mysql_fetch_assoc($category_data)) {
								if($category_row['id'] == 1)
								{
							echo'<option selected value = "'.$category_row['id'].'">'.$category_row['category'].'</option>'; 
								}
								else
								{
							echo'<option value = "'.$category_row['id'].'">'.$category_row['category'].'</option>';
								}
							}
							?>
							<!-- end Associative Array -->
						</select>
					</div>

					<!-- Modify -->
					<div class="large-1 columns addstock-modify" id="category-modal">
						<img id="category-modify" src="img/iconmonstr-pencil-icon.png" alt="Modify Category" title="Modify Category">
					</div>
					<!-- end Modify -->

				</div>
				<!-- end Catogory Field -->
				
				<!-- Product Name Field -->
				<div class="row">
					<div class="large-5 columns">
						<label for="p-name">Product Name</label>
					</div>

					<div class="large-6 columns">
						<input type="text" name="p-name"  id="product_name">
					</div>
					<div class="large-1 columns"></div>
				</div>
				<!-- end Product Name Field -->

				<!-- Qty Field -->
				<div class="row">
					<div class="large-5 columns">
						<label for="qty">Quantity</label>
					</div>

					<div class="large-6 columns">
						<input type="number" name="qty" min="1" value="1" id="quantity">
					</div>
					<div class="large-1 columns"></div>
				</div>
				<!-- end Qty Field -->

				<!-- Price Field -->
				<div class="row">
					<div class="large-5 columns">
						<label for="price">Price</label>
					</div>

					<div class="large-6 columns">
						<input type="text" name="price" id="product_price">
					</div>
					<div class="large-1 columns"></div>
				</div>
				<!-- end Price Field -->

				<!-- Brand Field -->
				<div class="row">
					<div class="large-5 columns">
						<label for="brand">Brand Name</label>
					</div>

					<div class="large-6 columns brand_display">
						<select name="brand" id="brand">
							<!-- Fetch Brand Name and Create Associative Array -->
							<?php 
							while ($brand_row = mysql_fetch_assoc($brand_data)) {
								if($brand_row['id'] == 1)
								{
							echo'<option selected value = "'.$brand_row['id'].'">'.$brand_row['brand'].'</option>'; 
								}else{
							echo'<option value = "'.$brand_row['id'].'">'.$brand_row['brand'].'</option>';
								}
							}
							?>
							<!-- end Associative Array -->
						</select>
					</div>
					
					<!-- Modify -->
					<div class="large-1 columns addstock-modify" id="brand-modal">
						<img id="brand-modify" src="img/iconmonstr-pencil-icon.png" alt="Modify Brand" title="Modify Brand">
					</div>
					<!-- end Modify -->

				</div>
				<!-- end Brand Field -->

				<!-- Color Field -->
				<div class="row">
					<div class="large-5 columns">
						<label for="color">Colour</label>
					</div>

					<div class="large-6 columns">
						<input type="text" name="color" id="color">
					</div>
					<div class="large-1 columns"></div>
				</div>
				<!-- end Color Field -->

				<!-- Size Field -->
				<div class="row">
					<div class="large-5 columns">
						<label for="size">Size</label>
					</div>

					<div class="large-6 columns" id="des_fix">
					
						<input type="text" id="size" name="size">
					</div>
					<div class="large-1 columns"></div>
				</div>
				
				<!-- end Size Field -->

				<!-- Type Field -->
				<div class="row">
					<div class="large-5 columns">
						<label for="type">Type</label>
					</div>

					<div class="large-6 columns">
						<input type="text" name="type" id="type" placeholder="M/F">
					</div>
					<div class="large-1 columns"></div>
				</div>
				<!-- end Type Field -->
				
				<!-- Button Group -->
				<div class="row">
					<div class="large-7 columns large-centered">
						<button  id="addmore_btn" name="addmore_btn" style="width:150px;">ADD MORE +</button>
						<button class="hide" type="reset" id="addmore_btn_reset" style="width:150px;">ADD MORE +</button>
						<button id="done_btn" name="done_btn">DONE</button>
						<button  type="reset" class="hide" id="done_btn_reset">DONE</button>
						<button type="reset">RESET</button>
					</div>
				<!-- end Button Group -->
				</div>
		</from>
		<?php
		if(isset($_POST['addmore_btn']))
		{
		?>
		<div style="text-align:center;margin-top: 30px; color: green; font-size: 24px;"> 
			You have added <?php echo $_SESSION['number_of_items'] ?> items in stock
			<span><a href="current_barcode.php">click here</a></span>
			to print a barcode.
		</div>
		<?php
		}
		?>
		

			</div>
		</div>
		

	
</div>


<!-- Modals Section -->
	<!-- Category Modify Modal -->
		<div id="category-modal-content" class="reveal-modal small" style="margin-top:-75px">
		  <center>
		  	<div class="row">
		  		<div class="large-12 columns modal-edit">
					
					<!-- Modal Heading -->		  			
		  			<div class="row">
		  				<div class="large-6 large-centered columns" id="modal-heading">
		  					Edit Category
		  				</div> <!-- end modal-heading -->
		  			</div> <!-- end row -->
		  			<!-- end Modal Heading -->

		  			<div class="row">
		  				<div class="large-10 large-centered columns">
		  					<input type="text" id="category-search-input" placeholder="Search by Category Name...">
		  				</div>
		  			</div>

		  			<div class="row">
		  				<div class="large-11 large-centered columns" id="addstock-modal-result">
		  					<table>
		  						
		  						<thead>
		  							<tr>
		  								<th>Sno</th>
		  								<th>Category Name</th>
		  								<th></th>
		  							</tr>
		  						</thead> <!-- end thead -->

		  						<tbody class="category_tbody">
		  							<?php 
		  						

											//Fetch Category Name From Tabel Category
											$category_query = "SELECT * FROM category WHERE status = '1' ORDER BY category ASC;";
											//Execute The Sql Query
											$category_data = mysql_query($category_query);

		  									$i=1;
		  									while ($category_row = mysql_fetch_assoc($category_data)) {
												echo "<tr>";
		  											echo "<td>".$i."</td>";
		  											echo "<td class='category_edit' id='".$category_row['id']."'>".$category_row['category']."</td>";
		  											if($category_row['id'] != 1)
		  											echo "<td class='del'><img src='img/iconmonstr-x-mark-icon.png' alt='del' class='delete_category'></td>";
		  										echo "</tr>";
		  										$i++;
		  									}
		  						
		  							?>
		  						</tbody>											
		  					</table> <!-- end table -->
							
							<div class="row">
								<div class="large-offset-8 large-4 columns category-add-row text-right">
									<div>
										<img src="img/iconmonstr-plus-icon.png" alt=""> <span>Add New</span>
									</div>
								</div>
							</div>				
		  				</div> <!-- end large-11 columns -->
		  			</div> <!-- end row -->
		  		
		  		</div> <!-- end modal-edit -->
		  	</div> <!-- end row -->


		  	
		  </center>
		  <a class="close-reveal-modal">&#215;</a>
		</div>
	<!-- end Category Modify Modal -->
	
	<!-- Hidden Field -->
		<!-- Required For AJAX -->
  		<div id="hidden-text" class="hide"></div>
  	<!-- end Hidden Field -->
	
	<!-- Brand Modify Modal -->
	<div id="brand-modal-content" class="reveal-modal small" style="margin-top:-75px">
	  <center>
		  	<div class="row">
		  		<div class="large-12 columns modal-edit">
					
					
					<!-- Modal Heading -->		  			
		  			<div class="row">
		  				<div class="large-6 large-centered columns" id="modal-heading">
		  					Edit Brand
		  				</div> <!-- end modal-heading -->
		  			</div> <!-- end row -->
		  			<!-- end Modal Heading -->

		  			<div class="row">
		  				<div class="large-10 large-centered columns">
		  					<input type="text" id="brand-search-input" placeholder="Search by Brand Name...">
		  				</div>
		  			</div>

		  			<div class="row">
		  				<div class="large-11 large-centered columns" id="addstock-modal-result">
		  					<table>
		  						
		  						<thead>
		  							<tr>
		  								<th>Sno</th>
		  								<th>Brand Name</th>
		  								<th></th>
		  							</tr>
		  						</thead> <!-- end thead -->

		  						<tbody class="brand_tbody">
		  							<?php											//Fetch Category Name From Tabel Category
										$brand_query = "SELECT * FROM brand WHERE status = '1' ORDER BY brand ASC;";
										//Execute The Sql Query
										$brand_data = mysql_query($brand_query);

	  									$i=1;
	  									while ($brand_row = mysql_fetch_assoc($brand_data)) {
											echo "<tr>";
												echo "<td>".$i."</td>";
												echo "<td class='brand_edit' id='".$brand_row['id']."'>".$brand_row['brand']."</td>";
												if($brand_row['id'] != 1)
												echo "<td class='del'><img src='img/iconmonstr-x-mark-icon.png' alt='del' class='delete_brand'></td>";
											echo "</tr>";
											$i++;
	  									}
		  							?>
		  						</tbody>											
		  					</table> <!-- end table -->
							
							<div class="row">
								<div class="large-offset-8 large-4 columns brand-add-row text-right">
									<div>
										<img src="img/iconmonstr-plus-icon.png" alt=""> <span>Add New</span>
									</div>
								</div>
							</div>				
		  				</div> <!-- end large-11 columns -->
		  			</div> <!-- end row -->
		  		
		  		</div> <!-- end modal-edit -->
		  	</div> <!-- end row -->

			<!-- Hidden Field -->
				<!-- Required For AJAX -->
		  	<!-- <div id="hidden-text" class="hide"></div> -->
		  	<!-- end Hidden Field -->
		  </center>
		  <a class="close-reveal-modal">&#215;</a>
	</div>
	<!-- end Brand Modify Modal -->

<!-- end Modals Section -->
<div class="hidden_category hide" ></div>
<div class="hidden_brand hide" ></div>

<!-- success message modal start -->
<div id="success_msg_modal" class="reveal-modal small" style="margin-top:0px;">
	<div class="row ">
		<div class="large-12 columns large-centered">
		
			<div class="row">
				<div class="large-2 columns ">
					<img src="img/1380650991_accepted_48.png">
				</div>
				<div class="large-10 columns end msg" style="font-size: 24px;color: green;font-weight: bold;padding-top: 9px;" >
					Product Successfully Added
				</div>
			</div>
			

		</div> <!--end large-12 columns-->
	</div><!-- end row -->
<a class="close-reveal-modal modal_close">&#215;</a>
</div>
<!-- success message modal end -->

<?php
if(isset($_POST['done_btn']) || isset($_POST['addmore_btn']))
{
?>
<script type="text/javascript">
	$("#success_msg_modal").foundation('reveal', 'open');
</script>
<?php
}
?>

<script src="js/foundation/foundation.reveal.js"></script>


<script>
	$('#category-modal').click(function(){
		$('#category-modal-content').foundation('reveal', 'open');
	});

	$('#brand-modal').click(function(){
		$('#brand-modal-content').foundation('reveal', 'open');
	});

	$('.close-reveal-modal').click(function(){
		$(this).foundation('reveal', 'close');
	});

</script>

<!-- AJAX SECTION -->
<!-- CATEGORY MODAL -->
<script>

//accept only integer for product_price , price and quantity..
$("#product_price").keypress(function(e){
	//if the letter is not digit then display error and don't type anything
	//if the letter is not digit then display error and don't type anything
	if (e.which != 8 && e.which != 0 && e.which != 46 && (e.which < 48 || e.which > 57)) {

		return false;
	}

	if(e.which == 46)
	{
		//check if one dot is exist in string then return false
		if($(this).val().indexOf('.') !== -1)
		{
			return false
		}


	}
	if( $(this).val().length == 1 )
	{
		if($(this).val().indexOf('.') !== -1)
		{
			$(this).val("0.");
		}
	}
});



$("#category-search-input").keyup(function (e) {
	var search_text = $(this).val();
	$("#hidden-text").text(search_text);
	var category_search = $("#hidden-text").text();
	$(".la-anim-10").addClass('la-animate');
	$.ajax({
		type : "POST",
		url : "viewstock_ajax.php",
		data : {search_text : category_search},
		success : function(result){
			$(".la-anim-10").removeClass('la-animate');
			$(".category_tbody").html(result);
		}//end success	
	});//end ajax
});//end keydown

//make td editable when click on it..
$(".category_tbody").on('click','.category_edit',function(){
	//Category Content Update
	$(".category_edit").attr('contentEditable',false);
	var category_id = $(this).attr("id");
	if(category_id != 1)
	$(this).attr("contentEditable",true);
	else
	alert('You can not edit Misc category !');

	$(this).focus();
});	
//end Category click

//update category when focusout category div
$(".category_tbody").on('focusout','.category_edit',function(){
	var category = $(this).text();
	var category_id = $(this).attr("id");
	//check if category is empty
	if(category == "")
	{
		alert("Please do not leave blank !");
		$(this).text($(".hidden_category").text());
		$(this).focus();
	}
	//if catgory is not empty
	else
	{
		//update category into database..
		$.ajax({
			type:"POST",
			url:"viewstock_ajax.php",
			data: {update_category_name : category , update_category_id : category_id},
			success : function(result){
				$(".category_display").html(result);
			}
		});
	}
});//end focusout

//store category value into hidden_category division on focus in..
$(".category_tbody").on('focusin','.category_edit',function(){
	$(".hidden_category").text($(this).text());
});

//return false when click enter button in category div
$(".category_tbody").on('keypress','.category_edit , .new_category',function(e){
	if(e.which == 13)
	{
		$(this).blur();
		return false;
	}
});

//delete category when click on delete button in category modal
$(".category_tbody").on('click','.delete_category',function(){
	var category_id = $(this).parent().prev().attr("id");
	var category_name = $(this).parent().prev().text();
	if(category_name != "")
	{
		//show confirmation message..
		var confirm_msg = confirm("Do you want to delete '"+ category_name +"' category");
		//if confirmation message is true
		if(confirm_msg == true)
		{
			$(this).parent().parent().fadeOut(700);
			//delete category into database..
			$.ajax({
				type:"POST",
				url:"viewstock_ajax.php",
				data: {delete_category_id : category_id},
				success : function(result){
					$(".category_display").html(result);
				}
			});
		}
	}
	else{
		$(this).parent().parent().fadeOut(700);
		$(this).parent().parent().remove();
	}
	
});

//append new category row...
$(".category-add-row").click(function()
{
	var last_row_number = $('.category_tbody').children().last().children().first().text();
	var new_row_number = parseInt(last_row_number) + 1;
	var last_row_category_name = $('.category_tbody').children().last().children('.category_edit').text();
	var new_row = "<tr><td>"+new_row_number+"</td><td contenteditable='true' class='new_category'></td><td class='del'><img src='img/iconmonstr-x-mark-icon.png' alt='del' class='delete_category'></td></tr>";
	
	if(last_row_category_name != "")
	{
		$(".category_tbody").append(new_row);
		$('.category_tbody').children().last().children('.new_category').focus();
	}
	else
	{
		$('.category_tbody').children().last().children('.new_category').focus();
	}
});

//insert new category..
$(".category_tbody").on("focusout",'.new_category',function(){
	var new_category_value = $(this).text();
	if(new_category_value != "")
	{
		$(this).addClass('category_edit');
		$(this).removeClass('new_category');

		$.ajax({
				type:"POST",
				url:"viewstock_ajax.php",
				data: {new_category_name : new_category_value},
				success : function(result){
					var abc = result.split("***kasovious***");
					$(".category_display").html(abc[1]);
					$('.category_tbody').children().last().children('.category_edit').attr('id', abc[0]);
				}
			});
	}
})

	
</script>
<!-- end CATEGORY MODAL -->

<!-- BRAND MODAL -->
<script>

$("#brand-search-input").keyup(function (e) {
	var search_text = $(this).val();
	$("#hidden-text").text(search_text);
	var brand_search = $("#hidden-text").text();
	$(".la-anim-10").addClass('la-animate');

	$.ajax({
		type : "POST",
		url : "viewstock_ajax.php",
		data : {search_text_brand : brand_search},
		success : function(result){
			$(".brand_tbody").html(result);
			$(".la-anim-10").removeClass('la-animate');
		}//end success	
	});//end ajax
});//end keydown

//make td editable when click on it..
$(".brand_tbody").on('click','.brand_edit',function(){
	//Category Content Update
	$(".brand_edit").attr('contentEditable',false);
	var brand_id = $(this).attr("id");
	if(brand_id != 1)
	$(this).attr("contentEditable",true);
	else
	alert('You can not edit Misc Brand !');

	$(this).focus();
});	
//end Category click

//update category when focusout category div
$(".brand_tbody").on('focusout','.brand_edit',function(){
	var brand = $(this).text();
	var brand_id = $(this).attr("id");

	//check if brand is empty
	if(brand == "")
	{
		alert("Please do not leave blank !");
		$(this).text($(".hidden_brand").text());
		$(this).focus();
	}
	//if catgory is not empty
	else
	{
		//update brand into database..
		$.ajax({
			type:"POST",
			url:"viewstock_ajax.php",
			data: {update_brand_name : brand , update_brand_id : brand_id},
			success : function(result){

				$(".brand_display").html(result);
			}
		});
	}
});//end focusout

//store brand value into hidden_brand division on focus in..
$(".brand_tbody").on('focusin','.brand_edit',function(){
	$(".hidden_brand").text($(this).text());
});

//return false when click enter button in brand div
$(".brand_tbody").on('keypress','.brand_edit , .new_brand',function(e){
	if(e.which == 13)
	{
		$(this).blur();
		return false;
	}
});

//delete brand when click on delete button in brand modal
$(".brand_tbody").on('click','.delete_brand',function(){
	var brand_id = $(this).parent().prev().attr("id");
	var brand_name = $(this).parent().prev().text();
	if(brand_name != "")
	{
		//show confirmation message..
		var confirm_msg = confirm("Do you want to delete '"+ brand_name +"' brand");
		//if confirmation message is true
		if(confirm_msg == true)
		{
			$(this).parent().parent().fadeOut(700);
			//delete brand into database..
			$.ajax({
				type:"POST",
				url:"viewstock_ajax.php",
				data: {delete_brand_id : brand_id},
				success : function(result){
					$(".brand_display").html(result);
				}
			});
		}
	}
	else{
		$(this).parent().parent().fadeOut(700);
		$(this).parent().parent().remove();
	}
	
});

//append new brand row...
$(".brand-add-row").click(function()
{
	var last_row_number = $('.brand_tbody').children().last().children().first().text();
	var new_row_number = parseInt(last_row_number) + 1;
	var last_row_brand_name = $('.brand_tbody').children().last().children('.brand_edit').text();
	var new_row = "<tr><td>"+new_row_number+"</td><td contenteditable='true' class='new_brand'></td><td class='del'><img src='img/iconmonstr-x-mark-icon.png' alt='del' class='delete_brand'></td></tr>";
	
	if(last_row_brand_name != "")
	{
		$(".brand_tbody").append(new_row);
		$('.brand_tbody').children().last().children('.new_brand').focus();
	}
	else
	{
		$('.brand_tbody').children().last().children('.new_brand').focus();
	}
});

//insert new brand..
$(".brand_tbody").on("focusout",'.new_brand',function(){
	var new_brand_value = $(this).text();
	if(new_brand_value != "")
	{
		$(this).addClass('brand_edit');
		$(this).removeClass('new_brand');

		$.ajax({
				type:"POST",
				url:"viewstock_ajax.php",
				data: {new_brand_name : new_brand_value},
				success : function(result){
					var abc = result.split("***kasovious***");
					$(".brand_display").html(abc[1]);
					$('.brand_tbody').children().last().children('.brand_edit').attr('id', abc[0]);;
				}
			});
	}
})

	
</script>
<!-- end BRAND MODAL -->

<!-- end AJAX SECTION -->
<!-- Footer Section -->
<?php include 'footer.php' ?>
<!-- end Footer Section-->
<script type="text/javascript">
$("#addmore_btn").click(function(){
	//if product name is empty
	if($("#product_name").val() == "")
	{
		$("#product_name").focus().addClass('inputbox_error');
		return false;
	}
	//if product name is not empty
	else{
		// if product name is not empty and price is empty
		if( $("#product_price").val() == "")
		{
			$("#product_price").focus().addClass('inputbox_error');
			return false;
		}
		//else price and product name is not empty
		else{
			$(this).hide();
			$("#addmore_btn_reset").show();
			form.sumbit();
		}
	}
	
})

$("#done_btn").click(function(){
	//if product name is empty
	if($("#product_name").val() == "")
	{
		$("#product_name").focus().addClass('inputbox_error');
		return false;
	}
	//if product name is not empty
	else{
		// if product name is not empty and price is empty
		if( $("#product_price").val() == "")
		{
			$("#product_price").focus().addClass('inputbox_error');
			return false;
		}
		//else price and product name is not empty
		else{
			$(this).hide();
			$("#done_btn_reset").show();
			form.sumbit();
		}
	}
})
</script>
<script type="text/javascript">
	$("#product_name").keyup(function(e) {
		/* Act on the event */
		if(e.which == "32")
		{
			var product_name = $(this).val() ;

			product_name = $.trim(product_name);
			if(product_name  == ""){
				$(this).val("");
			}
		}
		if( $(this).val() != "" )
		{
			$(this).removeClass('inputbox_error');
		}

	});
	$("#product_price").keyup(function(event) {
		/* Act on the event */
		if( $(this).val() != "" )
		{
			$(this).removeClass('inputbox_error');
		}
	});
</script>