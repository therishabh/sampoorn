
<script>
// script for close modal
$('.modal_close').click(function(){
	$(this).foundation('reveal', 'close');
});

$(".quick-nav .show_notification").click(function(){
	$("#notification_modal").foundation('reveal', 'open');
})

$("body").keydown(function(event) {
	if(event.which == 27)
	{
		$(this).foundation('reveal', 'close');
	}
});

	$('.en-des').change(function(){
			$('#des-en').attr("disabled","disabled");
	});

	$('#des_fix').click(function(){
		$('#des-en').attr("disabled",false);
		$('.en-des').attr("checked",false);
	})
</script>

</body>
</html>
<?php
unset($_SESSION['show_notificaiton']);
?>


<!-- start script for notification modal -->
<script type="text/javascript">

//reset serial number from due notification table..
$("#due_noti_table tr").each(function(id){
	$(this).children().first().html(id+1);	
});

//reset serial number from stock notification table..
$("#stock_noti_table tr").each(function(id){
	$(this).children().first().html(id+1);	
});


$(".remove_notification").click(function(){
	var customer_id = $(this).parent().next().text();
	var customer_name = $(this).parent().parent().children('.customer_name').text();
	var confirm_msg = confirm("Do you want to delete '"+customer_name+"' customer from notificaiton ?");
	if(confirm_msg == true)
	{
		//remove all customer from notification table where customer id is same..
		$("#due_noti_table tr").each(function(){
			if(  $(this).children('.customer_id').text() == customer_id )
			{
				$(this).remove();
			}
		})
		
		//reset serial number from due notification table..
		$("#due_noti_table tr").each(function(id){
			$(this).children().first().html(id+1);	
		});

		$.ajax({
			type : "POST",
			url : "dashboard_ajax.php",
			data : {customer_id_notification : customer_id}
		})
	}
	
});
$(".remove_notification_stock").click(function(){
	var product_id = $(this).parent().next().text();
	var product_name = $(this).parent().parent().children('.product_name').text();
	var confirm_msg = confirm("Do you want to delete '"+product_name+"' product from notificaiton ?");
	if(confirm_msg == true)
	{
		$(this).parent().parent().remove();
		//reset serial number from stock notification table..
		$("#stock_noti_table tr").each(function(id){
			$(this).children().first().html(id+1);	
		});

		$.ajax({
			type : "POST",
			url : "dashboard_ajax.php",
			data : {product_id_notification : product_id}
		})

	}
});

	var doc_ht = $(document).height();
	var header_ht = $('.head').height();
	var quicknav_ht = parseInt(doc_ht) - parseInt(header_ht);
	quicknav_ht = quicknav_ht+"px";
	$(".quick-nav .heading").css("height",quicknav_ht);

</script>
<!-- end script for notification modal -->