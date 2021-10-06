<?php
include_once 'header.php';
// THIS CLASS ALLOWS 3 LOGIN ATTEMPTS, THEN THE LOGIN-FIELDS ARE DISABLED. IT WORKS!

$msg="";

if(!isset($_SESSION['attempts'])){
  $_SESSION['attempts'] = 0;
}

if ($_SESSION['attempts']>3) {
  $dif = time() - $_SESSION['stopTime'];
  $lockedTime = 60*15;
  if ($dif < $lockedTime) {
      $msg="You have to wait a bit longer. Try again later";
  } else {
    $_SESSION['attempts'] = 0;
  }
}

if ($_SESSION['attempts'] < 3) {
  if (isset($_POST["submit"])) {

    if (!empty($_POST["username"]) && !empty($_POST["password"])) {

      $con = mysqli_connect('localhost', 'root', '', 'plants') or die("Unable to connect");

      // Create a prepared statement
      $statement = $con->prepare("SELECT * FROM users WHERE username=?");
      $statement->bind_param("s", $username);

      // Set variables 
      //$username = ($_POST["username"]); // Set if preforming XSS
      $username = htmlspecialchars($_POST["username"]); // Disable if XSS
      $password = $_POST["password"];

      // Execute the prepared statement and store result
      $statement->execute();
      $result = $statement->get_result();

      // --- ALLOW SQL INJECTION : these two lines instead of the two above ---
      // $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
      // $result = $con->query($query);

      // One form of attack: login as user with unknown password by
      // inputting    a' OR '1'='1   as password 

      if ($result->num_rows > 0) {
        
        $res = $result->fetch_all();
        if (password_verify($password, $res[0][1])) {
          // ----- Setting the username if successful login
          session_start();
          session_regenerate_id();
          header('Location: ./homepage.php');
          $_SESSION["curr_user"] = $res[0][0];
        } else {
          $_SESSION['attempts']++;
          $_SESSION['stopTime']=time();
          $attemptsLeft=3-$_SESSION['attempts'];
          $msg="Invalid username or password! Attempts left: $attemptsLeft";
        }
      } else {
        $_SESSION['attempts']++;
        $_SESSION['stopTime']=time();
        $attemptsLeft=3-$_SESSION['attempts'];
        $msg="Invalid username or password! Attempts left: $attemptsLeft";
        
      }
    } else {
        $msg= "Did you forget to fill in either your username and password? All fields are required, please try again.";
    }
  }
} 
if ($_SESSION['attempts']==3) {
  $msg="Too many failed attempts. Try again in 15 minutes";
  $_SESSION['attempts']++;
}

?>

<html>

<head>
  <title>User Login</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=WindSong" />
  <link rel="stylesheet" href="../styles/index.css" />
</head>

<body>
  <main>
    <form name="frmUser" method="post" action="">
     <div class="message"><?php if($msg!="") { echo $msg; } ?></div>
      <h3>Enter Login Details</h3>

      <p>
        <input type="text" name="username" placeholder="Username" />
      </p>

      <p>
        <input type="password" name="password" placeholder="Password">
      </p>

      <input type="submit" name="submit" value="Submit">
      <input type="reset">
      <element id= "login-reference"><a href="signup.php">Don't have an account? Sign up </a></element> 
    </form>
  </main>
</body>

</html>