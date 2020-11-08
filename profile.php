<!DOCTYPE html>

<?php
  if(!isset($_GET['id'])){
    header("location: error.html");
  }
  $db = new PDO("mysql:host=localhost;dbname=projetifd;charset=utf8","root","");
  $req = $db->prepare("SELECT pseudo, nom, prenom, bio, date_de_creation FROM utilisateur WHERE id = ".$_GET['id']);
  $req->execute();
  $usr = $req->fetch();
?>
<html lang="fr" dir="ltr" class="cover">
  <head>
    <meta charset="utf-8">
    <title><?php echo($usr['pseudo']);?></title>
  </head>
  <body>

        <?php
          include 'header.php';

          /************************************************/
          echo('
            <div class="corps">
                <div class="titre_page">'.$usr['pseudo'].'</div>');
        /*****************Friend request***************/
        $id = $_GET['id'];
        $req2 = $db->query("SELECT * FROM utilisateur;");
        $data = $req2->fetchALL();

        for ($i=0; $i < sizeof($data) ; $i++) {
            if( (!in_array($data[$i]['pseudo'],$user_check)) && ($data[$i]['id'] == $id) ){
                echo  "<div class='demande_ami'><a href='friend_action.php?action=add&id=".$data[$i]['id']." '> Demander en ami</a></div>";
            }
        }
          echo('
                <div class="rubrique">
                    <h2>'.$usr['prenom'].' '.$usr['nom'].'</h2><b> - Membre depuis le '.$usr['date_de_creation'].'</b><br/>
                    <br/><i>'.nl2br($usr['bio']).'<i/>
                    <br/>
                </div>
                <div class="rubrique">
                    <h2>Critiques</h2>
          ');

          $req = $db->prepare("SELECT critiques.id AS crit_id, critiques.nom AS crit_nom, jeux.nom AS jeu_nom, note, date_crit FROM critiques INNER JOIN jeux ON critiques.id_jeu = jeux.id WHERE critiques.id_utilisateur = ".$_GET['id']);
          $req->execute();
          $crit = $req->fetch();
          while($crit){
            echo('
                  <b>Critique du '.$crit['jeu_nom'].' réalisé le '.$crit['date_crit'].' :</b><br/>
                  <a href="critique.php?id='.$crit['crit_id'].'" class="crit_com">'.$crit['crit_nom'].'('.$crit['note'].'/10) </a></b>
                  <br/><br/>
            ');
            $crit = $req->fetch();
          }

          echo('
                </div>
                <div class="rubrique">
                    <h2>Commentaires</h2>');
          $req = $db->prepare("SELECT critiques.nom AS crit_nom, critiques.note AS crit_note, critiques.id AS crit_id,reponses.content AS com FROM reponses INNER JOIN critiques ON reponses.id_critiques = critiques.id WHERE reponses.id_auteur =".$_GET['id']);
          $req->execute();
          $com = $req->fetch();
          while($com){
            echo('
              <b><a href="critique.php?id='.$com['crit_id'].'">Sur '.$com['crit_nom'].'('.$com['crit_note'].'/10):</a></b><br/>
              <i class="crit_com">'.$com['com'].'</i>
              <br/><br/>
            ');
            $com = $req->fetch();
          }
        ?>
            </div>
    </div>
  </body>
</html>
