<?php
session_start();
if (isset($_POST["newValue"]) && isset($_POST["id"])) {
    $product_id = $_POST["id"];
    $newValue = $_POST["newValue"];

    if ($newValue == 0) {
        unset($_SESSION["cart"][$product_id]);
    } else {
        $_SESSION["cart"][$product_id] = $_POST["newValue"];
    }
}
header("Location: cart.php");
