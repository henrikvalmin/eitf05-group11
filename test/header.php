<?php
  session_start();
?>

<!DOCTYPE html>
<html>

<head>
  <title>Plants 'n' stuff</title>
  <link rel="stylesheet" href="../styles/index.css" />

  <!-- Linking web fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=WindSong" />

  <!-- <script type="module" src="js/login.js"></script> -->
  <script type="module" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

</head>
<body>
 

<header>
  <!-- Temporary working title for web shop -->
  <h1><a href="index.php">Plants 'n' stuff</a></h1>

  <!-- Set username in navigation bar -->
  <?php
  if (isset($_SESSION["username"])) {
    $curr_user = $_SESSION["username"];
    echo "<h2>Welcome, $curr_user!</h2>";
  } else {
    echo "<h2>Welcome!</h2>";
  }
  ?>

 <nav>
    <div class="wrapper">
    <ul>
    <li><a href="php/receipt.php">temp link to receipt</a></li>
    <?php
    if (isset($_SESSION["username"])) {
    $curr_user = $_SESSION["username"];
    echo '<li><a href= "myprofile.php">My Profile</a></li>';
    echo '<li><a href= "./inc/logout.inc.php">Log Out</a></li>';
  } else {
    echo '<li><a href= "login.php">Log In</a></li>';
    echo '<li><a href="signup.php">Sign Up</a></li>';
  }
  ?>
    </ul>
  </nav>
  <div class="wrapper">


</header>