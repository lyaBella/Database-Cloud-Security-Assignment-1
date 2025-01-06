<?php
session_start();
require_once('connection.php');
include('nobypass.php');


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
  <title>Student List</title>
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
              <li><a id = "menu_effects"  href = "instructors.html" target="_self">Our Instructors &nbsp &nbsp</a></li>
              <li><a id = "menu_effects"  href = "about_us.html">About Us &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</a></li>
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
      <h1>Class : </h1>
    </div>
    <!------------------------------------->
     <div class = "student_list_box">
        <table>
          <tr>

            <th id = "number_cell">Search</th>
            <th colspan = '3'> <form action="" method="post">
            <select name = "search">

            <?php
            $email = $_SESSION['email'];
            $selectquery = "SELECT * FROM enrolled_users WHERE email = '$email'";
            $selectqueryrun = mysqli_query($conn,$selectquery);
            //This part gets all the data about the user's class thats why we specify the email
            while($fetchselect = mysqli_fetch_array($selectqueryrun)){
              //once we get the user's class id, to make it easier for the people using the website to understand, we are getting the class's name
              $namecourse1 = "SELECT * FROM schedule WHERE scheduleID = '$fetchselect[scheduleID]'";
              $namecourse1run  = mysqli_query($conn, $namecourse1);

              $namecourse1fetch = mysqli_fetch_array($namecourse1run);
              $namecourse2 = "SELECT * FROM courses WHERE courseid = '$namecourse1fetch[courseid]'";
              $namecourse2run = mysqli_query($conn, $namecourse2);
              //this is the <select> tag but in php
              $namecourse2fetch = mysqli_fetch_array($namecourse2run);
              echo"<option value = '$fetchselect[scheduleID]'>Schedule ID $fetchselect[scheduleID] / $namecourse2fetch[coursename]";
              }
              ?></select>
            <input type = "submit" name = "submit" value = "search"></th>

          </form>

          </tr>
          <tr>
            <th id = "number_cell">No.</th>
            <th id = "student_cell">Student</th>
			<th id = "email_cell">Email</th>
            <th id = "class_cell"> Class</th>
          </tr>
          <?php
//when you click search button
if (isset($_POST['search'])) {
  $no = 0;
  $search = $_POST['search'];
  $logged_in_email = $_SESSION['email']; // Get the logged-in user's email
  //basically the percentage is user input. so it filters based on the user's input
  $query = "SELECT * FROM enrolled_users WHERE scheduleID = '$search'";
  $queryrun = mysqli_query($conn,$query);
  while ($fetch = mysqli_fetch_array($queryrun)) {
    //this is to get the user's name
    $getname = $fetch['email'];
    $namequery = "SELECT * FROM user WHERE email = '$getname'";
    $getnamequery = mysqli_query($conn, $namequery);
    $fetchname = mysqli_fetch_array($getnamequery);

    //this is to get the courseid using the classid / schedule id
    $id = $fetch['scheduleID'];
    $search2 = "SELECT * FROM schedule WHERE scheduleID = '$id'";
    $search2run = mysqli_query($conn, $search2);
    $fetch2 = mysqli_fetch_array($search2run);

    //getting the coursename using the data from fetch2. refer to line 140 you can see that we are using fetchclass['coursename']
    $getcourseid = $fetch2['courseid'];
    $getclass = "SELECT * FROM courses WHERE courseid = '$getcourseid'";
    $getclassrun = mysqli_query($conn, $getclass);
    $fetchclass = mysqli_fetch_array($getclassrun);

    $no = $no +1;
	// Mask the email if it is not the logged-in user's email
    $display_email = $fetch['email'] === $logged_in_email ? $fetch['email'] : mask_email($fetch['email']);
?>

?>
          <tr>
            <td><?php echo $no;?></td>
            <td><?php echo $fetchname['name'];?></td>
			 <td><?php echo $display_email; ?></td>
            <td><?php echo $fetchclass['coursename'];?></td>
          </tr>

          <?php }}
		  
		  // Function to mask an email
function mask_email($email) {
  $email_parts = explode("@", $email);
  $name_part = $email_parts[0];
  $domain_part = $email_parts[1];

  // Partially mask the name part, keeping the first and last character visible
  $masked_name = substr($name_part, 0, 1) . str_repeat("*", strlen($name_part) - 2) . substr($name_part, -1);

  return $masked_name . "@" . $domain_part;
}
?>
		  
        </table>
     </div>

  </div>
</body>
