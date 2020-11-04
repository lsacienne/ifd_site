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
    <option value="search.php">prix</option>
    <option value="note_sorting.php">note</option>
    </select><br/><br/>
    <?php

    /********Query by default (sorted by price)*************************/
    if(isSet($_POST["recherche"] )){
       $recherche = strtolower($_POST['recherche']);
        $_SESSION['recherche'] = strtolower($_POST['recherche']);
     }
    else $recherche = $_SESSION['recherche'];

    $db = new PDO("mysql:host=localhost;dbname=projetifd;charset=utf8","root","");
    /**************Games query*******************************************/
    $jeux = $db->prepare("SELECT nom,prix,editeur,nom_categorie FROM jeux INNER JOIN link_categorie_jeux ON jeux.id = link_categorie_jeux.id_jeux INNER JOIN categorie ON categorie.id = link_categorie_jeux.id_categorie  WHERE ('$recherche' = jeux.nom OR '$recherche' = jeux.editeur OR '$recherche' = categorie.nom_categorie) ORDER BY jeux.prix;");
    $jeux->execute();
    $line = $jeux->fetch();

    /**************Users query*******************************************/
    $users = $db->prepare("SELECT id,pseudo,nom,prenom FROM utilisateur WHERE ('$recherche' = utilisateur.pseudo OR '$recherche' = utilisateur.prenom OR '$recherche' = utilisateur.nom);");
    $users->execute();
    $tmp = $users->fetch();

    /******************Displaying results**********************************/

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
      </br></br><a href="home.php"><img src="<?=$nom?>.jpg" alt="Image" height="80" width = "80"> </a><br/>
      <?php
        $in = TRUE;
        echo('<b>'. $nom . '</b>' . ' - ' . round($tmp3['average'],1) . '/10' . '</br></br>');
        echo("Par $editeur - $prix euros</br></br>");
        echo ("$categorie</br>");
      }
      $line = $jeux->fetch();

    }

    /***********Displaying user********************/

    while($tmp){
      $pseudo = $tmp['pseudo'];
      $nom = $tmp['nom'];
      $prenom = $tmp['prenom'];

      ?>
      <a href="profile.php?id=<?=$tmp['id']?>"><?=$pseudo?> </a>
      <?php
      echo ("- $prenom $nom</br></br>");
      $tmp = $users->fetch();
    }
    ?>

  </body>
</html>
