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

            $total_price = 0;
            for ($i = 0; $i < sizeof($cart_products); $i++) {
                $id = $cart_products[$i];
                $name = $db->getName($id);
                $price = $db->getPrice($id);

                echo "<p>$name <span class='price'>$$price</span></p>";
                $total_price = $total_price + $price;
            }

            echo "<div class='total-wrapper'>
                    <p class='total-sum'>Total: <span class='price'>$$total_price</span></p>
                </div>"

            ?>
        </div>
    </main>
</body>


</html>