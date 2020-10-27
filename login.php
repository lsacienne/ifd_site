<!DOCTYPE html>
<?php
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
        <label for="uname">Username:</label>
        <input type="text" name="uname" placeholder="Username" required>

        <label for="pwd">Password:</label>
        <input type="password" name="pwd" placeholder="Password" required>

        <button type="submit" class="bouton_log_sign">Login</button>

    </form>
    <div class="white_text">
    <?php
    if(isset($_GET['failed'])){
        echo("<br/>Connection failed, please try again :(<br/>");
    }
    if(isset($_GET['success'])){
        echo("<br/>Account created succesfully, please log in :)<br/>");
    }
    ?>
    </div>
    <p class="white_text"><br>Pas encore membre ? <a href="create_account.php">Inscrivez-vous ici !</a></p>

  </div>
  </body>
</html>

