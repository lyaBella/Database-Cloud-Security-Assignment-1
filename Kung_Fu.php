<?php
//refer karate...
session_start();
require_once('connection.php');
if(isset($_SESSION['email'])){
  if (isset($_POST['enroll_2'])) {
    $email = $_SESSION['email'];
    $scheduleselect = $_POST['scheduleselect'];
    $check = "SELECT * FROM cart WHERE courseid = 4 AND email = '$email'";

    $checkrun = mysqli_query($conn,$check);

    $checkscheduleid = "SELECT * FROM enrolled_users WHERE email = '$email' AND scheduleID BETWEEN 7 and 8";
    $checkscheduleidrun = mysqli_query($conn,$checkscheduleid);

    $checkstudentstatus = "SELECT * FROM user WHERE email = '$email'";
    $checkstudentstatusrun = mysqli_query($conn, $checkstudentstatus);
    $fetchstudent = mysqli_fetch_array($checkstudentstatusrun);

    $maxstudents = "SELECT maxstudents FROM schedule WHERE scheduleID = $scheduleselect AND maxstudents = 0;";
    $maxstudentsquery = mysqli_query($conn, $maxstudents);

    if(mysqli_num_rows($maxstudentsquery)<1){

      if(mysqli_num_rows($checkrun)==0 AND mysqli_num_rows($checkscheduleidrun)==0){
        if($fetchstudent['student_status'] == "Yes"){
          $query = "INSERT INTO cart VALUES(4,100,null,'$email','$scheduleselect')";
          $queryrun = mysqli_query($conn, $query);
          echo"<script>alert('Added to your shopping cart!')</script>";
          header('Refresh:0; url = kung_fu.php');
        }elseif($fetchstudent['student_status'] == "No"){
          $query = "INSERT INTO cart VALUES(4,150,null,'$email','$scheduleselect')";
          $queryrun = mysqli_query($conn, $query);
          echo"<script>alert('Added to your shopping cart!')</script>";
          header('Refresh:0; url = kung_fu.php');
        }
      }elseif(mysqli_num_rows($checkrun)>0 OR mysqli_num_rows($checkscheduleidrun)>0){
        echo"<script>alert('It is already in your cart!')</script>";
        header('Refresh:0; url = kung_fu.php');
      }else{
        echo"<script>alert('Unknown error has occured')</script>";
        header('Refresh:0; url = kung_fu.php');
      }
    }else{
      echo"<script>alert('Class Capacity Max! Will not take anymore students!')</script>";
      header('Refresh:0; url = kung_fu.php');
    }
  }
}else{
  if (isset($_POST['enroll_2'])) {
      echo"<script>alert('Register First la ')</script>";
      header('Refresh:0; url = kung_fu.php');
  }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kung Fu</title>
   <link rel="icon" type="image/x-icon" href="assets/img/mmu.jpg">
</head>
<body>
<style>
*{
  margin: 0;
  padding: 0;
   }
:root{
    --primary-color: #f68e1f;
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
  background-color: #f32323e4;
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
  background-color: rgb(204, 197, 60);
}

.active {
  background-color:#81141476
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
margin-bottom: 35px;
margin-top: 30px;
}

.button1 {
background-color: rgb(41, 215, 18);
color: black;
border: 2px solid #22d11c;
}

.button1:hover {
background-color: #4e25a1;
color: white;
}
.logo{
width: 250px;
}
.wrapper{
width: 100%;
}

.pc{
  position: relative;left: -640px;
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
    <li><a href="silat.php">SILAT</a></li>
    <li><a href="silambam.php">SILAMBAM</a></li>
    <li><a href="karate.php">KARATE</a></li>
    <li style="float:right"><a class="active">KUNG FU</a></li>
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
    $queryget = "SELECT * FROM schedule WHERE courseid = 4";
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
  </table>
  <center>
  <div class="text">
  <p><br><br><br>-Fees will be RM 100 for MMU Students and RM 150 for Outsiders</p>
  </div>
  <p class="text2">-Venue will be at MMU Indoor Sports</p>
  <p class="text3">-The attire will be Sports Attire for the participants<br><br><br><br><br></p>
  </center>
  <img class="img1" src="https://img.freepik.com/premium-vector/twilight-kung-fu-karate-background_685023-7.jpg?w=2000">

  <h2>Origin</h2>
  <p class="origin"><br>In general, kung fu refers to the Chinese martial arts also called wushu and quanfa. In China, it refers to any study, learning, or practice that requires patience, energy, and time to complete. In its original meaning, kung fu can refer to any discipline or skill achieved through hard work and practice, not necessarily martial arts (for example, the discipline of tea making is called the Gongfu tea ceremony).
    The Chinese literal equivalent of "Chinese martial art" would be 中國武術 zhōngguó wǔshù</p>
    <p class="origin"><br>There are many forms of kung fu, such as Shaolin Kung Fu, Wing Chun, Tai chi, etc., and they are practiced all over the world. Each form of kung fu has its own principles and techniques, but is best known for its trickery and quickness, which is where the word kung fu is derived. It is only in the late twentieth century that this term was used in relation to Chinese martial arts by the Chinese community.
        The Oxford English Dictionary defines the term "kung-fu" as "a primarily unarmed Chinese martial art resembling karate" and attributes the first use of "kung fu" in print to Punch magazine in 1966. This illustrates how the meaning of this term has been changed in English. The origin of this change can be attributed to the misunderstanding or mistranslation of the term through movie subtitles or dubbing
  </p>

  <h2 class="pc"><br>Popular Culture</h2>
  <p class="origin"><br>
    References to the concepts and use of Chinese martial arts can be found in popular culture. Historically, the influence of Chinese martial arts can be found in books and in the performance arts specific to Asia. Recently, those influences have extended to the movies and television that targets a much wider audience. As a result, Chinese martial arts have spread beyond its ethnic roots and have a global appeal.</p>
    <p class="origin"><br>Martial arts play a prominent role in the literature genre known as wuxia (武俠小說). This type of fiction is based on Chinese concepts of chivalry, a separate martial arts society (武林; Wulin) and a central theme involving martial arts. Wuxia stories can be traced as far back as 2nd and 3rd century BCE, becoming popular by the Tang dynasty and evolving into novel form by the Ming dynasty. This genre is still extremely popular in much of Asia and provides a major influence for the public perception of the martial arts.
    </p>
    <p class="origin"><br>Martial arts influences can also be found in dance, theater and especially Chinese opera, of which Beijing opera is one of the best-known examples. This popular form of drama dates back to the Tang dynasty and continues to be an example of Chinese culture. Some martial arts movements can be found in Chinese opera and some martial artists can be found as performers in Chinese operas.</p>
    <p class="origin"><br>In modern times, Chinese martial arts have spawned the genre of cinema known as the Kung fu film. The films of Bruce Lee were instrumental in the initial burst of Chinese martial arts' popularity in the West in the 1970's, following a famous demonstration of "Chinese Boxing" to the US karate community the Long Beach International Karate Championships in 1964. Martial artists and actors such as Jackie Chan, Jet Li and Donnie Yen have continued the appeal of movies of this genre. Jackie Chan successfully brought in a sense of humor in his fighting style into his movies. Martial arts films from China are often referred to as "kung fu movies" (功夫片), or "wire-fu" if extensive wire work is performed for special effects, and are still best known as part of the tradition of kung fu theater. (see also: wuxia, Hong Kong action cinema). In 2003, the Fuse (TV channel) began airing episodes of a half-hour television show titled Kung Faux that married classic kung fu films with hip hop sensibilities and comic affects to gain resilient critical success.</p>
    <p class="origin"><br>"Bitter Work," the literal Cantonese translation of "kung fu," is the title of the ninth episode of season 2 of Avatar. The episode entails the protagonist and nemesis of the show mastering different aspects of kung fu.
  </p>
 <form class="" action="" method="post">
  <select name = "scheduleselect">

    <?php
    $querygetrun2 = mysqli_query($conn, "SELECT * FROM schedule WHERE courseid = 4");
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
