<!DOCTYPE html>
<html lang="en" dir="ltr" class="cover">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
  <?php
    //This file is used so users can reply to a comment (to add a comment to a reveiw, it's on the review page)
    include 'header.php';

    echo'<div class="corps">';
    echo'<b class="commentaire">Rédiger une réponse</b></br></br>';

    //get the comment data from the table form an id sent through the url
    $db = new PDO("mysql:host=localhost;dbname=projetifd;charset=utf8","root","");
    $sql ='SELECT content,pseudo FROM reponses INNER JOIN utilisateur ON reponses.id_auteur = utilisateur.id WHERE reponses.id='.$_GET['id'];
    $req = $db->prepare($sql);
    $req->execute();
    $com = $req->fetch();
    //if the comment doesn't exist, send the user to an error page
    if(!($com)){header('location: error.html');}


    //display the username from the comment's author and the comment
    echo('<b>'.$com['pseudo'].':</b> '.$com['content'].'<br/><br/>')
  ?>
  <form method="post" action="add_reply.php?id=<?php echo($_GET['id'])?>">
      <div class="commentaire">
          <label for="input">Réponse:</label>
          <input type="text" name="input" maxlength="100" size="50">
          <button type="submit" id="submit_corps">Reply</button>
      </div>
  </form>
  </div>
  </body>
</html>
