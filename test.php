<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Critiques</title>
  </head>
  <body>
    <?php
      include 'header.php';
    ?>

    <?php
      /********Query for getting critics infos**********************/
      $db = new PDO("mysql:host=localhost;dbname=projetifd;charset=utf8","root","");
      $req = $db->prepare("SELECT jeux.id AS idj,utilisateur.id AS userid,date_crit,critiques.content AS content,critiques.nom AS crit_nom,jeux.nom AS jeu_nom,pseudo FROM critiques INNER JOIN link_utilisateur_score ON link_utilisateur_score.id_critiques = critiques.id INNER JOIN utilisateur ON link_utilisateur_score.id_utilisateur = utilisateur.id INNER JOIN jeux ON critiques.id_jeu = jeux.id;");
      $req->execute();
      $line = $req->fetch();

     /******************Sorting and displaying results**********************************/

     $nb_displayed = 0;
      while($line){
          $id = $line['userid'];
          $idj = $line['idj'];
          $date_crit = strtolower($line['date_crit']);
          $content = strtolower($line['content']);
          $nom_crit = strtolower($line['crit_nom']);
          $nom_jeu = strtolower($line['jeu_nom']);
          $pseudo = strtolower($line['pseudo']);


          /*********Query for getting the values sum*********************/
            $req_sum = $db->prepare("SELECT DISTINCT SUM(value) as sumv FROM critiques INNER JOIN link_utilisateur_score ON critiques.id = link_utilisateur_score.id_critiques WHERE critiques.id_jeu = '$idj' AND critiques.id_utilisateur = $id  ;  ");
            $req_sum->execute();
            $sum = $req_sum->fetch();
          


          /***********Displaying the critics with the best votes********************/
          //on veut display les 3 critiques ayant les meilleurs votes(sum)
          //compliqué étant donné qu'on récupère 1 crit par 1 crit








          $line = $req->fetch();
        }
  ?>

    </body>
  </html>
