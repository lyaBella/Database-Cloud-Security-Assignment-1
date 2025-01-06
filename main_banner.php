<?php

#this is if the user logs in, then the user is greeted with this specific menu. This menu is only accessible after logging in.
if(isset($_SESSION['email'])){

  $email = $_SESSION['email'];

  $query = "SELECT * FROM user WHERE email = '$email'";
  $queryrun = mysqli_query($conn, $query);
  $queryfetch = mysqli_fetch_array($queryrun);

  $enrolled = "SELECT * FROM enrolled_users WHERE email = '$email'";
  $enrolledrun = mysqli_query($conn,$enrolled);

  if(mysqli_num_rows($queryrun)>0){
?>

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
      <!-- Implement SHOPPING CART & DARK/LIGHTMODE TOGGLE -->
      <a id = "login_box" href = "logout.php"> Log Out </a>
      <!------------------------------------->
      <div class = "shopping_cart_icon">
        <button id = "shopping_button" onclick="location.href = 'shopping_cart.php';"><i class="fa-solid fa-cart-shopping"><?php include('shoppingcart.php');?></i></button>
      </div>
      <?php if(mysqli_num_rows($enrolledrun)>0){?>
      <!------------------------------------->
      <div class = "calendar_icon">
        <!-- Implement the increment and the number in between the <i> KALLA -->
        <button id = "calendar_button" onclick="window.location.href='timetable.php'">
          <i class="fa-regular fa-calendar-days"></i>
        </button>
      </div>
      <!------------------------------------->
      <div class = "user_icon">
        <!-- Implement the increment and the number in between the <i> KALLA -->
        <button id = "user_button" onclick="window.location.href='student_list.php'">
          <i class="fa-solid fa-user"></i>
        </button>
      </div>
    <?php }?>
      <!------------------------------------->
    </div> <!-- right section ending div -->
    <!---------------------------------------->
  </div>
  <!-------------------------------------------------------------------------->
  <div class = "image_wrapper">
    <img id = "banner_image" src = "assets/martial.jpg"></img>
  </div>


<?php
}}else{
?>
<div class = "main_banner">
  <div class = "left_section">
      <!-- This part will be a JQuery button that shows the courses available -->

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
                    <li><a id = "course_links" href = "Kung_Fu.php">Kung-fu &nbsp &nbsp</a></li>
                    <li><a id = "course_links" href = silambam.php>Silambam &nbsp</a></li>
                  </ul>
                </div>
              </li>
              <!-- KALLA make the schedule button hyperlink to register if user hasn't logged in yet -->
              <li><a id = "menu_effects" href = "schedule.php">Schedule &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</a></li>
              <li><a id = "menu_effects"  href = "instructors.php">Our Instructors &nbsp &nbsp</a></li>
               <li><a id = "menu_effects"  href = "studentmaxcheck.php">Student Capacity Checking</a></li>
              <li><a id = "menu_effects"  href = "about_us.php">About Us &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</a></li>
            </ul>
          </div>
        </div>

  </div>
  <div class = "middle_section">
    <!-- Will implement our title and website logo here -->
    <a href="index.php"><img id = "mmu_logo" src = "assets/mmu_logo.png" ></img></a>
  </div>
  <div class = "right_section">
    <!-- Implement SHOPPING CART & DARK/LIGHTMODE TOGGLE -->
    <a id = "login_box" href = "registration_login.php"> Sign In </a>
      <!-- maybe add <button> to hyperlink shopping cart? -->

  </div>
</div>
<!---------------------------------------------------------------->
<div class = "image_wrapper">
  <img id = "banner_image" src = "assets/martial.jpg"></img>
</div>
 <script>
function logout(){
  return confirm('Log Out');
}
</script>
<?php
}
?>
