<?php
require_once('csrf.php');
session_start();

// Check that there's a valid csrf token
if (isset($_POST["csrf_token"]) && check_token($_POST["csrf_token"])) {

    $_SESSION["bought_items"] = $_SESSION["cart"];
    $_SESSION["cart"] = array();
    header('Location: receipt.php');
} else {
    echo "<h2>Token invalid!</h2>";
}
