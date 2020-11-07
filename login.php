<!DOCTYPE html>
<?php
//form letting the user login to the website, sending a post to check_login.php
session_start();
if(isset($_SESSION['login']) && $_SESSION['login'] == true){
    header('location: home.php');
}
?>
<html lang="fr" class="clogin">
<link rel="stylesheet" type="text/css" href="style_site.css">
<head>
    <meta charset="utf-8">
    <title>Login</title>
</head>
<body class="text_box">
<div class="line">
    <h1>Bienvenue sur UnTrollBienMécontent.fr</h1>
    <p class="white_text">
        Discutez de vos jeux favoris, avec une communauté active et sympathique !
    </p>
    <br/><br>
    <form class="white_text" method ="post" action="check_login.php">
        <label for="pseudo">Username:</label>
        <input type="text" name="pseudo" placeholder="Username" required>

        <label for="pwd">Password:</label>
        <input type="password" name="pwd" placeholder="Password" required>

        <button type="submit" class="bouton_log_sign">Login</button>

    </form>
    <div class="white_text">
    <?php
    //case if no username were found
    if(isset($_GET['failed'])){
        echo("<br/>Ce compte n'existe pas<br/>");
    }
    //case where the username was found, the the password didn't match
    if(isset($_GET['failed2'])){
        echo("<br/>Le mot de passe est erroné, veuillez réessayer<br/>");
    }
    //case where a signing in was successfull
    if(isset($_GET['success'])){
        echo("<br/>Compte crée avec succès, veuilliez vous connecter<br/>");
    }
    ?>
    </div>
    <p class="white_text"><br>Pas encore membre ? <a href="create_account.php">Inscrivez-vous ici !</a></p>//link t

  </div>
  </body>
</html>
