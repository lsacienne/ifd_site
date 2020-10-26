<!DOCTYPE html>
<?php
  session_start();
  if(isset($_SESSION['login']) && $_SESSION['login'] == true){
    header('location: home.php');
  }
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Inscription</title>
  </head>
  <body>
    <h1>Inscription au site </h1>
    <p>Entre tes informations ci dessous<p/><br/>
    <form method="post" action="add_account.php">
	    <label for="lastname">Nom:</label>
	    <input name="lastname" type="text" required/> <br /><br />

	    <label for="name">Prénom:</label>
	    <input name="name" type="text" required/> <br /><br />

	    <label for="uname">Pseudo:</label>
	    <input name="uname" type="text" required/> <br /><br />

      <label for="birthdate">Date de naissance:</label>
	    <input name="birthdate" type="date" required/> <br /><br />

      <label for="bio">Bio:</label>
	    <textarea name="bio" cols="40" rows="5"></textarea><br /><br />

  	  <label for="mail">Email:</label>
	    <input name="mail" type="email" required/> <br /><br />

      <label for="pwd">Mot de passe:</label>
      <input name="pwd" type="password" required/> <br /><br />

      <button type="submit">Create account</button>
    </form>
    <?php
      if(isset($_GET['failed'])){
        echo("<br/>La création du compte a échoué :( essayez un autre pseudo/adresse email<br/>");
      }
     ?>
  </body>
</html>
