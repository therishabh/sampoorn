<!-- Include Main Head -->
<?php include 'header.php' ?>
<!-- end Main Head -->

<div class="row stock-wrap">
	<!-- Quick Navigation Menu -->
		<?php include 'quicknav.php' ?>
	<!-- end Quick Navigation Menu -->
	
	<!-- Stock Wrap -->
	<div class="large-9 columns stock">
		<div class="row">
			<div class="large-8 columns large-centered">
				<ul>

					<?php
					if(in_array("addstock.php",$privileges))
					{
					?>
					<!-- ADD STOCK ITEM -->
					<a href="addstock.php">
						<li>
							<center>
								<img src="img/database-add-icon.png" alt="">
							</center>
							<div>ADD STOCK</div>
						</li>
					</a>
					<!-- end ADD STOCK ITEM -->
					<?php
					}
					else{
					?>
					<a href="#">
						<li style="filter:grayscale(100%);
							-webkit-filter:grayscale(100%);
							-moz-filter: grayscale(100%);
							-ms-filter: grayscale(100%);
							-o-filter: grayscale(100%);">
							<center>
								<img src="img/database-add-icon.png" alt="">
							</center>
							<div>ADD STOCK</div>
						</li>
					</a>
					<?php
					}
					?>

					<?php
					if(in_array("viewstock.php",$privileges))
					{
					?>
					<!-- VIEW STOCK ITEM -->
					<a href="viewstock.php">
						<li>
							<center>
								<img src="img/edit-icon.png" alt="">
							</center>
							<div>MANAGE STOCK</div>
						</li>
					</a>
					<!-- end VIEW STOCK ITEM -->
					<?php
					}else
					{
					?>
					<a href="#">
						<li style="filter:grayscale(100%);
							-webkit-filter:grayscale(100%);
							-moz-filter: grayscale(100%);
							-ms-filter: grayscale(100%);
							-o-filter: grayscale(100%);">
							<center>
								<img src="img/edit-icon.png" alt="">
							</center>
							<div>MANAGE STOCK</div>
						</li>
					</a>
					<?php
					}
					?>

				</ul> <!-- end ul -->
			</div> <!-- end columns -->
		</div> <!-- end row -->
	</div> <!-- end stock -->
	<!-- end Stock Wrap -->
</div>
<!-- Include Common Footer -->
<?php include 'footer.php' ?>
<!-- end Include Common Footer-->
