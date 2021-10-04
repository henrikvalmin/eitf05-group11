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
            if (isset($_POST["csrf_token"]) && check_token($_POST["csrf_token"])) {
                $db = new Database();
                $_SESSION["bought_items"] = $_SESSION["cart"];
                $_SESSION["cart"] = array();
                $bought_items = $_SESSION["bought_items"];

                // Empty receipt message
                if (sizeof($bought_items) == 0) {
                    echo "<h3>Your cart was empty!</h3>";
                    return;
                }

                // Non-empty receipt message
                $total_price = 0;
                foreach ($bought_items as $id => $num) {
                    $name = $db->getName($id);
                    $price = $db->getPrice($id);

                    echo "<p>$num x $name <span class='price'>$$price</span></p>";
                    $total_price = $total_price + $num * $price;
                }
                echo    "<div class='total-wrapper'>
                        <p class='total-sum'>Total: <span class='price'>$$total_price</span></p>
                    </div>";
            } else {
                echo "<h3>Token invalid!</h3>";
            }
            ?>
        </div>
    </main>
</body>


</html>