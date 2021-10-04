<html>

<head>
  <title>Plants 'n' stuff</title>
  <link rel="stylesheet" href="../styles/index.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=WindSong" />
</head>

<?php include('header.php') ?>

<body>
  <main>
    <div class="products">
      <?php
      require_once('csrf.php');
      $db = new Database();
      $products = $db->getProducts();

      for ($i = 0; $i < sizeof($products); $i++) {
        $product = $products[$i];
        $id = $product[0];
        $name = $product[1];
        $price = $product[2];

        echo "<div class='product-card'>
                <img src='../images/$name.jpg' />
                <p class='product-name'>$name</p> 
                <p class='price'>$$price</p>
                <form method='POST' action='addToCart.php'>
                  <input type='hidden' name='id' value='$id' />
                  <input type='submit' value='Add to cart' />
                " . csrf_input_field() . "
                </form>
              </div>";
      }

      ?>
    </div>
  </main>
</body>

</html>