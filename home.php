<!DOCTYPE html>
  <html lang="en" dir="ltr">
    <head>
      <meta charset="utf-8">
      <title>Homepage</title>
    </head>
    <body>
      a
      a
      a
      a
      a









      <?php
        session_start();
        if($_SESSION['login']){
          echo "Bienvenue, ",$_SESSION['uname'];
        }else{
          header('location: login.php');
       }
      ?>
    </body>
    <form action="logout.php">
      <input type="submit" value="Logout"/>
    </form>
</html>
