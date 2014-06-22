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
				if(in_array("new_bill.php",$privileges))
				{
				?>
				<a href="new_bill.php">
					<li>
						<img src="img/newbill.png" alt="">
						<br>
						<center>
							<span>NEW BILL</span>
						</center>
					</li>
				</a>
				<?php
				}
				else{
				?>
				<a href="#">
					<li class="icon_grayscale">
						<img src="img/newbill.png" alt="">
						<br>
						<center>
							<span>NEW BILL</span>
						</center>
					</li>
				</a>
				<?php
				}
				?>
				
				<?php
				if(in_array("manage_bill.php",$privileges))
				{
				?>
				<a href="manage_bill.php">
					<li>
						<img src="img/managebill.png" alt="">
						<br>
						<center>
							<span>MANAGE BILL</span>
						</center>
					</li>
				</a>
				<?php
				}
				else{
				?>
				<a href="#">
					<li class="icon_grayscale">
						<img src="img/managebill.png" alt="">
						<br>
						<center>
							<span>MANAGE BILL</span>
						</center>
					</li>
				</a>
				<?php
				}
				?>
			</center>
		</ul>
	

	</div> <!-- end row -->
</div> <!-- end dashboard -->

<!-- Include Common Footer -->
<?php include 'footer.php' ?>
<!-- end Include Common Footer -->