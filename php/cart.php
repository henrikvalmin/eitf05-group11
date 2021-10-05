<?php
require_once('csrf.php');
include('header.php');
function build_select_options($curr_id)
{
    $select = "";
    $actual_num = $_SESSION["cart"][$curr_id];
    $max_size_select = 10;
    if ($actual_num >= $max_size_select) {
        $max_size_select = $actual_num + 5;
    }
    $select .= "<option value='0'>Delete</option>";
    for ($i = 1; $i <= $max_size_select; $i++) {
        $select .= "<option value='$i'";
        if ($i == $actual_num) {
            $select .= " selected";
        }
        $select .= ">$i</option>\n";
    }
    return $select;
}
?>


<html>

<head>
    <title>Plants 'n' stuff</title>
    <link rel="stylesheet" href="../styles/index.css" />
    <link rel="stylesheet" href="../styles/cart.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=WindSong" />
</head>

<body>
    <main>
        <div class="show-cart">
            <?php

            $db = new Database();

            $cart_products = $_SESSION["cart"];
            foreach ($cart_products as $id => $num) {
                $name = $db->getName($id);
                $price = $db->getPrice($id);

                $cart_item =
                    "<div class='cart-item'>
                    <div cart-item-description>
                        <p class='name'>$name</p>
                        <p class='price'>$$price</p>
                    </div>
                    <form method='POST' action='changeCart.php'>
                        <select name='newValue'>
                ";
                $cart_item .= build_select_options($id);
                $cart_item .=
                    "</select>
                    " . csrf_input_field() . "
                        <input type='hidden' name='id' value='$id' />
                        <input type='submit' value='Update amount' />
                    </form>
                </div>";
                echo $cart_item;
            }

            ?>
        </div>
        <form method="POST" class="pay-form" action="checkout.php">
            <?php
            if (sizeof($_SESSION["cart"]) != 0) {
                echo csrf_input_field();
                echo "<input type='submit' value='Check out' />";
            } else {
                echo "<h3>The cart is empty!</h3>";
            }

            ?>
        </form>
    </main>
</body>

</html>