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
  $jeux = $db->prepare("SELECT id,nom,prix,editeur,picture FROM jeux ");
  $jeux->execute();
  $line = $jeux->fetch();

  $in = FALSE; //To avoid displaying the same game several times
  $test = NULL; //To avoid displaying the same game several times

  while($line){
    $categorie = "";
    $nom = $line['nom'];
    $editeur = $line['editeur'];
    $prix = $line['prix'];

    /************Query for getting the game's categories**************/
    $categories = $db->prepare("SELECT nom_categorie FROM link_categorie_jeux INNER JOIN categorie ON categorie.id = link_categorie_jeux.id_categorie WHERE link_categorie_jeux.id_jeux =".$line['id']);
    $categories->execute();
    $tmp2= $categories->fetch();
    /************Concatenating categories' name**********************/
    while($tmp2){
      $categorie = $categorie . ' ' . $tmp2['nom_categorie'];
      $tmp2 = $categories->fetch();
    }

    /*********Query for getting the average note*********************/
    $avgnote = $db->prepare("SELECT DISTINCT AVG(note) as average FROM critiques INNER JOIN jeux ON critiques.id_jeu = jeux.id WHERE jeux.nom = '$nom';  ");
    $avgnote->execute();
    $tmp3 = $avgnote->fetch();


    echo('</br><a href="game.php?id='.$line['id'].'"><img src="data:image/jpeg;base64, '.base64_encode($line['picture']).'" height="80" name="image"/></a><br/>');
    echo('<b>'. $nom . '</b>' . ' - ' . round($tmp3['average'],1) . '/10' . '</br>');
    echo("Par $editeur - $prix euros</br>");
    echo ("$categorie<br/>");
    $line = $jeux->fetch();
    //"<img src='data:image/jpeg;base64,".$i["image"]."'/ height='250'name='image'></img>"
  }
?>
</div>
</body>
</html>
