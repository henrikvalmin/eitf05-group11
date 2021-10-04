<?php

function emptyInputSignUp($username,$pwd, $pwdrepeat, $address) {
    if (empty($username) || empty($pwd) || empty($pwdrepeat) || empty($address)) {
        $result = true;
    }else {
        $result = false;
    }
    return $result;
}

function invalidUsername($username) {
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    }else {
        $result = false;
    }
    return $result;
}

function pwdMatch($pwd,$pwdrepeat) {
    if ($pwd !== $pwdrepeat) {
        $result = true;
    }else {
    $result = false;
    }
    return $result;
}

function usernameExists($conn, $username) {
    $sql = "SELECT * FROM users WHERE username = ?";
    $statement = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($statement, $sql)) {
            header("location:../signup.php?error=statementFailed");
            exit();
        }
    mysqli_stmt_bind_param($statement, "s", $username);
    mysqli_stmt_execute($statement);
    $resultData = mysqli_stmt_get_result($statement);
        if($row = mysqli_fetch_assoc($resultData)) {
            return $row;
        }else {
            $result = false;
            return $result;
        }
mysqli_stmt_close($statement);
}

function pwdInBlacklist($conn,$pwd) {
    $sql = "SELECT * FROM passwordblacklist WHERE password = ?;";
    $statement = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($statement, $sql)) {
            header("location:../signup.php?error=statementFailed");
            exit();
        }
    mysqli_stmt_bind_param($statement, "s", $pwd);
    mysqli_stmt_execute($statement);
    $resultData = mysqli_stmt_get_result($statement);
        if($row = mysqli_fetch_assoc($resultData)) {
            session_start();
            return $row;
        }else {
            $result = false;
            return $result;
        }
mysqli_stmt_close($statement);
}

function validPassword($pwd){
    if(!preg_match('/\A(?=[\x20-\x7E]*?[A-Z])(?=[\x20-\x7E]*?[a-z])(?=[\x20-\x7E]*?[0-9])[\x20-\x7E]{8,}\z/', $pwd)){
        $result = true;
    }else {
        $result = false;
    }
    return $result; 
}

function createUser($conn, $username, $pwd, $address) {
    $sql = "INSERT INTO users (username, password, address) VALUES (?,?,?);";
    $statement = mysqli_stmt_init($conn);
    
    if (!mysqli_stmt_prepare($statement, $sql)) {
    header("location:../signup.php?error=statementFailed");
    exit();
    }
    
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($statement, "sss", $username, $hashedPwd, $address);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);
    header("location:../signup.php?error=none");
    exit();
}
