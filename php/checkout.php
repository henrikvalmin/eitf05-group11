<?php
require_once('csrf.php');
session_start();

// Check that there's a valid csrf token
if (isset($_POST["csrf_token"]) && check_token($_POST["csrf_token"])) {
    header('Location: payment.php');
} else {
    echo "<h2>Token invalid!</h2>";
}
