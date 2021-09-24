<?php

if(isset($_POST["submit"])){

    $address = $_POST["address"];
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $pwdrepeat = $_POST["pwdrepeat"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    #if(emptyInputSignUp($username, $address,$pwd, $pwdrepeat) !== false){
    #    header("location:../signup.php?error=emptyInput");
    #    exit();
   # }
    if(invalidUsername($username) !== false){
        header("location:../signup.php?error=invalidUsername");
        exit();
    }

    if(pwdMatch($pwd, $pwdrepeat) !== false){
        header("location:../signup.php?error=pwdMatch");
        exit();
    }

    if(usernameExists($conn, $username) !== false){
        header("location:../signup.php?error=usernameExists");
        exit();
    }

    createUser($conn,$username,$address,$pwd);


 } else {
    header("location:../signup.php");
}