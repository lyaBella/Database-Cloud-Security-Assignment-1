<?php
//refer karate
session_start();
require_once('connection.php');
if(isset($_SESSION['email'])){
  if (isset($_POST['enroll_2'])) {
   $email = $_SESSION['email'];
    $scheduleselect = $_POST['scheduleselect'];
    $check = "SELECT * FROM cart WHERE courseid = 3 AND email = '$email'";
    $checkrun = mysqli_query($conn,$check);

    $checkstudentstatus = "SELECT * FROM user WHERE email = '$email'";
    $checkstudentstatusrun = mysqli_query($conn, $checkstudentstatus);
    $fetchstudent = mysqli_fetch_array($checkstudentstatusrun);

    $checkscheduleid = "SELECT * FROM enrolled_users WHERE email = '$email' AND scheduleID BETWEEN 5 and 6";
    $checkscheduleidrun = mysqli_query($conn,$checkscheduleid);

    $maxstudents = "SELECT maxstudents FROM schedule WHERE scheduleID BETWEEN 5 and 6 AND maxstudents = 0;";
    $maxstudentsquery = mysqli_query($conn, $maxstudents);

    if(mysqli_num_rows($maxstudentsquery)<1){


      if(mysqli_num_rows($checkrun)==0 AND mysqli_num_rows($checkscheduleidrun)==0){
        if($fetchstudent['student_status'] == "Yes"){
          $query = "INSERT INTO cart VALUES(3,100,null,'$email','$scheduleselect')";
          $queryrun = mysqli_query($conn, $query);
          echo"<script>alert('Added to your shopping cart!')</script>";
          header('Refresh:0; url = silat.php');
        }elseif($fetchstudent['student_status'] == "No"){
          $query = "INSERT INTO cart VALUES(3,150,null,'$email','$scheduleselect')";
          $queryrun = mysqli_query($conn, $query);
          echo"<script>alert('Added to your shopping cart!')</script>";
          header('Refresh:0; url = silat.php');
        }
      }elseif(mysqli_num_rows($checkrun)>0 OR mysqli_num_rows($checkscheduleidrun)>0){
        echo"<script>alert('It is already in your cart!')</script>";
        header('Refresh:0; url = silat.php');
      }else{
        echo"<script>alert('Unknown error has occured')</script>";
        header('Refresh:0; url = silat.php');
      }
  }else{
      echo"<script>alert('Class Capacity Max! Will not take anymore students!')</script>";
      header('Refresh:0; url = silat.php');
}}
}else{
  if (isset($_POST['enroll_2'])) {
      echo"<script>alert('Register First la ')</script>";
      header('Refresh:0; url = silat.php');
  }
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="silat.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Silat</title>
    <link rel="icon" type="image/x-icon" href="assets/img/mmu.jpg">
</head>
<body>
<style>
*{
  margin: 0;
  padding: 0;
   }
:root{
    --primary-color: #353434c3;
    --secondary-color: #212121;
}
.dark-theme{
  --primary-color: #212121;
  --secondary-color: white;
}
body{
  background-color: var(--primary-color);
}

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #c8930b;
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
  background-color:#fbca4e
}

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
color: white;
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
background-color: rgba(249, 247, 243, 0.841);
color: black;
border: 2px solid #491cd1;
}

.button1:hover {
background-color: #e7a532;
color: white;
}
.logo{
width: 250px;
}
.wrapper{
width: 100%;
}
.ety{
  position: relative;left: -670px;
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
    <li><a href="taekwondo.php">TAE KWON DO</a></li>
    <li><a href="silambam.php">SILAMBAM</a></li>
    <li><a href="karate.php">KARATE</a></li>
    <li><a href="Kung_fu.php">KUNG FU</a></li>
    <li style="float:right"><a class="active">SILAT</a></li>
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
    $queryget = "SELECT * FROM schedule WHERE courseid = 3";
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
  <img class="img1" src="https://wallpapercave.com/wp/BPD7rtG.jpg">

  <h2>Origin</h2>
  <p class="origin"><br>Silat is the collective term for a class of indigenous martial arts from the Nusantara and surrounding geo-cultural areas of Southeast Asia. It is traditionally practised in Brunei, Indonesia, Malaysia, Singapore, Southern Thailand, Southern Philippines and Southern Vietnam. There are hundreds of different styles (aliran) and schools (perguruan) which tend to focus either on strikes, joint manipulation, weaponry, or some combination thereof.</p>
    <p class="origin"><br>The word silat is used by Malay-speaking countries throughout Southeast Asia, but is officially called Pencak silat in Indonesia. The term Pencak silat has been adopted globally in reference to silat being performed as professional competitive sport, similar to wushu. Regional dialect names including penca in Sundanese, silek in Minangkabau, main-po or maen po in the lower speech of Sundanese, gayong or gayung in parts of Sumatra, Singapore, and Malaysia, dika or padik in Southern Thailand and silat in Southern Philippines.
  </p>

  <h2 class="ety"><br>Etymology</h2>
  <p class="origin"><br>
    The origin of the word silat is uncertain. The Malay term silat is linked to Minangkabau word silek, thus a Sumatran origin of the term is likely. It possibly related to silambam, the Tamil martial art which has been recorded as being practiced in Malaysia since at least the fifteenth century in Malacca. According to Malaysian source, the word 'silat' is said to originate from the Arabic word 'silah' (سِلَاح) meaning 'weapon' or 'silah' (صِلَةُ) meaning 'connection'. The most popular theory in Malaysia is that it derives from sekilat meaning "as (fast as) lightning".</p>
    <p class="origin"><br>Other theories derive silat from the Sanskrit śīla meaning morality or principle, or the Southern Chinese saula which means to push or perform with the hands. The Sanskrit theory is particularly popular in Thailand, as sila is an alternate form of the word silat in that country. Other similar-sounding words have been proposed, but are generally not considered by etymologists. One example is si elat which means someone who confuses, deceives or bluffs. A similar term, ilat, means an accident, misfortune or a calamity. Yet another similar-sounding word is silap meaning wrong or error. Some styles contain a set of techniques called Langkah Silap designed to lead the opponent into making a mistake
    </p>
    <p class="origin"><br>In its proper usage in the languages of its origin, silat is often a general term for any fighting style. This is still common in Indonesia where in some regions both silat and kuntau are traditionally interchangeable</p>

 <form class="" action="" method="post">
  <select name = "scheduleselect">

    <?php
    $querygetrun2 = mysqli_query($conn, "SELECT * FROM schedule WHERE courseid = 3");
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
