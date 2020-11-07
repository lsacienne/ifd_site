<!DOCTYPE html>
<html lang="fr" class="cover">
<head>
  <meta charset="utf-8">
  <title>Homepage</title>
</head>
<body>

<?php
  include 'header.php';
  echo'<div class="corps">';
  $db = new PDO("mysql:host=localhost;dbname=projetifd;charset=utf8","root","");
  $jeux = $db->prepare("SELECT nom,prix,editeur,nom_categorie FROM jeux INNER JOIN link_categorie_jeux ON jeux.id = link_categorie_jeux.id_jeux INNER JOIN categorie ON categorie.id = link_categorie_jeux.id_categorie ;");
  $jeux->execute();
  $line = $jeux->fetch();

  $in = FALSE; //To avoid displaying the same game several times
  $test = NULL; //To avoid displaying the same game several times

  while($line){
      $nom = $line['nom'];
      $editeur = $line['editeur'];
      $prix = $line['prix'];

      /************Query for getting the game's categories**************/
      $categories = $db->prepare("SELECT nom_categorie FROM categorie INNER JOIN link_categorie_jeux ON categorie.id = link_categorie_jeux.id_categorie INNER JOIN jeux ON link_categorie_jeux.id_jeux = jeux.id WHERE jeux.nom = '$nom';");
      $categories->execute();
      $tmp2= $categories->fetch();
      $categorie = $tmp2['nom_categorie'];
      $tmp2 = $categories->fetch();

      /************Concatenating categories' name**********************/
      while($tmp2){
        $categorie = $categorie . ', ' . $tmp2['nom_categorie'];
        $tmp2 = $categories->fetch();
      }

      /*********Query for getting the average note*********************/
        $avgnote = $db->prepare("SELECT DISTINCT AVG(note) as average FROM critiques INNER JOIN jeux ON critiques.id_jeu = jeux.id WHERE jeux.nom = '$nom';  ");
        $avgnote->execute();
        $tmp3 = $avgnote->fetch();

    /************Checking if a game has already been displayed******/
    if( ($test != $nom) ){
      $in = FALSE;
      $test  = $nom;
    }
  /***********Displaying the game********************/
    if((!$in)){
      ?>
        </br><a href="home.php"><img src="<?=$nom?>.jpg" alt="Image" height="80" width = "80"> </a><br/>
    <?php
      $in = TRUE;
      echo('<b>'. $nom . '</b>' . ' - ' . round($tmp3['average'],1) . '/10' . '</br>');
      echo("Par $editeur - $prix euros</br>");
      echo ("$categorie<br/>");
    }
    $line = $jeux->fetch();

  }


 ?>



    </div>
</body>
</html>
