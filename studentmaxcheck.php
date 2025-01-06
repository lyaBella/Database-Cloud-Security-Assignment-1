<?php
session_start();
require_once('connection.php');
?>
<!DOCTYPE html>
<html>
<!---------------------------------------------->
<head>
  <!-- General Website Settings -->
  <meta charset="utf-8" lang="en">
  <script src="jquery-3.6.0.min.js"></script>
  <!-- Allows website to fit devices -->
  <meta name = "viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="student_list.css">
  <!-- Webpage Title -->
  <title>Students Check</title>
  <link rel="icon" type="image/x-icon" href="assets/mmu.jpg">
</head>
<!---------------------------------------------->
<body>
  <div class = "main_banner">
    <div class = "left_section">

        <div class =  "dropdown">
          <button class = "courses_button">☰ &nbsp Menu</button>
          <div class = "dropdown_content">
            <ul class = "menu">
              <li class = "course_dropdown">Courses
                <div class = "submenu">
                  <ul>
                    <!-- "&nbsp" adds whitespace in the texts, DO NOT DISTURB! -->
                    <li><a id = "course_links" href = "taekwondo.php">Taekwando</a></li>
                    <li><a id = "course_links" href = "karate.php">Karate &nbsp &nbsp &nbsp</a></li>
                    <li><a id = "course_links" href = "silat.php">Silat &nbsp &nbsp &nbsp &nbsp &nbsp</a></li>
                    <li><a id = "course_links" href = "kung_fu.php">Kung-fu &nbsp &nbsp</a></li>
                    <li><a id = "course_links" href = "silambam.php">Silambam &nbsp</a></li>
                  </ul>
                </div>
              </li>
              <!-- KALLA make the schedule button hyperlink to register if user hasn't logged in yet -->
              <li><a id = "menu_effects" href = "schedule.php">Schedule &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</a></li>
              <li><a id = "menu_effects"  href = "instructors.php" target="_self">Our Instructors &nbsp &nbsp</a></li>
              <li><a id = "menu_effects"  href = "studentmaxcheck.php">Student Capacity Checking</a></li>
              <li><a id = "menu_effects"  href = "about_us.php">About Us &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</a></li>
            </ul>
          </div>
        </div>
    </div>
    <!-------------------------------------------------------------------------->
    <div class = "middle_section">
      <!-- Will implement our title and website logo here -->
      <a class = "homepage_link" href = "index.php">
      <img id = "mmu_logo" src = "assets/mmu_logo.png"></img>
      </a>
    </div>
    <!-------------------------------------------------------------------------->
    <div class = "right_section">

    </div>
 <!------------------------------------->

  </div>
    <!-------------------------------------------------------------------------->
  <div class = "student_list_wrapper">
    <div class = "text_box">
    </div>
    <!------------------------------------->
     <div class = "student_list_box">
        <table>
          <tr>

            <th id = "number_cell">Schedule ID </th>
            <th id = "student_cell">Course Name </th>
            <th id = "class_cell"> Current Student Capacity</th>
          </tr>
                <?php
                //Taking all information from the class
              $query = "SELECT * FROM schedule";
              $queryrun = mysqli_query($conn, $query);
              while($fetchquery = mysqli_fetch_array($queryrun)){
                //from the class / schedule table we are taking courseid... why? with that courseid we can refer back to the course table to get the course name... Why are we doing this? again for user's simplicity..
                $courseid = $fetchquery['courseid'];
                $query2 = "SELECT * FROM courses WHERE courseid = '$courseid'";
                $query2run = mysqli_query($conn, $query2);
                $fetchquery2 = mysqli_fetch_array($query2run);

            ?>
          <tr>

            <td><?php echo $fetchquery['scheduleID'];?></td>
            <td><?php echo $fetchquery2['coursename'];?></td>
            <td><?php echo $fetchquery['maxstudents'];}?></td>
          </tr>
        </table>
     </div>

  </div>
</body>
