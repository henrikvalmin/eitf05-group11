<?php
session_start();

if (!isset($_SESSION['attempts'])) {
  $_SESSION['attempts'] = 0;
}

if ($_SESSION['attempts'] < 5) {
  if (isset($_POST["submit"])) {

    if (!empty($_POST["username"]) && !empty($_POST["password"])) {

      $con = mysqli_connect('localhost', 'root', '', 'plants') or die("Unable to connect");

      // Create a prepared statement
      $statement = $con->prepare("SELECT * FROM users WHERE username=? AND password=?");
      $statement->bind_param("ss", $username, $password);

      // Set variables
      $username = $_POST["username"];
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

        // ----- Setting the username if successful login
        session_start();
        session_regenerate_id();
        header('Location: ./homepage.php');
        $_SESSION["curr_user"] = $res[0][0];
      } else {
        echo "Invalid username or password!";
        $_SESSION['attempts']++;
      }
    } else {
      echo "Did you forget to fill in either your username and password? All fields are required, please try again.";
    }
  }
} else {
  echo "Too many failed attempts, try again later";
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
      <div class="message"><?php if ($message != "") {
                              echo $message;
                            } ?></div>
      <h3>Enter Login Details</h3>

      <p>
        <input type="text" name="username" placeholder="Username" />
        <label for="Username">Username</label>
      </p>

      <p>
        <input type="password" name="password" placeholder="Password">
        <label for="Password">Password</label>
      </p>

      <input type="submit" name="submit" value="Submit">
      <input type="reset">
    </form>
  </main>
</body>

</html>