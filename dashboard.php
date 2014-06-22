<!--Include Main Head -->
<?php include 'header.php' ?>
<!-- end Main Head -->

<div class="dashboard">
	<div class="row">

		<!-- Quick Navigation Menu -->
			<?php include 'quicknav.php' ?>
		<!-- end Quick Navigation Menu -->
		
		<ul class="dashboard-wrap large-9 columns">
			<center>
				<?php
				if(in_array("billing.php",$privileges))
				{
				?>
				<!-- active billing icon -->
				<a href="billing.php">
					<li>
						<img src="img/cash-register-icon.png" alt="">
						<br>
						<center>
							<span>BILLING</span>
						</center>
					</li>
				</a>
				<!-- end active billing icon -->
				<?php
				}
				else
				{
				?>
				<!-- inactive billing icon -->
				<a href="#">
					<li style="filter:grayscale(100%);
							-webkit-filter:grayscale(100%);
							-moz-filter: grayscale(100%);
							-ms-filter: grayscale(100%);
							-o-filter: grayscale(100%);">
						<img src="img/cash-register-icon.png" alt="">
						<br>
						<center>
							<span>BILLING</span>
						</center>
					</li>
				</a>
				<!-- end inactive billing icon -->
				<?php
				}
				?>
				
				
				
				<?php
				if(in_array("customer.php",$privileges))
				{
				?>
				<!-- active customer icon -->
				<a href="customer.php">
					<li>
						<img src="img/Office-Customer-Male-Light-icon.png" alt="">
						<br>
						<center>
							<span>CUSTOMER</span>
						</center>
					</li>
				</a>
				<!-- end active customer icon -->
				<?php
				}
				else
				{
				?>
				<!-- inactive customer icon -->
				<a href="#">
					<li style="filter:grayscale(100%);
							-webkit-filter:grayscale(100%);
							-moz-filter: grayscale(100%);
							-ms-filter: grayscale(100%);
							-o-filter: grayscale(100%); ">
						<img src="img/Office-Customer-Male-Light-icon.png" alt="">
						<br>
						<center>
							<span>CUSTOMER</span>
						</center>
					</li>
				</a>
				<!-- end inactive customer icon -->
				<?php
				}
				?>

				<?php
				if(in_array("dues.php",$privileges))
				{
				?>
				<!-- active dues icon -->
				<a href="dues.php">
					<li>
						<img src="img/money-icon.png" alt="">
						<br>
						<center>
							<span>DUES</span>
						</center>
					</li>
				</a>
				<!-- end active dues icon -->
				<?php
				}
				else{
				?>
				<!-- inactive dues icon -->
				<a href="#">
					<li style="filter:grayscale(100%);
							-webkit-filter:grayscale(100%);
							-moz-filter: grayscale(100%);
							-ms-filter: grayscale(100%);
							-o-filter: grayscale(100%); ">
						<img src="img/money-icon.png" alt="">
						<br>
						<center>
							<span>DUES</span>
						</center>
					</li>
				</a>
				<!-- end inactive dues icon -->
				<?php
				}
				?>


				<?php
				if(in_array("stock.php",$privileges))
				{
				?>
				<!-- active stock icon -->
				<a href="stock.php">
					<li>
						<img src="img/shop-cart-apply-icon.png" alt="">
						<br>
						<center>
							<span>STOCK</span>
						</center>
					</li>
				</a>
				<!-- end active stock icon -->
				<?php
				}
				else
				{
				?>
				<!-- inactive stock icon -->
				<a href="#">
					<li style="filter:grayscale(100%);
							-webkit-filter:grayscale(100%);
							-moz-filter: grayscale(100%);
							-ms-filter: grayscale(100%);
							-o-filter: grayscale(100%); ">
						<img src="img/shop-cart-apply-icon.png" alt="">
						<br>
						<center>
							<span>STOCK</span>
						</center>
					</li>
				</a>
				<!-- end inactive stock icon -->
				<?php
				}
				?>

				<?php
				if(in_array("finance.php",$privileges))
				{
				?>
				<!-- inactive finance icon -->
				<a href="finance.php">
					<li>
						<img src="img/numbers-black-icon.png" alt="">
						<br>
						<center>
							<span>FINANCE</span>
						</center>
					</li>
				</a>
				<!-- inactive finance icon -->
				<?php
				}
				else
				{
				?>
				<a href="finance.php">
					<li style="filter:grayscale(100%);
							-webkit-filter:grayscale(100%);
							-moz-filter: grayscale(100%);
							-ms-filter: grayscale(100%);
							-o-filter: grayscale(100%); ">
						<img src="img/numbers-black-icon.png" alt="">
						<br>
						<center>
							<span>FINANCE</span>
						</center>
					</li>
				</a>
				<?php
				}
				?>

				
				<?php
				if(in_array("system_wizard.php",$privileges))
				{
				?>
				<!-- active system_wizard icon -->
				<a href="system_wizard.php">
					<li>
						<img src="img/Tools-2-icon.png" alt="">
						<br>
						<center>
							<span>SYSTEM WIZARD</span>
						</center>
					</li>
				</a>
				<!-- end active system_wizard icon -->
				<?php
				}
				else
				{
				?>
				<!-- inactive system_wizard icon -->
				<a href="#">
					<li style="filter:grayscale(100%);
							-webkit-filter:grayscale(100%);
							-moz-filter: grayscale(100%);
							-ms-filter: grayscale(100%);
							-o-filter: grayscale(100%); ">
						<img src="img/Tools-2-icon.png" alt="">
						<br>
						<center>
							<span>SYSTEM WIZARD</span>
						</center>
					</li>
				</a>
				<!-- end inactive system_wizard icon -->
				<?php
				}
				?>


			</center>
		</ul> <!-- end dashboard-wrap -->

	</div> <!-- end row -->
</div> <!-- end dashboard -->


<!-- Include Common Footer -->
<?php include 'footer.php' ?>
<!-- end Include Common Footer-->