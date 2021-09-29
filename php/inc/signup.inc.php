<?php 

  if(isset($_POST["submit"])){

    $address = $_POST["address"];
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $pwdrepeat = $_POST["pwdrepeat"];

    require_once 'dBh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputSignUp($username,$pwd, $pwdrepeat, $address) !== false){
      header("location:../signup.php?error=emptyinput");
      exit();
    }
    if (invalidUsername($username) !== false){
      header("location:../signup.php?error=invalidUsername");
      exit();
    }
    if (pwdMatch($pwd,$pwdrepeat) !== false){
      header("location:../signup.php?error=pwdMatch");
      exit();
    }
    if (usernameExists($conn, $username) !== false){
      header("location:../signup.php?error=usernametaken");
      exit();
    }
    if (pwdInBlacklist($conn,$pwd) !== false){
      header("location:../signup.php?error=passwordtooweak");
      exit();
    }
    createUser($conn, $username, $pwd, $address);

  } else {
    header("location:../signup.php");
}



