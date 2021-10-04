<?php
require_once('csrf.php');
session_start();

if (isset($_POST["newValue"]) && isset($_POST["id"])) {

    // Check that there's a valid csrf token
    if (isset($_POST["csrf_token"]) && check_token($_POST["csrf_token"])) {
        $product_id = $_POST["id"];
        $newValue = $_POST["newValue"];

        if ($newValue == 0) {
            unset($_SESSION["cart"][$product_id]);
        } else {
            $_SESSION["cart"][$product_id] = $_POST["newValue"];
        }

        header("Location: cart.php");
    } else {
        echo "<h2>Token invalid!</h2>";
    }
}
