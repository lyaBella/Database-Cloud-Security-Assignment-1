<?php
//refer karate
session_start();
require_once('connection.php');

if(isset($_SESSION['email'])){
  if (isset($_POST['enroll_2'])) {

    $email = $_SESSION['email'];
    $scheduleselect = $_POST['scheduleselect'];
    $check = "SELECT * FROM cart WHERE courseid = 1 AND email = '$email'";

    $checkrun = mysqli_query($conn,$check);
    $checkscheduleid = "SELECT * FROM enrolled_users WHERE email = '$email' AND scheduleID BETWEEN 1 and 2";
    $checkscheduleidrun = mysqli_query($conn,$checkscheduleid);

    $checkstudentstatus = "SELECT * FROM user WHERE email = '$email'";
    $checkstudentstatusrun = mysqli_query($conn, $checkstudentstatus);
    $fetchstudent = mysqli_fetch_array($checkstudentstatusrun);

    $maxstudents = "SELECT maxstudents FROM schedule WHERE scheduleID = $scheduleselect AND maxstudents = 0;";
    $maxstudentsquery = mysqli_query($conn, $maxstudents);

    if(mysqli_num_rows($maxstudentsquery)<1){

      if(mysqli_num_rows($checkrun)==0 AND mysqli_num_rows($checkscheduleidrun)==0){
        if($fetchstudent['student_status'] == "Yes"){
          $query = "INSERT INTO cart VALUES(1,100,null,'$email','$scheduleselect')";
          $queryrun = mysqli_query($conn, $query);
          echo"<script>alert('Added to your shopping cart!')</script>";
          header('Refresh:0; url = taekwondo.php');
        }elseif($fetchstudent['student_status'] == "No"){
          $query = "INSERT INTO cart VALUES(1,150,null,'$email','$scheduleselect')";
          $queryrun = mysqli_query($conn, $query);
          echo"<script>alert('Added to your shopping cart!')</script>";
          header('Refresh:0; url = taekwondo.php');
        }

      }elseif(mysqli_num_rows($checkrun)>0 OR mysqli_num_rows($checkscheduleidrun)>0){
        echo"<script>alert('It is already in your cart!')</script>";
        header('Refresh:0; url = taekwondo.php');
      }else{
        echo"<script>alert('Unknown error has occured')</script>";
        header('Refresh:0; url = taekwondo.php');
      }
  }else{
    echo"<script>alert('Class Capacity Max! Will not take anymore students!')</script>";
    header('Refresh:0; url = taekwondo.php');
  }
}
}else{
  if (isset($_POST['enroll_2'])) {
      echo"<script>alert('Register First la ')</script>";
      header('Refresh:0; url = taekwondo.php');
  }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taekwondo</title>
    <link rel="icon" type="image/x-icon" href="assets/img/mmu.jpg">
</head>
<body>
<style>
*{
  margin: 0;
  padding: 0;
   }

:root{
  --primary-color: white;
  --secondary-color: #212121;

}
.dark-theme{
--primary-color: #212121;
--secondary-color: white;
}
body{
  background-color:var(--primary-color);
}
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #FF0000;
}

li {
  float: left;
}

li a {
  display: block;
  color: var(--secondary-color);
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover:not(.active) {
  background-color: rgb(120, 207, 241);
}

.active {
  background-color:#940a0af8
}wwsx

table, th, td {
  border:2px solid var(--secondary-color);
  font-family: Verdana, Geneva, Tahoma, sans-serif;
  color: var(--secondary-color);
}
.text{
  font-family: Georgia, 'Times New Roman', Times, serif;
  padding: 0px 5px 10px;
  color: var(--secondary-color);
}
.text2{
font-family: Georgia, 'Times New Roman', Times, serif;
padding: 0px 5px 10px;
color:var(--secondary-color);
}
.text3{
font-family: Georgia, 'Times New Roman', Times, serif;
padding: 0px 5px 10px;
color: var(--secondary-color);
}
.cd{
font-family: Verdana, Geneva, Tahoma, sans-serif;
font-size: large;
}
.img1{width: 300px;
margin-bottom: 60px;
}
.origin{
font-family:'Times New Roman', Times, serif;
font-size: 20px;
color: var(--secondary-color);
text-align: justify;
width: 95%;
font-style: italic;
line-height: 30px;
}
h2{
position: relative;left: -685px;
color: var(--secondary-color);
}
.button {
background-color: #b0ec0a;
border: none;
color: var(--primary-color);
padding: 16px 32px;
text-align: center;
text-decoration: none;
display: inline-block;
font-size: 16px;
margin: 4px 2px;
transition-duration: 0.4s;
cursor: pointer;
margin-bottom: 35px;
margin-top: 30px;
}

.button1 {
background-color: rgba(248, 169, 10, 0.841);
color: black;
border: 2px solid #f9f7f6;
}

.button1:hover {
background-color: #29b111;
color:var(--primary-color);
}
.logo{
width: 250px;
}
.wrapper{
width: 100%;
}
#icon{
width: 30px;
cursor: pointer;
margin-top: 10px;
}
p{
color: var(--secondary-color);
}

</style>
<div class="wrapper">
  <ul>
    <li><a href="index.php">HOME</a></li>
    <li><a href="silambam.php">SILAMBAM</a></li>
    <li><a href="karate.php">KARATE</a></li>
    <li><a href="Kung_Fu.php">KUNG FU</a></li>
    <li><a href="silat.php">SILAT</a></li>

    <li style="float:right"><a class="active">TAE KWON DO</a></li>
    <img src="https://www.pngall.com/wp-content/uploads/5/Crescent-Moon-PNG-Clipart.png" id="icon">
  </ul>
  <center>
    <img class="logo" src="https://www.zec.education/images/mmulogo.png">
  <p><br><br><br></p>
  <p class="cd">COURSE DETAILS</p>
  <p><br><br></p>

  <table style="width:50%">

    <tr>
      <th style="text-align: center;">No</th>
      <th style="text-align: center;">Day 1</th>
      <th style="text-align: center;">Day 2</th>
      <th style="text-align: center;">Time Start</th>
      <th style="text-align: center;">Time End</th>
      <th style="text-align: center;">Instructor</th>
      <th style="text-align: center;">Schedule ID</th>
    </tr>
    <?php
    $queryget = "SELECT * FROM schedule WHERE courseid = 1";
    $querygetrun = mysqli_query($conn, $queryget);
    $no = 1;
    while($get = mysqli_fetch_array($querygetrun)){

    ?>

    <tr>
      <td style="text-align: center;"><?php echo $no++; ?></td>
      <td style="text-align: center;"><?php echo $get['dayone'];?></td>
      <td style="text-align: center;"><?php echo $get['daytwo'];?></td>
      <td style="text-align: center;"><?php echo $get['timestart'];?></td>
      <td style="text-align: center;"><?php echo $get['timeend'];?></td>
      <td style="text-align: center;"><?php echo $get['instructor'];?></td>
      <td style="text-align: center;"><?php echo $get['scheduleID'];}?>


  </center>
  </table>
  <center>
  <div class="text">
  <p><br><br><br>-Fees will be RM 100 for MMU Students and RM 150 for Outsiders</p>
  </div>
  <p class="text2">-Venue will be at MMU Indoor Sports</p>
  <p class="text3">-The attire will be Sports Attire for the participants<br><br><br><br><br></p>
  </center>
  <img class="img1" src="https://i.pinimg.com/474x/3a/98/83/3a988304be1cf6a90d93262429d3bc69.jpg">

  <h2>History</h2>
  <p class="origin"><br>Beginning in 1945, shortly after the end of World War II and Japanese Occupation, new martial arts schools called kwans opened in Seoul. These schools were established by Korean martial artists with backgrounds in Japanese and Chinese martial arts. At the time, indigenous disciplines (such as Taekkyeon) were being forgotten, due to years of decline and repression by the Japanese colonial government. The umbrella term traditional Taekwondo typically refers to the martial arts practiced by the kwans during the 1940s and 1950s, though in reality the term "Taekwondo" had not yet been coined at that time, and indeed each kwan (school) was practicing its own unique style of the Korean art
</p>
    <p class="origin"><br>In 1952, South Korean president Syngman Rhee witnessed a martial arts demonstration by ROK Army officers Choi Hong-hi and Nam Tae-hi from the 29th Infantry Division. He misrecognized the technique on display as Taekkyeon, and urged martial arts to be introduced to the army under a single system. Beginning in 1955 the leaders of the kwans began discussing in earnest the possibility of creating a unified Korean martial art. Until then, Tang Soo Do was the term used to for Korean Karate, using the Korean hanja pronunciation of the Japanese kanji (唐手道). The name Tae Soo Do (跆手道) was also used to describe a unified style Korean martial arts
  </p>

  <p class="origin"><br>Choi Hong-hi advocated the use of the name Tae Kwon Do, replacing su "hand" with 拳 kwon (Revised Romanization: gwon; McCune–Reischauer: kkwŏn) "fist", the term also used for "martial arts" in Chinese (pinyin quán). The name was also the closest to the pronunciation of Taekkyeon, in accordance with the views of the president. The new name was initially slow to catch on among the leaders of the kwans. During this time Taekwondo was also adopted for use by the South Korean military, which increased its popularity among civilian martial arts schools
  </p>

  <p class="origin"><br>In 1959 the Korea Taekwondo Association or KTA (then-Korea Tang Soo Do Association) was established to facilitate the unification of Korean martial arts. General Choi, of the Oh Do Kwan, wanted all the other member kwans of the KTA to adopt his own Chan Hon-style of Taekwondo, as a unified style. This was, however, met with resistance as the other kwans instead wanted a unified style to be created based on inputs from all the kwans, to serve as a way to bring on the heritage and characteristics of all of the styles, not just the style of a single kwan. As a response to this, along with political disagreements about teaching Taekwondo in North Korea and unifying the whole Korean Peninsula, Choi broke with the (South Korea) KTA in 1966, in order to establish the International Taekwon-Do Federation (ITF)— a separate governing body devoted to institutionalizing his Chan Hon-style of Taekwondo in Canada
  </p>

  <p class="origin"><br>Initially, the South Korean president, having close ties to General Choi, gave General Choi's ITF limited support.[10] However, the South Korean government wished to avoid North Korean influence on the martial art. Conversely, ITF president Choi Hong-hi sought support for his Chan Hon-style of Taekwondo from all quarters, including North Korea. In response, in 1972 South Korea withdrew its support for the ITF. The ITF continued to function as an independent federation, then headquartered in Toronto, Ontario, Canada; Choi continued to develop the ITF-style, notably with the 1983 publication of his Encyclopedia of Taekwon-Do. After Choi's retirement, the ITF split in 2001 and then again in 2002 to create three separate ITF federations each of which continues to operate today under the same name.
  </p>

  <p class="origin"><br>In 1972 the KTA and the South Korean government's Ministry of Culture, Sports and Tourism established the Kukkiwon as the new national academy for Taekwondo. Kukkiwon now serves many of the functions previously served by the KTA, in terms of defining a government-sponsored unified style of Taekwondo. In 1973 the KTA and Kukkiwon supported the establishment of the World Taekwondo Federation (WTF, renamed to World Taekwondo in 2017 due to confusion with the initialism) to promote the sportive side of Kukki-Taekwondo. WT competitions employ Kukkiwon-style Taekwondo. For this reason, Kukkiwon-style Taekwondo is often referred to as WT-style Taekwondo, sport-style Taekwondo, or Olympic-style Taekwondo, though in reality the style is defined by the Kukkiwon, not the WT.
  </p>

  <p class="origin"><br>Since 2021, Taekwondo has been one of three Asian martial arts (the others being judo and karate), and one of six total (the others being the previously mentioned, Greco-Roman wrestling, freestyle wrestling, and boxing) included in the Olympic Games. It started as a demonstration event at the 1988 games in Seoul, a year after becoming a medal event at the Pan Am Games, and became an official medal event at the 2000 games in Sydney. In 2010, Taekwondo was accepted as a Commonwealth Games sport.
  </p>

 <form class="" action="" method="post">
  <select name = "scheduleselect">

    <?php

    $querygetrun2 = mysqli_query($conn, "SELECT * FROM schedule WHERE courseid = 1");
    while($get2=mysqli_fetch_array($querygetrun2)){
      echo "<option value = '$get2[scheduleID]'>Schedule ID $get2[scheduleID]";
      }?>
  </select>
    <button class="button button1" type ='submit' name='enroll_2'>Add to cart!</button>
  </form>

</div>
<script>

    var icon = document.getElementById("icon");

    icon.onclick = function(){
        document.body.classList.toggle("dark-theme");
        if(document.body.classList.contains("dark-theme")){
          icon.src ="https://i.pinimg.com/originals/81/ba/c5/81bac554131ddaee50aacaa1f91b105a.png"
        }else{
          icon.src ="https://www.pngall.com/wp-content/uploads/5/Crescent-Moon-PNG-Clipart.png"
        }

    }

</script>
</body>
</html>
