<?php

// THIS CLASS ALLOWS 3 LOGIN ATTEMPTS, THEN THE LOGIN-FIELDS ARE DISABLED. IT WORKS!

session_start();
$msg="";

if(!isset($_SESSION['attempts'])){
  $_SESSION['attempts'] = 0;
}

if ($_SESSION['attempts']>3) {
  $dif = time() - $_SESSION['stopTime'];
  //echo "Dif: ", $dif, " Time: ", time(), " StopTime: ", $_SESSION['stopTime'];
  $lockedTime = 60*15;
  //Låses i 1 min
  if ($dif < 10) {
  //if ($dif < $lockedTime) {
      $msg="Too many failed attempts. Try again later";
  } else {
    $_SESSION['attempts'] = 0;
  }
}

if ($_SESSION['attempts'] < 3) {
  if (isset($_POST["submit"])) {

    if (!empty($_POST["username"]) && !empty($_POST["password"])) {

      $con = mysqli_connect('localhost', 'root', '', 'plants') or die("Unable to connect");

      // Create a prepared statement
      $statement = $con->prepare("SELECT * FROM users WHERE username=? AND password=?");
      $statement->bind_param("ss", $username, $password);

      // Set variables
      $username = $_POST["username"];
      $password = $_POST["password"];
      $attempt = $_POST['hidden'];

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
  <link rel="stylesheet" href="../styles/index.css" />
</head>

<body>
  <main>
    <form name="frmUser" method="post" action="">
     <div class="message"><?php if($msg!="") { echo $msg; } ?></div>
      <h3>Enter Login Details</h3>

      <p>
        <input type="text" name="username" <?php if($attempt==3){?> disabled="disabled" <?php }?> placeholder="Username" />
        <label for="Username">Username</label>
      </p>

      <p>
        <input type="password" name="password" <?php if($attempt==3){?> disabled="disabled" <?php }?> placeholder="Password">
        <label for="Password">Password</label>
      </p>

      <input type="submit" name="submit" <?php if($attempt==3){?> disabled="disabled" <?php }?>  value="Submit">
    </form>
  </main>
</body>

</html>