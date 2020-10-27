<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
  <?php
    include 'header.php';
    echo'<h1>Rédiger une réponse</h1>';
    $db = new PDO("mysql:host=localhost;dbname=projetifd;charset=utf8","root","");
    $sql ='SELECT content,pseudo FROM reponses INNER JOIN utilisateur ON reponses.id_auteur = utilisateur.id WHERE reponses.id='.$_GET['id'];
    $req = $db->prepare($sql);
    $req->execute();
    $com = $req->fetch();
    if(!($com)){header('location: error.html');}
    echo('<b>'.$com['pseudo'].':</b> '.$com['content'].'<br/><br/>')
  ?>
  <form method="post" action="add_reply.php?id=<?php echo($_GET['id'])?>">
    <label for="input">Réponse:</label>
    <input type="text" name="input" maxlength="100" size="50">
    <button type="submit">Reply</button>
  </form>
  </body>
</html>
