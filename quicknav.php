		<?php
		$username = $_SESSION['username'];
		$query_header = mysql_query("SELECT * FROM user WHERE username = '$username'");
		$row_header = mysql_fetch_array($query_header);
		$privileges = $row_header['privileges'];
		$privileges = explode("/",$privileges);
		?>
		<div class="quick-nav">
			<div class="large-3 columns heading">
				<p>Quick Menu</p>
				
				<div class="row ">	
					<a href="dashboard.php">
						<div class="large-9 columns large-offset-2 quick-nav-li">
							<img src="img/iconmonstr-home-4-icon.png" alt="">
							<span>Home</span>
						</div>
					</a>
					<div class="large-1 columns"></div>
				</div>
				
				<!-- Start New Bill quicknav -->
				<?php
				if(in_array("new_bill.php", $privileges))
				{
				?>
				<div class="row">	
					<a href="new_bill.php">
						<div class="large-9 columns large-offset-2 quick-nav-li">
							<img src="img/billing.png" alt="">
							<span>Billing</span>
						</div>
					</a>
					<div class="large-1 columns"></div>
				</div>
				<?php
				}
				else{
				?>
				<div class="row">	
					<a href="#">
						<div class="large-9 columns large-offset-2 quick-nav-pr">
							<img class="icon_grayscale" src="img/billing.png" alt="">
							<span>Billing</span>
						</div>
					</a>
					<div class="large-1 columns"></div>
				</div>
				<?php
				}
				?>
				<!-- End New Bill quicknav -->
				
				<!-- Start New Bill quicknav -->
				<?php
				if(in_array("finance.php", $privileges))
				{
				?>
				<div class="row">	
					<a href="finance.php">
						<div class="large-9 columns large-offset-2 quick-nav-li">
							<img src="img/finance.png" alt="">
							<span>Finance</span>
						</div>
					</a>
					<div class="large-1 columns"></div>
				</div>
				<?php
				}
				else
				{
				?>
				<div class="row">	
					<a href="#">
						<div class="large-9 columns large-offset-2 quick-nav-pr">
							<img src="img/finance.png" alt="">
							<span>Finance</span>
						</div>
					</a>
					<div class="large-1 columns"></div>
				</div>
					<?php
				}
				?>

				
				<!-- Start dues quicknav -->
				<?php
				if(in_array("dues.php", $privileges))
				{
				?>
				<div class="row">	
					<a href="dues.php">
						<div class="large-9 columns large-offset-2 quick-nav-li">
							<img src="img/sales.png" alt="">
							<span>Dues</span>
						</div>
					</a>
					<div class="large-1 columns"></div>
				</div>
				<?php
				}
				else
				{
				?>
				<div class="row">	
					<a href="#">
						<div class="large-9 columns large-offset-2 quick-nav-pr">
							<img src="img/sales.png" alt="">
							<span>Dues</span>
						</div>
					</a>
					<div class="large-1 columns"></div>
				</div>
				<?php
				}
				?>
				<!-- End dues quicknav -->


				<!-- Start Customer quicknav -->
				<?php
				if(in_array("customer.php", $privileges))
				{
				?>
				<div class="row">	
					<a href="customer.php">
						<div class="large-9 columns large-offset-2 quick-nav-li">
							<img src="img/cust.png" alt="" style="padding-top:3px;">
							<span style="padding-bottom:7px;">Customer</span>
						</div>
					</a>
					<div class="large-1 columns"></div>
				</div>
				<?php
				}
				else{
				?>
				<div class="row">	
					<a href="#">
						<div class="large-9 columns large-offset-2 quick-nav-pr">
							<img  src="img/cust.png" alt="" style="padding-top:3px;">
							<span style="padding-bottom:7px;">Customer</span>
						</div>
					</a>
					<div class="large-1 columns"></div>
				</div>
				<?php
				}
				?>
				<!-- end Customer quicknav -->

				
				<!-- Start Addstock Quicknav -->
				<?php
				if(in_array("addstock.php", $privileges))
				{
				?>
				<div class="row">	
					<a href="addstock.php">
						<div class="large-9 columns large-offset-2 quick-nav-li">
							<img src="img/stock.png" alt="">
							<span id="size_fix2">Add Stock</span>
						</div>
					</a>
					<div class="large-1 columns"></div>
				</div>
				<?php
				}
				else
				{
				?>
				<div class="row">	
					<a href="#">
						<div class="large-9 columns large-offset-2 quick-nav-pr">
							<img src="img/stock.png" alt="">
							<span id="size_fix2" >Add Stock</span>
						</div>
					</a>
					<div class="large-1 columns"></div>
				</div>
				<?php
				}
				?>
				<!-- End Addstock Quicknav -->
				

				<!-- start notification quicknav -->
				<?php
				$username = $_SESSION['username'];
				$query_header = mysql_query("SELECT * FROM user WHERE username = '$username'");
				$row_header = mysql_fetch_array($query_header);
				if($row_header['notification'] == 1)
				{
				?>
				<div class="row">
					<a href="#" class="show_notification">
						<div class="large-9 columns large-offset-2 quick-nav-li">
							<img src="img/notif.png" alt="" style="padding-top:4px;">
							<span style="padding-bottom:7px;">Notification</span>
						</div>
					</a>
					<div class="large-1 columns"></div>
				</div>
				<?php
				}
				else
				{
				?>
				<div class="row">
					<a href="#">
						<div class="large-9 columns large-offset-2 quick-nav-pr">
							<img src="img/notif.png" alt="" style="padding-top:4px;">
							<span style="padding-bottom:7px;">Notification</span>
						</div>
					</a>
					<div class="large-1 columns"></div>
				</div>
				<?php
				}
				?>
				<!-- end notification quicknav -->

					
				<!-- Start Barcode Quicknav -->
				<?php
				if(in_array("addstock.php", $privileges))
				{
				?>
				<div class="row">	
					<a href="barcode.php">
						<div class="large-9 columns large-offset-2 quick-nav-li">
							<img src="img/barcode.png" alt="">
							<span id="size_fix1">Bar-Code</span>
						</div>
					</a>
					<div class="large-1 columns"></div>
				</div>
				<?php
				}
				else
				{
				?>
				<div class="row">	
					<a href="#">
						<div class="large-9 columns large-offset-2 quick-nav-pr">
							<img src="img/barcode.png" alt="">
							<span id="size_fix1">Bar-Code</span>
						</div>
					</a>
					<div class="large-1 columns"></div>
				</div>
				<?php
				}
				?>
				<!-- End Barcode Quicknav -->

			</div> <!-- end Heading -->
		</div> <!-- end quick-nav -->
