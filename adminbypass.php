<?php
#no hackers can enter
#this bypass is only for the admin page
#basically this part is saying that if the global session / variable is empty or not set, it will go back to index.php
if(!isset($_SESSION['email']))
{
	session_destroy();
	header('Refresh:0; url = index.php');
	exit();
}elseif(!($_SESSION['email'] == 'admin@gmail.com')){
	session_destroy();
	header('Refresh:0; url = index.php');
	exit();
}
?>

