<?php
session_start();
require_once('connection.php');
#establishing connection with the server

?>
<!DOCTYPE html>
<head>
  <!-- General Website Settings -->
  <meta charset="utf-8" lang="en">
  <script src="jquery-3.6.0.min.js"></script>
  <!-- Allows website to fit devices -->
  <meta name = "viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="index.css">
  <script src="index.js"></script>
  <!-- Adds the shopping cart icon -------------->
  <script src="https://kit.fontawesome.com/8ba9633148.js" crossorigin="anonymous"></script>
  <!-- Webpage Title -->
  <title>Welcome to Martial Arts Academy</title>
  <link rel="icon" type="image/x-icon" href="assets/img/mmu.jpg">
</head>

<body>

<?php
#this is basically calling the navbar separately to keep things clean...
include('main_banner.php');?>
</body>
<footer>

</footer>

</html>
