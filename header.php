<?php
  session_start();
  if($_SESSION['login']){
    echo "Connecté en tant que ",$_SESSION['uname'],"(",$_SESSION['id'],")";
    echo('
       <form action="logout.php">
         <input type="submit" value="Logout"/>
       </form>
      ');
  }else{
    header('location: login.php');
  }
?>
