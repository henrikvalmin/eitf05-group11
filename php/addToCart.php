<?php
session_start();
if (isset($_POST["id"])) {
    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = array();
    }
    array_push($_SESSION["cart"], $_POST["id"]);
    header("Location: homepage.php");
}
