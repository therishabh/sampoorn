<?php
include 'include/db.php';
$query = mysql_query("SELECT * FROM feedback WHERE status = 1");
?>
<html>
<head>
	<title>Rating</title>
	<link rel="stylesheet" href="css/style.css">
	<script src="js/jquery.js"></script>
  	<script src="js/foundation.min.js"></script>
</head>
<body>
	<div class="row" style="margin-top:20px;">
		<div class="large-3 large-centered columns" style="font-size:30px; color:#0a855f; border-bottom:4px double #0a855f; text-align:center;">
			Retailapp Rating
		</div>
	</div>

	<div class="row" style="margin-top:20px;">
		<div class="large-10 large-centered columns" >
			<div class="row">
				<div class="large-5 columns" style="font-size:25px; text-align:center; ">
					Number of Users : <?php echo mysql_num_rows($query)?>
				</div>
				<div class="large-5 columns large-offset-2 end" style="font-size:25px; text-align:center; ">
					<?php
					$query_avg_rating = mysql_query("SELECT avg(rating) as avg_rating FROM feedback WHERE status = 1");
					$row_avg_rating = mysql_fetch_assoc($query_avg_rating);
					$avg_rating = round($row_avg_rating['avg_rating'],2);
					?>
					Average Rating :  <?php echo $avg_rating;?>
				</div>
			</div>
		</div>
	</div>


	<div class="row" style="margin-top:20px;">
		<div class="large-10 large-centered columns">
			<center>
				<table>
					<thead>
						<th style='width:70px; text-align:center;'>S.No</th>
						<th>Name</th>
						<th>Email Id</th>
						<th style='width:70px; text-align:center;'>Rating</th>
						<th>Date</th>
						<th>Comments</th>
					</thead>
					<tbody>
						<?php
						$i = 1;
						while($row=mysql_fetch_assoc($query))
						{
							$date = $row['ratting_date'];
							$explode_date = explode(" ", $date);
							$date = $explode_date['0'];
							$time = $explode_date['1'];
							// echo $date;

							$final_date =  date("M jS, Y", strtotime($date));
							$final_time = date("h:i a", strtotime($time));
							$ratting_date = $final_date . " &nbsp;[ $final_time ]";
							echo "<tr>";
							echo "<td style='text-align:center;'>".$i."</td>";
							echo "<td>".$row['name']."</td>";
							echo "<td>".$row['email_id']."</td>";
							echo "<td style='text-align:center;'>".$row['rating']."</td>";
							echo "<td style='width:200px;'>".$ratting_date."</td>";
							echo "<td>".$row['comments']."</td>";
							echo "</tr>";
							$i++;
				
						}
						?>
					</tbody>
				</table>
			</center>
		</div>
	</div>

</body>
</html>