<?php
include_once 'header.php';
?>

<link rel="stylesheet" href="../styles/index.css" />

 <section class="signup-form">
  <div id="login" class="tabcontent">
    <main>
    <form action="./inc/signup.inc.php" method="post" id="login-form">
    <h3>Sign Up</h3>
    <p>
      <input type="text" name="username" placeholder="Username..." required minlength="3" >
      <label for="Username">Username</label>
    </p>
    <p>
      <input type="password" name="pwd" placeholder="Password..." required minlength="8">
      <label for="pwd">Password</label>
    </p>
    <p>
      <input type="password" name="pwdrepeat" placeholder="Confirm password..." required minlength="8">
      <label for="pwdrepeat">Confirm password</label>
    </p>
    <p>
    <input type="text" name="address" placeholder="Address..." required >
      <label for="address">Address</label>
    </p>
      <input type="submit" name="submit" value="Submit">
      <input type="reset">
      <element id= "login-reference"><a href="login.php">Already have an account? Log in </a></element> 
    </form>
    </main>
    </div>

<?php
if(isset($_GET["error"])){
    if($_GET["error"] == "invalidUsername"){
        echo "<p><center>Username is invalid, only letters and numbers or allowed</center></p>";
    } 
    else if($_GET["error"] == "pwdMatch"){
      echo "<p><center> Passwords don't match!</center></p>";
    }
    else if($_GET["error"] == "usernametaken"){
      echo "<p><center> Username is already taken!</center></p>";
    }
    else if($_GET["error"] == "statementFailed"){
      echo "<p><center>Something thing went wrong! (db)</center> </p>";
    }
    else if($_GET["error"] == "passwordtooweak"){
      echo "<p><center>Password is too weak, try again!</center></p>";
    }
    else if($_GET["error"] == "invalidPassword"){
      echo "<p><center>Password must be atleast 8 characters, 1 uppercase letter and 1 digit!</center></p>";
    }
    else if($_GET["error"] == "none"){
      echo "<p><center>You have signed up!</center></p>";
    }
}
?>
</section>
