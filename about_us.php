<!DOCTYPE html>
<html>
<!---------------------------------------------->
<head>
  <!-- General Website Settings -->
  <meta charset="utf-8" lang="en">
  <script src="jquery-3.6.0.min.js"></script>
  <!-- Allows website to fit devices -->
  <meta name = "viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="about_us.css">
  <!-- Webpage Title -->
  <title>About Us</title>
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
                    <li><a id = "course_links" href = "karate.php">Silambam &nbsp</a></li>
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
    <!------------------------------------------------------------------------->
    <div class = "right_section">

    </div>
  </div>
  <!--------------------------------------------------------------------------->
  <div class = "frontend_boxes">

    <div class = "frontend_text_box">
      <h2>The Front-end</h2>
    </div>

    <div id = "darwin_box">
      <img id = "darwin" src = "assets/darbin.jpeg"></img>
      <div id = "darwin_text">
          <h1>&nbsp Darwin A/L Radhakrishnan &nbsp</h1>
          <p>
            Born on April 10th 2003, Darwin took pure-science in high school<br>before entering a Foundation in Computing in MMU.<br>With his prodigal mathematical skills, he is<br>committed to his plan of undertaking<br>Data Science for his Bachelors.
          </p>
      </div>
    </div>

    <div id = "shaun_box">
      <img id = "shaun" src = "assets/shon.jpeg"></img>
      <div id = "shaun_text">
          <h1>&nbsp Shaun D. Leong &nbsp</h1>
          <p>
            Born on October 10th 2003, Shaun took a pure-science stream in<br>high school before shortly entering a Foundation in Computing<br>in MMU. Although, he is unsure of what to specialise<br>in for his Bachelors.
          </p>
      </div>
    </div>
  </div>
  <!--------------------------------------------------------------------------->
  <div class = "backend_boxes">

    <div class = "backend_text_box">
      <h2>The Back-end</h2>
    </div>

    <div id = "kalla_box">
      <img id = "kalla" src = "assets/kallai.jpeg"></img>
      <div id = "kalla_text">
          <h1>&nbsp Kalla Deveshwara Rao &nbsp</h1>
          <p>
            Born on 5th June 2003, Kalla had already been tinkering with code<br>since high school. Experienced with PHP, SQL and even<br>Python, armed with his will to learn and a love for a<br>certain telugu girl, the sky's the limit<br>for Kalla's cybersecurity future.
          </p>
      </div>
    </div>

    <div id = "vimal_box">
      <img id = "vimal" src = "assets/vimang_rib.jpeg"></img>
      <div id = "vimal_text">
          <h1>&nbsp Vimal Rich &nbsp</h1>
          <p>
            Born on April 1st 2001, with a strong interest in politics and Andrew<br>Garfield, Vimal has been familiar with coding since his high school,<br>eventually taking a Foundation of Computing in MMU.<br>Eager to learn new things, he plans to take<br>a Bachelor in Computer Science.
          </p>
      </div>
    </div>
  </div>


  <!------------------------------------------------------------>
  </body>
