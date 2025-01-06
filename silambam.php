<?php
//refer karate
session_start();
require_once('connection.php');
if(isset($_SESSION['email'])){
  if (isset($_POST['enroll_2'])) {


    $email = $_SESSION['email'];
    $scheduleselect = $_POST['scheduleselect'];
    $check = "SELECT * FROM cart WHERE courseid = 5 AND email = '$email'";
    $checkrun = mysqli_query($conn,$check);

    $checkscheduleid = "SELECT * FROM enrolled_users WHERE email = '$email' AND scheduleID BETWEEN 9 AND 11";
    $checkscheduleidrun = mysqli_query($conn,$checkscheduleid);

    $checkstudentstatus = "SELECT * FROM user WHERE email = '$email'";
    $checkstudentstatusrun = mysqli_query($conn, $checkstudentstatus);
    $fetchstudent = mysqli_fetch_array($checkstudentstatusrun);

    $maxstudents = "SELECT maxstudents FROM schedule WHERE scheduleID = $scheduleselect AND maxstudents = 0;";
    $maxstudentsquery = mysqli_query($conn, $maxstudents);

    if(mysqli_num_rows($maxstudentsquery)<1){

      if(mysqli_num_rows($checkrun)==0 and mysqli_num_rows($checkscheduleidrun)==0){

        if($fetchstudent['student_status'] == "Yes"){
          $query = "INSERT INTO cart VALUES(5,100,null,'$email','$scheduleselect')";
          $queryrun = mysqli_query($conn, $query);
          echo"<script>alert('Added to your shopping cart!')</script>";
          header('Refresh:0; url = silambam.php');

        }elseif($fetchstudent['student_status'] == "No"){

          $query = "INSERT INTO cart VALUES(5,150,null,'$email','$scheduleselect')";
          $queryrun = mysqli_query($conn, $query);
          echo"<script>alert('Added to your shopping cart!')</script>";
          header('Refresh:0; url = silambam.php');

        }
      }elseif((mysqli_num_rows($checkrun))>0 OR (mysqli_num_rows($checkscheduleidrun))>0){

        echo"<script>alert('It is already in your cart! Dah enrolled kot!')</script>";
        header('Refresh:0; url = silambam.php');

      }else{

        echo"<script>alert('Unknown error has occured')</script>";
        header('Refresh:0; url = silambam.php');
      }
    }else{
      echo"<script>alert('Class Capacity Max! Will not take anymore students!')</script>";
      header('Refresh:0; url = silambam.php');
      }
  }



}else{
  if (isset($_POST['enroll_2'])) {
      echo"<script>alert('Register First la ')</script>";
      header('Refresh:0; url = silambam.php');
  }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Silambam</title>
    <link rel="icon" type="image/x-icon" href="assets/img/mmu.jpg">
</head>
<body>
<style>
*{
  margin: 0;
  padding: 0;
   }
:root{
    --primary-color: rgb(166, 213, 213);
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
  background-color: rgb(69, 194, 239);
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
  background-color: rgb(165, 26, 170);
}

.active {
  background-color: #043baa;
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
margin-top: 35px;
}

.button1 {
background-color: rgb(228, 255, 54);
color: black;
border: 2px solid #d5f80c;
}

.button1:hover {
background-color: #29bff1;
color: white;
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
    <li><a href="kung_fu.php">KUNG FU</a></li>
    <li><a href="Taekwondo.php">TAE KWON DO</a></li>
    <li><a href="silat.php">SILAT</a></li>
    <li><a href="karate.php">KARATE</a></li>
    <li style="float:right"><a class="active">SILAMBAM</a></li>
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
    $queryget = "SELECT * FROM schedule WHERE courseid = 5";
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
  <img class="img1" src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/40/Silambam_vector.svg/1200px-Silambam_vector.svg.png">

  <h2>Origin</h2>
  <p class="origin"><br>Silambam has been practiced since at least the 4th century BC. It derives from the Tamil word silam, meaning hill.
    The term silambambu referred to a particular type of bamboo from the Kurinjimala (kurinji hills) in present-day Kerala. Thus silambam was named after its primary weapon, the bamboo staff.
    Bamboo staffs-as well as swords, pearls and armor-were in great demand from foreign traders.
    The ancient city of Madurai formed as the point of focus of Silambam's spreading.</p>
    <p class="origin"><br>The Silambam staff was acquired by the Egyptians, Greeks and Romans and was spread back to the Middle East, Europe and North Africa.
    The Tamil Kingdom which encompassed Southern India and Sri Lanka spread it throughout the Southeast Asia.
    The Kings Puli Thevar and Dheeran Chinnamalai had armies of Silambam soldiers named "Thadii Pattalam." Veerapandiya Kattabomman, Chinna Maruthu and Periya Maruthu (1760–1799) relied mainly on their Silambam prowess in warfare against the British East India Company.Indian martial arts and other related martial arts practices suffered a decline after the British banned Silambam and promoted modern military training, which favored firearms over traditional weaponry.
  </p>

  <h2><br>Training</h2>
  <p class="origin"><br>The first stages of Silambam practice are meant to provide a foundation for fighting, and also preparatory body conditioning. This includes improving flexibility, agility, and hand-eye coordination, kinesthetic awareness, balance, strength, speed, muscular and cardiovascular stamina.
  </p>

  <h2><br>Weapons</h2>
  <p class="origin"><br>Silambam's main focus is on the bamboo staff. The length of the staff depends on the height of the practitioner. Ideally, it should just touch the forehead about three fingers from the head, typically measuring around 1.68 meters (five and a half feet). Different lengths may be used depending on the situation. For instance, the sedikuchi or 3-foot stick can be easily concealed. Separate practice is needed for staffs of different lengths.
    <br>Listed below are some of the weapons used in Silambam.
    <p><br></p>
    <br><p class="origin"><b>Silambam</b>: staff, preferably made from bamboo, but sometimes also from teak or Indian rose chestnut wood.
        The staff is immersed in water and strengthened by beating it on the surface of still or running water. It is often tipped with metal rings to prevent the ends from being damaged.
        Kattari: native push-dagger with a H-shaped handle. Some are capable of piercing armor. The blade may be straight or wavy.
    <br><b>Maru</b>: a thrusting weapon made from deer (more accurately, Blackbuck) horns.
    <br><b>Panthukol</b>: staff with balls of fire, or weighted chains on each end.
    <br><b>Aruval</b>: sickle, often paired.
    <br><b>Savuku</b>: whip.
    <br><b>Vaal</b>: sword, generally curved.
    <br><b>Kuttu katai</b>: spiked knuckleduster.
    <br><b>Katti</b>: knife.
    <br><b>Surul kaththi</b>: flexible sword.
    <br><b>Sedikuchi</b>: cudgel or short stick, often wielded as a pair.
  </p>
  <p><br><br></p>
  <form class="" action="" method="post">
  <select name = "scheduleselect">

    <?php
    $querygetrun2 = mysqli_query($conn, "SELECT * FROM schedule WHERE courseid = 5");
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
