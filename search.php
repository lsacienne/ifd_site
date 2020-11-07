<!DOCTYPE html>
<html lang="en" dir="ltr" class="cover">
  <head>
    <meta charset="utf-8">
    <title>Critiques</title>
  </head>
  <body>
    <?php
      include 'header.php';
      if(isSet($_POST["recherche"] )){
         $recherche = strtolower($_POST['recherche']);
          $_SESSION['recherche'] = strtolower($_POST['recherche']);
       }
      else $recherche = $_SESSION['recherche'];

      $db = new PDO("mysql:host=localhost;dbname=projetifd;charset=utf8","root","");

    ?>
    <div class="corps">
        <h2>Résultats</h2>

        <form method="post" action="search.php" onChange="submit()">
        <label for="tris">Trier par:</label>
        <select name="tris">
        <option <?php if(empty($_POST['tris']) || $_POST['tris'] == "prix") echo "selected";?> value="prix">prix</option>
        <option <?php if(!empty($_POST['tris']) && $_POST['tris'] == "note") echo "selected";?> value="note">note</option>
        </select><br/><br/>
        </form>
            <?php

            if(!empty($_POST['tris'])) $t = $_POST['tris'];

            /**************Games sorted by price*******************************************/

            if(empty($t) || $t == "prix"){
              $jeux = $db->prepare("SELECT nom,prix,editeur,nom_categorie FROM jeux INNER JOIN link_categorie_jeux ON jeux.id = link_categorie_jeux.id_jeux INNER JOIN categorie ON categorie.id = link_categorie_jeux.id_categorie  WHERE ('$recherche' = jeux.nom OR '$recherche' = jeux.editeur OR '$recherche' = categorie.nom_categorie OR '$recherche' = substr(jeux.nom,0,3)) ORDER BY jeux.prix;");
              $jeux->execute();
              $line = $jeux->fetch();
            }


            /********Games sorted by note**********************/
            if(!empty($t) && $t == "note"){

              $jeux = $db->prepare("SELECT DISTINCT jeux.nom,prix,editeur,nom_categorie FROM jeux INNER JOIN link_categorie_jeux ON jeux.id = link_categorie_jeux.id_jeux INNER JOIN categorie ON categorie.id = link_categorie_jeux.id_categorie INNER JOIN critiques ON critiques.id_jeu = jeux.id WHERE ('$recherche' = jeux.nom OR '$recherche' = jeux.editeur OR '$recherche' = categorie.nom_categorie) ORDER BY (SELECT AVG(note) FROM critiques WHERE critiques.id_jeu = jeux.id) DESC;");
              $jeux->execute();
              $line = $jeux->fetch();
          }



        /**************Users query*******************************************/
        $users = $db->prepare("SELECT id,pseudo,nom,prenom FROM utilisateur WHERE ('$recherche' = utilisateur.pseudo OR '$recherche' = utilisateur.prenom OR '$recherche' = utilisateur.nom);");
        $users->execute();
        $tmp2 = $users->fetch();

        /******************Displaying results**********************************/
        if($recherche != ""){
        $in = FALSE; //To avoid displaying the same game several times
        $test = NULL; //To avoid displaying the same game several times
        while($line){
            $nom = $line['nom'];
            $editeur = $line['editeur'];
            $prix = $line['prix'];

            /************Query for getting the game's categories**************/
            $categories = $db->prepare("SELECT nom_categorie FROM categorie INNER JOIN link_categorie_jeux ON categorie.id = link_categorie_jeux.id_categorie INNER JOIN jeux ON link_categorie_jeux.id_jeux = jeux.id WHERE jeux.nom = '$nom';");
            $categories->execute();
            $tmp3= $categories->fetch();
            $categorie = $tmp3['nom_categorie'];
            $tmp3 = $categories->fetch();

            /************Concatenating categories' name**********************/
            while($tmp3){
              $categorie = $categorie . ', ' . $tmp3['nom_categorie'];
              $tmp3 = $categories->fetch();
            }

            /*********Query for getting the average note*********************/
              $avgnote = $db->prepare("SELECT DISTINCT AVG(note) as average FROM critiques INNER JOIN jeux ON critiques.id_jeu = jeux.id WHERE jeux.nom = '$nom';  ");
              $avgnote->execute();
              $tmp = $avgnote->fetch();

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
            echo('<b>'. $nom . '</b>' . ' - ' . round($tmp['average'],1) . '/10' . '</br>');
            echo("Par $editeur - $prix euros</br>");
            echo ("$categorie</br>");
          }
          $line = $jeux->fetch();


        }

        /***********Displaying user********************/

        while($tmp2){
          $pseudo = $tmp2['pseudo'];
          $nom = $tmp2['nom'];
          $prenom = $tmp2['prenom'];

          ?>
          <br /><a href="profile.php?id=<?=$tmp2['id']?>"><?=$pseudo?> </a>
          <?php
          echo ("- $prenom $nom");
          $tmp2 = $users->fetch();
        }
      }
        ?>
    </div>
  </body>
</html>
