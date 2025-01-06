<?php
session_start();
require_once('connection.php');
include('nobypass.php');

//If the button is pressed then it will proceed with the code
if(isset($_POST['paynow'])){

  //the email variable is based on the user's login credential
  $email = $_SESSION['email'];

  //selecting all from cart from that specific email
  $queryrow = "SELECT * FROM cart WHERE email = '$email'";
  $queryrowrun = mysqli_query($conn, $queryrow);

  //numerical value from the current month
  $month = date('n');

  //This is to add customer in sales_stats table, this particular line here is to check whether this specific user alredy exists in the customer list
  $customer = "SELECT * FROM enrolled_users WHERE email = '$email'";
  $customerrun = mysqli_query($conn, $customer);


  if(mysqli_num_rows($customerrun)==0){
    //this will update the sale_stat's table, customer's column to increase by one for this month
    $sales_stats = mysqli_query($conn,"UPDATE sales_stats SET customers = customers + 1 WHERE month ='$month'");
  }


  //this will insert into enrolledusers table, delete everything from cart and update the class capacity... the moment you press the button...
  while($fetchrow = mysqli_fetch_array($queryrowrun)){
    $schedulefromcart = $fetchrow['scheduleID'];

    $pricefromcart = $fetchrow['price'];

    $query1 ="INSERT INTO enrolled_users VALUES(NULL,'$email','$schedulefromcart','$pricefromcart','$month')";
    $query1run = mysqli_query($conn,$query1);

    $query2 ="UPDATE schedule SET maxstudents = maxstudents - 1 WHERE scheduleID = '$schedulefromcart'";
    $query2run = mysqli_query($conn,$query2);

    $query3 ="DELETE FROM cart WHERE scheduleID = '$schedulefromcart' AND email = '$email'";
    $query3run = mysqli_query($conn, $query3);

  }
  echo"<script>alert('Done!')</script>";
  header('refresh: 0; url=shopping_cart.php');

}
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
  <link rel="stylesheet" href="shopping_cart.css">
  <!-- Adds the shopping cart icon -------------->
  <script src="https://kit.fontawesome.com/8ba9633148.js" crossorigin="anonymous"></script>
  <!-- Webpage Title -->
  <title>Shopping Cart</title>
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
  </div>
    <!-------------------------------------------------------------------------->

    <div class = "page_box">
      <!-------------------------------------------------------------------------->
      <div class = "text_box">
        <h1>Shopping Cart &nbsp<i class="fa-solid fa-cart-shopping"></i></h1>

      </div>
      <!-------------------------------------------------------------------------->
      <div class = "table_wrapper">
    <form action = '' method="POST">
          <table class = "shopping_table">
              <!------------------------->
              <tr>
                <td>No.</td>
                <td>Course</td>
                <td>Price (RM)</td>
                <td>Schedule ID</td>
                <td>Action</td>
              </tr>
              <!------------------------->

                <?php
                    $email = $_SESSION['email'];
                    $getdataquery1 = "SELECT * FROM cart WHERE email = '$email'";
                    $getdataqueryrun1 = mysqli_query($conn, $getdataquery1);

                    $no = 1;
                    $totalprice = 0;

                    //this is to display all the data in shopping cart related to the usr's email
                      while($fetchdata1 = mysqli_fetch_array($getdataqueryrun1)){
                        $courseid = $fetchdata1['courseid'];
                        $getcoursename = "SELECT coursename FROM courses WHERE courseid = '$courseid'";

                        $getcoursenamerun = mysqli_query($conn, $getcoursename);
                        $fetchcoursename = mysqli_fetch_array($getcoursenamerun);

                        $coursename = $fetchcoursename['coursename'];

                        $price = $fetchdata1['price'];

                        $schedule = $fetchdata1['scheduleID'];

                        $totalprice = $totalprice + $price;
                        $month = date('n');

                        $orders = mysqli_query($conn,"UPDATE courses SET orders = orders + 1 WHERE coursename = '$coursename'");

                        $sales_stats = mysqli_query($conn,"UPDATE sales_stats SET sales = sales + 1 WHERE month ='$month'");
                  ?>
  <tr>
    <td><?php echo $no++;?></td>
    <td><?php echo $coursename;?></td>
    <td><?php echo $price;?></td>
    <td><?php echo $schedule?></td>
    <td align="center"><a href="remove.php?courseid=<?php echo $fetchdata1['courseid'];?>" onclick="return checkdelete()"> Remove!</a></td>
  <?php }

  ?>
  </tr>
    <tr>Total Cost: <?php echo $totalprice," Ringgit";?></tr>

  </form>



              <!------------------------->
          </table>
      </div>
      <!-------------------------------------------------------------------------->
      <div class = "payment_wrapper">
        <form action="" method="POST">
        <button id = "payment_button" name = "paynow">PAY NOW</button>
        </form>

        <!--Print-->
        <button class="print" onclick="myfun()">
         <span class="button__text">Print</span>
          <span class="button__icon">
         <ion-icon name="print-outline"></ion-icon>
         </span>
        </button>

        <script>
         function myfun(){
         window.print();
         }

        </script>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>

      </div>
    </div>


  </body>
