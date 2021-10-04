<html>

<head>
    <title>Plants 'n' stuff</title>
    <link rel="stylesheet" href="../styles/index.css" />
    <link rel="stylesheet" href="../styles/receipt.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=WindSong" />
</head>

<?php include('header.php'); ?>

<body>
    <main>
        <div id="receipt">
            <h2>Receipt</h2>
            <?php
            $db = new Database();
            $cart_products = $_SESSION["cart"];

            // Empty receipt message
            if (sizeof($cart_products) == 0) {
                echo "<h3>Your cart was empty!</h3>";
                return;
            }

            // Non-empty receipt message
            $total_price = 0;
            foreach ($cart_products as $id => $num) {
                $name = $db->getName($id);
                $price = $db->getPrice($id);

                echo "<p>$num x $name <span class='price'>$$price</span></p>";
                $total_price = $total_price + $num * $price;
            }
            echo    "<div class='total-wrapper'>
                        <p class='total-sum'>Total: <span class='price'>$$total_price</span></p>
                    </div>";

            ?>
        </div>
    </main>
</body>


</html>