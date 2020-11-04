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
    <option value="search.php">prix</option>
    </select><br/><br/>

    <?php
      /********Query for note sorting**********************/
      $recherche = strtolower($_SESSION['recherche']);
      $db = new PDO("mysql:host=localhost;dbname=projetifd;charset=utf8","root","");
      $req = $db->prepare("SELECT DISTINCT jeux.nom,prix,editeur,nom_categorie FROM jeux INNER JOIN link_categorie_jeux ON jeux.id = link_categorie_jeux.id_jeux INNER JOIN categorie ON categorie.id = link_categorie_jeux.id_categorie INNER JOIN critiques ON critiques.id_jeu = jeux.id WHERE ('$recherche' = jeux.nom OR '$recherche' = jeux.editeur OR '$recherche' = categorie.nom_categorie) ORDER BY (SELECT AVG(note) FROM critiques WHERE critiques.id_jeu = jeux.id) DESC;");
      $req->execute();
      $line = $req->fetch();

     /******************Displaying results**********************************/

      $in = FALSE; //To avoid displaying the same game several times
      $tmp = NULL;
      while($line){
          $nom = strtolower($line['nom']);
          $editeur = strtolower($line['editeur']);
          $prix = strtolower($line['prix']);

          /************Query for getting the game's categories**************/
          $req2 = $db->prepare("SELECT nom_categorie FROM categorie INNER JOIN link_categorie_jeux ON categorie.id = link_categorie_jeux.id_categorie INNER JOIN jeux ON link_categorie_jeux.id_jeux = jeux.id WHERE jeux.nom = '$nom';");
          $req2->execute();
          $tmp2= $req2->fetch();
          $categorie = $tmp2['nom_categorie'];
          $tmp2 = $req2->fetch();

          /************Concatenating categories' name**********************/
          while($tmp2){
              $categorie = $categorie . ', ' . $tmp2['nom_categorie'];
              $tmp2 = $req2->fetch();
          }

          /*********Query for getting the average note*********************/
            $req3 = $db->prepare("SELECT DISTINCT AVG(note) as average FROM critiques INNER JOIN jeux ON critiques.id_jeu = jeux.id WHERE jeux.nom = '$nom' ;  ");
            $req3->execute();
            $tmp3 = $req3->fetch();

          /************Checking if a game has already been displayed******/
          if( ($tmp != $nom) ){
            $in = FALSE;
            $tmp  = $nom;
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

    $line = $req->fetch();
    }
  ?>

    </body>
  </html>
