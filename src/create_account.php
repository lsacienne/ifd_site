<!DOCTYPE html>
<!--This file is a form for account creation-->
<link rel="stylesheet" type="text/css" href="style_site.css">
<html lang="en" dir="ltr" class="clogin">
<?php
  session_start();
  if(isset($_SESSION['login']) && $_SESSION['login'] == true){
    //send back the user to the homepage if he is allready logged in
    header('location: home.php');
  }
?>
  <head>
    <meta charset="utf-8">
    <title>Inscription</title>
  </head>
  <body class="text_box">
  <div class="line">
    <h1>Inscription au site </h1>

    <p class="white_text">Entre tes informations ci dessous<p/><br/>
    <form class="white_text" method="post" action="add_account.php">
	    <label for="lastname">Nom:</label>
	    <input name="lastname" type="text" required/> <br /><br />

	    <label for="name">Prénom:</label>
	    <input name="name" type="text" required/> <br /><br />

	    <label for="uname">Pseudo:</label>
	    <input name="uname" type="text" required/> <br /><br />

      <label for="birthdate">Date de naissance:</label>
	    <input name="birthdate" type="date" required/> <br /><br />

      <label for="bio">Bio:<br></label>
	    <textarea name="bio" cols="40" rows="5"></textarea><br /><br />

  	  <label for="mail">Email:</label>
	    <input name="mail" type="email" required/> <br /><br />

      <label for="pwd">Mot de passe:</label>
      <input name="pwd" type="password" maxlength="50" required/> <br /><br />

      <button type="submit" class="bouton_log_sign">Create account</button>
    </form>
  </div>
    <?php
      if(isset($_GET['failed'])){
        //case where the username or mail entred by the user are allready used by another user
        echo("<br/>La création du compte a échoué :( essayez un autre pseudo/adresse email<br/>");
      }
     ?>
  </body>
</html>
