<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Critique</title>
  </head>
  <body>
    <?php
      include 'header.php';
      if(!(isset($_GET['id']))){
        echo("<br/>La page n'existe pas, désolé");
      }else{
        $id = $_GET['id'];
        $db = new PDO( "mysql:host=localhost;dbname=projetifd;charset=utf8","root","");
        $sql = 'SELECT utilisateur.id AS user_id,pseudo,jeux.id AS game_id,jeux.nom AS game_name,note,content,date_crit,up,down FROM utilisateur INNER JOIN critiques ON utilisateur.id = critiques.id_utilisateur INNER JOIN jeux ON jeux.id = critiques.id_jeu WHERE critiques.id = '.$id;
        $req = $db->prepare($sql);
        $req->execute();
        $critique = $req->fetch();
        echo('
          <p><h1>Critique de '. $critique['pseudo'].' sur : <a href="game.php?id='.$critique['game_id'].'">'.$critique['game_name'].'</a></h1>
          Réalisé le '.$critique['date_crit'].'</p>
          <p>
          '.$critique['content'].'
          </p>
          <h1>Note : '.$critique['note'].'/10</h1>
        ');
      }
    ?>
  </body>
</html>
