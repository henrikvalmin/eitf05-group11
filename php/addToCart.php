<?php
session_start();
if (isset($_POST["id"])) {
    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = array();
    }

    $id = $_POST["id"];
    if ($_SESSION["cart"][$id]) {
        $_SESSION["cart"][$id]++;
    } else {
        $_SESSION["cart"][$id] = 1;
    }

    header("Location: homepage.php");
}
