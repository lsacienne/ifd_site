<?php
  session_start();
  if($_SESSION['login']){
    echo "Connecté en tant que ",$_SESSION['uname'],"(",$_SESSION['id'],")";
    echo('
       <form action="logout.php">
         <input type="submit" value="Logout"/>
       </form>
       <form action="critics_input.php">
         <input type="submit" value="Add critic"/>
       </form>
       <form action="home.php">
         <input type="submit" value="Home"/>
       </form>
      ');
  }else{
    header('location: login.php');
  }
?>
