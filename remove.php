<?php
session_start();
//connection
require_once('connection.php');
//query to delete
$course = $_GET['courseid'];
//delete from cart based on the page's request
$query = "DELETE FROM cart WHERE courseid = '$course'";
$result = mysqli_query($conn, $query);
#if the thing works without any hitch it will just show unenrolled otherwise failed
if(($result) === TRUE ){
	echo "<script>alert('Unenrolled')</script>";
	header('Refresh:0 ; url=shopping_cart.php');
}else{
	echo "<script>alert('Failed')</script>";
		header('Refresh:0 ; url=shopping_cart.php');
}



?>