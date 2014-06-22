<?php
include 'include/db.php';
session_start();
if(isset($_POST['feedback_submit']))
{
	$name = htmlspecialchars($_POST['feedback_name'],ENT_QUOTES);

	$email = htmlspecialchars($_POST['feedback_email'],ENT_QUOTES);

	$comment = htmlspecialchars($_POST['feedback_comment'],ENT_QUOTES);

	if(isset($_POST['feedback_rating']) || !empty($_POST['feedback_comment']))
	{
		if(isset($_POST['feedback_rating']))
		$rating = $_POST['feedback_rating'];
		else
		$rating = "0";

		$insert_feedback = mysql_query("INSERT INTO feedback (name,email_id,rating,comments,ratting_date) 
		VALUES ('$name','$email','$rating','$comment',NOW())");

	}
	unset($_SESSION['login_user']);
	session_destroy();
	header('location:index.php');
}
// unset($_SESSION['login_user']);
// session_destroy();
// header('location:index.php');

?>