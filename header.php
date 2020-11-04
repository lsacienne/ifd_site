<!DOCTYPE html>
  <html lang="en" dir="ltr">
    <head>
      <meta charset="utf-8">
      <title>Header</title>
    </head>
    <body>
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

<form method="post" action="search.php" >

<br/><br/><label for="recherche"></label>
<input name="recherche" type="text" placeholder="Rechercher un jeu..."/><br /><br/>
<button type="submit">Rechercher</button>

</form>

</body>
</html>
