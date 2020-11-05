<!DOCTYPE html>
<html lang="en" dir="ltr" class="cover">
  <head>
    <meta charset="utf-8">
    <title>Critique</title>
  </head>
    <?php
      include 'header.php';
      echo'<div class="corps">';
      include 'print_comment.php';
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
          <div class="rubrique">
              <div class="titre_rubrique">'.$critique['crit_name'].'</div></br>
              <p class="right"><b>Critique de<a href="profile.php?id='.$critique['user_id'].'"> '. $critique['pseudo'].' </a>sur : <a href="game.php?id='.$critique['game_id'].'">'.$critique['game_name'].'</a></b>
              Réalisé le '.$critique['date_crit'].'</p></br>
              <p class="texte_corps">
              '.nl2br($critique['content']).'
              </p>');
        if($critique['note']>=5){
            echo('
                <div class="note good" >Note : '.$critique['note'].'/10</div>
          </div>
            ');
        } else {
            echo('
                <div class="note bad">Note : '.$critique['note'].'/10</div>
          </div>
        ');
        }


        /* SYSTEME DE UPVOTE */

        echo '<div class="menu_upvote">';
        $sql = 'SELECT SUM(value) AS value FROM link_utilisateur_score WHERE id_critiques ='.$id;
        $req = $db->prepare($sql);
        $req->execute();
        $upvotes = $req->fetch();
        echo('<b>Upvotes:</b>  ');
        $sql = 'SELECT value FROM link_utilisateur_score WHERE id_critiques ='.$id.' AND id_utilisateur='.$_SESSION['id'].';';
        $req = $db->prepare($sql);
        $req->execute();
        $uservote = $req->fetch();
        $textPlus = "<button class='up_down'>+</button>";
        $textMinus = "<button class='up_down'>-</button>";
        if(isset($uservote['value'])){
          if($uservote['value']==1){
            $textPlus="<button class='up_down up'>+</button>";
          }else{
            $textMinus="<button class='up_down down'>-</button>";
          }
        }
        echo '<a href = "update_votes.php?value=1&id='.$id.'">'.$textPlus.'</a> <a href = "update_votes.php?value=-1&id='.$id.'">'.$textMinus.'</a><b>'.(0+$upvotes['value']).' </b></div>';
        echo '<div class="commentaire"><b class="titre">Commentaires:</b><br/>';

    ?>
                <br/>
                <form method="post" action="add_comment.php?id=<?php echo($_GET['id'])?>">
                  <label for="input"></label>
                  <input type="text" name="input" maxlength="100" size="80" placeholder="Ecrire un commentaire...">
                  <button type="submit">></button>
                </form>

    <?php
        printComs($id,NULL,0,$db);
      }
    ?>
            </div>
    </div>
  </body>
</html>
