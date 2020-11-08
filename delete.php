<!DOCTYPE html>
<!--This file is a form used to ask the user if he really wants to delete its profile-->
<html lang="en" dir="ltr" class="cover">
  <head>
    <meta charset="utf-8">
    <title>supprimer ?</title>
  </head>
  <body>
    <?php include'header.php';?>
    <div class="corps">
        <div class="titre_page">ATTENTION</div>
        <br/>
        <div class="center">
            <b>Supprimer votre compte est irréversible, vous perderez toutes vos informations.<br/>
            Etes-vous sur ?</b>
            <a href="delete_account.php?confirm=1">Oui, supprimer mon compte !</a>
        </div>
    </div>
  </body>
</html>
