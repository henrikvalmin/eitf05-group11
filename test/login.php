<?php
include_once 'header.php';
?>

 <section class="signup-form">
  <div id="login" class="tabcontent">
     <h2>Log In</h2>
       <form action="./inc/login.inc.php" method="post" id="login-form">
      <p>
      <input type="test" name="username" placeholder="Username..." required>
        <label for="Username">Username</label>
      </p>
      <p>
      <input type="password" name="pwd" placeholder="Password..." required>
        <label for="pwd">Password</label>
    </p>
      <p>
       <button type="submit" name="submit">Log In</button>
       </p>
     </form>
    </div>
    <?php
 if(isset($_GET["error"])){
   if($_GET["error"] == "invalidUsername"){
     echo "<p> Username is invalid, only letters and numbers or allowd</p>";
   } 
   else if($_GET["error"] == "wronglogin"){
     echo "<p> Wrong login! </p>";
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