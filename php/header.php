<?php
session_start();
require('database.php');

// User welcome text (should be logged in at this point)
if (isset($_SESSION["curr_user"])) {
    $welcome_text  = "Welcome, " . $_SESSION["curr_user"] . "!";
} else {
    $welcome_text = "Welcome!";
}

// Number of items in cart
$items_in_cart = 0;
if (isset($_SESSION["cart"])) {
    $items_in_cart = 0;
    foreach ($_SESSION["cart"] as $id => $num) {
        $items_in_cart += $num;
    }
}
$cart_text = "Cart (" . $items_in_cart . " items)";

?>

<header>
    <h1><a href="homepage.php">Plants 'n' stuff</a></h1>
    <h2><?php echo $welcome_text; ?></h2>
    <nav>
        <ul>
            <li><a href="homepage.php">Home</a></li>
            <li><a href="cart.php"><?php echo "$cart_text"; ?></a></li>
            <li><a href="logout.php">Log out</a></li>
        </ul>
    </nav>
</header>