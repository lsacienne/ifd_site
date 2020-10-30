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
    </br></br><h1>Résultats</h1>



      <label for="tris">Trier par:</label>
      <select onchange="location.href=this.options[this.selectedIndex].value">
      <option value="note_sorting.php">note</option>
      <option value="price_sorting.php">prix</option>
      </select><br/><br/>
    <?php


      /********Requête trier note**********************/
      $recherche = strtolower($_SESSION['recherche']);
      $db = new PDO("mysql:host=localhost;dbname=projetifd;charset=utf8","root","");
      $req = $db->prepare("SELECT DISTINCT jeux.nom,prix,editeur,nom_categorie FROM jeux INNER JOIN link_categorie_jeux ON jeux.id = link_categorie_jeux.id_jeux INNER JOIN categorie ON categorie.id = link_categorie_jeux.id_categorie INNER JOIN critiques ON critiques.id_jeu = jeux.id ORDER BY (SELECT AVG(note) FROM critiques WHERE critiques.id_jeu = jeux.id );");
      $req->execute();
      $line = $req->fetch();

  /******************Affichage des résultats*****************************************/

    $in = FALSE;
    $tmp = NULL;
  while($line){
      $nom = strtolower($line['nom']);
      $editeur = strtolower($line['editeur']);
      $prix = strtolower($line['prix']);

      $req2 = $db->prepare("SELECT nom_categorie FROM categorie INNER JOIN link_categorie_jeux ON categorie.id = link_categorie_jeux.id_categorie INNER JOIN jeux ON link_categorie_jeux.id_jeux = jeux.id WHERE jeux.nom = '$nom';");
      $req2->execute();
      $tmp2= $req2->fetch();
      $categorie = $tmp2['nom_categorie'];
      $tmp2 = $req2->fetch();

      while($tmp2){
          $categorie = $categorie . ', ' . $tmp2['nom_categorie'];
          $tmp2 = $req2->fetch();
      }

      if( ($tmp != $nom) ){
        $in = FALSE;
        $tmp  = $nom;
      }

  if((!$in)){
    ?>
  </br></br><a href="home.php"><img src="<?=$nom?>.jpg" alt="Image" height="80" width = "80"> </a><br/>
   <?php
     $in = TRUE;
     echo("<b>$nom</b></br></br>");
     echo("Par $editeur - $prix euros</br></br>");
     echo ("$categorie</br>");
    }

    $line = $req->fetch();
    }
     ?>



  </body>
</html>
