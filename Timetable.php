<?php
session_start();
require_once('connection.php');
include('nobypass.php');

//for some reason i did this here instead of doing it down there.. idk why but basically taking all the data from enrolled users table with the usr's email. we are doing this because that table has sechedule id and we want that to check student capacity
$email = $_SESSION['email'];
$query = "SELECT * FROM enrolled_users WHERE email = '$email'";
$queryrun = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="Timetable.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timetable</title>
    <link rel="icon" type="image/x-icon" href="assets/img/mmu.jpg">
</head>
<body>

  <ul>
    <li><a href="index.php">HOME</a></li>
    <li style="float:right"><a class="active">TIMETABLE</a></li>
  </ul>
  <center>
  <p><br><br><br></p>

  <p class="text">CLASS TIMETABLE</p>
  <table style="width:50%">

    <tr>
      <th style="text-align: left">Course name</th>
      <th style="text-align: left">Day one</th>
      <th style="text-align: left">Day two</th>
      <th style="text-align: left">Session Start</th>
      <th style="text-align: left">Session End</th>
      <th style="text-align: left">Instructor</th>
    </tr>
    <?php

  while($fetch1 = mysqli_fetch_array($queryrun)){
    //getting schedule id from the enrolled table
    $schedulefromenrolled = $fetch1['scheduleID'];

    //selecting the specific classes from schedule table using the scheduleid we get from enroll table
    $schedule = "SELECT * FROM schedule WHERE scheduleID = '$schedulefromenrolled'";
    $schedulerun = mysqli_query($conn,$schedule);
    $fetch2 = mysqli_fetch_array($schedulerun);

    //getting the coursename from the specific classes
    $coursename = "SELECT * FROM courses WHERE courseid = '$fetch2[courseid]'";
    $coursenamerun = mysqli_query($conn, $coursename);
    $fetch3 = mysqli_fetch_array($coursenamerun)
    ?>
      <tr>
        <td><?php echo $fetch3['coursename']?></td>
        <td><?php echo $fetch2['dayone'];?></td>
        <td><?php echo $fetch2['daytwo'];?></td>
        <td><?php echo $fetch2['timestart'];?></td>
        <td><?php echo $fetch2['timeend'];?></td>
        <td><?php echo $fetch2['instructor'];?>

      <?php }?>
  </table>


</body>
</html>
