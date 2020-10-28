<!DOCTYPE html>
<html lang="en" dir="ltr" class="cover">
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
        $sql = 'SELECT utilisateur.id AS user_id,pseudo,jeux.id AS game_id,jeux.nom AS game_name,critiques.nom AS crit_name,note,content,date_crit FROM utilisateur INNER JOIN critiques ON utilisateur.id = critiques.id_utilisateur INNER JOIN jeux ON jeux.id = critiques.id_jeu WHERE critiques.id ='.$id;
        $req = $db->prepare($sql);
        $req->execute();
        $critique = $req->fetch();
        echo('
          <h1>'.$critique['crit_name'].'</h1>
          <b>Critique de '. $critique['pseudo'].' sur : <a href="game.php?id='.$critique['game_id'].'">'.$critique['game_name'].'</a></b>
          Réalisé le '.$critique['date_crit'].'</p>
          <p>
          '.$critique['content'].'
          </p>
          <h1>Note : '.$critique['note'].'/10</h1>
        ');
        $sql = 'SELECT SUM(value) AS value FROM link_utilisateur_score WHERE id_critiques ='.$id;
        $req = $db->prepare($sql);
        $req->execute();
        $upvotes = $req->fetch();
        echo('<h3><b>Upvotes: '.(0+$upvotes['value']).'</b><br/>');
        $sql = 'SELECT value FROM link_utilisateur_score WHERE id_critiques ='.$id.' AND id_utilisateur='.$_SESSION['id'].';';
        $req = $db->prepare($sql);
        $req->execute();
        $uservote = $req->fetch();
        $textPlus = "+";
        $textMinus = "-";
        if(isset($uservote['value'])){
          if($uservote['value']==1){
            $textPlus="<mark>+</mark>";
          }else{
            $textMinus="<mark>-</mark>";
          }
        }
        echo '<a href = "update_votes.php?value=1&id='.$id.'">'.$textPlus.'<a/> / <a href = "update_votes.php?value=0&id='.$id.'">0<a/> / <a href = "update_votes.php?value=-1&id='.$id.'">'.$textMinus.'<a/>';







      }
    ?>
  </body>
</html>
