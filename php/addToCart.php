<?php
require_once('csrf.php');
session_start();

// Check that there's a product id to add to the cart
if (isset($_POST["id"])) {

    // Check that there's a valid csrf token
    if (isset($_POST["csrf_token"]) && check_token($_POST["csrf_token"])) {

        // Initialize new cart if needed
        if (!isset($_SESSION["cart"])) {
            $_SESSION["cart"] = array();
        }

        // Add or increment specified product in the cart
        $id = $_POST["id"];
        if ($_SESSION["cart"][$id]) {
            $_SESSION["cart"][$id]++;
        } else {
            $_SESSION["cart"][$id] = 1;
        }

        header("Location: homepage.php");
    } else {
        echo "<h2>Token invalid!</h2>";
    }
}
