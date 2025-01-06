<!DOCTYPE html>
<html>
  <title>Login / Registration</title>
  <link rel="icon" type="image/x-icon" href="assets/img/mmu.jpg">
<head>
    <link rel="stylesheet" href="style.css">
</head>

<body>

  <div class="background">
    <div class="form-box">
      <div class="button-box">
        <div id="btn"></div>
        <button type="button" class="toggle" onclick="login()">Log In</button>
        <button type="button" class="toggle" onclick="register()">Register</button>
      </div>

      <form id="login" class="input-group" method="POST" action="">
        <input type="email" class="input-field" placeholder="Email" name="email" required>
        <input type="password" class="input-field" placeholder="Enter Password" name="pwd" required>
        <br>
        <button type="submit" class="submit-btn" name="login_btn">Log In</button>
        <br>
        <center><a href="index.php">Back</a></center>
      </form>

      <form id="register" class="input-group" method="POST" action="">
        <input type="text" class="input-field" placeholder="User ID" name="usernameregister" required>
        <input type="email" class="input-field" placeholder="Email Address" name="email" required>
        <input type="password" class="input-field" placeholder="Enter Password" name="passwordcreate" required>
		
		  <!-- Password requirements display -->
    <div id="password-requirements" style="font-size: 14px; color: #888;">
        <ul>
            <li>Minimum length: 8 characters</li>
            <li>At least one uppercase letter</li>
            <li>At least one lowercase letter</li>
            <li>At least one number</li>
            <li>At least one special character (e.g., !, @, #, $, etc.)</li>
        </ul>
    </div>

        <select name="studentstatus" id="studentstatus" class="input-field" required>
          <option hidden selected value="No"> Are you a student? </option>
          <option value="Yes">Yes</option>
          <option value="No">No</option>
        </select>
        <br>
        <button type="submit" class="submit-btn" name="register_btn">Register</button>
        <br>
        <center><a href="index.php">Back</a></center>
      </form>
    </div>
  </div>

  <script>
    var x = document.getElementById("login");
    var y = document.getElementById("register");
    var z = document.getElementById("btn");

    function register() {
      x.style.left = "-400px";
      y.style.left = "50px";
      z.style.left = "110px";
	  y.style.top = "100px";
	 
    }
    function login() {
      x.style.left = "50px";
      y.style.left = "450px";
      z.style.left = "0px";
    }
  </script>

</body>
</html>

<?php
session_start();
require_once('connection.php');

function log_audit_event($email, $action, $details) {
    global $conn;
    
    // Find user ID (you can modify this to fetch the actual user ID based on email)
    $query = "SELECT id FROM user WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($user_id);
    $stmt->fetch();
    $stmt->close();

    if ($user_id) {
        // Insert the audit log
        $query = "INSERT INTO audit_logs (user_id, action, details) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iss", $user_id, $action, $details);
        $stmt->execute();
        $stmt->close();
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login_btn'])) {
        // Login logic with parameterized query
        $email = $_POST['email'];
        $password = $_POST['pwd'];
		
		 // Hash the input password
    $password_hashed = hash('sha256', $password);

        $querylogin = "SELECT * FROM user WHERE email = ? AND password = ?";
        $stmt = $conn->prepare($querylogin);
        $stmt->bind_param("ss", $email, $password_hashed); // Bind parameters
        $stmt->execute();
        $queryloginrun = $stmt->get_result();
        $arraylogin = $queryloginrun->fetch_array();

        if ($email == 'admin@gmail.com' && $password == 'adminsexy') {
            $_SESSION['email'] = $email;
            echo "<script>alert('Successfully Logged In! Welcome Admin!')</script>";
            header('refresh: 0; url=admin.php');
			log_audit_event($email, 'Admin Login', 'Admin logged in');
        } elseif ($queryloginrun->num_rows > 0) {
            $_SESSION['email'] = $email;
            echo "<script>alert('Successfully Logged In! Welcome $arraylogin[0]!')</script>";
            header('refresh: 0; url=index.php');
			log_audit_event($email, 'User Login', "User logged in with email $email");

        } else {
            echo "<script>alert('Sorry, wrong password or username!')</script>";
            header('refresh: 0; url=registration_login.php');
			log_audit_event($email, 'Failed Login', 'Failed login attempt');
        }
        $stmt->close();

    } elseif (isset($_POST['register_btn'])) {
        // Registration logic with parameterized query
        $usernameregister = $_POST['usernameregister'];
        $passwordcreate = $_POST['passwordcreate'];
        $email = $_POST['email'];
        $studentstatus = $_POST['studentstatus'];
		
		// Check password policy on the server side
        $minLength = 8;
        $uppercase = preg_match('/[A-Z]/', $passwordcreate);
        $lowercase = preg_match('/[a-z]/', $passwordcreate);
        $number = preg_match('/\d/', $passwordcreate);
        $specialChar = preg_match('/[!@#$%^&*(),.?":{}|<>]/', $passwordcreate);

        if (strlen($passwordcreate) < $minLength || !$uppercase || !$lowercase || !$number || !$specialChar) {
            echo "<script>alert('Password does not meet the security requirements.');</script>";
            header('refresh: 0; url=registration_login.php');
            exit();
        }

        $querycheck = "SELECT * FROM user WHERE email = ?";
        $stmt = $conn->prepare($querycheck);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $querycheckrun = $stmt->get_result();

        $querycheck = "SELECT * FROM user WHERE email = ?";
        $stmt = $conn->prepare($querycheck);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $querycheckrun = $stmt->get_result();

        if ($querycheckrun->num_rows > 0) {
            echo "<script>alert('Account already exists!')</script>";
            header('refresh: 0; url=registration_login.php');
        } else {
            $queryinsert = "INSERT INTO user VALUES(?, ?, ?, ?)";
            $stmt = $conn->prepare($queryinsert);
            $stmt->bind_param("ssss", $usernameregister, $passwordcreate, $email, $studentstatus);
            $stmt->execute();

            echo "<script>alert('Successfully Registered!')</script>";
            header('refresh: 0; url=registration_login.php');
        }
        $stmt->close();
    }
}

$conn->close();
?>
