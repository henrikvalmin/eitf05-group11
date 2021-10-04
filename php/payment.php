<?php
require_once('csrf.php');
session_start();

?>

<head>
    <title>Plants 'n' stuff</title>
    <link rel="stylesheet" href="../styles/index.css" />
    <link rel="stylesheet" href="../styles/payment.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=WindSong" />
</head>

<?php include('header.php') ?>

<body>
    <main>

        <form id="payment" method="POST" action="receipt.php">
            <h3>Payment</h3>
            <p>
                <label for="name">Name</label>
                <input type="text" name="name" required />
            </p>
            <p>
                <?php
                $address = "";
                if (isset($_SESSION["curr_user"])) {
                    $db = new Database();
                    $address = $db->getAddress($_SESSION["curr_user"]);
                }
                ?>
                <label for="address">Address</label>
                <input type="text" name="address" value="<?php echo $address ?>" required />
            </p>
            <p>
                <label for="cardnumber">Card number</label>
                <input type="text" name="cardnumber" required />
            </p>
            <div>

                <p>
                    <label for="expiration">Expiration Date (mm/yy)</label>
                    <input type="text" name="expiration" required />
                </p>
                <p class="small">
                    <label for="securitycode">Security Code</label>
                    <input type="text" name="securitycode" required />
                </p>
            </div>
            <p>
                <?php echo csrf_input_field(); ?>
                <input type="submit" value="Place order" />
            </p>
        </form>
    </main>
</body>