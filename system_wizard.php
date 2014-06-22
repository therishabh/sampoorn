<!-- Include Main Head -->
<?php include 'header.php' ?>
<!-- end Main Head -->

<div class="row wizard-wrap">
	
	<!-- Quick Navigation Menu -->
		<?php include 'quicknav.php' ?>
	<!-- end Quick Navigation Menu -->
	
	<!-- Stock Wrap -->
	<div class="large-9 columns stock">
		<div class="row">
			<div class="large-9 columns large-centered">
				<center>
				<ul>

					<?php
					if(in_array("manage_user.php",$privileges))
					{
					?>
					<!-- ADD STOCK ITEM -->
					<a href="manage_user.php">
						<li>
							<center>
								<img src="img/Office-Customer-Male-Light-icon.png" alt="">
							</center>
							<div>MANAGE USER</div>
						</li>
					</a>
					<!-- end ADD STOCK ITEM -->
					<?php
					}
					else{
					?>
					<a href="#">
						<li class="icon_grayscale">
							<center>
								<img src="img/Office-Customer-Male-Light-icon.png" alt="">
							</center>
							<div>MANAGE USER</div>
						</li>
					</a>
					<?php
					}
					?>

					<?php
					if(in_array("change_password.php",$privileges) || in_array("notification.php",$privileges) )
					{
					?>
					<!-- VIEW STOCK ITEM -->
					<a href="change_password.php">
						<li>
							<center>
								<img src="img/1381700308_gnome-keyring-manager.png" alt="">
							</center>
							<div>SETTING</div>
						</li>
					</a>
					<!-- end VIEW STOCK ITEM -->
					<?php
					}else
					{
					?>
					<a href="#">
						<li class="icon_grayscale">
							<center>
								<img src="img/1381700308_gnome-keyring-manager.png" alt="">
							</center>
							<div>SETTING</div>
						</li>
					</a>
					<?php
					}
					?>

				</ul> <!-- end ul -->
				</center>
			</div> <!-- end columns -->
		</div> <!-- end row -->
	</div> <!-- end stock -->
	<!-- end Stock Wrap -->


	
</div>
<!-- end row -->

<!-- Include Common Footer -->
<?php include 'footer.php' ?>
<!-- end Include Common Footer-->
