<?php
include_once 'header.php';
// THIS CLASS ALLOWS 3 LOGIN ATTEMPTS, THEN THE LOGIN-FIELDS ARE DISABLED. IT WORKS!

$msg = "";

if (!isset($_SESSION['attempts'])) {
  $_SESSION['attempts'] = 0;
}

if ($_SESSION['attempts'] > 3) {
  $dif = time() - $_SESSION['stopTime'];
  $lockedTime = 60 * 15;
  if ($dif < $lockedTime) {
    $msg = "You have to wait a bit longer. Try again later";
  } else {
    $_SESSION['attempts'] = 0;
  }
}
if ($_SESSION['attempts'] < 3) {
  if (isset($_POST["submit"])) {

    if (!empty($_POST["username"]) && !empty($_POST["password"])) {

      $con = mysqli_connect('localhost', 'root', '', 'plants') or die("Unable to connect");
      $username = $_POST["username"];
      $password = $_POST["password"];

      // --- Secure version (SQL) ---
      $username = htmlspecialchars($username);
      $password = htmlspecialchars($password);

      $salt_statement = $con->prepare("SELECT salt FROM users WHERE username=?");
      $salt_statement->bind_param("s", $username);
      $salt_statement->execute();

      $salt = $salt_statement->get_result();
      $salt = $salt->fetch_row()[0];

      $hashedPassword = hash('sha256', $salt . $password);
      $statement = $con->prepare("SELECT * FROM users WHERE password='$hashedPassword' AND username=?");
      $statement->bind_param("s", $username);
      $statement->execute();
      $result = $statement->get_result();

      // --- Insecure version ---
      // One form of attack: login as some user by putting 
      //     user' or '1'='1
      // as the username

      // $salt_query = "SELECT salt FROM users WHERE username='$username'";
      // $salt = $con->query($salt_query);
      // $salt = $salt->fetch_row()[0];

      // $hashedPassword = hash('sha256', $salt . $password);
      // $query = "SELECT * FROM users WHERE password='$hashedPassword' AND username='$username'";
      // $result = $con->query($query);

      // -------

      if ($result->num_rows > 0) {

        $res = $result->fetch_all();
        session_start();
        session_regenerate_id();
        header('Location: ./homepage.php');

        // ----- Setting the username if successful login
        $_SESSION["curr_user"] = $res[0][0];
      } else {
        $_SESSION['attempts']++;
        $_SESSION['stopTime'] = time();
        $attemptsLeft = 3 - $_SESSION['attempts'];
        $msg = "Invalid username or password! Attempts left: $attemptsLeft";
      }
    } else {
      $msg = "Did you forget to fill in either your username and password? All fields are required, please try again.";
    }
  }
}
if ($_SESSION['attempts'] == 3) {
  $msg = "Too many failed attempts. Try again in 15 minutes";
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
      <div class="message"><?php if ($msg != "") {
                              echo $msg;
                            } ?></div>
      <h3>Enter Login Details</h3>

      <p>
        <input type="text" name="username" placeholder="Username" />
      </p>

      <p>
        <input type="password" name="password" placeholder="Password">
      </p>

      <input type="submit" name="submit" value="Submit">
    </form>
  </main>
</body>

</html>