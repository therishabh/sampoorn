<?php
include 'include/db.php';
session_start();
//If Session Does Not Exists
if(!isset($_SESSION['login_user']) || empty($_SESSION['login_user']) )
{	
?>

	<script type="text/javascript">
	window.location = "index.php";
	</script>
	
<?php
}
else if(isset($_SESSION['login_user']) && !empty($_SESSION['login_user']))
{
	$username = $_SESSION['username'];
	$query_header = mysql_query("SELECT * FROM user WHERE username = '$username' AND status = 1");
	if(mysql_num_rows($query_header) > 0)
	{
		$row_header = mysql_fetch_array($query_header);
		$privileges = $row_header['privileges'];
		$privileges = explode("/",$privileges);
		$current_page_name = basename($_SERVER['REQUEST_URI']);
		//if current page is not addstock page then unset session..
		if($current_page_name != "addstock.php")
		{
			unset($_SESSION['number_of_items']);
		}//end if condition
		if($current_page_name == "addstock.php" || $current_page_name == "current_barcode.php")
		{
			
		}//end if condition
		else{
			unset($_SESSION['barcode']);
		}//end else condition
		if(!in_array($current_page_name,$privileges))
		{
			//check if current page is change_password..
			if($current_page_name == "change_password.php")
			{
				if(!in_array("notification.php",$privileges) && !in_array("change_password.php",$privileges))
				{
					?>
					<script type="text/javascript">
						window.location = "dashboard.php";
					</script>
					<?php
				}//end if condition if(!in_array("notification.php",$privileges) && !in_array("change_password.php",$privileges))
			}//end if condition if($current_page_name == "change_password.php")
			else
			{
		?>

		<script type="text/javascript">
		window.location = "dashboard.php";
		</script>
		
		<?php
			}//end else condition
		}//end if condition if(!in_array($current_page_name,$privileges))
	}//end if condition
	//execute if user is not deleted..
	else
	{		
		unset($_SESSION['login_user']);
		session_destroy();

	?>
		<script type="text/javascript">
		
		window.location = "index.php";
		</script>
		
	<?php
	}

}

?>
<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->

<head>
	<meta charset="utf-8" />
  <meta name="viewport" content="width=device-width" />
  <title>Sampoorn : Kasovious</title>
  <link rel="icon" type="image/ico" href="img/favicon_new.ico"/>
	
  <link rel="stylesheet" href="css/style.css">
	<!-- <link rel="stylesheet" type="text/css" href="http://cdn.webrupee.com/font"> -->
	

	<!-- script for loading -->
	<link rel="stylesheet" type="text/css" href="css/loading/component.css" />
	<script src="js/loading/modernizr.custom.js"></script>
	<script src="js/loading/classie.js"></script>
	<!-- End script for loading -->


  <script src="js/vendor/custom.modernizr.js"></script>
  <script src="js/jquery.js"></script>
  <script src="js/foundation.min.js"></script>


</head>
<body>
	
	<div class="la-anim-10"></div>

	<header class="head row">
		<a href="dashboard.php">
		<div class="large-5 columns" id="head-content">
			
			<p>Sampoorn</p>
			
			<p>A-249 Lajpat Nagar, Sahibabad, Ghaziabad [+91-9871198786]</p>
		</div>
		</a>
		<!-- <div class="large-4 columns test"></div> -->
		<div class="large-offset-5 large-2 columns system-detail">
			<!-- First Child system-detail -->
			<p>Welcome Sir</p>
			
			<!-- Second Child system-detail -->
			<p>Today is, 
				<span>
					<?php date_default_timezone_set('UTC'); echo date("j M Y"); ?>	
				</span>
			 </p>
			
			<!-- Third Child system-detail -->
			 <p>
			 	<a href="system_wizard.php">SETTING</a>
			 	<a href="#" id="logout">LOGOUT</a>
			 </p>
		</div>
	</header>

	<div id="sam" class="reveal-modal small">
  		<input id="sam-command" list="pages" type="text" x-webkit-speech>
  		<datalist id="pages">
  			<?php
  			$query = mysql_query("SELECT * FROM sam WHERE status = '1'");
  			while($row = mysql_fetch_assoc($query))
  			{
  				echo '<option value="'.$row['command'].'">';
  			}
  			?>
		</datalist>
  		
  		<div class="hide command-hidden"></div>
    		<div class="testing"></div>
    		<a class="close-reveal-modal">&#215;</a>
	</div>
<script>
$("#sam-command").val("h").focus();
//script for call quick search to press ` button..
$(document).keydown(function (e){
	var code = (e.keyCode ? e.keyCode : e.which);
	if(code == 192){
		$('#sam').foundation('reveal', 'open');

		$('.close-reveal-modal').click(function(){
		$(this).foundation('reveal', 'close');
		});
	}
});

//script for perform action when speak into search box..
$("#sam-command").bind('webkitspeechchange', function(){
    var search_text = $("#sam-command").val();

    $.ajax({
    	type : "POST",
    	url : "quick_search_ajax.php",
    	data : {search_text : search_text},
    	success : function(result){
    		if(result == "fail")
    		{
    		}
    		else
    		{
    			window.location = result;
    		}
    	}
    })
});

//script for perform action when press enter after type search text..
$("#sam-command").keydown(function(e){
	var code  = (e.keyCode ? e.keyCode : e.which);
	var search_text = $("#sam-command").val();
	if(search_text != "")
	{
		if(code == 13)
		{
			$.ajax({
		    	type : "POST",
		    	url : "quick_search_ajax.php",
		    	data : {search_text : search_text},
		    	success : function(result){
		    		if(result == "fail")
		    		{
		    		}
		    		else
		    		{
		    			window.location = result;
		    		}
		    	}
		    });//end ajax
		}
	}
	
});

  </script>



<!-- feedback modal start -->
<div id="feedback_modal" class="reveal-modal small" style="margin-top:0px;">
	<div class="row" style="border:4px double #f2f2f2; padding:20px;">
		<div class="large-12 columns large-centered">

	<div class="row">
		<div class="large-7 large-centered columns" style="text-align:center; padding-bottom:3px; color:#0a855f; border-bottom:3px double #0a855f;">
			Let Us Know What You Think !
		</div>
	</div>
	
	<form action="logout.php" method="post">
	<div class="row" style="margin-top:16px;">
		<div class="large-9 columns large-centered">
		<input type="text" name="feedback_name" placeholder="Name (Don't worry it's not required)">
		</div>
	</div><!-- end row -->
	<div class="row ">
		<div class="large-9 columns large-centered">
		<input type="email" name="feedback_email" placeholder="Email Address (it's not required either)">
		</div>
	</div><!-- end row -->
	<div class="row">
		<div class="large-9 large-centered columns star">
			<center>
				<span>
					<label class="1">
						<input type="radio" value="1" name="feedback_rating" class="radio_1 hide">
						<img src="img/star1.png" style="height:30px;" class="star_blank">
						<img src="img/star2.png" style="height:30px;" class="star_fill hide">					
					</label>
				</span>
				<span>
					<label class="2">
						<input type="radio" value="2" name="feedback_rating" class="radio_2 hide">
						<img src="img/star1.png" style="height:30px;" class="star_blank">
						<img src="img/star2.png" style="height:30px;" class="star_fill hide">				
					</label>
				</span>
				<span>
					<label class="3">
						<input type="radio" value="3" name="feedback_rating" class="radio_3 hide">
						<img src="img/star1.png" style="height:30px;" class="star_blank">
						<img src="img/star2.png" style="height:30px;" class="star_fill hide">				
					</label>
				</span>
				<span>
					<label class="4">
						<input type="radio" value="4" name="feedback_rating" class="radio_4 hide">
						<img src="img/star1.png" style="height:30px;" class="star_blank">
						<img src="img/star2.png" style="height:30px;" class="star_fill hide">				
					</label>
				</span>
				<span>
					<label class="5">
						<input type="radio" value="5" name="feedback_rating" class="radio_5 hide">
						<img src="img/star1.png" style="height:30px;" class="star_blank">
						<img src="img/star2.png" style="height:30px;" class="star_fill hide">				
					</label>
				</span>
			</center>
		</div>
	</div>
	<div class="row" style="margin-top:10px;">
		<div class="large-9 large-centered columns">
			<textarea name="feedback_comment" id="comments" style="width:100%;height:100px; resize:none;" placeholder="Enter Your Comments..."></textarea>
		</div>
	</div>

	<div class="row">
		<div class="large-5 large-centered columns">
			<button name="feedback_submit" style="width:100%">Submit</button>
		</div>
	</div>
	
	</form>

		


		</div>
	</div>
<a class="close-reveal-modal modal_close">&#215;</a>
</div>
<!-- end feedback modal end -->





<script type="text/javascript">

	$("#logout").click(function(event) {
		$(".modal_close").foundation('reveal', 'close');
		$("#feedback_modal").foundation('reveal', 'open');
	});

	$("#feedback_modal .star label").hover(function() {
		/* Stuff to do when the mouse enters the element */
		var label_class =  $(this).attr("class");
		for(var i = 1; i<= label_class ; i++)
		{
			$("#feedback_modal ."+i+" .star_blank").hide();
			$("#feedback_modal ."+i+" .star_fill").show();
		}
	}, function() {
		/* Stuff to do when the mouse leaves the element */
		var label_class =  $(this).attr("class");
		for(var i = 1; i<= label_class ; i++)
		{
			if($("#feedback_modal ."+i).hasClass('star_click') ){

			}
			else{
			$("#feedback_modal ."+i+" .star_fill").hide();
			$("#feedback_modal ."+i+" .star_blank").show();	
			}
		}
	});


	$("#feedback_modal .star label").click(function() {
		/* Stuff to do when the mouse enters the element */
		$("#feedback_modal .star label").removeClass('star_click');
		$("#feedback_modal label .star_blank").show();
		$("#feedback_modal label .star_fill").hide();

		var label_class =  $(this).attr("class");
		for(var i = 1; i<= label_class ; i++)
		{
			$("#feedback_modal ."+i+" .star_blank").hide();
			$("#feedback_modal ."+i+" .star_fill").show();
			$("#feedback_modal ."+i).addClass('star_click')
		}
	});

</script>
<?php
//start script for notification modal
date_default_timezone_set('Asia/Calcutta'); 
$username = $_SESSION['username'];
$query_user = mysql_query("SELECT * FROM user WHERE username = '$username'");
$row_user = mysql_fetch_array($query_user);
$stock_item = $row_user['stock_item'];


$abc = "-".$row_user['due_day']." days";
$from_date = date('Y-m-d', strtotime($abc));

//if user notification is true..
if($row_user['notification'] == "1")
{
	$query_bill_from = mysql_query("SELECT id from bill WHERE created_date > '$from_date' ORDER BY id ASC LIMIT 1");
	$row_bill_from = mysql_fetch_array($query_bill_from);
	if(mysql_num_rows($query_bill_from) > 0){

		$from_id = $row_bill_from['id'];

		$query_bill = mysql_query("SELECT bill_number , customer_id , created_date , due 
			FROM bill WHERE id >= $from_id AND status = 1 ORDER BY id DESC ");
	}

	$sql_stock = "SELECT product.product_id  AS product_id , category.category AS category , 
		product.product_name AS product_name , product.qty AS qty , product.price AS price, 
		brand.brand AS brand ,  product.sell_qty AS sell_qty 
		FROM product,category,brand WHERE product.category = category.id AND product.brand = brand.id 
		AND product.status = 1 AND product.notification_status = 1 AND product.qty - product.sell_qty <= {$stock_item}";


	$query_stock = mysql_query($sql_stock) or die(mysql_error());
	//end script for notification modal
?>


	<!-- Notification modal start -->
	<div id="notification_modal" class="reveal-modal large" style="margin-top:-80px;">
		<div class="row" >
			<div class="large-12 columns large-centered noti_modal" >
			
			<fieldset>
				<legend>Dues Notification</legend>
				<table id="due_noti_heading">
				<thead>
					<tr>
						<th><center> S No. </center></th>
						<th><center> Customer Name </center></th>
						<th><center> Mobile No. </center></th>
						<th><center> Bill No. </center></th>
						<th><center> Bill Date </center></th>
						<th><center> Due </center></th>
						<th><center> Total Due </center></th>
						<th></th>
					</tr>
				</thead>
				</table>
				<div id="due_noti_table">
				<table>
					<tbody>
					<?php
					if(mysql_num_rows($query_bill_from) > 0)
					{
						if(mysql_num_rows($query_bill) > 0)
						{
							
							while($row_bill = mysql_fetch_array($query_bill))
							{
								$customer_id = $row_bill['customer_id'];
								$query_customer = mysql_query("SELECT * FROM customer 
									WHERE id ='$customer_id' AND notification_status = '1' AND status = '1'");
								$row_customer = mysql_fetch_array($query_customer);
								$remaining_due = $row_customer['total_due'] - $row_customer['total_paid_due'];
								if($remaining_due > 0)
								{
									$date = $row_bill['created_date'];
									$explode_date = explode(" ", $date);
									$date = $explode_date['0'];
									$time = $explode_date['1'];
									$bill_date =  date("jS M", strtotime($date));

									echo "<tr>";
									echo "<td></td>";
									echo "<td class='customer_name'>".$row_customer['name']."</td>";
									echo "<td>".$row_customer['phone_no']."</td>";
									echo "<td>".$row_bill['bill_number']."</td>";
									echo "<td>".$bill_date."</td>";
									echo "<td><span class='WebRupee'>Rs. </span>".$row_bill['due']."</td>";
									echo "<td><span class='WebRupee'>Rs. </span>".$remaining_due."</td>";
									echo "<td><span class='remove_notification'><img src='img/iconmonstr-x-mark-icon.png' title='Delete customer from notification' style='height:18px;'></span></td>";
									echo "<td class='customer_id hide'>".$row_customer['id']."</td>";
									echo "</tr>";
								}

							}//end while condition
						}//end if condition if(mysql_num_rows($query_bill) > 0)
					}//end if condition if(mysql_num_rows($query_bill_from) > 0)
						?>
						
					</tbody>
				</table>
				
				</div>
				<?php
				if(mysql_num_rows($query_bill_from) > 0)
				{
					if(mysql_num_rows($query_bill) > 0)
					{

					}
					else
					{
						echo '<div style="text-align:center; font-size:20px;color:red;">
							No New Records
						</div>';
					}
				}
				else
				{
					echo '<div style="text-align:center; font-size:20px;color:red;">
						No New Records
					</div>';
				}
				?>
				
			
			</fieldset>
			

			<fieldset>
				<legend>Stock Notification</legend>
				<table id="stock_noti_heading">
				<thead>
					<tr>
						<th><center> S No. </center></th>
						<th><center> Product Name </center></th>
						<th><center> Category </center></th>
						<th><center> Brand </center></th>
						<th><center> Remaining Pices </center></th>
						<th><center> Price </center></th>
						<th></th>
					</tr>
				</thead>
				</table>

				<div id="stock_noti_table">
				<table>
					<tbody>
					<?php
					if(mysql_num_rows($query_stock) > 0)
					{
						
						while($row_stock = mysql_fetch_array($query_stock))
						{
							$remaining_pices = $row_stock['qty'] - $row_stock['sell_qty'];
							echo "<tr>";
							echo "<td></td>";
							echo "<td class='product_name'>".$row_stock['product_name']."</td>";
							echo "<td>".$row_stock['category']."</td>";
							echo "<td>".$row_stock['brand']."</td>";
							echo "<td>".$remaining_pices."</td>";
							echo "<td><span class='WebRupee'>Rs. </span>".$row_stock['price']."</td>";
							echo "<td><span class='remove_notification_stock'><img src='img/iconmonstr-x-mark-icon.png' title='Delete product from notification' style='height:18px;'></span></td>";
							echo "<td class='product_id hide'>".$row_stock['product_id']."</td>";
							echo "</tr>";

						}//end while condition
					}//end if condition if(mysql_num_rows($query_stock) > 0)
					?>
						
					</tbody>
				</table>
				
				</div>

				<?php
				if(mysql_num_rows($query_stock) > 0)
				{

				}
				else
				{
					echo '<div style="text-align:center; font-size:20px;color:red;">
						No New Records
					</div>';
				}
				?>

			</fieldset>
			</div> <!--end large-12 columns-->
		</div><!-- end row -->
	<a class="close-reveal-modal modal_close">&#215;</a>
	</div>
	<!-- Notification modal end -->
<?php
}//end if condition for checking notification
?>

<div id="noti_nodi" class="reveal-modal large" style="margin-top:-80px;">
<a class="close-reveal-modal modal_close">&#215;</a>
</div>


<?php
if($row_user['notification'] == 1)
{
	if(isset($_SESSION['show_notificaiton']))
	{
?>
<script type="text/javascript">
	$("#notification_modal").foundation('reveal', 'open');
</script>
<?php
	}
}
?>

