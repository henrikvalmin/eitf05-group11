<!DOCTYPE html>
<html>

<head>
  <title>Plants 'n' stuff</title>
  <link rel="stylesheet" href="styles/index.css" />

  <!-- Linking web fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=WindSong" />

  <script type="module" src="js/login.js"></script>
  <script type="module" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

</head>

<header>
  <!-- Temporary working title for web shop -->
  <h1><a href="#">Plants 'n' stuff</a></h1>
  <nav>
    <ul>
      <li><a href="#">Nav item 1</a></li>
      <li><a href="#">Nav item 2</a></li>
      <li><a href="#">Nav item 3</a></li>
    </ul>
  </nav>
</header>

<aside>
  <!-- login form -->
  <div id="login" class="tabcontent">
    <h2>Log in</h2>
    <form method="POST" id="login-form">
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
        <button id="loginSubmit" name="submitLogIn" type="button">Log in</button>
      </p>

    </form>
  </div>
  <!--End of login div -->
</aside>

<body>

  <main>

    <div class="products">
      <?php
      $names = array("Monstera", "Peperomia", "Cactus", "Succulent");
      $prices = array(14.99, 7.99, 9.99, 12.99);

      for ($x = 0; $x < sizeof($names); $x++) {
        echo "<div class='product-card' id='$names[$x]'>
                <img src='images/$names[$x].jpg' />
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
    </script>
  </main>


</body>



</html>