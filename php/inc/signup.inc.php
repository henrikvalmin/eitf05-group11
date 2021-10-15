<?php

if (isset($_POST["submit"])) {

  // Set variables 
  $username = ($_POST["username"]);
  $username = htmlspecialchars($_POST["username"]); // Disable if XSS
  $address = htmlspecialchars($_POST["address"]);
  $pwd = $_POST["pwd"];
  $pwdrepeat = $_POST["pwdrepeat"];

  require_once 'dBh.inc.php';
  require_once 'functions.inc.php';

  if (emptyInputSignUp($username, $pwd, $pwdrepeat, $address) !== false) {
    header("location:../signup.php?error=emptyinput");
    exit();
  }
  
  //Disable this when XSS
  if (invalidUsername($username) !== false) {
    header("location:../signup.php?error=invalidUsername");
    exit();
  }

  if (pwdMatch($pwd, $pwdrepeat) !== false) {
    header("location:../signup.php?error=pwdMatch");
    exit();
  }
  if (validPassword($pwd) !== false) {
    header("location:../signup.php?error=invalidPassword");
    exit();
  }
  if (usernameExists($conn, $username) !== false) {
    header("location:../signup.php?error=usernametaken");
    exit();
  }
  if (pwdInBlacklist($conn, $pwd) !== false) {
    header("location:../signup.php?error=passwordtooweak");
    exit();
  }
  createUser($conn, $username, $pwd, $address);
} else {
  header("location:../signup.php");
}
