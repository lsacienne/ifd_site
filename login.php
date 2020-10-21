<!DOCTYPE html>
<?php
  session_start();
  if(isset($_SESSION['login']) && $_SESSION['login'] == true){
    header('location: home.php');
  }
?>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
  </head>
  <body>
    <form method="post" action="check_login.php">
      <label for="uname">Username:</label>
      <input type="text" name="uname" placeholder="Username" required><br/>

      <label for="pwd">Password:</label>
      <input type="password" name="pwd" placeholder="Password" required><br/>

      <button type="submit">Login</button>

    </form>
    <?php
      if(isset($_GET['failed'])){
        echo("<br/>Connection failed, please try again :(");
      }
     ?>
  </body>
</html>
