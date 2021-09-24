<?php

function emptyInputSignUp($username, $address,$pwd, $pwdrepeat){
    if(empty($username)|| empty($address) || empty($pwd)|| empty($pwdrepeat)){
        $result = true;
        } else{
            $result = false;
        }
    return $result;
}

function invalidUsername($username){
    if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        $result = true;
        } else{
            $result = false;
        }
    return $result;
}

function pwdMatch($pwd, $pwdrepeat){
    if($pwd !== $pwdrepeat){
        $result = true;
        } else{
            $result = false;
        }
    return $result;
}

function usernameExists($conn, $username){
    $sql = "SELECT * FROM users WHERE username = ?;";
    $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location:../signup.php?error=statementFaild");
            exit();
        }
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }else{
        $result = false;
        return $result;
    }
 mysqli_stmt_close($stmt);
}

function createUser($conn,$username,$address,$pwd){
    $sql = "INSERT INTO users (username, password, address) VALUES (?,?,?);";
    $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location:../signup.php?error=statementFaild");
            exit();
        }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "sss", $username, $hashedPwd, $address);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location:../signup.php?error=none");
    exit();
}

function loginUser($conn, $username, $pwd){
    $userExists = usernameExists($conn, $username);
 if($userExists === false) {
     header("location:../login.php?error=wronglogin");
     exit();
 }
 
 $pwdHashed = $userExists["password"];
 $checkPwd = password_verify($pwd, $pwdHashed);

 if($checkPwd === false){
    header("location:../login.php?error=wronglogin");
    exit();
 } 
 else if($checkPwd === true){
     session_start();
     session_regenerate_id();
     $_SESSION["username"] = $userExists["username"];
     header("location:../index.php");
     exit();
 }
}