<!-- Include Main Head -->
<?php include 'header.php' ?>
<!-- end Main Head -->

<!-- Database Operations -->
	<!-- Fetching Category Name & Brand Name -->
	<?php 
		//Fetch Category Name From Tabel Category
		$category_query = "SELECT id,category FROM category;";
		//Execute The Sql Query
		$category_data = mysql_query($category_query);

		//Fetch Brand Name From Tabel Brand
		$brand_query = "SELECT brand FROM brand;";
		//Execute The Sql Query
		$brand_data = mysql_query($brand_query);
	?>
<!-- end Database Operations -->

<!-- Search Form Action -->
<?php
	if(isset($_POST['search-submit'])){
		
		if( (!empty($_POST['category'])) || (!empty($_POST['pname'])) || (!empty($_POST['brand'])) || (!empty($_POST['price'])) || (!empty($_POST['colour'])) || (!empty($_POST['size'])) ){	
			
			if(!empty($_POST['category'])){	
				$category = $_POST['category'];
			}
			else{
				$category = "%";	
			}

			if(!empty($_POST['pname'])){	
				$pname = $_POST['pname'];
			}
			else{
				$pname = "%";	
			}

			if(!empty($_POST['brand'])){	
				$brand = $_POST['brand'];
			}
			else{
				$brand = "%";	
			}
			
			if(!empty($_POST['price'])){	
				$price = $_POST['price'];
			}
			else{
				$price = "%";	
			}
			
			if(!empty($_POST['colour'])){	
				$colour = $_POST['colour'];
			}
			else{
				$colour = "%";	
			}

			if(!empty($_POST['size'])){	
				$size = $_POST['size'];
			}
			else{
				$size = "%";	
			}

			$query = "SELECT * FROM product WHERE category LIKE '$category' AND product_name LIKE '$pname' AND price LIKE '$price' AND brand LIKE '$brand' AND color LIKE '$colour' AND size LIKE '$size' AND status = '1' ORDER BY product_name ASC;";
			$data = mysql_query($query);

		
		} //Check NOT EMPTY Case For Parameters
		 
	} //Check If Submit Button is SET
?>
<!-- end Search Form Action -->

<!-- Edit & Save Changes -->
<?php 
	if (isset($_POST['save'])) {
		$content = $_POST['content'];
		echo $content;
	}
?>
<!-- end Edit & Save Changes -->

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
			<form method="POST" action="ajaxtemp.php">

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
							<input type="text" name="pname" placeholder="Product Name">
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
							<input type="text" name="price" placeholder="Price">
						</div>
						<!-- end Price Field -->

						<!-- Colour Field -->
						<div class="large-4 columns">
							<input type="text" name="colour" placeholder="Colour">
						</div>
						<!-- end Colour Field -->

						<!-- Size Field -->
						<div class="large-4 columns">
							<input type="text" name="size" placeholder="Size">
						</div>
						<!-- end Size Field -->

					</div>
					<!-- end Second Search Row -->

					<div class="row">
						<div class="large-3 columns">
							<button type="reset" name="save" id="save">Save Change</button>
						</div>
					</div>

				</div>
				
				<div class="large-3 columns" id="viewstock-btn">
					<button type="submit" name="search-submit">Search</button>
					<button type="reset">Reset</button>
				</div>

			</form>
			<!-- end Search Form -->
		</div>
		<!-- end Search Section -->
		<div class="row">
			<div class="large-12 columns search-result">
				<center>
				<?php
					echo "<table>";
						echo "<thead>";
							echo "<tr>";
								echo "<th>Category</th>";
								echo "<th>Product Name</th>";
								echo "<th>Quantity</th>";
								echo "<th>Price</th>";
								echo "<th>Brand</th>";
								echo "<th>Colour</th>";
								echo "<th>Size</th>";
								echo "<th>Type</th>";
							echo "</tr>";
						echo "</thead>";

					if (isset($_POST['search-submit'])) {
						if( (!empty($_POST['category'])) || (!empty($_POST['pname'])) || (!empty($_POST['brand'])) || (!empty($_POST['price'])) || (!empty($_POST['colour'])) || (!empty($_POST['size'])) )
						{
							//Display Search Results
							echo "<tbody>";
							while ($row = mysql_fetch_assoc($data)) {
								echo "<tr>";
									echo "<td>".$row['category']."</td>";
									echo "<td>".$row['product_name']."</td>";
									echo "<td>".$row['qty']."</td>";
									echo "<td>".$row['price']."</td>";
									echo "<td>".$row['brand']."</td>";
									echo "<td>".$row['color']."</td>";
									echo "<td>".$row['size']."</td>";
									echo "<td>".$row['type']."</td>";
								echo "</tr>";
							}
							echo "</tbody>";
						}

						//If All The Parameters Are EMPTY
						if( (empty($_POST['category'])) && (empty($_POST['pname'])) && (empty($_POST['brand'])) && (empty($_POST['price'])) && (empty($_POST['colour'])) && (empty($_POST['size'])) )
						{
							$query = "SELECT * FROM product ORDER BY product_name ASC";
							$data = mysql_query($query);
							//Display Search Results
							echo "<tbody>";
							$i=1;
							while ($row = mysql_fetch_assoc($data)) {
								echo "<tr>";
									echo "<td contenteditable='true' class='edit_".$i."' id='".$row['product_id']."'>".$row['category']."</td>";
									$i++;
									echo "<td contenteditable='true' class='edit_".$i."' id='".$row['product_id']."'>".$row['product_name']."</td>"; 
									$i++;
									echo "<td contenteditable='true' class='edit_".$i."' id='".$row['product_id']."'>".$row['qty']."</td>";
									$i++;
									echo "<td contenteditable='true' class='edit_".$i."' id='".$row['product_id']."'>".$row['price']."</td>";
									$i++;
									echo "<td contenteditable='true' class='edit_".$i."' id='".$row['product_id']."'>".$row['brand']."</td>";
									$i++;
									echo "<td contenteditable='true' class='edit_".$i."' id='".$row['product_id']."'>".$row['color']."</td>";
									$i++;
									echo "<td contenteditable='true' class='edit_".$i."' id='".$row['product_id']."'>".$row['size']."</td>";
									$i++;
									echo "<td contenteditable='true' class='edit_".$i."' id='".$row['product_id']."'>".$row['type']."</td>";
									$i++;
								echo "</tr>";
							}
							echo "</tbody>";
						}
					}
					echo "</table>";
				 ?>
				</center>	
			</div> <!-- end search-result -->
		</div> <!-- end row -->
	</div> <!-- end viewstock -->
</div> <!-- end viewstock-wrap -->

<script>
	<?php 
		$j=$i;
		$i=1;
		for ($i=1; $i<=$j; $i++) { 
	?>

	$('.edit_<?php echo $i; ?>').focusout(function(){
		var content = $('.edit_<?php echo $i; ?>').html();
		var content_id = $('.edit_<?php echo $i; ?>').attr('id');
		$.ajax({
			type:"POST",
			url:"viewstock_ajax.php",
			data: {content:content,content_id:content_id}
		}).done(function(msg){
			$('.edit_<?php echo $i; ?>').html(msg);
		});
	});

	<?php } ?>

</script>