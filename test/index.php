<?php
include_once 'header.php';
?>

<!-- 
<aside>
  <div id="login" class="tabcontent">
    <h2>Log in</h2>
    <form method="POST" id="login-form" action="php/login.php">
      <p>
        <input type="text" name="username" id="Username" placeholder="Username" required />
        <label for="Username">Username</label>
      </p>

      <p>
        <input type="password" name="password" id="Password" placeholder="Password" required />
        <label for="Password">Password</label>
        <a id="forgot-password">Forgot password?</a>
      </p>

      <p>
        <input type="submit" id="loginSubmit" name="submitLogIn" value="Log in" />
      </p>

    </form>
  </div>
</aside> -->

<body>

  <main>

    <div class="products">
      <?php
      $names = array("Monstera", "Peperomia", "Cactus", "Succulent");
      $prices = array(14.99, 7.99, 9.99, 12.99);

      for ($x = 0; $x < sizeof($names); $x++) {
        echo "<div class='product-card' id='$names[$x]'>
                <img src='../images/$names[$x].jpg' />
                <p class='product-name'>$names[$x]</p> 
                <p class='price'>$$prices[$x]</p>
                <p class='add-to-cart'>Add to cart</p>
              </div>";
      }
      ?>
    </div>


    <!-- Inline script for printing which item is added to the cart -->
    <script>
      let cards = document.querySelectorAll('.product-card');
      for (let card of cards) {
        let button = card.querySelector('.add-to-cart');
        button.addEventListener('click', (event) => {
          console.dir('---');
          console.dir("Clicked: " + button.parentNode.id);
        });
      }
      document.cookie["products"] = ["Monstera", "9.99"]
    </script>
  </main>


</body>



</html>
