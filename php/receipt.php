<html>

<head>
    <title>Plants 'n' stuff</title>
    <link rel="stylesheet" href="../styles/index.css" />
    <link rel="stylesheet" href="../styles/receipt.css" />

    <!-- Linking web fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=WindSong" />
</head>

<header>
    <!-- Temporary working title for web shop -->
    <h1><a href="../index.php">Plants 'n' stuff</a></h1>
    <?php
    session_start();
    if (isset($_SESSION["curr_user"])) {
        $curr_user = $_SESSION["curr_user"];
        echo "<h2>Welcome, $curr_user!</h2>";
    } else {
        echo "<h2>Welcome!</h2>";
    }
    ?>
    <nav>
        <ul>
            <li><a href="#">Nav item 1</a></li>
            <li><a href="#">Nav item 2</a></li>
            <li><a href="#">Nav item 3</a></li>
        </ul>
    </nav>
</header>

<body>
    <main>
        <div id="receipt">
            <h2>Receipt</h2>

            <?php

            // Initializing cookie values for testing, 
            // will be set from "Add to cart" later
            session_start();
            $chosen_products = array(array("Monstera", 14.99), array("Cactus", 9.99));
            $_SESSION["products"] = $chosen_products;

            // ––––––––––––––––
            // Building up the receipt from products that have been purchased
            $total_price = 0;
            for ($i = 0; $i < sizeof($_SESSION["products"]); $i++) {
                $name = $_SESSION["products"][$i][0];
                $price = $_SESSION["products"][$i][1];

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