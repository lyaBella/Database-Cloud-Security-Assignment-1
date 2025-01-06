

<!DOCTYPE html>
<html>
<!---------------------------------------------->
<head>
  <!-- General Website Settings -->
  <meta charset="utf-8" lang="en">
  <script src="jquery-3.6.0.min.js"></script>
  <!-- Allows website to fit devices -->
  <meta name = "viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="instructors.css">
  <!-- Webpage Title -->
  <title>About Instructors</title>
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

  </div>
  </div>
    <!-------------------------------------------------------------------------->

    <div class = "silambam_images">

      <div class = "silambam_course">
        <h2>Silambam</h2>
      </div>

      <div id = "thiran_box">
        <img id = "thiran" src = "assets/mr_thiran.jpg"></img>
        <div id = "thiran_text">
            <h1>&nbsp Thiran A/L Vaseekaran &nbsp</h1>
            <p>With 7 years of experience and a regional championship<br>title under his belt at just 19 years of age, Thiran's<br>martial experience in the art of Silambam<br>has shown in his track record.
            </p>
        </div>
      </div>

      <div id = "devesh_box">
        <img id = "devesh" src = "assets/mr_devesh.jfif"></img>
        <div id = "devesh_text">
            <h1>&nbsp Devesh A/L Duraisingam &nbsp</h1>
            <p>5 years in Junior level, 7 years in Senior level<br>Devesh became the top silambam master in Malaysia.<br>His expertise is very well in this field.
            </p>
        </div>
      </div>

      <div id = "tanah_box">
        <img id = "tanah" src = "assets/ms_tanah.png"></img>
        <div id = "tanah_text">
            <h1>&nbsp Tanah A/P Manalan &nbsp</h1>
            <p>She is the one and only woman in Malaysia to be a Silambam master.<br>It only took her 4 years to be very well in this martial arts.<br>Learning from her is a breakthrough for any newbies.
            </p>
        </div>
      </div>

    </div>
    <!-------------------------------------------------------------------------------------------------->
    <div class = "karate_images">
      <div class = "karate_course">
        <h2>Karate</h2>
      </div>

      <div id = "chong_box">
        <img id = "chong" src = "assets/chong_sun.jpg"></img>
        <div id = "chong_text">
            <h1>&nbsp Chong Sun Kim &nbsp</h1>
            <p>Mr Chong has almost 30 years of experience in this field.<br>A new student's age is same or lower than Mr Chong's experience.<br>With a master like him Karate is going to be as learning ABC for anyone.
            </p>
        </div>
      </div>

      <div id = "leong_box">
        <img id = "leong" src = "assets/leong_shen.jpg"></img>
        <div id = "leong_text">
            <h1>&nbsp Leong Ann Shen &nbsp</h1>
            <p>Leong the breaker is what they call him.<br>Leong has joined over hundreds of tournaments in his life.<br>He is a good trainer for those who  are seeking for professional.
            </p>
        </div>
      </div>
    </div>
    <!------------------------------------------------------------->
    <div class = "taekwondo_images">
      <div class = "taekwondo_course">
        <h2>Taekwondo</h2>
      </div>

      <div id = "marcus_box">
        <img id = "marcus" src = "assets/marcus.png"></img>
        <div id = "marcus_text">
            <h1>&nbsp Marcus Sayner &nbsp</h1>
            <p>With 10 years of experience and 3 International Championships<br>title under his belt, experience in the martial art of Karate<br>has shown in his track record.
            </p>
        </div>
      </div>
    </div>
    <!------------------------------------------------------------->
    <div class = "kungfu_images">
      <div class = "kungfu_course">
        <h2>Kung-fu</h2>
      </div>

      <div id = "xong_chi_box">
        <img id = "xong_chi" src = "assets/xong_chi.jpg"></img>
        <div id = "xong_chi_text">
            <h1>&nbsp Shin Xong Chi &nbsp</h1>
            <p>Xong Chi the Legend is his Kung-Fu name. The word legend was given to him,<br> after the victorious battle of Xong Chi and the Legendary William Chaeng<br>
            </p>
        </div>
      </div>
    </div>
    <!------------------------------------------------------------->
    <div class = "silat_images">
      <div class = "silat_course">
        <h2>Silat</h2>
      </div>

      <div id = "ismail_box">
        <img id = "ismail" src = "assets/ismail.jpg"></img>
        <div id = "ismail_text">
            <h1>&nbsp Ismail Raif &nbsp</h1>
            <p>Ismail has featured in the movie 'Mat Kilau' just because of his talent.<br>He thought all the main actors Silat just within a year.<br>Students who wants to learn in a fast pace, Ismail is the man.
            </p>
        </div>
      </div>
    </div>
    <!------------------------------------------------------------->
</body>

</html>
