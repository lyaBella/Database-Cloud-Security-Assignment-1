<?php
#this is connected  to the logout button in the index page once a person logs in..
	session_start();
	session_destroy();
	header("Location:index.php");
?>
