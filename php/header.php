<?php
session_start();
require('database.php');
require_once('csrf.php');

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
<title>Plants 'n' stuff</title>
  <link rel="stylesheet" href="../styles/index.css" />

  <!-- Linking web fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=WindSong" />

  <!-- <script type="module" src="js/login.js"></script> -->

  <script type="module" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <h1><a href="homepage.php">Plants 'n' stuff</a></h1>
    <h2><?php echo $welcome_text; ?></h2>
    <nav>
        <ul>
            <li><a href="homepage.php">Home</a></li>
            <li><a href="cart.php"><?php echo "$cart_text"; ?></a></li>
            <?php
            if (isset($_SESSION["curr_user"])){
                $curr_user = $_SESSION["curr_user"];
                echo '<li><a href= "myprofile.php">My Profile</a></li>';
                ?>
                 <form method="POST" action="logout.php" id="logout-form">
                    <?php
                    echo csrf_input_field();
                    ?>
                    <input id="logout-button" type="submit" value="Log out" />
                </form> 
                <?php
            } else {
                echo '<li><a href="login.php">Log In</a></li>';
                echo '<li><a href="signup.php">Sign Up</a></li>';
            }
            ?>
        </ul>

        </ul>
    </nav>
</header>