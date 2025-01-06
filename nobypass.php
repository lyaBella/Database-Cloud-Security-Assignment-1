<?php
#this is so that normal users cant bypass specific pages without logging in. Like shopping cart and so on
if(!isset($_SESSION['email']))
{
	session_destroy();
	header('Refresh:0; url = index.php');
	exit();
}
?>
