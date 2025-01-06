<?php
session_start();
require_once('connection.php');
#If the global array email is not empty it will proceed with the code. Basically the $_Session['email'] is carrying the email that the
#user uses to log in.
if(isset($_SESSION['email'])){
  #once the enroll_2 / submit button is pressed, it will proceed with the code
  if (isset($_POST['enroll_2'])) {

    #global variable $email is set to the user's email
    $email = $_SESSION['email'];

    #posting/taking schedule id from the website. Its the select option in the website
    $scheduleselect = $_POST['scheduleselect'];

    #this code is to check whether in shopping cart got or not with that specific email and course id...
    $check = "SELECT * FROM cart WHERE courseid = 2 AND email = '$email'";
    $checkrun = mysqli_query($conn,$check);

    #this code is to check whether the person got enroll or not in the enrolled table...
    $checkscheduleid = "SELECT * FROM enrolled_users WHERE email = '$email' AND scheduleID BETWEEN 3 and 4";
    $checkscheduleidrun = mysqli_query($conn,$checkscheduleid);

    #this code is to RETRIEVE data regarding the student's status. If they are a student then it will give them reduced price whereas for those who are not students of mmu it will give them different price
    $checkstudentstatus = "SELECT * FROM user WHERE email = '$email'";
    $checkstudentstatusrun = mysqli_query($conn, $checkstudentstatus);

    #fetching data in array form so that html can read it
    $fetchstudent = mysqli_fetch_array($checkstudentstatusrun);

    #this is to check whether the amount of students in that specific schedule got slots or not.
    $maxstudents = "SELECT maxstudents FROM schedule WHERE scheduleID = $scheduleselect AND maxstudents = 0;";
    $maxstudentsquery = mysqli_query($conn, $maxstudents);

    #if statement to check whether max student capacity reached or not. if tak reach then it will proceed with the code below, if not it will not proceed with the student enrollment.
    #It works by returning the amount of rows that meets the requirement for that query
    if(mysqli_num_rows($maxstudentsquery)<1){

      #this is to show that if it is not added to cart and the user not enrolled in it then it will proceed..
      if(mysqli_num_rows($checkrun)==0 AND mysqli_num_rows($checkscheduleidrun)==0){

        #if the user is a student.. then cheaper price
        if($fetchstudent['student_status'] == "Yes"){
          $query = "INSERT INTO cart VALUES(2,100,null,'$email','$scheduleselect')";
          $queryrun = mysqli_query($conn, $query);

          echo"<script>alert('Added to your shopping cart!')</script>";
          header('Refresh:0; url = karate.php');

          #if the user is not a student then... higher price
        }elseif($fetchstudent['student_status'] == "No"){
          $query = "INSERT INTO cart VALUES(2,150,null,'$email','$scheduleselect')";
          $queryrun = mysqli_query($conn, $query);

          echo"<script>alert('Added to your shopping cart!')</script>";
          header('Refresh:0; url = karate.php');
        }
        #if it is already in cart or in your enrolled classes, then it will show this message...
      }elseif(mysqli_num_rows($checkrun)>0 OR mysqli_num_rows($checkscheduleidrun)>0){
        echo"<script>alert('It is already in your cart!')</script>";
        header('Refresh:0; url = karate.php');
        #unpredictable stuff happens then this message
      }else{
        echo"<script>alert('Unknown error has occured')</script>";
        header('Refresh:0; url = karate.php');
      }
      #this is for the website to popup class capacity message
    }else{
      echo"<script>alert('Class Capacity Max! Will not take anymore students!')</script>";
      header('Refresh:0; url = silat.php');
    }
  }
}else{
  #if the user is not logged in
  if (isset($_POST['enroll_2'])) {
      echo"<script>alert('Register First la ')</script>";
      header('Refresh:0; url = karate.php');
  }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karate</title>
    <link rel="icon" type="image/x-icon" href="assets/img/mmu.jpg">
</head>
<body>
<style>
  *{
  margin: 0;
  padding: 0;
   }
:root{
    --primary-color: rgba(246, 223, 148, 0.782);
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
  background-color: rgb(208, 239, 69);
}

li {
  float: left;
}

li a {
  display: block;
  color: black;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover:not(.active) {
  background-color: rgb(58, 245, 64);
}

.active {
  background-color: #b5a20c;
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
position: relative;left: -680px;
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
margin-top: 30px;
margin-bottom: 35px;
}

.button1 {
background-color: rgb(219, 21, 14);
color: black;
border: 2px solid #d5f80c;
}

.button1:hover {
background-color: #f66feb;
color: white;
}
.logo{
width: 250px;
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
    <li><a href="kung_fu.php">KUNG FU</a></li>
    <li><a href="taekwondo.php">TAE KWON DO</a></li>
    <li><a href="silat.php">SILAT</a></li>
    <li><a href="silambam.php">SILAMBAM</a></li>
    <li style="float:right"><a class="active">KARATE</a></li>
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
    $queryget = "SELECT * FROM schedule WHERE courseid = 2";
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
  <img class="img1" src="https://static.vecteezy.com/system/resources/thumbnails/006/945/733/small/simple-karate-logo-vector.jpg">

  <h2>Origin</h2>
  <p class="origin"><br>Karate is a martial art developed in the Ryukyu
    Kingdom. It developed from the indigenous Ryukyuan martial arts under the influence of Chinese martial arts, particularly Fujian White Crane.
    </p>
    <p class="origin"><br>Karate is now predominantly a striking art using punching, kicking, knee strikes, elbow strikes and open-hand techniques such as
        knife-hands, spear-hands and palm-heel strikes. Historically, and in some modern styles, grappling, throws, joint locks, restraints and vital-point strikes are also taught.
        A karate practitioner is called a karateka.
  </p>
<center>
  <h2 class="ety"><br>Etymology</h2>
</center>
  <p class="origin"><br>Karate was originally written as "Chinese hand" in kanji. It was changed to a homophone meaning empty hand in 1935. The original use of the word "karate" in print is attributed to Ankō Itosu; he wrote it as "唐手".
    The Tang Dynasty of China ended in AD 907, but the kanji representing it remains in use in Japanese language referring to China generally, in such words as "唐人街" meaning Chinatown. Thus the word "karate" was originally a way of expressing "martial art from China."
    <p class="origin"><br>
    Since there are no written records it is not known definitely whether the kara in karate was originally written with the character 唐 meaning China or the character 空 meaning empty. During the time when admiration for China and things Chinese was at its height in the Ryūkyūs it was the custom to use the former character when referring to things of fine quality. Influenced by this practice, in recent times karate has begun to be written with the character 唐 to give it a sense of class or elegance.</p>
    <p class="origin"><br>The first documented use of a homophone of the logogram pronounced kara by replacing the Chinese character meaning "Tang Dynasty" with the character meaning "empty" took place in Karate Kumite written in August 1905 by Chōmo Hanashiro (1869–1945). Sino-Japanese relations have never been very good and especially at the time of the Japanese invasion of Manchuria, referring to the Chinese origins of karate was considered politically incorrect.</p>
    <p class="origin"><br>In 1933, the Okinawan art of karate was recognized as a Japanese martial art by the Japanese Martial Arts Committee known as the "Butoku Kai". Until 1935, "karate" was written as "唐手" (Chinese hand). But in 1935, the masters of the various styles of Okinawan karate conferred to decide a new name for their art. They decided to call their art "karate" written in Japanese characters as "空手" (empty hand)</p>
    <p class="origin"><br>Another nominal development is the addition of dō (道:どう) to the end of the word karate. Dō is a suffix having numerous meanings including road, path, route and way. It is used in many martial arts that survived Japan's transition from feudal culture to modern times. It implies that these arts are not just fighting systems but contain spiritual elements when promoted as disciplines. Examples include aikido, judo, kyūdō and kendo. Thus karatedō is more than just empty hand techniques. It is "The Way of the Empty Hand".
  </p>


  <form class="" action="" method="post">
  <select name = "scheduleselect">

    <?php
    #this is to get the data from the database and make it display in the select thingy
    $querygetrun2 = mysqli_query($conn, "SELECT * FROM schedule WHERE courseid = 2");
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
