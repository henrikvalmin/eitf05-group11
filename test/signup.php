<?php
include_once 'header.php';
?>

 <section class="signup-form">
  <div id="login" class="tabcontent">
     <h2>Sign Up</h2>
       <form action="./inc/signup.inc.php" method="post" id="login-form">
       <p>
       <input type="text" name="address" placeholder="Address..." required>
        <label for="address">Address</label>
      </p>
      <p>
      <input type="test" name="username" placeholder="Username..." required>
        <label for="Username">Username</label>
      </p>
      <p>
      <input type="password" name="pwd" placeholder="Password..." required>
        <label for="pwd">Password</label>
    </p>
    <p>
      <input type="password" name="pwdrepeat" placeholder="Repeat password..." required>
        <label for="pwdrepeat">Repeat password</label>
      </p>
      <p>
       <button type="submit" name="submit">Sign Up</button>
       </p>
     </form>
    </div>
    <?php
 if(isset($_GET["error"])){
   if($_GET["error"] == "invalidUsername"){
     echo "<p> Username is invalid, only letters and numbers or allowd</p>";
   } 
   else if($_GET["error"] == "pwdMatch"){
     echo "<p> Passwords doesn't match! </p>";
   }
    else if($_GET["error"] == "usernameExists"){
    echo "<p> This username is already exists! </p>";
  }
  else if($_GET["error"] == "statementtFailed"){
    echo "<p> Something thing went wrong! (db)  </p>";
 }
 else if($_GET["error"] == "none"){
  echo "<p> You have signed up! </p>";
}
 }
?>
 </section>
