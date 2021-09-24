<?php

if(isset($_POST["submit"])){
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(invalidUsername($username) !== false){
        header("location:../signup.php?error=invalidUsername");
        exit();
    }
    
    loginUser($conn, $username, $pwd);
}
else {
    header("location:../signup.php");
}
