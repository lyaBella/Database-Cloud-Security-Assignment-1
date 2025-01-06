<?php

require_once('connection.php');
$email = $_SESSION['email'];
$querycheck = "SELECT COUNT(email) FROM cart WHERE email = '$email'";
$querycheckrun = mysqli_query($conn, $querycheck);
$shoppingcart = mysqli_fetch_array($querycheckrun);
echo $shoppingcart[0]; ?>
